
@extends('layouts.customer')

@section('title', 'Dashboard Customer - PetCare')

@section('content')

    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            Halo, {{ auth()->user()->name }}! 👋
        </h2>

        <p class="text-muted mb-0">
            Selamat datang di PetCare. Kelola kebutuhan hewan kesayanganmu dengan mudah.
        </p>
    </div>


    {{-- Menu Utama --}}
    <div class="row g-4 mb-4">

        {{-- Booking --}}
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">

                    <div
                        class="rounded-3 bg-success-subtle d-flex align-items-center justify-content-center mb-3"
                        style="width: 55px; height: 55px;"
                    >
                        <i class="bi bi-calendar-check text-success fs-3"></i>
                    </div>

                    <h5 class="fw-bold">
                        Booking Grooming
                    </h5>

                    <p class="text-muted">
                        Jadwalkan grooming untuk hewan kesayanganmu.
                    </p>

                    <a
                        href="{{ route('customer.booking') }}"
                        class="btn btn-success"
                    >
                        <i class="bi bi-calendar-plus me-1"></i>
                        Buat Booking
                    </a>

                </div>
            </div>
        </div>


        {{-- Hewan --}}
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">

                    <div
                        class="rounded-3 bg-primary-subtle d-flex align-items-center justify-content-center mb-3"
                        style="width: 55px; height: 55px;"
                    >
                        <i class="bi bi-heart text-primary fs-3"></i>
                    </div>

                    <h5 class="fw-bold">
                        Hewan Saya
                    </h5>

                    <p class="text-muted">
                        Kelola data hewan peliharaan yang kamu miliki.
                    </p>

               <a 
    href="{{ route('customer.pets.index') }}"
    class="btn btn-outline-primary"
>
    <i class="bi bi-heart me-1"></i>
    Lihat Hewan
</a>

                </div>
            </div>
        </div>


        {{-- Produk --}}
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">

                    <div
                        class="rounded-3 bg-warning-subtle d-flex align-items-center justify-content-center mb-3"
                        style="width: 55px; height: 55px;"
                    >
                        <i class="bi bi-bag text-warning fs-3"></i>
                    </div>

                    <h5 class="fw-bold">
                        Produk Pet Shop
                    </h5>

                    <p class="text-muted">
                        Lihat produk makanan dan kebutuhan hewan.
                    </p>

                    <a
                        href="{{ route('customer.products') }}"
                        class="btn btn-outline-warning"
                    >
                        <i class="bi bi-bag me-1"></i>
                        Lihat Produk
                    </a>

                </div>
            </div>
        </div>

    </div>


    {{-- Booking & Informasi --}}
    <div class="row g-4">

        {{-- Booking --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Booking Grooming
                            </h5>

                            <p class="text-muted mb-0">
                                Kelola jadwal grooming hewanmu.
                            </p>
                        </div>

                        <i class="bi bi-calendar-heart text-success fs-2"></i>

                    </div>

                    <div class="bg-light rounded-3 p-4 text-center">

                        <i
                            class="bi bi-calendar-check text-success"
                            style="font-size: 45px;"
                        ></i>

                        <p class="text-muted mt-3 mb-3">
                            Kamu bisa membuat booking grooming sekarang.
                        </p>

                        <a
                            href="{{ route('customer.booking') }}"
                            class="btn btn-success"
                        >
                            <i class="bi bi-calendar-plus me-1"></i>
                            Booking Sekarang
                        </a>

                    </div>

                </div>
            </div>
        </div>


        {{-- Informasi Akun --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">
                        Informasi Akun
                    </h5>

                    {{-- Nama --}}
                    <div class="mb-3">
                        <small class="text-muted d-block">
                            Nama
                        </small>

                        <span class="fw-semibold">
                            {{ auth()->user()->name }}
                        </span>
                    </div>

                    {{-- Username --}}
                    <div class="mb-3">
                        <small class="text-muted d-block">
                            Username
                        </small>

                        <span class="fw-semibold">
                            {{ auth()->user()->username }}
                        </span>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <small class="text-muted d-block">
                            Email
                        </small>

                        <span class="fw-semibold">
                            {{ auth()->user()->email }}
                        </span>
                    </div>

                    {{-- Role --}}
                    <div>
                        <small class="text-muted d-block">
                            Role
                        </small>

                        <span class="badge bg-success">
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

