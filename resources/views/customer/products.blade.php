@extends('layouts.customer')

@section('title', 'Produk - PetCare')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Produk Pet Shop</h2>
        <p class="text-muted mb-0">
            Temukan kebutuhan terbaik untuk hewan kesayanganmu.
        </p>
    </div>

    <a href="{{ route('customer.cart') }}"
       class="btn btn-success">
        <i class="bi bi-cart3 me-1"></i>
        Keranjang
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">

        <form method="GET"
              action="{{ route('customer.products') }}">

            <div class="input-group">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Cari produk..."
                       value="{{ request('search') }}">

                <button class="btn btn-success">
                    <i class="bi bi-search me-1"></i>
                    Cari
                </button>
            </div>

        </form>

    </div>
</div>

<div class="row g-4">

    @forelse($products as $product)

        <div class="col-md-6 col-lg-4 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                @if($product->gambar)
                    <img src="{{ asset('storage/' . $product->gambar) }}"
                         class="card-img-top"
                         style="height: 200px; object-fit: cover;">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center"
                         style="height: 200px;">

                        <i class="bi bi-box-seam text-muted"
                           style="font-size: 60px;"></i>

                    </div>
                @endif

                <div class="card-body d-flex flex-column">

                    <small class="text-success fw-semibold">
                        {{ $product->category->nama_category ?? '-' }}
                    </small>

                    <h5 class="fw-bold mt-1">
                        {{ $product->nama_product }}
                    </h5>

                    <p class="text-muted small flex-grow-1">
                        {{ Str::limit($product->deskripsi, 80) }}
                    </p>

                    <div class="fw-bold text-success mb-2">
                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                    </div>

                    <small class="text-muted mb-3">
                        Stok: {{ $product->stok }}
                    </small>

                    <form action="{{ route('customer.cart.add', $product) }}"
                          method="POST">

                        @csrf

                        <div class="input-group">

                            <input type="number"
                                   name="jumlah"
                                   class="form-control"
                                   value="1"
                                   min="1"
                                   max="{{ $product->stok }}">

                            <button type="submit"
                                    class="btn btn-success">

                                <i class="bi bi-cart-plus"></i>

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    @empty

        <div class="col-12">

            <div class="card border-0 shadow-sm">
                <div class="card-body text-center p-5">

                    <i class="bi bi-box-seam text-muted"
                       style="font-size: 60px;"></i>

                    <h5 class="fw-bold mt-3">
                        Produk tidak ditemukan
                    </h5>

                    <p class="text-muted">
                        Coba gunakan kata pencarian lain.
                    </p>

                </div>
            </div>

        </div>

    @endforelse

</div>

<div class="mt-4">
    {{ $products->links() }}
</div>

@endsection