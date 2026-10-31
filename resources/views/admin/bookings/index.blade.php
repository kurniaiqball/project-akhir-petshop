@extends('layouts.admin')

@section('content')

<style>
    .booking-page {
        color: #344054;
    }

    /* Header */
    .booking-title {
        font-size: 28px;
        font-weight: 700;
        color: #182230;
        letter-spacing: -0.4px;
    }

    .booking-subtitle {
        color: #7b8494;
        font-size: 14px;
    }

    /* Card */
    .booking-card {
        background: #fff;
        border: 1px solid #e6e9ed;
        border-radius: 10px;
        overflow: hidden;
    }

    /* Filter */
    .booking-filter {
        padding: 18px 20px;
        border-bottom: 1px solid #edf0f3;
        background: #fff;
    }

    .search-wrapper {
        position: relative;
    }

    .search-wrapper i {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #98a2b3;
        font-size: 15px;
        z-index: 2;
    }

    .search-wrapper input {
        height: 40px;
        padding-left: 38px;
        border: 1px solid #dce1e7;
        border-radius: 6px;
        font-size: 14px;
        box-shadow: none;
    }

    .search-wrapper input:focus,
    .booking-filter select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, .08);
    }

    .booking-filter select {
        height: 40px;
        border: 1px solid #dce1e7;
        border-radius: 6px;
        font-size: 14px;
        color: #475467;
        box-shadow: none;
    }

    .btn-search {
        height: 40px;
        border: none;
        border-radius: 6px;
        background: #198754;
    }

    .btn-search:hover {
        background: #157347;
    }

    .btn-reset {
        height: 40px;
        border: 1px solid #d5dbe2;
        border-radius: 6px;
        background: #fff;
        color: #667085;
        font-size: 14px;
    }

    .btn-reset:hover {
        background: #f8f9fa;
        color: #344054;
    }

    /* Table */
    .booking-table-wrapper {
        padding: 0 20px;
    }

    .booking-table {
        margin-bottom: 0;
    }

    .booking-table thead th {
        background: #fafbfc;
        border-bottom: 1px solid #e4e7ec;
        color: #667085;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .3px;
        padding: 13px 12px;
        white-space: nowrap;
    }

    .booking-table tbody td {
        padding: 15px 12px;
        border-bottom: 1px solid #eef0f2;
        color: #475467;
        font-size: 14px;
        vertical-align: middle;
    }

    .booking-table tbody tr:last-child td {
        border-bottom: none;
    }

    .booking-table tbody tr {
        transition: background .15s ease;
    }

    .booking-table tbody tr:hover {
        background: #fbfdfc;
    }

    /* Number */
    .number-column {
        width: 50px;
        color: #98a2b3 !important;
        font-size: 13px !important;
    }

    /* Customer / Pet / Service */
    .main-text {
        color: #1d2939;
        font-weight: 600;
        line-height: 1.3;
    }

    .sub-text {
        display: block;
        margin-top: 4px;
        color: #98a2b3;
        font-size: 12px;
        line-height: 1.3;
    }

    .service-price {
        display: block;
        margin-top: 4px;
        color: #198754;
        font-size: 12px;
        font-weight: 500;
    }

    /* Schedule */
    .booking-date {
        color: #344054;
        font-weight: 600;
        white-space: nowrap;
    }

    .booking-time {
        display: block;
        margin-top: 4px;
        color: #98a2b3;
        font-size: 12px;
    }

    /* Status */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 9px;
        border-radius: 5px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-badge::before {
        content: "";
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-menunggu {
        background: #fff7e6;
        color: #b7791f;
    }

    .status-dikonfirmasi {
        background: #eaf7fb;
        color: #087ea4;
    }

    .status-selesai {
        background: #eaf6ef;
        color: #16834d;
    }

    .status-dibatalkan {
        background: #fff0f1;
        color: #d14343;
    }

    /* Action */
    .status-form {
        min-width: 175px;
    }

    .status-select {
        height: 34px;
        border: 1px solid #d0d5dd;
        border-radius: 6px 0 0 6px;
        font-size: 12px;
        color: #475467;
        box-shadow: none;
    }

    .status-select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 2px rgba(25, 135, 84, .08);
    }

    .btn-update-status {
        width: 38px;
        height: 34px;
        border: none;
        border-radius: 0 6px 6px 0;
        background: #198754;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-update-status:hover {
        background: #157347;
        color: #fff;
    }

    /* Empty */
    .empty-state {
        padding: 60px 20px !important;
        text-align: center;
    }

    .empty-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #f2f4f7;
        color: #98a2b3;
        font-size: 21px;
    }

    .empty-title {
        color: #344054;
        font-weight: 600;
        font-size: 14px;
    }

    .empty-text {
        margin-top: 4px;
        color: #98a2b3;
        font-size: 13px;
    }

    /* Alert */
    .booking-alert {
        border-radius: 7px;
        font-size: 14px;
    }

    /* Pagination */
    .booking-pagination {
        padding: 14px 20px;
        border-top: 1px solid #edf0f3;
    }

    .booking-pagination .pagination {
        margin-bottom: 0;
    }

    .booking-pagination .page-link {
        min-width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #667085;
        border-color: #e4e7ec;
        font-size: 13px;
    }

    .booking-pagination .page-item.active .page-link {
        background: #198754;
        border-color: #198754;
        color: #fff;
    }

    .booking-pagination .page-link:hover {
        background: #f3f8f5;
        color: #198754;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .booking-table {
            min-width: 950px;
        }
    }

    @media (max-width: 768px) {
        .booking-title {
            font-size: 23px;
        }

        .booking-filter {
            padding: 14px;
        }

        .booking-table-wrapper {
            padding: 0 10px;
        }
    }
