
@extends('layouts.admin')

@section('title', 'Tambah Hewan - Galaxy Petshop')

@section('page-title', 'Tambah Hewan')

@section('page-description')
    Tambahkan data hewan peliharaan baru ke Galaxy Petshop.
@endsection

@section('content')

<style>
    .pet-orange {
        color: #f28c28;
    }

    .pet-orange-soft {
        background-color: #fff2e6;
    }

    .btn-orange {
        background-color: #f28c28;
        border-color: #f28c28;
        color: #fff;
    }

    .btn-orange:hover {
        background-color: #df7817;
        border-color: #df7817;
        color: #fff;
    }

    .pet-form-card {
        border-radius: 16px;
        overflow: hidden;
    }

    .pet-form-card .form-control,
    .pet-form-card .form-select {
        border-radius: 9px;
        padding: 10px 13px;
    }

    .pet-form-card .form-control:focus,
    .pet-form-card .form-select:focus {
        border-color: #f28c28;
        box-shadow: 0 0 0 .2rem rgba(242, 140, 40, .15);
    }

    .pet-section-title {
        font-weight: 700;
        color: #343a40;
        font-size: 15px;
    }

    .pet-section-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fff2e6;
        color: #f28c28;
        margin-right: 10px;
    }

    .pet-photo-preview {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid #ffe0c2;
    }
</style>

<div class="container-fluid px-0">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">Tambah Hewan</h4>
            <p class="text-muted mb-0">
                Lengkapi informasi hewan peliharaan pelanggan.
            </p>
        </div>

        <a href="{{ route('admin.pets.index') }}"
           class="btn btn-outline-secondary rounded-3">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali
        </a>
    </div>

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3">
            <div class="fw-bold mb-2">
                <i class="bi bi-exclamation-circle me-2"></i>
                Terdapat kesalahan input.
            </div>

            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FORM CARD --}}
    <div class="card pet-form-card border-0 shadow-sm">

        <div class="card-header bg-white border-0 px-4 pt-4 pb-0">
            <div class="d-flex align-items-center">
                <div class="pet-section-icon">
                    <i class="bi bi-paw fs-5"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">Informasi Hewan</h5>
                    <small class="text-muted">
                        Isi data hewan dengan benar.
                    </small>
                </div>
            </div>
        </div>

        <div class="card-body p-4">

            <form action="{{ route('admin.pets.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                {{-- DATA UTAMA --}}
                <div class="mb-4">

                    <h6 class="pet-section-title mb-3">
                        <i class="bi bi-info-circle pet-orange me-2"></i>
                        Data Utama
                    </h6>

                    <div class="row g-3">

                        {{-- CUSTOMER --}}
                        <div class="col-md-6">
                            <label for="id_customer" class="form-label fw-semibold">
                                Pemilik Hewan <span class="text-danger">*</span>
                            </label>

                            <select name="id_customer"
                                    id="id_customer"
                                    class="form-select @error('id_customer') is-invalid @enderror"
                                    required>

                                <option value="">-- Pilih Customer --</option>

                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id_customer }}"
                                        {{ old('id_customer') == $customer->id_customer ? 'selected' : '' }}>
                                        {{ $customer->nama }}
                                    </option>
                                @endforeach

                            </select>

                            @error('id_customer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NAMA HEWAN --}}
                        <div class="col-md-6">
                            <label for="nama_pet" class="form-label fw-semibold">
                                Nama Hewan <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="nama_pet"
                                   id="nama_pet"
                                   class="form-control @error('nama_pet') is-invalid @enderror"
                                   value="{{ old('nama_pet') }}"
                                   placeholder="Contoh: Mochi"
                                   maxlength="100"
                                   required>

                            @error('nama_pet')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- JENIS --}}
                        <div class="col-md-6">
                            <label for="jenis" class="form-label fw-semibold">
                                Jenis Hewan <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="jenis"
                                   id="jenis"
                                   class="form-control @error('jenis') is-invalid @enderror"
                                   value="{{ old('jenis') }}"
                                   placeholder="Contoh: Kucing"
                                   required>

                            @error('jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- RAS --}}
                        <div class="col-md-6">
                            <label for="ras" class="form-label fw-semibold">
                                Ras
                            </label>

                            <input type="text"
                                   name="ras"
                                   id="ras"
                                   class="form-control @error('ras') is-invalid @enderror"
                                   value="{{ old('ras') }}"
                                   placeholder="Contoh: Persia, Anggora"
                                   maxlength="100">

                            @error('ras')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- JENIS KELAMIN --}}
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label fw-semibold">
                                Jenis Kelamin <span class="text-danger">*</span>
                            </label>

                            <select name="jenis_kelamin"
                                    id="jenis_kelamin"
                                    class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                    required>

                                <option value="">-- Pilih Jenis Kelamin --</option>

                                <option value="Jantan"
                                    {{ old('jenis_kelamin') == 'Jantan' ? 'selected' : '' }}>
                                    Jantan
                                </option>

                                <option value="Betina"
                                    {{ old('jenis_kelamin') == 'Betina' ? 'selected' : '' }}>
                                    Betina
                                </option>

                            </select>

                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <hr class="border-light my-4">

                {{-- UMUR HEWAN --}}
                <div class="mb-4">

                    <h6 class="pet-section-title mb-3">
                        <i class="bi bi-calendar-heart pet-orange me-2"></i>
                        Umur Hewan
                    </h6>

                    <div class="row g-3">

                        <div class="col-md-3">
                            <label for="umur_tahun" class="form-label fw-semibold">
                                Umur (Tahun)
                            </label>

                            <input type="number"
                                   name="umur_tahun"
                                   id="umur_tahun"
                                   class="form-control @error('umur_tahun') is-invalid @enderror"
                                   value="{{ old('umur_tahun') }}"
                                   min="0"
                                   placeholder="0">

                            @error('umur_tahun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="umur_bulan" class="form-label fw-semibold">
                                Umur (Bulan)
                            </label>

                            <input type="number"
                                   name="umur_bulan"
                                   id="umur_bulan"
                                   class="form-control @error('umur_bulan') is-invalid @enderror"
                                   value="{{ old('umur_bulan') }}"
                                   min="0"
                                   max="11"
                                   placeholder="0">

                            @error('umur_bulan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <hr class="border-light my-4">

                {{-- FOTO HEWAN --}}
                <div class="mb-4">

                    <h6 class="pet-section-title mb-3">
                        <i class="bi bi-camera pet-orange me-2"></i>
                        Foto Hewan
                    </h6>

                    <div class="row">

                        <div class="col-md-6">

                            <label for="foto" class="form-label fw-semibold">
                                Upload Foto
                            </label>

                            <input type="file"
                                   name="foto"
                                   id="foto"
                                   class="form-control @error('foto') is-invalid @enderror"
                                   accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">

                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <small class="text-muted d-block mt-2">
                                Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                            </small>

                            {{-- PREVIEW --}}
                            <div class="mt-3 d-none" id="preview-container">

                                <img id="preview-foto"
                                     src=""
                                     alt="Preview foto hewan"
                                     class="pet-photo-preview">

                                <div>
                                    <button type="button"
                                            id="hapus-preview"
                                            class="btn btn-sm btn-outline-danger mt-2">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Batal Pilih Foto
                                    </button>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <hr class="border-light my-4">

                {{-- CATATAN --}}
                <div class="mb-4">

                    <h6 class="pet-section-title mb-3">
                        <i class="bi bi-card-text pet-orange me-2"></i>
                        Catatan Tambahan
                    </h6>

                    <label for="catatan" class="form-label fw-semibold">
                        Catatan
                    </label>

                    <textarea name="catatan"
                              id="catatan"
                              rows="4"
                              class="form-control @error('catatan') is-invalid @enderror"
                              placeholder="Contoh: Alergi makanan tertentu, kondisi kesehatan, atau informasi lainnya...">{{ old('catatan') }}</textarea>

                    @error('catatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                {{-- FOOTER BUTTON --}}
                <div class="d-flex justify-content-end gap-2 pt-3 border-top">

                    <a href="{{ route('admin.pets.index') }}"
                       class="btn btn-light border rounded-3 px-4">
                        Batal
                    </a>

                    <button type="submit"
                            class="btn btn-orange rounded-3 px-4">
                        <i class="bi bi-save me-1"></i>
                        Simpan Hewan
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

{{-- PREVIEW FOTO --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const inputFoto = document.getElementById('foto');
    const previewContainer = document.getElementById('preview-container');
    const previewFoto = document.getElementById('preview-foto');
    const tombolHapus = document.getElementById('hapus-preview');

    let previewUrl = null;

    inputFoto.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) {
            previewContainer.classList.add('d-none');
            previewFoto.removeAttribute('src');
            return;
        }

        const formatDiizinkan = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!formatDiizinkan.includes(file.type)) {
            alert('Format foto harus JPG, JPEG, PNG, atau WEBP.');
            this.value = '';
            previewContainer.classList.add('d-none');
            previewFoto.removeAttribute('src');
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran foto maksimal 2 MB.');
            this.value = '';
            previewContainer.classList.add('d-none');
            previewFoto.removeAttribute('src');
            return;
        }

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
        }

        previewUrl = URL.createObjectURL(file);

        previewFoto.src = previewUrl;
        previewContainer.classList.remove('d-none');

    });

    tombolHapus.addEventListener('click', function () {

        inputFoto.value = '';

        previewFoto.removeAttribute('src');
        previewContainer.classList.add('d-none');

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }

    });

});
</script>

@endsection