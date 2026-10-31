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
        <div class="dashboard-stat-card">

            <div class="stat-content">
                <span class="stat-label">
                    Total Produk
                </span>

                <h3 class="stat-number">
                    {{ $jumlahProduk }}
                </h3>

                <span class="stat-info">
                    Produk tersedia
                </span>
            </div>

            <div class="stat-icon stat-icon-green">
                <i class="bi bi-box-seam"></i>
            </div>

        </div>
    </div>


    {{-- TOTAL CUSTOMER --}}
    <div class="col-12 col-md-6 col-xl-3">
        <div class="dashboard-stat-card">

            <div class="stat-content">
                <span class="stat-label">
                    Total Customer
                </span>

                <h3 class="stat-number">
                    {{ $jumlahCustomer }}
                </h3>

                <span class="stat-info">
                    Customer terdaftar
                </span>
            </div>

            <div class="stat-icon stat-icon-blue">
                <i class="bi bi-people"></i>
            </div>

        </div>
    </div>


    {{-- TOTAL HEWAN --}}
    <div class="col-12 col-md-6 col-xl-3">
        <div class="dashboard-stat-card">

            <div class="stat-content">
                <span class="stat-label">
                    Total Hewan
                </span>

                <h3 class="stat-number">
                    {{ $jumlahHewan }}
                </h3>

                <span class="stat-info">
                    Hewan terdaftar
                </span>
            </div>

            <div class="stat-icon stat-icon-orange">
                <i class="bi bi-heart"></i>
            </div>

        </div>
    </div>


    {{-- TOTAL BOOKING --}}
    <div class="col-12 col-md-6 col-xl-3">
        <div class="dashboard-stat-card">

            <div class="stat-content">
                <span class="stat-label">
                    Total Booking
                </span>

                <h3 class="stat-number">
                    {{ $jumlahBooking }}
                </h3>

                <span class="stat-info">
                    Booking pelanggan
                </span>
            </div>

            <div class="stat-icon stat-icon-cyan">
                <i class="bi bi-calendar-check"></i>
            </div>

        </div>
    </div>

</div>



{{-- =========================
    BOOKING TERBARU
========================= --}}

<div class="dashboard-card">

    {{-- HEADER --}}
    <div class="dashboard-card-header">

        <div>
            <h5 class="dashboard-card-title">
                Booking Terbaru
            </h5>

            <p class="dashboard-card-description">
                Daftar booking terbaru dari customer.
            </p>
        </div>

        <a
            href="{{ route('admin.bookings.index') }}"
            class="btn btn-outline-success btn-sm dashboard-action-btn"
        >
            Lihat Semua
            <i class="bi bi-arrow-right ms-1"></i>
        </a>

    </div>


    {{-- TABLE --}}
    <div class="table-responsive">

        <table class="table dashboard-table align-middle mb-0">

            <thead>
                <tr>
                    <th width="60">No</th>
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
                        <td>
                            <span class="table-number">
                                {{ $loop->iteration }}
                            </span>
                        </td>


                        {{-- CUSTOMER --}}
                        <td>

                            <div class="customer-name">
                                {{ $booking->customer->nama ?? '-' }}
                            </div>

                        </td>


                        {{-- HEWAN --}}
                        <td>

                            <div class="pet-name">

                                <span class="pet-icon">
                                    <i class="bi bi-heart"></i>
                                </span>

                                {{ $booking->pet->nama_pet ?? '-' }}

                            </div>

                        </td>


                        {{-- LAYANAN --}}
                        <td>

                            <span class="service-name">
                                {{ $booking->service->nama_service ?? '-' }}
                            </span>

                        </td>


                        {{-- TANGGAL --}}
                        <td>

                            <span class="booking-date">
                                <i class="bi bi-calendar3 me-1"></i>

                                {{ $booking->tanggal_booking?->format('d/m/Y') ?? '-' }}
                            </span>

                        </td>


                        {{-- STATUS --}}
                        <td>

                            @if ($booking->status === 'Menunggu')

                                <span class="status-badge status-warning">
                                    <span class="status-dot"></span>
                                    Menunggu
                                </span>

                            @elseif ($booking->status === 'Dikonfirmasi')

                                <span class="status-badge status-primary">
                                    <span class="status-dot"></span>
                                    Dikonfirmasi
                                </span>

                            @elseif ($booking->status === 'Selesai')

                                <span class="status-badge status-success">
                                    <span class="status-dot"></span>
                                    Selesai
                                </span>

                            @else

                                <span class="status-badge status-danger">
                                    <span class="status-dot"></span>
                                    Dibatalkan
                                </span>

                            @endif

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="empty-table"
                        >

                            <div class="empty-icon">
                                <i class="bi bi-calendar-x"></i>
                            </div>

                            <div>
                                <strong>Belum ada booking</strong>

                                <p>
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



