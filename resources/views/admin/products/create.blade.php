@extends('layouts.admin')

@section('title', 'Tambah Produk - PetCare')

@section('page-title', 'Tambah Produk')

@section('page-description')
    Tambahkan produk baru ke dalam sistem.
@endsection


@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-body">

        @if ($errors->any())

            <div class="alert alert-danger">

                <strong>
                    Ada kesalahan:
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('admin.products.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <div class="row">

                <div class="col-md-8">

                    <div class="mb-3">

                        <label class="form-label">
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


                    <div class="mb-3">

                        <label class="form-label">
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


                    <div class="row">

                        <div class="col-md-6">

                            <div class="mb-3">

                                <label class="form-label">
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


                        <div class="col-md-6">

                            <div class="mb-3">

                                <label class="form-label">
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


                    <div class="mb-3">

                        <label class="form-label">
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


                <div class="col-md-4">

                    <div class="mb-3">

                        <label class="form-label">
                            Gambar Produk
                        </label>

                        <input
                            type="file"
                            name="gambar"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small class="text-muted">
                            Maksimal 2 MB.
                        </small>

                    </div>

                </div>

            </div>


            <hr>


            <div class="d-flex gap-2">

                <a
                    href="{{ route('admin.products.index') }}"
                    class="btn btn-secondary"
                >
                    Kembali
                </a>

                <button
                    type="submit"
                    class="btn btn-success"
                >
                    <i class="bi bi-save me-1"></i>
                    Simpan Produk
                </button>

            </div>

        </form>

    </div>

</div>

@endsection