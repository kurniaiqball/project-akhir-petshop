@extends('layouts.admin')

@section('title', 'Detail Produk - PetCare')

@section('page-title', 'Detail Produk')

@section('page-description')
    Informasi lengkap produk.
@endsection


@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-body">

        <div class="row">

            <div class="col-md-4">

                @if ($product->gambar)

                    <img
                        src="{{ asset('storage/' . $product->gambar) }}"
                        class="img-fluid rounded"
                    >

                @else

                    <div
                        class="bg-light rounded d-flex align-items-center justify-content-center"
                        style="height: 300px;"
                    >
                        <span class="fs-1">🐾</span>
                    </div>

                @endif

            </div>


            <div class="col-md-8">

                <span class="badge text-bg-success mb-2">

                    {{ $product->category->nama_category ?? '-' }}

                </span>


                <h2 class="fw-bold">

                    {{ $product->nama_product }}

                </h2>


                <h4 class="text-success fw-bold">

                    Rp {{ number_format($product->harga, 0, ',', '.') }}

                </h4>


                <p class="mt-3">

                    {{ $product->deskripsi ?: 'Tidak ada deskripsi.' }}

                </p>


                <div class="mb-4">

                    <strong>
                        Stok:
                    </strong>

                    @if ($product->stok > 0)

                        <span class="badge text-bg-success">
                            {{ $product->stok }}
                        </span>

                    @else

                        <span class="badge text-bg-danger">
                            Habis
                        </span>

                    @endif

                </div>


                <div class="d-flex gap-2">

                    <a
                        href="{{ route('admin.products.edit', $product) }}"
                        class="btn btn-warning"
                    >
                        <i class="bi bi-pencil me-1"></i>
                        Edit
                    </a>

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="btn btn-secondary"
                    >
                        Kembali
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection