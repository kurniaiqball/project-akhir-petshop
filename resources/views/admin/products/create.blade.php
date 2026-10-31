
@extends('layouts.admin')

@section('title', 'Tambah Produk - PetCare')

@section('page-title', 'Tambah Produk')

@section('page-description')
    Tambahkan produk baru ke dalam sistem.
@endsection

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-body">

        {{-- ALERT ERROR --}}
        @if ($errors->any())

            <div class="alert alert-danger" role="alert">

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

            <div class="row">

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

                        {{-- HARGA --}}
                        <div class="col-md-6">

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Harga
                                </label>

                                <input
                                    type="number"
                                    name="harga"
                                    class="form-control"
                                    value="{{ old('harga') }}"
                                    min="0"
                                    required
                                >

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
                                    value="{{ old('stok', 0) }}"
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

                        <input
                            type="file"
                            name="gambar"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <div class="form-text">
                            Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        </div>

                    </div>

                </div>

            </div>


            <hr>


            {{-- TOMBOL AKSI --}}
            <div class="d-flex gap-2">

                <a
                    href="{{ route('admin.products.index') }}"
                    class="btn btn-outline-secondary"
                >
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="bi bi-save me-1"></i>
                    Simpan Produk
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
