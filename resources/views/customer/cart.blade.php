@extends('layouts.customer')

@section('title', 'Keranjang - PetCare')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-1">Keranjang Belanja</h2>
    <p class="text-muted mb-0">
        Periksa produk sebelum melakukan checkout.
    </p>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(empty($cart))

    <div class="card border-0 shadow-sm">
        <div class="card-body text-center p-5">

            <i class="bi bi-cart-x text-muted"
               style="font-size: 60px;"></i>

            <h5 class="fw-bold mt-3">
                Keranjang masih kosong
            </h5>

            <p class="text-muted">
                Yuk cari produk untuk hewan kesayanganmu.
            </p>

            <a href="{{ route('customer.products') }}"
               class="btn btn-success">

                <i class="bi bi-shop me-1"></i>
                Lihat Produk

            </a>

        </div>
    </div>

@else

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($cart as $item)

                            <tr>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $item['nama_product'] }}
                                    </div>
                                </td>

                                <td>
                                    Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $item['jumlah'] }}
                                </td>

                                <td class="fw-semibold">
                                    Rp {{ number_format(
                                        $item['harga'] * $item['jumlah'],
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>

                                <td>

                                    <form action="{{ route(
                                        'customer.cart.remove',
                                        $item['id_product']
                                    ) }}"
                                    method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-outline-danger">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <hr>

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <span class="text-muted">
                        Total
                    </span>

                    <h4 class="fw-bold text-success mb-0">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </h4>
                </div>

                <a href="{{ route('customer.checkout') }}"
                   class="btn btn-success btn-lg">

                    Checkout
                    <i class="bi bi-arrow-right ms-1"></i>

                </a>

            </div>

        </div>

    </div>

@endif

@endsection