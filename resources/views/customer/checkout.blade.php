
@extends('layouts.customer')

@section('title', 'Checkout - PetCare')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <h2 class="fw-bold mb-1" style="color: #29231f;">
        <i class="bi bi-receipt me-2" style="color: #f58220;"></i>
        Checkout
    </h2>

    <p class="text-muted mb-0">
        Periksa pesanan sebelum menyelesaikan transaksi.
    </p>
</div>

<div class="row g-3 g-lg-4">

    {{-- DETAIL PESANAN --}}
    <div class="col-12 col-lg-8">

        <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-body p-3 p-md-4">

                <div class="d-flex align-items-center justify-content-between mb-4">

                    <div>
                        <h5 class="fw-bold mb-1" style="color: #29231f;">
                            Detail Pesanan
                        </h5>

                        <small class="text-muted">
                            Periksa kembali produk yang kamu pesan.
                        </small>
                    </div>

                    <span class="badge rounded-pill px-3 py-2"
                          style="background-color: #fff2e6; color: #d96812;">
                        {{ count($cart) }} Produk
                    </span>

                </div>

                {{-- DAFTAR PRODUK --}}
                @foreach($cart as $item)

                    <div class="d-flex justify-content-between align-items-start gap-3 mb-3">

                        <div class="flex-grow-1">

                            <div class="fw-semibold mb-1"
                                 style="color: #29231f;">

                                {{ $item['nama_product'] }}

                            </div>

                            <small class="text-muted">
                                {{ $item['jumlah'] }} ×
                                Rp {{ number_format($item['harga'], 0, ',', '.') }}
                            </small>

                        </div>

                        <div class="fw-semibold text-nowrap"
                             style="color: #29231f;">

                            Rp {{ number_format(
                                $item['harga'] * $item['jumlah'],
                                0,
                                ',',
                                '.'
                            ) }}

                        </div>

                    </div>

                    @if(!$loop->last)
                        <hr class="my-3">
                    @endif

                @endforeach

                <hr class="my-4">

                {{-- TOTAL --}}
                <div class="d-flex justify-content-between align-items-center gap-2">

                    <div>
                        <span class="text-muted small">
                            Total Pembayaran
                        </span>

                        <h5 class="fw-bold mb-0" style="color: #29231f;">
                            Total
                        </h5>
                    </div>

                    <h4 class="fw-bold mb-0 text-end"
                        style="color: #f58220;">

                        Rp {{ number_format($total, 0, ',', '.') }}

                    </h4>

                </div>

            </div>

        </div>

    </div>

    {{-- DATA CUSTOMER --}}
    <div class="col-12 col-lg-4">

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body p-3 p-md-4">

                <div class="mb-4">

                    <h5 class="fw-bold mb-1" style="color: #29231f;">
                        <i class="bi bi-person-circle me-2"
                           style="color: #f58220;"></i>
                        Data Customer
                    </h5>

                    <small class="text-muted">
                        Informasi pemesan.
                    </small>

                </div>

                {{-- NAMA --}}
                <div class="mb-3">

                    <small class="text-muted d-block mb-1">
                        Nama
                    </small>

                    <div class="fw-semibold text-break"
                         style="color: #29231f;">

                        {{ $customer->nama }}

                    </div>

                </div>

                {{-- EMAIL --}}
                <div class="mb-3">

                    <small class="text-muted d-block mb-1">
                        Email
                    </small>

                    <div class="fw-semibold text-break"
                         style="color: #29231f;">

                        {{ $customer->email }}

                    </div>

                </div>

                {{-- NO HP --}}
                <div class="mb-4">

                    <small class="text-muted d-block mb-1">
                        No. HP
                    </small>

                    <div class="fw-semibold"
                         style="color: #29231f;">

                        {{ $customer->no_hp ?? '-' }}

                    </div>

                </div>

                <hr class="my-4">

                {{-- INFORMASI --}}
                <div class="rounded-3 p-3 mb-4"
                     style="background-color: #fff2e6;">

                    <div class="d-flex gap-2">

                        <i class="bi bi-info-circle"
                           style="color: #d96812;"></i>

                        <small style="color: #8f4a13;">
                            Pastikan data customer dan pesanan sudah benar sebelum membuat pesanan.
                        </small>

                    </div>

                </div>

                {{-- FORM CHECKOUT --}}
                <form action="{{ route('customer.checkout.process') }}"
                      method="POST">

                    @csrf

                    <button type="submit"
                            class="btn text-white w-100 py-2 fw-semibold"
                            style="background-color: #f58220; border-color: #f58220;">

                        <i class="bi bi-check-circle me-1"></i>
                        Buat Pesanan

                    </button>

                </form>

                <a href="{{ route('customer.cart') }}"
                   class="btn btn-outline-secondary w-100 mt-2">

                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali ke Keranjang

                </a>

            </div>

        </div>

    </div>

</div>

@endsection
