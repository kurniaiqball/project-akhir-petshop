
@extends('layouts.customer')

@section('title', 'Profil Saya - PetCare')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <h2 class="fw-bold mb-1" style="color: #29231f;">
        <i class="bi bi-person-circle me-2" style="color: #f58220;"></i>
        Profil Saya
    </h2>

    <p class="text-muted mb-0">
        Kelola foto profil akun PetCare kamu.
    </p>
</div>

{{-- NOTIFIKASI SUKSES --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3"
         role="alert">

        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
@endif

{{-- NOTIFIKASI ERROR --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-3"
         role="alert">

        <div class="fw-semibold mb-2">
            <i class="bi bi-exclamation-circle me-2"></i>
            Terjadi kesalahan:
        </div>

        <ul class="mb-0 ps-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
@endif

<div class="row justify-content-center">

    <div class="col-12 col-lg-8 col-xl-7">

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body p-3 p-md-5">

                {{-- INFORMASI PROFIL --}}
                <div class="text-center mb-4">

                    {{-- FOTO PROFIL --}}
                    @if ($customer->foto)

                        <img
                            src="{{ asset('storage/' . $customer->foto) }}"
                            alt="Foto {{ $customer->nama }}"
                            class="rounded-circle border border-4 mb-3"
                            style="width: 130px; height: 130px; object-fit: cover; border-color: #fff2e6 !important;"
                        >

                    @else

                        <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width: 130px; height: 130px; background-color: #fff2e6; color: #f58220; font-size: 60px;">

                            <i class="bi bi-person-fill"></i>

                        </div>

                    @endif

                    <h5 class="fw-bold mb-1" style="color: #29231f;">
                        {{ $customer->nama }}
                    </h5>

                    <p class="text-muted mb-0 text-break">
                        {{ $customer->email }}
                    </p>

                    <span class="badge rounded-pill mt-3 px-3 py-2"
                          style="background-color: #fff2e6; color: #d96812;">

                        <i class="bi bi-person-check me-1"></i>
                        Customer PetCare

                    </span>

                </div>

                <hr class="my-4">

                {{-- FORM UPLOAD FOTO --}}
                <div class="mb-4">

                    <h5 class="fw-bold mb-1" style="color: #29231f;">
                        <i class="bi bi-camera me-2" style="color: #f58220;"></i>
                        Foto Profil
                    </h5>

                    <p class="text-muted small mb-0">
                        Perbarui foto profil akun kamu.
                    </p>

                </div>

                <form
                    action="{{ route('customer.profile.update') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label for="foto" class="form-label fw-semibold">
                            Pilih Foto
                        </label>

                        <input
                            type="file"
                            name="foto"
                            id="foto"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                            required
                        >

                        <div class="form-text">
                            Format JPG, JPEG, PNG, atau WebP. Maksimal 2 MB.
                        </div>

                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-2">

                        <button type="submit"
                                class="btn text-white px-4"
                                style="background-color: #f58220; border-color: #f58220;">

                            <i class="bi bi-upload me-1"></i>
                            Simpan Foto

                        </button>

                        <a href="{{ route('customer.dashboard') }}"
                           class="btn btn-outline-secondary px-4">

                            <i class="bi bi-arrow-left me-1"></i>
                            Kembali

                        </a>

                    </div>

                </form>

                {{-- HAPUS FOTO --}}
                @if ($customer->foto)

                    <hr class="my-4">

                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">

                        <div>

                            <h6 class="fw-bold mb-1" style="color: #29231f;">
                                Hapus Foto Profil
                            </h6>

                            <small class="text-muted">
                                Hapus foto dan gunakan foto profil default.
                            </small>

                        </div>

                        <form
                            action="{{ route('customer.profile.photo.destroy') }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus foto profil?')"
                        >

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-outline-danger text-nowrap">

                                <i class="bi bi-trash me-1"></i>
                                Hapus Foto

                            </button>

                        </form>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection
