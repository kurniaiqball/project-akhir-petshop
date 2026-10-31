@extends('layouts.admin')

@section('title', 'Edit Produk - PetCare')

@section('page-title', 'Edit Produk')

@section('page-description')
    Perbarui informasi produk.
@endsection


@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-body">

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('admin.products.update', $product) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')


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
                            value="{{ old('nama_product', $product->nama_product) }}"
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

                            @foreach ($categories as $category)

                                <option
                                    value="{{ $category->id_category }}"
                                    @selected(
                                        old(
                                            'id_category',
                                            $product->id_category
                                        ) == $category->id_category
                                    )
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
                                    value="{{ old('harga', $product->harga) }}"
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
                                    value="{{ old('stok', $product->stok) }}"
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
                        >{{ old('deskripsi', $product->deskripsi) }}</textarea>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="mb-3">

                        <label class="form-label">
                            Gambar Produk
                        </label>

                        @if ($product->gambar)

                            <div class="mb-3">

                                <img
                                    src="{{ asset('storage/' . $product->gambar) }}"
                                    class="img-fluid rounded"
                                    style="max-height: 200px;"
                                >

                            </div>

                        @endif


                        <input
                            type="file"
                            name="gambar"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti gambar.
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
                    class="btn btn-warning"
                >
                    <i class="bi bi-save me-1"></i>
                    Update Produk
                </button>

            </div>

        </form>

    </div>

</div>

@endsection