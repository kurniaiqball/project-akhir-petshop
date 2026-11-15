
@extends('layouts.admin')

@section('title', 'Detail Produk - Galaxy Petshop')

@section('page-title', 'Detail Produk')

@section('page-description')
    Informasi lengkap produk.
@endsection

@section('content')

<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-header bg-white border-0 px-4 pt-4">
        <div class="d-flex align-items-center gap-3">
            <div class="feature-icon bg-orange-soft text-orange rounded-3 p-3">
                <i class="bi bi-box-seam fs-4"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-1">Informasi Produk</h5>
                <p class="text-muted small mb-0">
                    Detail lengkap produk Galaxy Petshop.
                </p>
            </div>
        </div>
    </div>

    <div class="card-body p-4">
        <div class="row g-4">

            {{-- GAMBAR PRODUK --}}
            <div class="col-md-4">
                <div class="bg-light rounded-4 p-3 d-flex align-items-center justify-content-center"
                     style="min-height: 300px;">

                    @if ($product->gambar)
                        <img
                            src="{{ asset('storage/' . $product->gambar) }}"
                            class="img-fluid rounded-3"
                            style="max-height: 350px; object-fit: contain;"
                            alt="{{ $product->nama_product }}"
                        >
                    @else
                        <div class="text-center text-muted">
                            <i class="bi bi-image display-1"></i>
                            <p class="mb-0 mt-2">Tidak ada gambar produk</p>
                        </div>
                    @endif

                </div>
            </div>

            {{-- INFORMASI PRODUK --}}
            <div class="col-md-8">

                <span class="badge bg-orange-soft text-orange rounded-pill px-3 py-2 mb-3">
                    <i class="bi bi-tag me-1"></i>
                    {{ $product->category->nama_category ?? '-' }}
                </span>

                <h3 class="fw-bold mb-2">
                    {{ $product->nama_product }}
                </h3>

                <h4 class="text-orange fw-bold mb-4">
                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                </h4>

                <hr class="my-4">

                {{-- DESKRIPSI --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-card-text text-orange me-1"></i>
                        Deskripsi Produk
                    </label>

                    <p class="text-muted mb-0" style="line-height: 1.8;">
                        {{ $product->deskripsi ?: 'Tidak ada deskripsi.' }}
                    </p>
                </div>

                {{-- STOK --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-boxes text-orange me-1"></i>
                        Stok Produk
                    </label>

                    <div>
                        @if ($product->stok > 0)
                            <span class="badge rounded-pill px-3 py-2" style="background-color:orange;">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ $product->stok }} tersedia
                            </span>
                        @else
                            <span class="badge bg-danger rounded-pill px-3 py-2">
                                <i class="bi bi-x-circle me-1"></i>
                                Habis
                            </span>
                        @endif
                    </div>
                </div>

                <hr class="my-4">

                {{-- TOMBOL AKSI --}}
                <div class="d-flex flex-wrap gap-2">

                    <a
                        href="{{ route('admin.products.edit', $product) }}"
                        class="btn btn-orange px-4"
                    >
                        <i class="bi bi-pencil-square me-1"></i>
                        Edit Produk
                    </a>

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="btn btn-outline-orange px-4"
                    >
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                    </a>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
