
@extends('layouts.admin')

@section('title', 'Edit Produk - PetCare')

@section('page-title', 'Edit Produk')

@section('page-description')
    Perbarui informasi produk.
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


        {{-- FORM EDIT PRODUK --}}
        <form
            action="{{ route('admin.products.update', $product) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


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
                            value="{{ old('nama_product', $product->nama_product) }}"
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


                        {{-- PREVIEW GAMBAR --}}
                        @if ($product->gambar)

                            <div class="mb-3">

                                <img
                                    src="{{ asset('storage/' . $product->gambar) }}"
                                    alt="{{ $product->nama_product }}"
                                    class="img-fluid rounded"
                                >

                            </div>

                        @endif


                        {{-- INPUT GAMBAR --}}
                        <input
                            type="file"
                            name="gambar"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <div class="form-text">
                            Kosongkan jika tidak ingin mengganti gambar.
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
                    Update Produk
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
