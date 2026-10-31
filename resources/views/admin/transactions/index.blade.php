
@extends('layouts.admin')

@section('title', 'Transaksi')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Data Transaksi</h4>
            <p class="text-muted mb-0">
                Kelola seluruh transaksi pelanggan.
            </p>
        </div>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FILTER --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.transactions.index') }}" method="GET">
                <div class="row g-3 align-items-end">

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Cari Customer</label>
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Nama customer..."
                            value="{{ request('search') }}"
                        >
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input
                            type="date"
                            name="tanggal"
                            class="form-control"
                            value="{{ request('tanggal') }}"
                        >
                    </div>

                    {{-- FILTER STATUS --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>

                            @foreach(['Pending', 'Diproses', 'Siap Diambil', 'Selesai', 'Dibatalkan'] as $status)
                                <option
                                    value="{{ $status }}"
                                    @selected(request('status') === $status)
                                >
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i>
                            Cari
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th class="px-3">ID</th>
                            <th>Customer</th>
                            <th>Produk</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($transactions as $transaction)
                            <tr>
                                {{-- ID --}}
                                <td class="px-3 fw-semibold">
                                    #{{ $transaction->id_transaction }}
                                </td>

                                {{-- CUSTOMER --}}
                                <td>
                                    {{ $transaction->customer->nama ?? '-' }}
                                </td>

                                {{-- PRODUK --}}
                                <td>
                                    @forelse($transaction->details as $detail)
                                        <div class="small">
                                            {{ $detail->product->nama_product ?? '-' }}
                                            <span class="text-muted">
                                                × {{ $detail->jumlah }}
                                            </span>
                                        </div>
                                    @empty
                                        <span class="text-muted">Tidak ada produk</span>
                                    @endforelse
                                </td>

                                {{-- TOTAL --}}
                                <td class="fw-semibold">
                                    Rp {{ number_format($transaction->total, 0, ',', '.') }}
                                </td>

                                {{-- TANGGAL --}}
                                <td>
                                    {{ $transaction->tanggal->format('d/m/Y H:i') }}
                                </td>

                                {{-- STATUS BADGE --}}
                                <td>
                                    @if($transaction->status === 'Pending')
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-clock me-1"></i>
                                            Pending
                                        </span>

                                    @elseif($transaction->status === 'Diproses')
                                        <span class="badge bg-primary">
                                            <i class="bi bi-arrow-repeat me-1"></i>
                                            Diproses
                                        </span>

                                    @elseif($transaction->status === 'Siap Diambil')
                                        <span class="badge bg-info text-dark">
                                            <i class="bi bi-bag-check me-1"></i>
                                            Siap Diambil
                                        </span>

                                    @elseif($transaction->status === 'Selesai')
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Selesai
                                        </span>

                                    @elseif($transaction->status === 'Dibatalkan')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-x-circle me-1"></i>
                                            Dibatalkan
                                        </span>

                                    @else
                                        <span class="badge bg-secondary">
                                            {{ $transaction->status }}
                                        </span>
                                    @endif
                                </td>

                                {{-- AKSI --}}
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-1">

                                        {{-- UBAH STATUS --}}
                                        <form
                                            action="{{ route('admin.transactions.status', $transaction) }}"
                                            method="POST"
                                            class="m-0"
                                        >
                                            @csrf
                                            @method('PUT')

                                            <select
                                                name="status"
                                                class="form-select form-select-sm"
                                                aria-label="Ubah status transaksi"
                                                onchange="this.form.submit()"
                                            >
                                                @foreach(['Pending', 'Diproses', 'Siap Diambil', 'Selesai', 'Dibatalkan'] as $status)
                                                    <option
                                                        value="{{ $status }}"
                                                        @selected($transaction->status === $status)
                                                    >
                                                        {{ $status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>

                                        {{-- DETAIL --}}
                                        <a
                                            href="{{ route('admin.transactions.show', $transaction) }}"
                                            class="btn btn-sm btn-outline-primary"
                                            title="Lihat detail"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.transactions.destroy', $transaction) }}"
                                            method="POST"
                                            class="m-0"
                                            onsubmit="return confirm('Yakin ingin menghapus transaksi ini? Stok produk akan dikembalikan.');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Hapus transaksi"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-receipt fs-1 d-block mb-2"></i>
                                        <p class="mb-0">Belum ada transaksi.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        @if($transactions->hasPages())
            <div class="card-footer bg-white">
                {{ $transactions->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

</div>
@endsection
