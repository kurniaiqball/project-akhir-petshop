
@extends('layouts.admin')

@section('title', 'Tambah Layanan - Galaxy Petshop')

@section('page-title', 'Tambah Layanan')

@section('page-description')
    Tambahkan layanan grooming atau perawatan baru di Galaxy Petshop.
@endsection

@section('content')

{{-- HEADER --}}
<div class="mb-4">

    <a
        href="{{ route('admin.services.index') }}"
        class="text-decoration-none text-muted"
    >
        <i class="bi bi-arrow-left me-1"></i>
        Kembali ke Layanan
    </a>

</div>

{{-- CARD FORM --}}
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">

    <div class="card-body p-4">

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
                    accept=".jpg,.jpeg,.png,.webp"
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
                        class="border rounded-3 p-3 text-center"
                    >

                        <div id="preview-placeholder" class="py-3">

                            <i class="bi bi-image text-secondary fs-1"></i>

                            <p class="text-muted small mb-0 mt-2">
                                Belum ada foto yang dipilih
                            </p>

                        </div>

                        <img
                            id="preview-image"
                            src=""
                            alt="Preview foto layanan"
                            class="img-fluid rounded-3 d-none"
                            style="max-height: 220px;"
                        >

                    </div>

                </div>

            </div>

            {{-- TOMBOL --}}
            <div class="d-flex justify-content-end gap-2 pt-3 border-top">

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

{{-- JAVASCRIPT PREVIEW --}}
<script>
    document.getElementById('foto').addEventListener('change', function(event) {

        const file = event.target.files[0];

        const preview = document.getElementById('preview-image');
        const placeholder = document.getElementById('preview-placeholder');

        if (file) {

            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (!allowedTypes.includes(file.type)) {
                alert('Format foto harus JPG, JPEG, PNG, atau WEBP.');
                event.target.value = '';
                preview.src = '';
                preview.classList.add('d-none');
                placeholder.classList.remove('d-none');
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran foto maksimal 2 MB.');
                event.target.value = '';
                preview.src = '';
                preview.classList.add('d-none');
                placeholder.classList.remove('d-none');
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                placeholder.classList.add('d-none');
            };

            reader.readAsDataURL(file);

        } else {

            preview.src = '';
            preview.classList.add('d-none');
            placeholder.classList.remove('d-none');

        }

    });
</script>

@endsection
