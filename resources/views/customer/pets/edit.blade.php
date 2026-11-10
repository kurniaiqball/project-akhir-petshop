@extends('layouts.customer')

@section('title', 'Edit Hewan - PetCare')

@section('content')

<style>
    .pet-photo-preview {
        width: 150px;
        height: 150px;
        border-radius: 16px;
        object-fit: cover;
        border: 2px dashed #dee2e6;
        background: #f8f9fa;
    }

    .pet-photo-placeholder {
        width: 150px;
        height: 150px;
        border-radius: 16px;
        background: #f1f5f9;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        border: 2px dashed #dee2e6;
    }
</style>

<div class="mb-4">
    <h2 class="fw-bold mb-1">Edit Hewan</h2>
    <p class="text-muted mb-0">
        Perbarui data hewan peliharaanmu.
    </p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        {{-- Pesan Kesalahan --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Terdapat kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('customer.pets.update', $pet) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            {{-- Foto Hewan --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">
                    Foto Hewan
                </label>

                <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">

                    {{-- Foto Lama / Placeholder --}}
                    @if($pet->foto)
                        <img
                            id="photoPreview"
                            class="pet-photo-preview"
                            src="{{ asset('storage/' . $pet->foto) }}"
                            alt="Foto {{ $pet->nama_pet }}"
                        >

                        <div id="photoPlaceholder" class="pet-photo-placeholder d-none">
                            <i class="bi bi-camera"></i>
                        </div>
                    @else
                        <div id="photoPlaceholder" class="pet-photo-placeholder">
                            <i class="bi bi-camera"></i>
                        </div>

                        <img
                            id="photoPreview"
                            class="pet-photo-preview d-none"
                            src=""
                            alt="Preview foto hewan"
                        >
                    @endif

                    <div>
                        <input
                            type="file"
                            name="foto"
                            id="foto"
                            class="form-control @error('foto') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        >

                        @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="text-muted d-block mt-2">
                            Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        </small>

                        <button
                            type="button"
                            id="removePhoto"
                            class="btn btn-sm btn-outline-danger mt-2 d-none"
                        >
                            <i class="bi bi-arrow-counterclockwise me-1"></i>
                            Batal Pilih Foto
                        </button>
                    </div>

                </div>
            </div>

            <hr class="mb-4">

            {{-- Nama Hewan --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Nama Hewan
                </label>

                <input
                    type="text"
                    name="nama_pet"
                    class="form-control"
                    value="{{ old('nama_pet', $pet->nama_pet) }}"
                    required
                >
            </div>

            <div class="row">

                {{-- Jenis --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">
                        Jenis Hewan
                    </label>

                    <input
                        type="text"
                        name="jenis"
                        class="form-control"
                        value="{{ old('jenis', $pet->jenis) }}"
                        required
                    >
                </div>

                {{-- Ras --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">
                        Ras
                    </label>

                    <input
                        type="text"
                        name="ras"
                        class="form-control"
                        value="{{ old('ras', $pet->ras) }}"
                    >
                </div>

                {{-- Jenis Kelamin --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">
                        Jenis Kelamin
                    </label>

                    <select
                        name="jenis_kelamin"
                        class="form-select"
                        required
                    >
                        <option value="">-- Pilih Jenis Kelamin --</option>

                        <option
                            value="Jantan"
                            {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'Jantan' ? 'selected' : '' }}
                        >
                            Jantan
                        </option>

                        <option
                            value="Betina"
                            {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'Betina' ? 'selected' : '' }}
                        >
                            Betina
                        </option>
                    </select>
                </div>

            </div>

            {{-- Umur --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Umur
                </label>

                <div class="row g-2">

                    <div class="col-md-6">
                        <div class="input-group">
                            <input
                                type="number"
                                name="umur_tahun"
                                class="form-control"
                                value="{{ old('umur_tahun', $pet->umur_tahun) }}"
                                min="0"
                                max="100"
                                placeholder="0"
                            >

                            <span class="input-group-text">Tahun</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group">
                            <input
                                type="number"
                                name="umur_bulan"
                                class="form-control"
                                value="{{ old('umur_bulan', $pet->umur_bulan) }}"
                                min="0"
                                max="11"
                                placeholder="0"
                            >

                            <span class="input-group-text">Bulan</span>
                        </div>
                    </div>

                </div>

                <small class="text-muted">
                    Isi bulan dengan angka 0–11.
                </small>
            </div>

            {{-- Catatan --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">
                    Catatan
                </label>

                <textarea
                    name="catatan"
                    class="form-control"
                    rows="4"
                    placeholder="Catatan tambahan"
                >{{ old('catatan', $pet->catatan) }}</textarea>
            </div>

            {{-- Tombol --}}
            <div class="d-flex gap-2">
                <a
                    href="{{ route('customer.pets.index') }}"
                    class="btn btn-light"
                >
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="bi bi-check-lg me-1"></i>
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>

{{-- Preview Foto --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const fotoInput = document.getElementById('foto');
    const photoPreview = document.getElementById('photoPreview');
    const photoPlaceholder = document.getElementById('photoPlaceholder');
    const removePhotoButton = document.getElementById('removePhoto');

    // Simpan foto lama untuk mengembalikan preview
    const oldPhoto = @json($pet->foto ? asset('storage/' . $pet->foto) : null);

    fotoInput.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) {
            resetPhotoPreview();
            return;
        }

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {
            alert('Format foto harus JPG, JPEG, PNG, atau WEBP.');
            this.value = '';
            resetPhotoPreview();
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran foto maksimal 2 MB.');
            this.value = '';
            resetPhotoPreview();
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            photoPreview.src = event.target.result;
            photoPreview.classList.remove('d-none');
            photoPlaceholder.classList.add('d-none');
            removePhotoButton.classList.remove('d-none');
        };

        reader.readAsDataURL(file);
    });

    // Batalkan foto baru
    removePhotoButton.addEventListener('click', function () {
        fotoInput.value = '';
        resetPhotoPreview();
    });

    function resetPhotoPreview() {

        if (oldPhoto) {
            photoPreview.src = oldPhoto;
            photoPreview.classList.remove('d-none');
            photoPlaceholder.classList.add('d-none');
        } else {
            photoPreview.src = '';
            photoPreview.classList.add('d-none');
            photoPlaceholder.classList.remove('d-none');
        }

        removePhotoButton.classList.add('d-none');
    }

});
</script>

@endsection