
@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Tambah Hewan</h2>
            <p class="text-muted mb-0">
                Tambahkan data hewan peliharaan baru.
            </p>
        </div>

        <a href="{{ route('admin.pets.index') }}"
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('admin.pets.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row g-3">

                    {{-- Customer --}}
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

                    {{-- Nama Hewan --}}
                    <div class="col-md-6">
                        <label for="nama_pet" class="form-label fw-semibold">
                            Nama Hewan <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="nama_pet"
                               id="nama_pet"
                               class="form-control @error('nama_pet') is-invalid @enderror"
                               value="{{ old('nama_pet') }}"
                               placeholder="Masukkan nama hewan"
                               maxlength="100"
                               required>

                        @error('nama_pet')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jenis Hewan --}}
                    <div class="col-md-6">
                        <label for="jenis" class="form-label fw-semibold">
                            Jenis Hewan <span class="text-danger">*</span>
                        </label>

                        <select name="jenis"
                                id="jenis"
                                class="form-select @error('jenis') is-invalid @enderror"
                                required>

                            <option value="">-- Pilih Jenis --</option>

                            <option value="Kucing"
                                {{ old('jenis') == 'Kucing' ? 'selected' : '' }}>
                                Kucing
                            </option>

                            <option value="Anjing"
                                {{ old('jenis') == 'Anjing' ? 'selected' : '' }}>
                                Anjing
                            </option>

                            <option value="Lainnya"
                                {{ old('jenis') == 'Lainnya' ? 'selected' : '' }}>
                                Lainnya
                            </option>
                        </select>

                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Ras --}}
                    <div class="col-md-6">
                        <label for="ras" class="form-label fw-semibold">
                            Ras
                        </label>

                        <input type="text"
                               name="ras"
                               id="ras"
                               class="form-control @error('ras') is-invalid @enderror"
                               value="{{ old('ras') }}"
                               placeholder="Contoh: Persia, Golden Retriever"
                               maxlength="100">

                        @error('ras')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
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

                    {{-- Umur Tahun --}}
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

                    {{-- Umur Bulan --}}
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

                    {{-- Foto Hewan --}}
                    <div class="col-md-6">
                        <label for="foto" class="form-label fw-semibold">
                            Foto Hewan
                        </label>

                        <input type="file"
                               name="foto"
                               id="foto"
                               class="form-control @error('foto') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">

                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <small class="text-muted d-block mt-1">
                            Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        </small>

                        <div class="mt-3" id="preview-container" style="display: none;">
                            <img id="preview-foto"
                                 src=""
                                 alt="Pratinjau foto hewan"
                                 class="img-thumbnail"
                                 style="width: 150px; height: 150px; object-fit: cover;">

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

                    {{-- Catatan --}}
                    <div class="col-12">
                        <label for="catatan" class="form-label fw-semibold">
                            Catatan
                        </label>

                        <textarea name="catatan"
                                  id="catatan"
                                  rows="4"
                                  class="form-control @error('catatan') is-invalid @enderror"
                                  placeholder="Masukkan catatan tambahan tentang hewan">{{ old('catatan') }}</textarea>

                        @error('catatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.pets.index') }}"
                       class="btn btn-light border">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Simpan Hewan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Preview Foto --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputFoto = document.getElementById('foto');
    const previewContainer = document.getElementById('preview-container');
    const previewFoto = document.getElementById('preview-foto');
    const tombolHapus = document.getElementById('hapus-preview');

    inputFoto.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) {
            previewContainer.style.display = 'none';
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
            previewContainer.style.display = 'none';
            previewFoto.removeAttribute('src');
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran foto maksimal 2 MB.');
            this.value = '';
            previewContainer.style.display = 'none';
            previewFoto.removeAttribute('src');
            return;
        }

        previewFoto.src = URL.createObjectURL(file);
        previewContainer.style.display = 'block';
    });

    tombolHapus.addEventListener('click', function () {
        inputFoto.value = '';
        previewFoto.removeAttribute('src');
        previewContainer.style.display = 'none';
    });
});
</script>
@endsection
