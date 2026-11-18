
@extends('layouts.customer')

@section('title', 'Keranjang - PetCare')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <h2 class="fw-bold mb-1" style="color: #29231f;">
        <i class="bi bi-cart3 me-2" style="color: #f58220;"></i>
        Keranjang Belanja
    </h2>

    <p class="text-muted mb-0">
        Periksa produk sebelum melakukan checkout.
    </p>
</div>

{{-- NOTIFIKASI --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3"
         role="alert">

        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-3"
         role="alert">

        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
@endif

@if(empty($cart))

    {{-- KERANJANG KOSONG --}}
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body text-center py-5 px-3 px-md-5">

            <div class="mb-3">
                <i class="bi bi-cart-x"
                   style="font-size: 65px; color: #f58220;"></i>
            </div>

            <h5 class="fw-bold mt-3"
                style="color: #29231f;">

                Keranjang Masih Kosong

            </h5>

            <p class="text-muted mb-4">
                Yuk cari produk untuk hewan kesayanganmu.
            </p>

            <a href="{{ route('customer.products') }}"
               class="btn text-white px-4 py-2"
               style="background-color: #f58220; border-color: #f58220;">

                <i class="bi bi-shop me-1"></i>
                Lihat Produk

            </a>

        </div>

    </div>

@else

    {{-- DAFTAR KERANJANG --}}
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-3 p-md-4">

            <div class="mb-3">
                <h5 class="fw-bold mb-1" style="color: #29231f;">
                    Daftar Produk
                </h5>

                <p class="text-muted small mb-0">
                    Pastikan produk dan jumlah pembelian sudah sesuai.
                </p>
            </div>

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr class="text-muted">
                            <th class="py-3">Produk</th>
                            <th class="py-3">Harga</th>
                            <th class="py-3">Jumlah</th>
                            <th class="py-3">Subtotal</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($cart as $item)

                            <tr>

                                {{-- NAMA PRODUK --}}
                                <td>
                                    <div class="fw-semibold text-nowrap"
                                         style="color: #29231f;">

                                        {{ $item['nama_product'] }}

                                    </div>
                                </td>

                                {{-- HARGA --}}
                                <td class="text-nowrap">
                                    Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                </td>

                                {{-- JUMLAH --}}
                                <td>
                                    <span class="badge rounded-2 px-3 py-2"
                                          style="background-color: #fff2e6; color: #d96812;">

                                        {{ $item['jumlah'] }}

                                    </span>
                                </td>

                                {{-- SUBTOTAL --}}
                                <td class="fw-semibold text-nowrap"
                                    style="color: #29231f;">

                                    Rp {{ number_format(
                                        $item['harga'] * $item['jumlah'],
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>

                                {{-- HAPUS PRODUK --}}
                                <td class="text-center">

                                    <form action="{{ route(
                                        'customer.cart.remove',
                                        $item['id_product']
                                    ) }}"
                                    method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Hapus produk"
                                                onclick="return confirm('Yakin ingin menghapus produk ini dari keranjang?')">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <hr class="my-4">

            {{-- TOTAL DAN CHECKOUT --}}
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                <div>
                    <span class="text-muted small">
                        Total Belanja
                    </span>

                    <h4 class="fw-bold mb-0"
                        style="color: #f58220;">

                        Rp {{ number_format($total, 0, ',', '.') }}

                    </h4>
                </div>

                <div class="d-flex flex-column flex-sm-row gap-2">

                    <a href="{{ route('customer.products') }}"
                       class="btn btn-outline-secondary px-3">

                        <i class="bi bi-arrow-left me-1"></i>
                        Lanjut Belanja

                    </a>

                    <a href="{{ route('customer.checkout') }}"
                       class="btn text-white px-4"
                       style="background-color: #f58220; border-color: #f58220;">

                        Checkout
                        <i class="bi bi-arrow-right ms-1"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>

@endif

@endsection