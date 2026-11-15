
@extends('layouts.admin')

@section('title', 'Edit Produk - Galaxy Petshop')

@section('page-title', 'Edit Produk')

@section('page-description')
    Perbarui informasi produk.
@endsection

@section('content')

<div class="card shadow-sm border-0 rounded-4 overflow-hidden">

    {{-- HEADER CARD --}}
    <div class="card-header bg-white border-0 px-4 pt-4">
        <div class="d-flex align-items-center gap-3">
            <div class="feature-icon bg-orange-soft text-orange rounded-3 p-3">
                <i class="bi bi-pencil-square fs-4"></i>
            </div>

            <div>
                <h5 class="fw-bold mb-1">Form Edit Produk</h5>
                <p class="text-muted small mb-0">
                    Perbarui informasi produk Galaxy Petshop.
                </p>
            </div>
        </div>
    </div>

    <div class="card-body p-4">

        {{-- ALERT ERROR --}}
        @if ($errors->any())
            <div class="alert alert-danger rounded-3" role="alert">
                <strong>
                    <i class="bi bi-exclamation-circle me-1"></i>
                    Ada kesalahan:
                </strong>

                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM EDIT PRODUK --}}
        <form
            action="{{ route('admin.products.update', $product) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <div class="row g-4">

                {{-- KOLOM KIRI --}}
                <div class="col-md-8">

                    {{-- NAMA PRODUK --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Nama Produk
                        </label>

                        <input
                            type="text"
                            name="nama_product"
                            class="form-control"
                            value="{{ old('nama_product', $product->nama_product) }}"
                            placeholder="Masukkan nama produk"
                            required
                        >
                    </div>

                    {{-- KATEGORI --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Kategori
                        </label>

                        <select
                            name="id_category"
                            class="form-select"
                            required
                        >
                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id_category }}"
                                    @selected(
                                        old('id_category', $product->id_category) == $category->id_category
                                    )
                                >
                                    {{ $category->nama_category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- HARGA DAN STOK --}}
                    <div class="row">

                        {{-- HARGA --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Harga
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text bg-orange-soft text-orange border-end-0">
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        name="harga"
                                        class="form-control"
                                        value="{{ old('harga', $product->harga) }}"
                                        min="0"
                                        required
                                    >
                                </div>
                            </div>
                        </div>

                        {{-- STOK --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Stok
                                </label>

                                <input
                                    type="number"
                                    name="stok"
                                    class="form-control"
                                    value="{{ old('stok', $product->stok) }}"
                                    min="0"
                                    required
                                >
                            </div>
                        </div>

                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            class="form-control"
                            rows="5"
                            placeholder="Masukkan deskripsi produk..."
                        >{{ old('deskripsi', $product->deskripsi) }}</textarea>
                    </div>

                </div>

                {{-- KOLOM KANAN --}}
                <div class="col-md-4">

                    {{-- GAMBAR PRODUK --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Gambar Produk
                        </label>

                        <div class="border rounded-4 p-3 bg-light">

                            {{-- PREVIEW GAMBAR --}}
                            <div class="text-center mb-3">

                                @if ($product->gambar)

                                    <img
                                        src="{{ asset('storage/' . $product->gambar) }}"
                                        alt="{{ $product->nama_product }}"
                                        class="img-fluid rounded-3 mb-2"
                                        style="max-height: 220px; object-fit: contain;"
                                    >

                                @else

                                    <div class="py-4">
                                        <i class="bi bi-image display-3 text-secondary"></i>
                                        <p class="text-muted small mb-0 mt-2">
                                            Belum ada gambar produk
                                        </p>
                                    </div>

                                @endif

                                <p class="fw-semibold small mb-0">
                                    Gambar Saat Ini
                                </p>

                            </div>

                            <hr>

                            {{-- INPUT GAMBAR --}}
                            <label class="form-label fw-semibold small">
                                Ganti Gambar
                            </label>

                            <input
                                type="file"
                                name="gambar"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                            >

                            <div class="form-text mt-2">
                                Kosongkan jika tidak ingin mengganti gambar.
                                Format JPG, JPEG, PNG, atau WEBP.
                                Maksimal 2 MB.
                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <hr class="my-4">

            {{-- TOMBOL AKSI --}}
            <div class="d-flex flex-wrap justify-content-between gap-2">

                <a
                    href="{{ route('admin.products.index') }}"
                    class="btn btn-outline-orange"
                >
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>

                <button
                    type="submit"
                    class="btn btn-orange px-4"
                >
                    <i class="bi bi-save me-1"></i>
                    Update Produk
                </button>

            </div>

        </form>

    </div>
</div>

@endsection
