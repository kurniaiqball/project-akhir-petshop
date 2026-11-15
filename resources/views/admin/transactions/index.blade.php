
@extends('layouts.admin')

@section('title', 'Transaksi - Galaxy Petshop')

@section('page-title', 'Data Transaksi')

@section('page-description')
    Kelola seluruh transaksi pelanggan.
@endsection

@section('content')

@push('styles')
<style>
    .transaction-card {
        border: none;
        border-radius: 15px;
    }

    .btn-orange {
        background-color: #ff922b;
        border-color: #ff922b;
        color: white;
    }

    .btn-orange:hover {
        background-color: #f07812;
        border-color: #f07812;
        color: white;
    }

    .table thead th {
        background-color: #fff3e6;
        color: #754016;
        border-bottom: 2px solid #ff922b;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .table tbody tr:hover {
        background-color: #fffaf5;
    }

    .table tbody td {
        font-size: 14px;
        vertical-align: middle;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #ff922b;
        box-shadow: 0 0 0 0.2rem rgba(255,146,43,.15);
    }

    .btn {
        border-radius: 9px;
    }

    .transaction-id {
        color: #ff922b;
        font-weight: 700;
    }

    .transaction-total {
        color: #f07812;
        font-weight: 700;
        white-space: nowrap;
    }

    .transaction-status {
        padding: 7px 11px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-width: 190px;
    }

    .action-buttons .form-select {
        width: 125px;
        font-size: 12px;
    }

    .action-buttons .btn {
        flex-shrink: 0;
    }

    .empty-icon {
        color: #ff922b;
        font-size: 40px;
    }

    @media (max-width: 768px) {
        .transaction-card .card-body {
            padding: 16px !important;
        }

        .filter-form .col-md-4,
        .filter-form .col-md-3,
        .filter-form .col-md-2 {
            width: 100%;
        }

        .filter-form button {
            width: 100%;
        }

        .table {
            min-width: 850px;
        }
    }
</style>
@endpush

{{-- NOTIFIKASI SUCCESS --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">

        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>
@endif

{{-- NOTIFIKASI ERROR --}}
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">

        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>
@endif

{{-- CARD FILTER --}}
<div class="card transaction-card shadow-sm mb-4">

    <div class="card-body p-3 p-md-4">

        <form
            action="{{ route('admin.transactions.index') }}"
            method="GET"
            class="row g-3 align-items-end filter-form"
        >

            {{-- SEARCH CUSTOMER --}}
            <div class="col-md-4">

                <label class="form-label fw-semibold">
                    Cari Customer
                </label>

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Nama customer..."
                    value="{{ request('search') }}"
                >

            </div>

            {{-- FILTER TANGGAL --}}
            <div class="col-md-3">

                <label class="form-label fw-semibold">
                    Tanggal
                </label>

                <input
                    type="date"
                    name="tanggal"
                    class="form-control"
                    value="{{ request('tanggal') }}"
                >

            </div>

            {{-- FILTER STATUS --}}
            <div class="col-md-3">

                <label class="form-label fw-semibold">
                    Status
                </label>

                <select name="status" class="form-select">

                    <option value="">
                        Semua Status
                    </option>

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

            {{-- BUTTON CARI --}}
            <div class="col-md-2">

                <button
                    type="submit"
                    class="btn btn-orange w-100"
                >
                    <i class="bi bi-search me-1"></i>
                    Cari
                </button>

            </div>

            {{-- RESET --}}
            @if(request()->filled('search') || request()->filled('tanggal') || request()->filled('status'))

                <div class="col-12">

                    <a
                        href="{{ route('admin.transactions.index') }}"
                        class="btn btn-outline-secondary btn-sm"
                    >
                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Reset Filter
                    </a>

                </div>

            @endif

        </form>

    </div>

</div>

{{-- CARD TABLE TRANSAKSI --}}
<div class="card transaction-card shadow-sm">

    <div class="card-body p-0">

        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>
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

                            {{-- ID TRANSAKSI --}}
                            <td class="px-3">
                                <span class="transaction-id">
                                    #{{ $transaction->id_transaction }}
                                </span>
                            </td>

                            {{-- CUSTOMER --}}
                            <td>
                                <div class="fw-semibold text-dark text-nowrap">
                                    {{ $transaction->customer->nama ?? '-' }}
                                </div>
                            </td>

                            {{-- PRODUK --}}
                            <td>

                                @forelse($transaction->details as $detail)

                                    <div class="small mb-1">
                                        <span class="fw-semibold">
                                            {{ $detail->product->nama_product ?? '-' }}
                                        </span>

                                        <span class="text-muted">
                                            × {{ $detail->jumlah }}
                                        </span>
                                    </div>

                                @empty

                                    <span class="text-muted small">
                                        Tidak ada produk
                                    </span>

                                @endforelse

                            </td>

                            {{-- TOTAL --}}
                            <td>
                                <span class="transaction-total">
                                    Rp {{ number_format($transaction->total, 0, ',', '.') }}
                                </span>
                            </td>

                            {{-- TANGGAL --}}
                            <td>
                                <div class="text-dark">
                                    {{ $transaction->tanggal->format('d/m/Y') }}
                                </div>

                                <small class="text-muted">
                                    {{ $transaction->tanggal->format('H:i') }}
                                </small>
                            </td>

                            {{-- STATUS --}}
                            <td>

                                @if($transaction->status === 'Pending')

                                    <span class="badge transaction-status bg-warning-subtle text-warning-emphasis">
                                        <i class="bi bi-clock me-1"></i>
                                        Pending
                                    </span>

                                @elseif($transaction->status === 'Diproses')

                                    <span class="badge transaction-status bg-primary-subtle text-primary">
                                        <i class="bi bi-arrow-repeat me-1"></i>
                                        Diproses
                                    </span>

                                @elseif($transaction->status === 'Siap Diambil')

                                    <span class="badge transaction-status bg-info-subtle text-info-emphasis">
                                        <i class="bi bi-bag-check me-1"></i>
                                        Siap Diambil
                                    </span>

                                @elseif($transaction->status === 'Selesai')

                                    <span class="badge transaction-status bg-success-subtle text-success">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Selesai
                                    </span>

                                @elseif($transaction->status === 'Dibatalkan')

                                    <span class="badge transaction-status bg-danger-subtle text-danger">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Dibatalkan
                                    </span>

                                @else

                                    <span class="badge transaction-status bg-secondary-subtle text-secondary">
                                        {{ $transaction->status }}
                                    </span>

                                @endif

                            </td>

                            {{-- AKSI --}}
                            <td>

                                <div class="action-buttons">

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

                        {{-- DATA KOSONG --}}
                        <tr>

                            <td colspan="7" class="text-center py-5">

                                <div class="d-flex flex-column align-items-center">

                                    <i class="bi bi-receipt empty-icon mb-2"></i>

                                    <p class="fw-semibold text-muted mb-1">
                                        Belum ada transaksi.
                                    </p>

                                    <small class="text-muted">
                                        Data transaksi pelanggan akan muncul di sini.
                                    </small>

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

        <div class="card-footer bg-white border-0 p-3">

            {{ $transactions->onEachSide(1)->withQueryString()->links('pagination::bootstrap-5') }}

        </div>

    @endif

</div>

@endsection
