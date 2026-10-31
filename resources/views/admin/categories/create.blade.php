
@extends('layouts.admin')

@section('title', 'Tambah Kategori - PetCare')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-1">Tambah Kategori</h2>
    <p class="text-muted mb-0">
        Tambahkan kategori produk baru.
    </p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('admin.categories.store') }}"
            method="POST"
        >
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_category"
                    class="form-control"
                    value="{{ old('nama_category') }}"
                    placeholder="Contoh: Makanan"
                    required
                >
            </div>

            <div class="d-flex gap-2">
                <a
                    href="{{ route('admin.categories.index') }}"
                    class="btn btn-outline-secondary"
                >
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>
                    Simpan
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
