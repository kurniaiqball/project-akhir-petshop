
@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Edit Hewan</h2>
            <p class="text-muted mb-0">
                Perbarui informasi dan foto hewan peliharaan.
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

            <form action="{{ route('admin.pets.update', $pet->id_pet) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

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
                                    {{ old('id_customer', $pet->id_customer) == $customer->id_customer ? 'selected' : '' }}>
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
                               value="{{ old('nama_pet', $pet->nama_pet) }}"
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
                                {{ old('jenis', $pet->jenis) == 'Kucing' ? 'selected' : '' }}>
                                Kucing
                            </option>

                            <option value="Anjing"
                                {{ old('jenis', $pet->jenis) == 'Anjing' ? 'selected' : '' }}>
                                Anjing
                            </option>

                            <option value="Lainnya"
                                {{ old('jenis', $pet->jenis) == 'Lainnya' ? 'selected' : '' }}>
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
                               value="{{ old('ras', $pet->ras) }}"
                               maxlength="100"
                               placeholder="Contoh: Persia">

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
                                {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'Jantan' ? 'selected' : '' }}>
                                Jantan
                            </option>

                            <option value="Betina"
                                {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'Betina' ? 'selected' : '' }}>
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
                               value="{{ old('umur_tahun', $pet->umur_tahun) }}"
                               min="0">

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
                               value="{{ old('umur_bulan', $pet->umur_bulan) }}"
                               min="0"
                               max="11">

                        @error('umur_bulan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Foto Hewan --}}
                    <div class="col-md-6">
                        <label for="foto" class="form-label fw-semibold">
                            Foto Hewan
                        </label>

                        @if ($pet->foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($pet->foto))
                            <div class="mb-3">
                                <p class="text-muted small mb-2">Foto saat ini:</p>

                                <img src="{{ asset('storage/' . $pet->foto) }}"
                                     alt="Foto {{ $pet->nama_pet }}"
                                     class="img-thumbnail"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox"
                                       name="hapus_foto"
                                       id="hapus_foto"
                                       value="1"
                                       class="form-check-input">

                                <label for="hapus_foto" class="form-check-label text-danger">
                                    Hapus foto saat ini
                                </label>
                            </div>
                        @else
                            <div class="mb-3 text-muted">
                                <i class="bi bi-camera fs-1"></i>
                                <p class="small mb-0">Belum ada foto hewan.</p>
                            </div>
                        @endif

                        <input type="file"
                               name="foto"
                               id="foto"
                               class="form-control @error('foto') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">

                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <small class="text-muted d-block mt-1">
                            Pilih foto baru untuk mengganti foto saat ini.
                            Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        </small>

                        <div id="preview-container" class="mt-3" style="display: none;">
                            <p class="text-muted small mb-2">Pratinjau foto baru:</p>

                            <img id="preview-foto"
                                 src=""
                                 alt="Pratinjau foto baru"
                                 class="img-thumbnail"
                                 style="width: 150px; height: 150px; object-fit: cover;">

                            <div>
                                <button type="button"
                                        id="batal-foto"
                                        class="btn btn-sm btn-outline-danger mt-2">
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
                                  placeholder="Masukkan catatan tambahan">{{ old('catatan', $pet->catatan) }}</textarea>

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
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputFoto = document.getElementById('foto');
    const previewContainer = document.getElementById('preview-container');
    const previewFoto = document.getElementById('preview-foto');
    const tombolBatal = document.getElementById('batal-foto');

    let previewUrl = null;

    inputFoto.addEventListener('change', function () {
        const file = this.files[0];

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }

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

        previewUrl = URL.createObjectURL(file);
        previewFoto.src = previewUrl;
        previewContainer.style.display = 'block';

        const hapusFoto = document.getElementById('hapus_foto');

        if (hapusFoto) {
            hapusFoto.checked = false;
        }
    });

    if (tombolBatal) {
        tombolBatal.addEventListener('click', function () {
            inputFoto.value = '';
            previewFoto.removeAttribute('src');
            previewContainer.style.display = 'none';

            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
                previewUrl = null;
            }
        });
    }
});
</script>
@endsection
