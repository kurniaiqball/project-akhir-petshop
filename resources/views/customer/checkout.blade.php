@extends('layouts.customer')

@section('title', 'Checkout - PetCare')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-1">Checkout</h2>
    <p class="text-muted mb-0">
        Periksa pesanan sebelum menyelesaikan transaksi.
    </p>
</div>

<div class="row g-4">

    <div class="col-lg-8">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <h5 class="fw-bold mb-4">
                    Detail Pesanan
                </h5>

                @foreach($cart as $item)

                    <div class="d-flex justify-content-between mb-3">

                        <div>
                            <div class="fw-semibold">
                                {{ $item['nama_product'] }}
                            </div>

                            <small class="text-muted">
                                {{ $item['jumlah'] }} ×
                                Rp {{ number_format($item['harga'], 0, ',', '.') }}
                            </small>
                        </div>

                        <div class="fw-semibold">
                            Rp {{ number_format(
                                $item['harga'] * $item['jumlah'],
                                0,
                                ',',
                                '.'
                            ) }}
                        </div>

                    </div>

                @endforeach

                <hr>

                <div class="d-flex justify-content-between">

                    <span class="fw-bold">
                        Total
                    </span>

                    <span class="fw-bold text-success fs-5">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </span>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <h5 class="fw-bold mb-3">
                    Data Customer
                </h5>

                <div class="mb-3">
                    <small class="text-muted d-block">
                        Nama
                    </small>

                    <span class="fw-semibold">
                        {{ $customer->nama }}
                    </span>
                </div>

                <div class="mb-3">
                    <small class="text-muted d-block">
                        Email
                    </small>

                    <span class="fw-semibold">
                        {{ $customer->email }}
                    </span>
                </div>

                <div class="mb-4">
                    <small class="text-muted d-block">
                        No. HP
                    </small>

                    <span class="fw-semibold">
                        {{ $customer->no_hp ?? '-' }}
                    </span>
                </div>

                <form action="{{ route('customer.checkout.process') }}"
                      method="POST">

                    @csrf

                    <button type="submit"
                            class="btn btn-success w-100">

                        <i class="bi bi-check-circle me-1"></i>
                        Buat Pesanan

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection