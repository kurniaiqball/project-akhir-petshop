
@extends('layouts.admin')

@section('title', 'Tambah Produk - Galaxy Petshop')

@section('page-title', 'Tambah Produk')

@section('page-description')
    Tambahkan produk baru ke dalam sistem.
@endsection

@section('content')

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-header bg-white border-0 pt-4 px-4">
        <div class="d-flex align-items-center gap-3">
            <div class="feature-icon bg-orange-soft text-orange rounded-3 p-3">
                <i class="bi bi-box-seam fs-4"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-1">Form Tambah Produk</h5>
                <p class="text-muted small mb-0">
                    Lengkapi informasi produk di bawah ini.
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

        {{-- FORM TAMBAH PRODUK --}}
        <form
            action="{{ route('admin.products.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

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
                            value="{{ old('nama_product') }}"
                            placeholder="Contoh: Royal Canin Adult"
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
                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id_category }}"
                                    @selected(old('id_category') == $category->id_category)
                                >
                                    {{ $category->nama_category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- HARGA DAN STOK --}}
                    <div class="row">
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
                                        value="{{ old('harga') }}"
                                        min="0"
                                        placeholder="Contoh: 50000"
                                        required
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Stok
                                </label>

                                <input
                                    type="number"
                                    name="stok"
                                    class="form-control"
                                    value="{{ old('stok', 0) }}"
                                    min="0"
                                    placeholder="Jumlah stok"
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
                            placeholder="Deskripsi produk..."
                        >{{ old('deskripsi') }}</textarea>
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
                            <div class="text-center mb-3">
                                <div class="feature-icon bg-orange-soft text-orange rounded-3 p-3 d-inline-flex">
                                    <i class="bi bi-image fs-2"></i>
                                </div>
                                <p class="fw-semibold mt-2 mb-1">
                                    Upload Gambar
                                </p>
                                <small class="text-muted">
                                    Pilih gambar produk
                                </small>
                            </div>

                            <input
                                type="file"
                                name="gambar"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                            >

                            <div class="form-text mt-2">
                                Format JPG, JPEG, PNG, atau WEBP.
                                Maksimal 2 MB.
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <hr class="my-4">

            {{-- TOMBOL AKSI --}}
            <div class="d-flex flex-wrap gap-2 justify-content-between">
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
                    Simpan Produk
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
