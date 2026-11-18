@extends('layouts.customer')

@section('title', 'Booking Grooming - Galaxy Petshop')

@section('content')

    {{-- HEADER --}}
    <div class="mb-4">
        <a
            href="{{ route('customer.dashboard') }}"
            class="text-decoration-none text-secondary"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Kembali ke Dashboard
        </a>

        <div class="mt-3">
            <span class="badge rounded-pill px-3 py-2 mb-2"
                style="background-color: #fff2e6; color: #d96812;">
                <i class="bi bi-calendar-heart me-1"></i>
                Grooming
            </span>

            <h2 class="fw-bold mt-1 mb-1">
                Booking Grooming
            </h2>

            <p class="text-secondary mb-0">
                Jadwalkan layanan grooming untuk hewan peliharaan Anda.
            </p>
        </div>
    </div>


    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert border-0 rounded-3 alert-dismissible fade show"
            style="background-color: #fff2e6; color: #a94d0b;">

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
    @if($errors->any())
        <div class="alert alert-danger rounded-3">

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


    {{-- BELUM ADA HEWAN --}}
    @if($pets->count() === 0)

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5">

                <div class="rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                    style="width: 75px; height: 75px; background-color: #fff2e6;">

                    <i class="bi bi-heart fs-1" style="color: #f58220;"></i>

                </div>

                <h5 class="fw-bold mt-2">
                    Belum Ada Hewan
                </h5>

                <p class="text-secondary mb-4">
                    Tambahkan data hewan terlebih dahulu sebelum melakukan booking.
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


    {{-- BELUM ADA LAYANAN --}}
    @elseif($services->count() === 0)

        <div class="alert rounded-3 border-0"
            style="background-color: #fff2e6; color: #a94d0b;">

            <i class="bi bi-exclamation-circle me-2"></i>
            Saat ini belum ada layanan grooming yang tersedia.

        </div>


    {{-- FORM BOOKING --}}
    @else

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">

                <div class="d-flex align-items-center gap-3 mb-4">

                    <div class="rounded-3 d-flex align-items-center justify-content-center"
                        style="width: 50px; height: 50px; background-color: #fff2e6; color: #d96812;">

                        <i class="bi bi-calendar-check fs-4"></i>

                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">
                            Form Booking
                        </h5>

                        <p class="text-secondary small mb-0">
                            Lengkapi data booking di bawah ini.
                        </p>
                    </div>

                </div>


                <form
                    action="{{ route('customer.booking.store') }}"
                    method="POST"
                >

                    @csrf

                    <div class="row">

                        {{-- HEWAN --}}
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
                                        {{ $pet->nama_pet }} - {{ $pet->jenis }}
                                    </option>

                                @endforeach

                            </select>

                            @error('id_pet')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- LAYANAN --}}
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
                                        {{ $service->nama_service }} -
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


                        {{-- TANGGAL --}}
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


                        {{-- JAM --}}
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

                            <small class="text-secondary">
                                <i class="bi bi-info-circle me-1"></"></i>
                                Pilih jam sesuai jam operasional pet shop.
                            </small>

                        </div>


                        {{-- CATATAN --}}
                        <div class="col-12 mb-4">

                            <label class="form-label fw-semibold">
                                Catatan
                                <span class="text-secondary fw-normal">
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


                    {{-- BUTTON --}}
                    <div class="d-flex justify-content-end gap-2 flex-wrap">

                        <a
                            href="{{ route('customer.dashboard') }}"
                            class="btn btn-outline-secondary px-4"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn text-white px-4"
                            style="background-color: #f58220; border-color: #f58220;"
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