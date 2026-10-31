@extends('layouts.customer')

@section('title', 'Profil Saya - PetCare')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-1">Profil Saya</h2>
    <p class="text-muted mb-0">
        Kelola foto profil akun PetCare kamu.
    </p>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        <div class="text-center mb-4">

            @if ($customer->foto)
                <img
                    src="{{ asset('storage/' . $customer->foto) }}"
                    alt="Foto {{ $customer->nama }}"
                    class="profile-preview mb-3"
                >
            @else
                <div class="profile-placeholder mx-auto mb-3">
                    <i class="bi bi-person-fill"></i>
                </div>
            @endif

            <h5 class="fw-bold mb-1">
                {{ $customer->nama }}
            </h5>

            <p class="text-muted mb-0">
                {{ $customer->email }}
            </p>

        </div>

        {{-- Upload Foto --}}
        <form
            action="{{ route('customer.profile.update') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="foto" class="form-label fw-semibold">
                    Foto Profil
                </label>

                <input
                    type="file"
                    name="foto"
                    id="foto"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp"
                    required
                >

                <small class="text-muted">
                    Format JPG, JPEG, PNG, atau WebP. Maksimal 2 MB.
                </small>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="bi bi-upload me-1"></i>
                Simpan Foto
            </button>
        </form>

        {{-- Hapus Foto --}}
        @if ($customer->foto)
            <hr class="my-4">

            <form
                action="{{ route('customer.profile.photo.destroy') }}"
                method="POST"
                onsubmit="return confirm('Yakin ingin menghapus foto profil?')"
            >
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-trash me-1"></i>
                    Hapus Foto
                </button>
            </form>
        @endif

    </div>
</div>

<style>
    .profile-preview,
    .profile-placeholder {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #d1fae5;
    }

    .profile-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #dcfce7;
        color: #198754;
        font-size: 58px;
    }
</style>

@endsection