</style>


<div class="booking-page">

    {{-- =========================
         HEADER
    ========================== --}}
    <div class="mb-4">

        <h2 class="booking-title mb-1">
            Booking Grooming
        </h2>

        <p class="booking-subtitle mb-0">
            Kelola jadwal grooming customer.
        </p>

    </div>


    {{-- =========================
         SUCCESS MESSAGE
    ========================== --}}
    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show booking-alert mb-4"
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


    {{-- =========================
         ERROR MESSAGE
    ========================== --}}
    @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show booking-alert mb-4"
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


    {{-- =========================
         MAIN CARD
    ========================== --}}
    <div class="booking-card shadow-sm">


        {{-- =========================
             SEARCH & FILTER
        ========================== --}}
        <div class="booking-filter">

            <form
                action="{{ route('admin.bookings.index') }}"
                method="GET"
                class="row g-2"
            >

                {{-- Search --}}
                <div class="col-lg-6 col-md-6">

                    <div class="search-wrapper">

                        <i class="bi bi-search"></i>

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari customer, hewan, atau layanan..."
                            value="{{ request('search') }}"
                        >

                    </div>

                </div>


                {{-- Status --}}
                <div class="col-lg-3 col-md-3">

                    <select
                        name="status"
                        class="form-select"
                    >

                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="Menunggu"
                            {{ request('status') === 'Menunggu' ? 'selected' : '' }}
                        >
                            Menunggu
                        </option>

                        <option
                            value="Dikonfirmasi"
                            {{ request('status') === 'Dikonfirmasi' ? 'selected' : '' }}
                        >
                            Dikonfirmasi
                        </option>

                        <option
                            value="Selesai"
                            {{ request('status') === 'Selesai' ? 'selected' : '' }}
                        >
                            Selesai
                        </option>

                        <option
                            value="Dibatalkan"
                            {{ request('status') === 'Dibatalkan' ? 'selected' : '' }}
                        >
                            Dibatalkan
                        </option>

                    </select>

                </div>


                {{-- Search --}}
                <div class="col-lg-1 col-md-1">

                    <button
                        type="submit"
                        class="btn btn-success btn-search w-100"
                        title="Cari"
                    >
                        <i class="bi bi-search"></i>
                    </button>

                </div>


                {{-- Reset --}}
                <div class="col-lg-2 col-md-2">

                    <a
                        href="{{ route('admin.bookings.index') }}"
                        class="btn btn-reset w-100"
                    >
                        Reset
                    </a>

                </div>

            </form>

        </div>


        {{-- =========================
             TABLE
        ========================== --}}
        <div class="booking-table-wrapper">

            <div class="table-responsive">

                <table class="table booking-table align-middle">

                    <thead>

                        <tr>

                            <th class="number-column">
                                No
                            </th>

                            <th>
                                Customer
                            </th>

                            <th>
                                Hewan
                            </th>

                            <th>
                                Layanan
                            </th>

                            <th>
                                Jadwal
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="190">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($bookings as $booking)

                            <tr>

                                {{-- No --}}
                                <td class="number-column">
                                    {{ $bookings->firstItem() + $loop->index }}
                                </td>


                                {{-- Customer --}}
                                <td>

                                    <div class="main-text">
                                        {{ $booking->customer->nama ?? '-' }}
                                    </div>

                                    <span class="sub-text">
                                        {{ $booking->customer->no_hp ?? '-' }}
                                    </span>

                                </td>


                                {{-- Hewan --}}
                                <td>

                                    <div class="main-text">
                                        {{ $booking->pet->nama_pet ?? '-' }}
                                    </div>

                                    <span class="sub-text">
                                        {{ $booking->pet->jenis ?? '-' }}
                                    </span>

                                </td>


                                {{-- Layanan --}}
                                <td>

                                    <div class="main-text">
                                        {{ $booking->service->nama_service ?? '-' }}
                                    </div>

                                    @if($booking->service)

                                        <span class="service-price">
                                            Rp {{ number_format($booking->service->harga, 0, ',', '.') }}
                                        </span>

                                    @endif

                                </td>


                                {{-- Jadwal --}}
                                <td>

                                    <div class="booking-date">
                                        {{ $booking->tanggal_booking?->format('d/m/Y') }}
                                    </div>

                                    <span class="booking-time">
                                        {{ $booking->jam_booking }}
                                    </span>

                                </td>


                                {{-- Status --}}
                                <td>

                                    @if($booking->status === 'Menunggu')

                                        <span class="status-badge status-menunggu">
                                            Menunggu
                                        </span>

                                    @elseif($booking->status === 'Dikonfirmasi')

                                        <span class="status-badge status-dikonfirmasi">
                                            Dikonfirmasi
                                        </span>

                                    @elseif($booking->status === 'Selesai')

                                        <span class="status-badge status-selesai">
                                            Selesai
                                        </span>

                                    @else

                                        <span class="status-badge status-dibatalkan">
                                            Dibatalkan
                                        </span>

                                    @endif

                                </td>


                                {{-- Update Status --}}
                                <td>

                                    <form
                                        action="{{ route('admin.bookings.status', $booking) }}"
                                        method="POST"
                                        class="status-form"
                                    >

                                        @csrf
                                        @method('PUT')

                                        <div class="input-group">

                                            <select
                                                name="status"
                                                class="form-select status-select"
                                            >

                                                <option
                                                    value="Menunggu"
                                                    {{ $booking->status === 'Menunggu' ? 'selected' : '' }}
                                                >
                                                    Menunggu
                                                </option>

                                                <option
                                                    value="Dikonfirmasi"
                                                    {{ $booking->status === 'Dikonfirmasi' ? 'selected' : '' }}
                                                >
                                                    Dikonfirmasi
                                                </option>

                                                <option
                                                    value="Selesai"
                                                    {{ $booking->status === 'Selesai' ? 'selected' : '' }}
                                                >
                                                    Selesai
                                                </option>

                                                <option
                                                    value="Dibatalkan"
                                                    {{ $booking->status === 'Dibatalkan' ? 'selected' : '' }}
                                                >
                                                    Dibatalkan
                                                </option>

                                            </select>

                                            <button
                                                type="submit"
                                                class="btn btn-update-status"
                                                title="Simpan perubahan"
                                            >
                                                <i class="bi bi-check-lg"></i>
                                            </button>

                                        </div>

                                    </form>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="empty-state"
                                >

                                    <div class="empty-icon">
                                        <i class="bi bi-calendar-x"></i>
                                    </div>

                                    <div class="empty-title">
                                        Belum ada booking
                                    </div>

                                    <div class="empty-text">
                                        Booking customer akan muncul di sini.
                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- =========================
             PAGINATION
        ========================== --}}
        @if($bookings->hasPages())

            <div class="booking-pagination">

                {{ $bookings->links() }}

            </div>

        @endif


    </div>

</div>

@endsection