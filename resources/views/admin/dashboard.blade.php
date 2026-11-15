
@extends('layouts.admin')

@section('title', 'Dashboard Admin - Galaxy Petshop')

@section('page-title', 'Dashboard Admin')

@section('page-description')
    Selamat datang kembali, {{ auth()->user()->name }}!
@endsection

@section('content')

{{-- =========================
    STATISTIK
========================= --}}

<div class="row g-4 mb-4">

    {{-- TOTAL PRODUK --}}
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <p class="text-muted small fw-semibold mb-2">
                        Total Produk
                    </p>

                    <h3 class="fw-bold mb-1 text-dark">
                        {{ $jumlahProduk }}
                    </h3>

                    <span class="text-muted small">
                        Produk tersedia
                    </span>
                </div>

                <div class="stat-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

            </div>
        </div>
    </div>


    {{-- TOTAL CUSTOMER --}}
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <p class="text-muted small fw-semibold mb-2">
                        Total Customer
                    </p>

                    <h3 class="fw-bold mb-1 text-dark">
                        {{ $jumlahCustomer }}
                    </h3>

                    <span class="text-muted small">
                        Customer terdaftar
                    </span>
                </div>

                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>

            </div>
        </div>
    </div>


    {{-- TOTAL HEWAN --}}
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <p class="text-muted small fw-semibold mb-2">
                        Total Hewan
                    </p>

                    <h3 class="fw-bold mb-1 text-dark">
                        {{ $jumlahHewan }}
                    </h3>

                    <span class="text-muted small">
                        Hewan terdaftar
                    </span>
                </div>

                <div class="stat-icon">
                    <i class="bi bi-heart"></i>
                </div>

            </div>
        </div>
    </div>


    {{-- TOTAL BOOKING --}}
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <p class="text-muted small fw-semibold mb-2">
                        Total Booking
                    </p>

                    <h3 class="fw-bold mb-1 text-dark">
                        {{ $jumlahBooking }}
                    </h3>

                    <span class="text-muted small">
                        Booking pelanggan
                    </span>
                </div>

                <div class="stat-icon">
                    <i class="bi bi-calendar-check"></i>
                </div>

            </div>
        </div>
    </div>

</div>


{{-- =========================
    BOOKING TERBARU
========================= --}}

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">

    {{-- HEADER --}}
    <div class="card-body p-4">

        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">

            <div>
                <div class="d-flex align-items-center gap-2 mb-2">

                    <span class="feature-icon">
                        <i class="bi bi-calendar-check"></i>
                    </span>

                    <h5 class="fw-bold mb-0">
                        Booking Terbaru
                    </h5>

                </div>

                <p class="text-muted small mb-0">
                    Daftar booking terbaru dari customer.
                </p>
            </div>

            <a
                href="{{ route('admin.bookings.index') }}"
                class="btn btn-outline-orange btn-sm px-3 py-2"
            >
                Lihat Semua
                <i class="bi bi-arrow-right ms-1"></i>
            </a>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead style="background-color: #fff2e6;">

                <tr>

                    <th class="px-4 py-3 text-secondary small" width="60">
                        No
                    </th>

                    <th class="py-3 text-secondary small">
                        Customer
                    </th>

                    <th class="py-3 text-secondary small">
                        Hewan
                    </th>

                    <th class="py-3 text-secondary small">
                        Layanan
                    </th>

                    <th class="py-3 text-secondary small">
                        Tanggal
                    </th>

                    <th class="py-3 text-secondary small">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($bookingTerbaru as $booking)

                    <tr>

                        {{-- NO --}}
                        <td class="px-4 fw-semibold text-muted">
                            {{ $loop->iteration }}
                        </td>


                        {{-- CUSTOMER --}}
                        <td>
                            <span class="fw-semibold text-dark">
                                {{ $booking->customer->nama ?? '-' }}
                            </span>
                        </td>


                        {{-- HEWAN --}}
                        <td>

                            <i class="bi bi-heart text-orange me-1"></i>

                            {{ $booking->pet->nama_pet ?? '-' }}

                        </td>


                        {{-- LAYANAN --}}
                        <td>
                            <span class="small text-secondary">
                                {{ $booking->service->nama_service ?? '-' }}
                            </span>
                        </td>


                        {{-- TANGGAL --}}
                        <td>

                            <span class="text-muted small">

                                <i class="bi bi-calendar3 me-1 text-orange"></i>

                                {{ $booking->tanggal_booking?->format('d/m/Y') ?? '-' }}

                            </span>

                        </td>


                        {{-- STATUS --}}
                        <td>

                            @if ($booking->status === 'Menunggu')

                                <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis px-3 py-2">
                                    <i class="bi bi-clock me-1"></i>
                                    Menunggu
                                </span>

                            @elseif ($booking->status === 'Dikonfirmasi')

                                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Dikonfirmasi
                                </span>

                            @elseif ($booking->status === 'Selesai')

                                <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Selesai
                                </span>

                            @else

                                <span class="badge rounded-pill bg-danger-subtle text-danger px-3 py-2">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Dibatalkan
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center py-5">

                            <div class="text-muted">

                                <div class="feature-icon mx-auto mb-3">
                                    <i class="bi bi-calendar-x"></i>
                                </div>

                                <p class="fw-semibold mb-1">
                                    Belum ada booking
                                </p>

                                <p class="small mb-0">
                                    Booking customer akan muncul di sini.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
