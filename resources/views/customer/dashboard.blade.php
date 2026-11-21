@extends('layouts.customer')

@section('title', 'Dashboard Customer - PetCare')

@section('content')

    {{-- HEADER --}}
    <div class="mb-4">
        <span class="badge rounded-pill px-3 py-2 mb-3"
            style="background-color: #fff2e6; color: #d96812;">
            <i class="bi bi-stars me-1"></i> Customer Dashboard
        </span>

        <h2 class="fw-bold mb-1">
            Halo, {{ auth()->user()->name }}! 
        </h2>

        <p class="text-secondary mb-0">
            Selamat datang di PetCare. Kelola kebutuhan hewan kesayanganmu dengan mudah.
        </p>
    </div>


    {{-- MENU UTAMA --}}
    <div class="row g-4 mb-4">

        {{-- BOOKING --}}
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <div class="rounded-3 d-flex align-items-center justify-content-center mb-3"
                        style="width: 55px; height: 55px; background-color: #fff2e6; color: #d96812;">
                        <i class="bi bi-calendar-check fs-3"></i>
                    </div>

                    <h5 class="fw-bold">Booking Grooming</h5>

                    <p class="text-secondary mb-4">
                        Jadwalkan grooming untuk hewan kesayanganmu.
                    </p>

                    <a href="{{ route('customer.booking') }}"
                        class="btn text-white px-4"
                        style="background-color: #f58220; border-color: #f58220;">
                        <i class="bi bi-calendar-plus me-1"></i>
                        Buat Booking
                    </a>

                </div>
            </div>
        </div>


        {{-- HEWAN --}}
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <div class="rounded-3 d-flex align-items-center justify-content-center mb-3"
                        style="width: 55px; height: 55px; background-color: #fff2e6; color: #d96812;">
                        <i class="bi bi-heart fs-3"></i>
                    </div>

                    <h5 class="fw-bold">Hewan Saya</h5>

                    <p class="text-secondary mb-4">
                        Kelola data hewan peliharaan yang kamu miliki.
                    </p>

                    <a href="{{ route('customer.pets.index') }}"
                        class="btn text-white px-4"
                        style="background-color: #f58220; border-color: #f58220; color: #d96812;">
                        <i class="bi bi-heart me-1"></i>
                        Lihat Hewan
                    </a>

                </div>
            </div>
        </div>


        {{-- PRODUK --}}
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <div class="rounded-3 d-flex align-items-center justify-content-center mb-3"
                        style="width: 55px; height: 55px; background-color: #fff2e6; color: #d96812;">
                        <i class="bi bi-bag fs-3"></i>
                    </div>

                    <h5 class="fw-bold">Produk Pet Shop</h5>

                    <p class="text-secondary mb-4">
                        Lihat produk makanan dan kebutuhan hewan.
                    </p>

                    <a href="{{ route('customer.products') }}"
                       class="btn text-white px-4"
                        style="background-color: #f58220; border-color: #f58220; color: #d96812;">
                        <i class="bi bi-bag me-1"></i>
                        Lihat Produk
                    </a>

                </div>
            </div>
        </div>

    </div>


    {{-- BOOKING & INFORMASI --}}
    <div class="row g-4">

        {{-- BOOKING --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Booking Grooming
                            </h5>

                            <p class="text-secondary mb-0">
                                Kelola jadwal grooming hewanmu.
                            </p>
                        </div>

                        <i class="bi bi-calendar-heart fs-2"
                            style="color: #f58220;"></i>

                    </div>

                    <div class="rounded-4 p-4 text-center"
                        style="background-color: #fff2e6;">

                        <i class="bi bi-calendar-check"
                            style="font-size: 45px; color: #f58220;"></i>

                        <p class="text-secondary mt-3 mb-3">
                            Kamu bisa membuat booking grooming sekarang.
                        </p>

                        <a href="{{ route('customer.booking') }}"
                            class="btn text-white px-4"
                            style="background-color: #f58220; border-color: #f58220;">
                            <i class="bi bi-calendar-plus me-1"></i>
                            Booking Sekarang
                        </a>

                    </div>

                </div>
            </div>
        </div>


        {{-- INFORMASI AKUN --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <div class="d-flex align-items-center gap-2 mb-4">
                        <div class="rounded-3 d-flex align-items-center justify-content-center"
                            style="width: 42px; height: 42px; background-color: #fff2e6; color: #d96812;">
                            <i class="bi bi-person-circle fs-5"></i>
                        </div>

                        <h5 class="fw-bold mb-0">
                            Informasi Akun
                        </h5>
                    </div>

                    {{-- NAMA --}}
                    <div class="mb-3">
                        <small class="text-secondary d-block mb-1">
                            Nama
                        </small>

                        <span class="fw-semibold">
                            {{ auth()->user()->name }}
                        </span>
                    </div>

                    {{-- USERNAME --}}
                    <div class="mb-3">
                        <small class="text-secondary d-block mb-1">
                            Username
                        </small>

                        <span class="fw-semibold">
                            {{ auth()->user()->username }}
                        </span>
                    </div>

                    {{-- EMAIL --}}
                    <div class="mb-3">
                        <small class="text-secondary d-block mb-1">
                            Email
                        </small>

                        <span class="fw-semibold text-break">
                            {{ auth()->user()->email }}
                        </span>
                    </div>

                    {{-- ROLE --}}
                    <div>
                        <small class="text-secondary d-block mb-2">
                            Role
                        </small>

                        <span class="badge rounded-pill px-3 py-2"
                            style="background-color: #fff2e6; color: #d96812;">
                            <i class="bi bi-person-check me-1"></i>
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection