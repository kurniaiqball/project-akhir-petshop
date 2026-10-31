
@extends('layouts.admin')

@section('title', 'Dashboard Admin - PetCare')

@section('page-title', 'Dashboard Admin')

@section('page-description')
    Selamat datang kembali, {{ auth()->user()->name }} 👋
@endsection

@section('content')

{{-- =========================
    STATISTIK
========================= --}}

<div class="row g-4 mb-4">

    {{-- TOTAL PRODUK --}}
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <p class="text-muted small fw-semibold mb-1">
                        Total Produk
                    </p>

                    <h3 class="fw-bold mb-1">
                        {{ $jumlahProduk }}
                    </h3>

                    <span class="text-muted small">
                        Produk tersedia
                    </span>
                </div>

                <div class="text-success">
                    <i class="bi bi-box-seam fs-1"></i>
                </div>

            </div>
        </div>
    </div>


    {{-- TOTAL CUSTOMER --}}
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <p class="text-muted small fw-semibold mb-1">
                        Total Customer
                    </p>

                    <h3 class="fw-bold mb-1">
                        {{ $jumlahCustomer }}
                    </h3>

                    <span class="text-muted small">
                        Customer terdaftar
                    </span>
                </div>

                <div class="text-primary">
                    <i class="bi bi-people fs-1"></i>
                </div>

            </div>
        </div>
    </div>


    {{-- TOTAL HEWAN --}}
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <p class="text-muted small fw-semibold mb-1">
                        Total Hewan
                    </p>

                    <h3 class="fw-bold mb-1">
                        {{ $jumlahHewan }}
                    </h3>

                    <span class="text-muted small">
                        Hewan terdaftar
                    </span>
                </div>

                <div class="text-warning">
                    <i class="bi bi-heart fs-1"></i>
                </div>

            </div>
        </div>
    </div>


    {{-- TOTAL BOOKING --}}
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <p class="text-muted small fw-semibold mb-1">
                        Total Booking
                    </p>

                    <h3 class="fw-bold mb-1">
                        {{ $jumlahBooking }}
                    </h3>

                    <span class="text-muted small">
                        Booking pelanggan
                    </span>
                </div>

                <div class="text-info">
                    <i class="bi bi-calendar-check fs-1"></i>
                </div>

            </div>
        </div>
    </div>

</div>


{{-- =========================
    BOOKING TERBARU
========================= --}}

<div class="card shadow-sm border-0">

    {{-- HEADER --}}
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h5 class="fw-bold mb-1">
                    Booking Terbaru
                </h5>

                <p class="text-muted small mb-0">
                    Daftar booking terbaru dari customer.
                </p>
            </div>

            <a
                href="{{ route('admin.bookings.index') }}"
                class="btn btn-outline-primary btn-sm"
            >
                Lihat Semua
                <i class="bi bi-arrow-right ms-1"></i>
            </a>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">
                <tr>
                    <th class="px-3" width="60">No</th>
                    <th>Customer</th>
                    <th>Hewan</th>
                    <th>Layanan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($bookingTerbaru as $booking)

                    <tr>

                        {{-- NO --}}
                        <td class="px-3 fw-semibold">
                            {{ $loop->iteration }}
                        </td>


                        {{-- CUSTOMER --}}
                        <td>
                            <span class="fw-semibold">
                                {{ $booking->customer->nama ?? '-' }}
                            </span>
                        </td>


                        {{-- HEWAN --}}
                        <td>
                            <i class="bi bi-heart text-danger me-1"></i>
                            {{ $booking->pet->nama_pet ?? '-' }}
                        </td>


                        {{-- LAYANAN --}}
                        <td>
                            <span class="small">
                                {{ $booking->service->nama_service ?? '-' }}
                            </span>
                        </td>


                        {{-- TANGGAL --}}
                        <td>
                            <span class="text-muted small">
                                <i class="bi bi-calendar3 me-1"></i>

                                {{ $booking->tanggal_booking?->format('d/m/Y') ?? '-' }}
                            </span>
                        </td>


                        {{-- STATUS --}}
                        <td>

                            @if ($booking->status === 'Menunggu')

                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-clock me-1"></i>
                                    Menunggu
                                </span>

                            @elseif ($booking->status === 'Dikonfirmasi')

                                <span class="badge bg-primary">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Dikonfirmasi
                                </span>

                            @elseif ($booking->status === 'Selesai')

                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Selesai
                                </span>

                            @else

                                <span class="badge bg-danger">
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
                                <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>

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
