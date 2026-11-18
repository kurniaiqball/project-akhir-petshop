
@extends('layouts.customer')

@section('title', 'Produk - PetCare')

@section('content')

{{-- HEADER --}}
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">

    <div>
        <h2 class="fw-bold mb-1" style="color: #29231f;">
            <i class="bi bi-shop me-2" style="color: #f58220;"></i>
            Produk Pet Shop
        </h2>

        <p class="text-muted mb-0">
            Temukan kebutuhan terbaik untuk hewan kesayanganmu.
        </p>
    </div>

    <a href="{{ route('customer.cart') }}"
       class="btn text-white px-4 py-2 align-self-start align-self-sm-center text-nowrap"
       style="background-color: #f58220; border-color: #f58220;">

        <i class="bi bi-cart3 me-1"></i>
        Keranjang
    </a>

</div>

{{-- NOTIFIKASI SUKSES --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">

        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"></button>

    </div>
@endif

{{-- NOTIFIKASI ERROR --}}
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">

        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"></button>

    </div>
@endif

{{-- PENCARIAN --}}
<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-body p-3 p-md-4">

        <form method="GET" action="{{ route('customer.products') }}">

            <div class="input-group">

                <input type="text"
                       name="search"
                       class="form-control py-2"
                       placeholder="Cari nama produk..."
                       value="{{ request('search') }}">

                <button type="submit"
                        class="btn text-white px-3 px-md-4"
                        style="background-color: #f58220; border-color: #f58220;">

                    <i class="bi bi-search me-1"></i>
                    <span class="d-none d-sm-inline">Cari</span>

                </button>

            </div>

        </form>

    </div>

</div>

{{-- DAFTAR PRODUK --}}
<div class="row g-3 g-md-4">

    @forelse($products as $product)

        <div class="col-6 col-md-6 col-lg-4 col-xl-3">

            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">

                {{-- FOTO PRODUK --}}
                @if($product->gambar)

                    <img src="{{ asset('storage/' . $product->gambar) }}"
                         alt="{{ $product->nama_product }}"
                         class="card-img-top"
                         style="height: 180px; object-fit: cover;">

                @else

                    <div class="bg-light d-flex align-items-center justify-content-center"
                         style="height: 180px;">

                        <i class="bi bi-box-seam text-secondary"
                           style="font-size: 55px;"></i>

                    </div>

                @endif

                {{-- INFORMASI PRODUK --}}
                <div class="card-body d-flex flex-column p-3">

                    <small class="fw-semibold mb-1"
                           style="color: #d96812;">

                        {{ $product->category->nama_category ?? '-' }}

                    </small>

                    <h6 class="fw-bold mb-2"
                        style="color: #29231f;">

                        {{ $product->nama_product }}

                    </h6>

                    <p class="text-muted small mb-3 flex-grow-1">

                        {{ Str::limit($product->deskripsi, 70) }}

                    </p>

                    {{-- HARGA --}}
                    <div class="fw-bold mb-2"
                         style="color: #f58220;">

                        Rp {{ number_format($product->harga, 0, ',', '.') }}

                    </div>

                    {{-- STOK --}}
                    <div class="mb-3">

                        <small class="text-muted">
                            <i class="bi bi-box-seam me-1"></i>
                            Stok: {{ $product->stok }}
                        </small>

                    </div>

                    {{-- TAMBAH KE KERANJANG --}}
                    <form action="{{ route('customer.cart.add', $product) }}"
                          method="POST">

                        @csrf

                        <div class="input-group">

                            <input type="number"
                                   name="jumlah"
                                   class="form-control"
                                   value="1"
                                   min="1"
                                   max="{{ $product->stok }}"
                                   aria-label="Jumlah produk">

                            <button type="submit"
                                    class="btn text-white"
                                    style="background-color: #f58220; border-color: #f58220;"
                                    title="Tambah ke keranjang">

                                <i class="bi bi-cart-plus"></i>

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    @empty

        {{-- PRODUK KOSONG --}}
        <div class="col-12">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body text-center py-5 px-3">

                    <i class="bi bi-search"
                       style="font-size: 60px; color: #f58220;"></i>

                    <h5 class="fw-bold mt-3"
                        style="color: #29231f;">

                        Produk Tidak Ditemukan

                    </h5>

                    <p class="text-muted mb-4">
                        Coba gunakan kata pencarian lain.
                    </p>

                    @if(request('search'))

                        <a href="{{ route('customer.products') }}"
                           class="btn text-white px-4"
                           style="background-color: #f58220; border-color: #f58220;">

                            <i class="bi bi-arrow-counterclockwise me-1"></i>
                            Tampilkan Semua Produk

                        </a>

                    @endif

                </div>

            </div>

        </div>

    @endforelse

</div>

{{-- PAGINATION --}}
@if($products->hasPages())

    <div class="mt-4">
        {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
    </div>

@endif

@endsection