{{-- =========================
    STYLE
========================= --}}

<style>

/* =========================
   STAT CARD
========================= */

.dashboard-stat-card {
    background: #ffffff;
    border: 1px solid #eaecf0;
    border-radius: 16px;
    padding: 22px;
    min-height: 145px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    transition: all 0.2s ease;
}

.dashboard-stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(16, 24, 40, 0.08);
    border-color: #d0d5dd;
}


/* CONTENT */

.stat-content {
    display: flex;
    flex-direction: column;
}

.stat-label {
    color: #667085;
    font-size: 14px;
    margin-bottom: 8px;
}

.stat-number {
    color: #101828;
    font-size: 32px;
    font-weight: 800;
    line-height: 1;
    margin-bottom: 9px;
}

.stat-info {
    color: #98a2b3;
    font-size: 12px;
}


/* =========================
   STAT ICON
========================= */

.stat-icon {
    width: 52px;
    height: 52px;

    border-radius: 14px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 23px;
}

.stat-icon-green {
    background: #dcfce7;
    color: #15803d;
}

.stat-icon-blue {
    background: #dbeafe;
    color: #2563eb;
}

.stat-icon-orange {
    background: #fef3c7;
    color: #d97706;
}

.stat-icon-cyan {
    background: #cffafe;
    color: #0891b2;
}


/* =========================
   DASHBOARD CARD
========================= */

.dashboard-card {
    background: #ffffff;
    border: 1px solid #eaecf0;
    border-radius: 16px;

    overflow: hidden;

    box-shadow: 0 2px 6px rgba(16, 24, 40, 0.04);
}


/* =========================
   CARD HEADER
========================= */

.dashboard-card-header {
    padding: 22px 24px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    border-bottom: 1px solid #f2f4f7;
}

.dashboard-card-title {
    color: #101828;
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 5px;
}

.dashboard-card-description {
    color: #667085;
    font-size: 14px;
    margin: 0;
}

.dashboard-action-btn {
    border-radius: 8px;
    font-weight: 500;
}


/* =========================
   TABLE
========================= */

.dashboard-table {
    color: #344054;
}

.dashboard-table thead th {
    background: #fcfcfd;
    color: #667085;

    font-size: 12px;
    font-weight: 600;

    text-transform: uppercase;
    letter-spacing: 0.3px;

    padding: 14px 24px;

    border-bottom: 1px solid #eaecf0;
}

.dashboard-table tbody td {
    padding: 15px 24px;

    border-bottom: 1px solid #f2f4f7;

    font-size: 14px;
}

.dashboard-table tbody tr:last-child td {
    border-bottom: none;
}

.dashboard-table tbody tr {
    transition: background 0.15s ease;
}

.dashboard-table tbody tr:hover {
    background: #f9fafb;
}


/* =========================
   TABLE CONTENT
========================= */

.table-number {
    color: #667085;
    font-weight: 500;
}

.customer-name {
    color: #101828;
    font-weight: 600;
}

.pet-name {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #344054;
}

.pet-icon {
    width: 30px;
    height: 30px;

    border-radius: 8px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    background: #fff7ed;
    color: #f97316;

    font-size: 13px;
}

.service-name {
    color: #475467;
}

.booking-date {
    color: #667085;
    white-space: nowrap;
}


/* =========================
   STATUS
========================= */

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;

    padding: 6px 10px;

    border-radius: 999px;

    font-size: 12px;
    font-weight: 600;
}

.status-dot {
    width: 6px;
    height: 6px;

    border-radius: 50%;

    background: currentColor;
}


/* STATUS COLORS */

.status-warning {
    background: #fff7ed;
    color: #c2410c;
}

.status-primary {
    background: #eff6ff;
    color: #2563eb;
}

.status-success {
    background: #ecfdf3;
    color: #15803d;
}

.status-danger {
    background: #fef2f2;
    color: #dc2626;
}


/* =========================
   EMPTY STATE
========================= */

.empty-table {
    padding: 45px 20px !important;

    text-align: center;
    color: #667085;
}

.empty-icon {
    width: 48px;
    height: 48px;

    margin: 0 auto 12px;

    border-radius: 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #f2f4f7;
    color: #98a2b3;

    font-size: 20px;
}

.empty-table strong {
    display: block;
    color: #344054;
    margin-bottom: 4px;
}

.empty-table p {
    margin: 0;
    font-size: 13px;
    color: #98a2b3;
}


/* =========================
   RESPONSIVE
========================= */

@media (max-width: 768px) {

    .dashboard-card-header {
        align-items: flex-start;
        gap: 15px;
        flex-direction: column;
    }

    .dashboard-action-btn {
        width: 100%;
    }

    .dashboard-table thead th,
    .dashboard-table tbody td {
        padding-left: 16px;
        padding-right: 16px;
    }

}

</style>

@endsection