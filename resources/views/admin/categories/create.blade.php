
@extends('layouts.admin')

@section('title', 'Tambah Kategori - Galaxy Petshop')

@section('page-title', 'Tambah Kategori')

@section('page-description')
    Tambahkan kategori produk baru ke Galaxy Petshop.
@endsection

@section('content')

<style>
    .category-card {
        border: none;
        border-radius: 15px;
    }

    .form-control {
        border-radius: 10px;
        padding: 11px 14px;
    }

    .form-control:focus {
        border-color: #ff922b;
        box-shadow: 0 0 0 0.2rem rgba(255, 146, 43, 0.15);
    }

    .btn-orange {
        background-color: #ff922b;
        border-color: #ff922b;
        color: white;
        border-radius: 10px;
    }

    .btn-orange:hover {
        background-color: #f07812;
        border-color: #f07812;
        color: white;
    }

    .btn-outline-secondary {
        border-radius: 10px;
    }
</style>

<div class="card category-card shadow-sm">

    <div class="card-body p-4">

        {{-- HEADER FORM --}}
        <div class="d-flex align-items-center mb-4">

            <div class="rounded-3 p-3 me-3"
                 style="background-color: #fff0df; color: #ff922b;">

                <i class="bi bi-tags fs-3"></i>

            </div>

            <div>
                <h5 class="fw-bold mb-1">
                    Informasi Kategori
                </h5>

                <p class="text-muted small mb-0">
                    Isi nama kategori yang ingin ditambahkan.
                </p>
            </div>

        </div>

        {{-- ERROR --}}
        @if($errors->any())

            <div class="alert alert-danger alert-dismissible fade show">

                <div class="fw-semibold mb-2">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    Terjadi kesalahan:
                </div>

                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>

            </div>

        @endif

        {{-- FORM --}}
        <form
            action="{{ route('admin.categories.store') }}"
            method="POST"
        >

            @csrf

            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_category"
                    class="form-control @error('nama_category') is-invalid @enderror"
                    value="{{ old('nama_category') }}"
                    placeholder="Contoh: Makanan, Vitamin, Aksesoris"
                    required
                >

                @error('nama_category')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <hr class="my-4">

            {{-- TOMBOL --}}
            <div class="d-flex gap-2">

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="btn btn-outline-secondary px-4"
                >
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>

                <button
                    type="submit"
                    class="btn btn-orange px-4"
                >
                    <i class="bi bi-save me-1"></i>
                    Simpan Kategori
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
