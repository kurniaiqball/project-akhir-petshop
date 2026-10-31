@extends('layouts.customer')

@section('content')

<div class="mb-4">
    <a
        href="{{ route('customer.dashboard') }}"
        class="text-decoration-none text-muted"
    >
        <i class="bi bi-arrow-left me-1"></i>
        Kembali ke Dashboard
    </a>

    <h2 class="fw-bold mt-3 mb-1">
        Booking Grooming
    </h2>

    <p class="text-muted mb-0">
        Jadwalkan layanan grooming untuk hewan peliharaan Anda.
    </p>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">

        <i class="bi bi-check-circle me-2"></i>

        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>

    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">

        <div class="fw-semibold mb-2">
            <i class="bi bi-exclamation-circle me-2"></i>
            Periksa kembali data booking.
        </div>

        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>
@endif

@if($pets->count() === 0)

    <div class="card border-0 shadow-sm">

        <div class="card-body text-center py-5">

            <i
                class="bi bi-heart text-muted"
                style="font-size: 50px;"
            ></i>

            <h5 class="fw-bold mt-3">
                Belum Ada Hewan
            </h5>

            <p class="text-muted">
                Tambahkan data hewan terlebih dahulu sebelum melakukan booking.
            </p>

            <a
                href="{{ route('customer.pets.create') }}"
                class="btn btn-success"
            >
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Hewan
            </a>

        </div>

    </div>

@elseif($services->count() === 0)

    <div class="alert alert-warning">
        Saat ini belum ada layanan grooming yang tersedia.
    </div>

@else

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form
                action="{{ route('customer.booking.store') }}"
                method="POST"
            >

                @csrf

                <div class="row">

                    {{-- Hewan --}}
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">
                            Hewan
                        </label>

                        <select
                            name="id_pet"
                            class="form-select @error('id_pet') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                -- Pilih Hewan --
                            </option>

                            @foreach($pets as $pet)

                                <option
                                    value="{{ $pet->id_pet }}"
                                    {{ old('id_pet') == $pet->id_pet ? 'selected' : '' }}
                                >
                                    {{ $pet->nama_pet }}
                                    -
                                    {{ $pet->jenis }}
                                </option>

                            @endforeach

                        </select>

                        @error('id_pet')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Layanan --}}
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">
                            Layanan
                        </label>

                        <select
                            name="id_service"
                            class="form-select @error('id_service') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                -- Pilih Layanan --
                            </option>

                            @foreach($services as $service)

                                <option
                                    value="{{ $service->id_service }}"
                                    {{ old('id_service') == $service->id_service ? 'selected' : '' }}
                                >
                                    {{ $service->nama_service }}
                                    -
                                    Rp {{ number_format($service->harga, 0, ',', '.') }}
                                </option>

                            @endforeach

                        </select>

                        @error('id_service')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Tanggal --}}
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">
                            Tanggal Booking
                        </label>

                        <input
                            type="date"
                            name="tanggal_booking"
                            class="form-control @error('tanggal_booking') is-invalid @enderror"
                            value="{{ old('tanggal_booking') }}"
                            min="{{ date('Y-m-d') }}"
                            required
                        >

                        @error('tanggal_booking')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Jam --}}
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">
                            Jam Booking
                        </label>

                        <input
                            type="time"
                            name="jam_booking"
                            class="form-control @error('jam_booking') is-invalid @enderror"
                            value="{{ old('jam_booking') }}"
                            required
                        >

                        @error('jam_booking')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="text-muted">
                            Pilih jam sesuai jam operasional pet shop.
                        </small>

                    </div>

                    {{-- Catatan --}}
                    <div class="col-12 mb-4">

                        <label class="form-label fw-semibold">
                            Catatan
                            <span class="text-muted fw-normal">
                                (opsional)
                            </span>
                        </label>

                        <textarea
                            name="catatan"
                            rows="4"
                            class="form-control @error('catatan') is-invalid @enderror"
                            placeholder="Contoh: Mohon menggunakan shampoo khusus..."
                        >{{ old('catatan') }}</textarea>

                        @error('catatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('customer.dashboard') }}"
                        class="btn btn-outline-secondary"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-success"
                    >
                        <i class="bi bi-calendar-check me-1"></i>
                        Buat Booking
                    </button>

                </div>

            </form>

        </div>

    </div>

@endif

@endsection