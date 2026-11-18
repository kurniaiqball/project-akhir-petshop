
@extends('layouts.customer')

@section('title', 'Tambah Hewan - PetCare')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <h2 class="fw-bold mb-1">
        Tambah Hewan
    </h2>

    <p class="text-muted mb-0">
        Tambahkan data hewan peliharaanmu.
    </p>
</div>

{{-- CARD FORM --}}
<div class="card border-0 shadow-sm rounded-4">

    <div class="card-body p-3 p-md-4 p-lg-5">

        {{-- VALIDATION ERROR --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terdapat kesalahan:</strong>

                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('customer.pets.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            {{-- FOTO HEWAN --}}
            <div class="mb-4">

                <label class="form-label fw-semibold">
                    <i class="bi bi-camera me-1" style="color: #f58220;"></i>
                    Foto Hewan
                </label>

                <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">

                    {{-- PLACEHOLDER --}}
                    <div
                        id="photoPlaceholder"
                        class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                        style="width: 150px; height: 150px; background-color: #fff2e6; border: 2px dashed #f58220;"
                    >
                        <i
                            class="bi bi-camera"
                            style="font-size: 48px; color: #f58220;"
                        ></i>
                    </div>

                    {{-- PREVIEW --}}
                    <img
                        id="photoPreview"
                        class="rounded-3 d-none flex-shrink-0"
                        src=""
                        alt="Preview foto hewan"
                        style="width: 150px; height: 150px; object-fit: cover;"
                    >

                    <div class="flex-grow-1 w-100">

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
                            <i class="bi bi-trash me-1"></i>
                            Batal Pilih Foto
                        </button>

                    </div>

                </div>
            </div>

            <hr class="mb-4">

            {{-- NAMA HEWAN --}}
            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Nama Hewan
                </label>

                <input
                    type="text"
                    name="nama_pet"
                    class="form-control @error('nama_pet') is-invalid @enderror"
                    value="{{ old('nama_pet') }}"
                    placeholder="Contoh: Milo"
                    required
                >

                @error('nama_pet')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="row">

                {{-- JENIS HEWAN --}}
                <div class="col-12 col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Jenis Hewan
                    </label>

                    <input
                        type="text"
                        name="jenis"
                        class="form-control @error('jenis') is-invalid @enderror"
                        value="{{ old('jenis') }}"
                        placeholder="Contoh: Kucing"
                        required
                    >

                    @error('jenis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- RAS --}}
                <div class="col-12 col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Ras
                    </label>

                    <input
                        type="text"
                        name="ras"
                        class="form-control @error('ras') is-invalid @enderror"
                        value="{{ old('ras') }}"
                        placeholder="Contoh: Persia"
                    >

                    @error('ras')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- JENIS KELAMIN --}}
                <div class="col-12 col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Jenis Kelamin
                    </label>

                    <select
                        name="jenis_kelamin"
                        class="form-select @error('jenis_kelamin') is-invalid @enderror"
                        required
                    >
                        <option value="">
                            -- Pilih Jenis Kelamin --
                        </option>

                        <option
                            value="Jantan"
                            {{ old('jenis_kelamin') == 'Jantan' ? 'selected' : '' }}
                        >
                            Jantan
                        </option>

                        <option
                            value="Betina"
                            {{ old('jenis_kelamin') == 'Betina' ? 'selected' : '' }}
                        >
                            Betina
                        </option>
                    </select>

                    @error('jenis_kelamin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

            {{-- UMUR --}}
            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Umur
                </label>

                <div class="row g-2">

                    <div class="col-12 col-md-6">

                        <div class="input-group">

                            <input
                                type="number"
                                name="umur_tahun"
                                class="form-control @error('umur_tahun') is-invalid @enderror"
                                value="{{ old('umur_tahun') }}"
                                min="0"
                                max="100"
                                placeholder="0"
                            >

                            <span class="input-group-text">
                                Tahun
                            </span>

                            @error('umur_tahun')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    <div class="col-12 col-md-6">

                        <div class="input-group">

                            <input
                                type="number"
                                name="umur_bulan"
                                class="form-control @error('umur_bulan') is-invalid @enderror"
                                value="{{ old('umur_bulan') }}"
                                min="0"
                                max="11"
                                placeholder="0"
                            >

                            <span class="input-group-text">
                                Bulan
                            </span>

                            @error('umur_bulan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                </div>

                <small class="text-muted">
                    Isi bulan dengan angka 0–11.
                </small>

            </div>

            {{-- CATATAN --}}
            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Catatan
                </label>

                <textarea
                    name="catatan"
                    class="form-control @error('catatan') is-invalid @enderror"
                    rows="4"
                    placeholder="Contoh: Tidak suka suara keras."
                >{{ old('catatan') }}</textarea>

                @error('catatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <hr class="mb-4">

            {{-- TOMBOL --}}
            <div class="d-flex flex-column flex-sm-row justify-content-between gap-2">

                <a
                    href="{{ route('customer.pets.index') }}"
                    class="btn btn-light px-4"
                >
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>

                <button
                    type="submit"
                    class="btn text-white px-4"
                    style="background-color: #f58220; border-color: #f58220;"
                >
                    <i class="bi bi-check-lg me-1"></i>
                    Simpan Hewan
                </button>

            </div>

        </form>

    </div>

</div>

{{-- PREVIEW FOTO --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const fotoInput = document.getElementById('foto');
        const photoPreview = document.getElementById('photoPreview');
        const photoPlaceholder = document.getElementById('photoPlaceholder');
        const removePhotoButton = document.getElementById('removePhoto');

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

        removePhotoButton.addEventListener('click', function () {
            fotoInput.value = '';
            resetPhotoPreview();
        });

        function resetPhotoPreview() {
            photoPreview.src = '';
            photoPreview.classList.add('d-none');
            photoPlaceholder.classList.remove('d-none');
            removePhotoButton.classList.add('d-none');
        }

    });
</script>

@endsection
