
@extends('layouts.admin')

@section('title', 'Tambah Layanan - Galaxy Petshop')

@section('page-title', 'Tambah Layanan')

@section('page-description')
    Tambahkan layanan grooming atau perawatan baru di Galaxy Petshop.
@endsection

@section('content')

<style>
    /* ================================
       SERVICE CREATE PAGE
    ================================= */

    .service-create-page {
        width: 100%;
        min-width: 0;
    }

    .service-create-page .service-back {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 14px;
        transition: color .2s ease;
    }

    .service-create-page .service-back:hover {
        color: #f28c28 !important;
    }

    .service-create-page .service-form-card {
        border: 0;
        border-radius: 16px;
        overflow: hidden;
    }

    .service-create-page .service-form-body {
        padding: 28px;
    }

    .service-create-page .form-label {
        margin-bottom: 8px;
        font-size: 14px;
    }

    .service-create-page .form-control,
    .service-create-page .input-group-text {
        min-height: 44px;
    }

    .service-create-page textarea.form-control {
        min-height: 110px;
        resize: vertical;
    }

    .service-create-page .form-control:focus {
        border-color: #f5a04c;
        box-shadow: 0 0 0 .2rem rgba(242, 140, 40, .12);
    }

    /* FOTO PREVIEW */

    .service-create-page .preview-container {
        width: 100%;
        min-height: 170px;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        background: #fafafa;
        border: 1px dashed #d7d7d7 !important;
        border-radius: 12px;
        padding: 16px;
    }

    .service-create-page .preview-placeholder {
        text-align: center;
    }

    .service-create-page .preview-image {
        display: block;
        max-width: 100%;
        max-height: 240px;
        width: auto;
        height: auto;
        object-fit: contain;
        border-radius: 10px;
    }

    /* BUTTONS */

    .service-create-page .service-form-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .service-create-page .service-form-actions .btn {
        min-height: 42px;
    }

    /* TABLET */

    @media (max-width: 991.98px) {
        .service-create-page .service-form-body {
            padding: 24px;
        }
    }

    /* MOBILE */

    @media (max-width: 767.98px) {
        .service-create-page .service-form-body {
            padding: 18px;
        }

        .service-create-page .service-form-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: 100%;
        }

        .service-create-page .service-form-actions .btn {
            width: 100%;
            padding-left: 10px;
            padding-right: 10px;
        }

        .service-create-page .preview-container {
            min-height: 150px;
        }
    }

    /* SMALL MOBILE */

    @media (max-width: 400px) {
        .service-create-page .service-form-body {
            padding: 14px;
        }

        .service-create-page .service-form-actions {
            grid-template-columns: 1fr;
        }

        .service-create-page .service-form-actions .btn {
            width: 100%;
        }

        .service-create-page .form-label {
            font-size: 13px;
        }
    }
</style>

<div class="service-create-page">

    {{-- HEADER --}}
    <div class="mb-4">

        <a
            href="{{ route('admin.services.index') }}"
            class="text-decoration-none text-muted service-back"
        >
            <i class="bi bi-arrow-left"></i>
            Kembali ke Layanan
        </a>

    </div>

    {{-- CARD FORM --}}
    <div class="card shadow-sm service-form-card">

        <div class="card-body service-form-body">

            <form
                action="{{ route('admin.services.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                {{-- INFORMASI LAYANAN --}}
                <div class="mb-4">

                    <h5 class="fw-bold text-dark mb-1">
                        Informasi Layanan
                    </h5>

                    <p class="text-muted small mb-0">
                        Masukkan informasi layanan yang akan ditambahkan.
                    </p>

                </div>

                {{-- NAMA LAYANAN --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nama Layanan
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="nama_service"
                        class="form-control @error('nama_service') is-invalid @enderror"
                        value="{{ old('nama_service') }}"
                        placeholder="Contoh: Full Grooming"
                        required
                    >

                    @error('nama_service')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- HARGA DAN DURASI --}}
                <div class="row">

                    {{-- HARGA --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Harga
                            <span class="text-danger">*</span>
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-light">
                                Rp
                            </span>

                            <input
                                type="number"
                                name="harga"
                                class="form-control @error('harga') is-invalid @enderror"
                                value="{{ old('harga') }}"
                                min="0"
                                placeholder="50000"
                                required
                            >

                        </div>

                        @error('harga')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- DURASI --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Durasi
                            <span class="text-danger">*</span>
                        </label>

                        <div class="input-group">

                            <input
                                type="number"
                                name="durasi"
                                class="form-control @error('durasi') is-invalid @enderror"
                                value="{{ old('durasi') }}"
                                min="1"
                                placeholder="60"
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

                {{-- DESKRIPSI --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="4"
                        class="form-control @error('deskripsi') is-invalid @enderror"
                        placeholder="Jelaskan layanan yang diberikan..."
                    >{{ old('deskripsi') }}</textarea>

                    @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- FOTO LAYANAN --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Foto Layanan
                    </label>

                    <input
                        type="file"
                        name="foto"
                        id="foto"
                        class="form-control @error('foto') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                    >

                    <div class="form-text">
                        Format JPG, JPEG, PNG, WEBP. Maksimal ukuran 2 MB.
                    </div>

                    @error('foto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    {{-- PREVIEW FOTO --}}
                    <div class="mt-3">

                        <p class="small fw-semibold text-muted mb-2">
                            Preview Foto
                        </p>

                        <div
                            id="preview-container"
                            class="preview-container"
                        >

                            <div id="preview-placeholder" class="preview-placeholder py-3">

                                <i class="bi bi-image text-secondary fs-1"></i>

                                <p class="text-muted small mb-0 mt-2">
                                    Belum ada foto yang dipilih
                                </p>

                            </div>

                            <img
                                id="preview-image"
                                src=""
                                alt="Preview foto layanan"
                                class="preview-image d-none"
                            >

                        </div>

                    </div>

                </div>

                {{-- TOMBOL --}}
                <div class="service-form-actions pt-3 border-top">

                    <a
                        href="{{ route('admin.services.index') }}"
                        class="btn btn-outline-secondary"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-orange px-4"
                    >
                        <i class="bi bi-save me-1"></i>
                        Simpan Layanan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- JAVASCRIPT PREVIEW --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const fotoInput = document.getElementById('foto');
        const preview = document.getElementById('preview-image');
        const placeholder = document.getElementById('preview-placeholder');

        if (!fotoInput || !preview || !placeholder) {
            return;
        }

        fotoInput.addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {
                preview.src = '';
                preview.classList.add('d-none');
                placeholder.classList.remove('d-none');
                return;
            }

            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            // VALIDASI FORMAT
            if (!allowedTypes.includes(file.type)) {

                alert('Format foto harus JPG, JPEG, PNG, atau WEBP.');

                fotoInput.value = '';
                preview.src = '';
                preview.classList.add('d-none');
                placeholder.classList.remove('d-none');

                return;
            }

            // VALIDASI UKURAN
            if (file.size > 2 * 1024 * 1024) {

                alert('Ukuran foto maksimal 2 MB.');

                fotoInput.value = '';
                preview.src = '';
                preview.classList.add('d-none');
                placeholder.classList.remove('d-none');

                return;
            }

            // TAMPILKAN PREVIEW
            const reader = new FileReader();

            reader.onload = function (e) {

                preview.src = e.target.result;

                preview.classList.remove('d-none');
                placeholder.classList.add('d-none');

            };

            reader.readAsDataURL(file);

        });

    });
</script>

@endsection
