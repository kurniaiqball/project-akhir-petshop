
@extends('layouts.admin')

@section('title', 'Edit Kategori - PetCare')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-1">Edit Kategori</h2>
    <p class="text-muted mb-0">
        Perbarui informasi kategori.
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
            action="{{ route('admin.categories.update', $category) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_category"
                    class="form-control"
                    value="{{ old('nama_category', $category->nama_category) }}"
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
                    Update
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
