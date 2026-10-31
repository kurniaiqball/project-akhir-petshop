
@extends('layouts.admin')

@section('title', 'Edit Layanan - PetCare')

@section('content')

<div class="mb-4">

    <a
        href="{{ route('admin.services.index') }}"
        class="text-decoration-none text-muted"
    >
        <i class="bi bi-arrow-left me-1"></i>
        Kembali ke Layanan
    </a>

    <h2 class="fw-bold mt-3 mb-1">
        Edit Layanan
    </h2>

    <p class="text-muted mb-0">
        Perbarui informasi layanan.
    </p>

</div>

<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        <form
            action="{{ route('admin.services.update', $service) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Nama Layanan
                </label>

                <input
                    type="text"
                    name="nama_service"
                    class="form-control @error('nama_service') is-invalid @enderror"
                    value="{{ old('nama_service', $service->nama_service) }}"
                    required
                >

                @error('nama_service')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Harga
                    </label>

                    <div class="input-group">

                        <span class="input-group-text bg-light">
                            Rp
                        </span>

                        <input
                            type="number"
                            name="harga"
                            class="form-control @error('harga') is-invalid @enderror"
                            value="{{ old('harga', $service->harga) }}"
                            min="0"
                            required
                        >

                    </div>

                    @error('harga')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Durasi
                    </label>

                    <div class="input-group">

                        <input
                            type="number"
                            name="durasi"
                            class="form-control @error('durasi') is-invalid @enderror"
                            value="{{ old('durasi', $service->durasi) }}"
                            min="1"
                            required
                        >

                        <span class="input-group-text bg-light">
                            menit
                        </span>

                    </div>

                    @error('durasi')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Deskripsi
                </label>

                <textarea
                    name="deskripsi"
                    rows="5"
                    class="form-control @error('deskripsi') is-invalid @enderror"
                >{{ old('deskripsi', $service->deskripsi) }}</textarea>

                @error('deskripsi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="d-flex gap-2">

                <a
                    href="{{ route('admin.services.index') }}"
                    class="btn btn-outline-secondary"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="bi bi-save me-1"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
