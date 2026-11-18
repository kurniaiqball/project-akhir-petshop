
@extends('layouts.customer')

@section('title', 'Hewan Saya - PetCare')

@section('content')

{{-- HEADER --}}
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">

    <div>
        <h2 class="fw-bold mb-1">
            Hewan Saya
        </h2>

        <p class="text-muted mb-0">
            Kelola data hewan peliharaanmu.
        </p>
    </div>

    <div class="mt-3 mt-md-0">
        <a
            href="{{ route('customer.pets.create') }}"
            class="btn text-white px-4"
            style="background-color: #f58220; border-color: #f58220;"
        >
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Hewan
        </a>
    </div>

</div>

{{-- SUCCESS --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>
    </div>
@endif

{{-- ERROR --}}
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>
    </div>
@endif

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

@if ($pets->count())

    <div class="row g-3 g-lg-4">

        @foreach ($pets as $pet)

            <div class="col-12 col-md-6 col-lg-4">

                <div class="card border-0 shadow-sm h-100 rounded-4">

                    <div class="card-body p-3 p-md-4">

                        {{-- FOTO HEWAN --}}
                        <div class="mb-3">

                            @if (
                                $pet->foto &&
                                \Illuminate\Support\Facades\Storage::disk('public')->exists($pet->foto)
                            )

                                <img
                                    src="{{ asset('storage/' . $pet->foto) }}"
                                    alt="Foto {{ $pet->nama_pet }}"
                                    class="rounded-3"
                                    style="width: 100%; height: 190px; object-fit: cover;"
                                    loading="lazy"
                                >

                            @else

                                <div
                                    class="rounded-3 d-flex align-items-center justify-content-center"
                                    style="width: 100%; height: 190px; background-color: #fff2e6;"
                                >
                                    <i
                                        class="bi bi-heart-fill"
                                        style="font-size: 55px; color: #f58220;"
                                    ></i>
                                </div>

                            @endif

                        </div>

                        {{-- NAMA HEWAN --}}
                        <div class="mb-3">

                            <h5 class="fw-bold mb-1">
                                {{ $pet->nama_pet }}
                            </h5>

                            <p class="text-muted mb-0">
                                {{ $pet->jenis }}

                                @if ($pet->ras)
                                    <span class="mx-1">•</span>
                                    {{ $pet->ras }}
                                @endif
                            </p>

                        </div>

                        <hr class="text-muted opacity-25">

                        {{-- DETAIL HEWAN --}}
                        <div class="mb-3">

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted small">
                                    <i class="bi bi-gender-ambiguous me-1"></i>
                                    Jenis Kelamin
                                </span>

                                <span class="fw-semibold small">
                                    {{ $pet->jenis_kelamin }}
                                </span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    Umur
                                </span>

                                <span class="fw-semibold small text-end">
                                    @if ($pet->umur_tahun && $pet->umur_bulan)
                                        {{ $pet->umur_tahun }} tahun
                                        {{ $pet->umur_bulan }} bulan
                                    @elseif ($pet->umur_tahun)
                                        {{ $pet->umur_tahun }} tahun
                                    @elseif ($pet->umur_bulan)
                                        {{ $pet->umur_bulan }} bulan
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>

                        </div>

                        {{-- CATATAN --}}
                        @if ($pet->catatan)

                            <div
                                class="rounded-3 p-3 mb-3"
                                style="background-color: #fff8f1;"
                            >

                                <small class="fw-semibold d-block mb-1" style="color: #d96812;">
                                    <i class="bi bi-sticky me-1"></i>
                                    Catatan
                                </small>

                                <small class="text-muted">
                                    {{ $pet->catatan }}
                                </small>

                            </div>

                        @endif

                        {{-- TOMBOL AKSI --}}
                        <div class="d-flex gap-2 mt-auto">

                            <a
                                href="{{ route('customer.pets.edit', $pet) }}"
                                class="btn btn-outline-warning flex-grow-1"
                                style="--bs-btn-color: #f58220; --bs-btn-border-color: #f58220; --bs-btn-hover-bg: #f58220; --bs-btn-hover-border-color: #f58220; --bs-btn-hover-color: #fff;"
                            >
                                <i class="bi bi-pencil me-1"></i>
                                Edit
                            </a>

                            <form
                                action="{{ route('customer.pets.destroy', $pet) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus data hewan ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-outline-danger"
                                    title="Hapus hewan"
                                >
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </div>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

@else

    {{-- EMPTY STATE --}}
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body text-center p-4 p-md-5">

            <div
                class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                style="width: 90px; height: 90px; background-color: #fff2e6;"
            >
                <i
                    class="bi bi-heart-fill"
                    style="font-size: 40px; color: #f58220;"
                ></i>
            </div>

            <h5 class="fw-bold mb-2">
                Belum Ada Hewan
            </h5>

            <p class="text-muted mb-4">
                Kamu belum menambahkan data hewan peliharaan.
                Yuk, tambahkan data hewan kesayanganmu!
            </p>

            <a
                href="{{ route('customer.pets.create') }}"
                class="btn text-white px-4"
                style="background-color: #f58220; border-color: #f58220;"
            >
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Hewan
            </a>

        </div>

    </div>

@endif

@endsection
