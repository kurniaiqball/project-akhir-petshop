
@extends('layouts.admin')

@section('title', 'Detail Produk - PetCare')

@section('page-title', 'Detail Produk')

@section('page-description')
    Informasi lengkap produk.
@endsection

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="row g-4">

            {{-- Gambar Produk --}}
            <div class="col-md-4">
                @if ($product->gambar)
                    <img
                        src="{{ asset('storage/' . $product->gambar) }}"
                        class="img-fluid rounded"
                        alt="{{ $product->nama_product }}"
                    >
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center p-5">
                        <i class="bi bi-image text-secondary display-1"></i>
                    </div>
                @endif
            </div>

            {{-- Informasi Produk --}}
            <div class="col-md-8">

                <span class="badge bg-success mb-2">
                    {{ $product->category->nama_category ?? '-' }}
                </span>

                <h4 class="fw-bold mb-2">
                    {{ $product->nama_product }}
                </h4>

                <h5 class="text-success fw-bold mb-3">
                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                </h5>

                <hr>

                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Deskripsi Produk
                    </label>

                    <p class="text-muted mb-0">
                        {{ $product->deskripsi ?: 'Tidak ada deskripsi.' }}
                    </p>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Stok Produk
                    </label>

                    <div>
                        @if ($product->stok > 0)
                            <span class="badge bg-success">
                                {{ $product->stok }} tersedia
                            </span>
                        @else
                            <span class="badge bg-danger">
                                Habis
                            </span>
                        @endif
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a
                        href="{{ route('admin.products.edit', $product) }}"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-pencil-square me-1"></i>
                        Edit Produk
                    </a>

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="btn btn-outline-secondary"
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
