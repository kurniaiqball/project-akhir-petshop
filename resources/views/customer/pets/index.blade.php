
@extends('layouts.customer')

@section('title', 'Hewan Saya - PetCare')

@section('content')

<style>
    .pet-list-photo {
        width: 60px;
        height: 60px;
        flex-shrink: 0;
        border-radius: 12px;
        overflow: hidden;
        background: #e7efff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pet-list-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .pet-list-photo i {
        font-size: 30px;
        color: #0d6efd;
    }
</style>

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
            class="btn btn-primary"
        >
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Hewan
        </a>
    </div>

</div>

{{-- SUCCESS --}}
@if (session('success'))
    <div
        class="alert alert-success alert-dismissible fade show"
        role="alert"
    >
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
    <div
        class="alert alert-danger alert-dismissible fade show"
        role="alert"
    >
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

    <div class="row g-4">

        @foreach ($pets as $pet)

            <div class="col-md-6 col-lg-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body p-4">

                        {{-- Foto Hewan --}}
                        <div class="pet-list-photo mb-3">

                            @if (
                                $pet->foto &&
                                \Illuminate\Support\Facades\Storage::disk('public')->exists($pet->foto)
                            )
                                <img
                                    src="{{ asset('storage/' . $pet->foto) }}"
                                    alt="Foto {{ $pet->nama_pet }}"
                                    loading="lazy"
                                >
                            @else
                                <i class="bi bi-heart"></i>
                            @endif

                        </div>

                        {{-- Nama --}}
                        <h5 class="fw-bold mb-1">
                            {{ $pet->nama_pet }}
                        </h5>

                        {{-- Jenis --}}
                        <p class="text-muted mb-3">
                            {{ $pet->jenis }}

                            @if ($pet->ras)
                                • {{ $pet->ras }}
                            @endif
                        </p>

                        {{-- Detail --}}
                        <div class="mb-3">

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">
                                    Jenis Kelamin
                                </span>

                                <span class="fw-semibold">
                                    {{ $pet->jenis_kelamin }}
                                </span>
                            </div>

                            <div class="d-flex justify-content-between">
                                <span class="text-muted">
                                    Umur
                                </span>

                                <span class="fw-semibold">
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

                        {{-- Catatan --}}
                        @if ($pet->catatan)
                            <div class="bg-light rounded-3 p-3 mb-3">

                                <small class="text-muted d-block mb-1">
                                    Catatan
                                </small>

                                <small>
                                    {{ $pet->catatan }}
                                </small>

                            </div>
                        @endif

                        {{-- Action --}}
                        <div class="d-flex gap-2">

                            <a
                                href="{{ route('customer.pets.edit', $pet) }}"
                                class="btn btn-outline-primary flex-grow-1"
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
    <div class="card border-0 shadow-sm">

        <div class="card-body text-center p-5">

            <div
                class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center mx-auto mb-3"
                style="width: 90px; height: 90px;"
            >
                <i class="bi bi-heart text-primary fs-1"></i>
            </div>

            <h5 class="fw-bold">
                Belum Ada Hewan
            </h5>

            <p class="text-muted mb-4">
                Kamu belum menambahkan data hewan peliharaan.
            </p>

            <a
                href="{{ route('customer.pets.create') }}"
                class="btn btn-primary"
            >
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Hewan
            </a>

        </div>

    </div>

@endif

@endsection
