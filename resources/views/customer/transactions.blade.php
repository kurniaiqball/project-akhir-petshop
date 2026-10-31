@extends('layouts.customer')

@section('title', 'Riwayat Transaksi - PetCare')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-1">Riwayat Transaksi</h2>
    <p class="text-muted mb-0">
        Lihat transaksi pembelian produkmu.
    </p>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
    </div>
@endif

@forelse($transactions as $transaction)

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <div>
                    <h5 class="fw-bold mb-1">
                        Transaksi #{{ $transaction->id_transaction }}
                    </h5>

                    <small class="text-muted">
                        {{ $transaction->tanggal->format('d/m/Y H:i') }}
                    </small>
                </div>

             
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
        <i class="bi bi-box-seam me-1"></i>
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


            </div>

            @foreach($transaction->details as $detail)

                <div class="d-flex justify-content-between border-top py-3">

                    <div>
                        <div class="fw-semibold">
                            {{ $detail->product->nama_product }}
                        </div>

                        <small class="text-muted">
                            {{ $detail->jumlah }} ×
                            Rp {{ number_format($detail->harga, 0, ',', '.') }}
                        </small>
                    </div>

                    <div class="fw-semibold">
                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                    </div>

                </div>

            @endforeach

            <div class="border-top pt-3 text-end">

                <small class="text-muted">
                    Total
                </small>

                <h5 class="fw-bold text-success">
                    Rp {{ number_format($transaction->total, 0, ',', '.') }}
                </h5>

            </div>

        </div>

    </div>

@empty

    <div class="card border-0 shadow-sm">

        <div class="card-body text-center p-5">

            <i class="bi bi-receipt text-muted"
               style="font-size: 60px;"></i>

            <h5 class="fw-bold mt-3">
                Belum Ada Transaksi
            </h5>

            <p class="text-muted">
                Kamu belum melakukan pembelian produk.
            </p>

            <a href="{{ route('customer.products') }}"
               class="btn btn-success">

                <i class="bi bi-shop me-1"></i>
                Belanja Sekarang

            </a>

        </div>

    </div>

@endforelse

<div class="mt-4">
    {{ $transactions->links() }}
</div>

@endsection