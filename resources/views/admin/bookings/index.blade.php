
@extends('layouts.admin')

@section('title', 'Booking Grooming - Galaxy Petshop')

@section('page-title', 'Booking Grooming')

@section('page-description')
    Kelola jadwal grooming customer Galaxy Petshop.
@endsection

@section('content')

@push('styles')
<style>
    .booking-card {
        border: none;
        border-radius: 15px;
    }

    .btn-orange {
        background-color: #ff922b;
        border-color: #ff922b;
        color: white;
    }

    .btn-orange:hover {
        background-color: #f07812;
        border-color: #f07812;
        color: white;
    }

    .btn-outline-orange {
        border-color: #ff922b;
        color: #ff922b;
    }

    .btn-outline-orange:hover {
        background-color: #ff922b;
        color: white;
    }

    .table thead th {
        background-color: #fff3e6;
        color: #754016;
        border-bottom: 2px solid #ff922b;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .table tbody tr:hover {
        background-color: #fffaf5;
    }

    .table tbody td {
        font-size: 14px;
        vertical-align: middle;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #ff922b;
        box-shadow: 0 0 0 0.2rem rgba(255,146,43,.15);
    }

    .btn {
        border-radius: 9px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 8px 12px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .action-form {
        display: flex;
        align-items: center;
        gap: 5px;
        min-width: 165px;
    }

    .action-form .form-select {
        flex: 1;
        min-width: 0;
        font-size: 12px;
    }

    .action-form button {
        flex-shrink: 0;
    }

    .empty-icon {
        width: 58px;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff0df;
        color: #ff922b;
        border-radius: 15px;
        font-size: 25px;
    }

    @media (max-width: 768px) {
        .booking-card .card-body {
            padding: 18px !important;
        }

        .booking-toolbar {
            align-items: stretch !important;
        }

        .booking-search {
            width: 100%;
        }

        .booking-search input {
            width: 100% !important;
        }

        .booking-search select {
            flex: 1;
            width: auto !important;
        }

        .table {
            min-width: 850px;
        }
    }
</style>
@endpush

{{-- NOTIFIKASI SUCCESS --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- NOTIFIKASI ERROR --}}
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-3">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- CARD BOOKING --}}
<div class="card booking-card shadow-sm">

    <div class="card-body p-3 p-md-4">

        {{-- TOOLBAR --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4 booking-toolbar">

            <div>
                <h5 class="fw-bold mb-1">
                    Daftar Booking Grooming
                </h5>

                <small class="text-muted">
                    Total booking pada halaman ini:
                    {{ $bookings->count() }} booking
                </small>
            </div>

            {{-- SEARCH DAN FILTER --}}
            <form
                action="{{ route('admin.bookings.index') }}"
                method="GET"
                class="d-flex align-items-center gap-2 flex-wrap booking-search"
            >

                {{-- SEARCH --}}
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    style="width: 250px;"
                    placeholder="Cari customer, hewan, layanan..."
                    value="{{ request('search') }}"
                >

                {{-- FILTER STATUS --}}
                <select
                    name="status"
                    class="form-select"
                    style="width: 165px;"
                >

                    <option value="">Semua Status</option>

                    <option value="Menunggu"
                        {{ request('status') === 'Menunggu' ? 'selected' : '' }}>
                        Menunggu
                    </option>

                    <option value="Dikonfirmasi"
                        {{ request('status') === 'Dikonfirmasi' ? 'selected' : '' }}>
                        Dikonfirmasi
                    </option>

                    <option value="Selesai"
                        {{ request('status') === 'Selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>

                    <option value="Dibatalkan"
                        {{ request('status') === 'Dibatalkan' ? 'selected' : '' }}>
                        Dibatalkan
                    </option>

                </select>

                {{-- BUTTON SEARCH --}}
                <button
                    type="submit"
                    class="btn btn-orange px-3"
                    title="Cari booking"
                >
                    <i class="bi bi-search"></i>
                </button>

                {{-- RESET --}}
                @if(request()->filled('search') || request()->filled('status'))
                    <a
                        href="{{ route('admin.bookings.index') }}"
                        class="btn btn-outline-secondary"
                        title="Reset pencarian"
                    >
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                @endif

            </form>

        </div>

        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th width="60" class="px-3 text-center">No</th>
                        <th>Customer</th>
                        <th>Hewan</th>
                        <th>Layanan</th>
                        <th>Jadwal</th>
                        <th>Status</th>
                        <th width="190">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($bookings as $booking)

                        @php
                            $status = strtolower($booking->status ?? '');

                            $statusConfig = match ($status) {

                                'menunggu' => [
                                    'class' => 'bg-warning-subtle text-warning-emphasis',
                                    'icon' => 'bi-clock',
                                    'label' => 'Menunggu',
                                ],

                                'dikonfirmasi' => [
                                    'class' => 'bg-primary-subtle text-primary',
                                    'icon' => 'bi-check-circle',
                                    'label' => 'Dikonfirmasi',
                                ],

                                'selesai' => [
                                    'class' => 'bg-success-subtle text-success',
                                    'icon' => 'bi-check-circle-fill',
                                    'label' => 'Selesai',
                                ],

                                'dibatalkan' => [
                                    'class' => 'bg-danger-subtle text-danger',
                                    'icon' => 'bi-x-circle',
                                    'label' => 'Dibatalkan',
                                ],

                                default => [
                                    'class' => 'bg-secondary-subtle text-secondary',
                                    'icon' => 'bi-question-circle',
                                    'label' => ucfirst($booking->status ?? 'Tidak diketahui'),
                                ],
                            };
                        @endphp

                        <tr>

                            {{-- NOMOR --}}
                            <td class="px-3 text-center text-muted">
                                {{ $bookings->firstItem() + $loop->index }}
                            </td>

                            {{-- CUSTOMER --}}
                            <td>
                                <div class="fw-semibold text-dark">
                                    {{ $booking->customer->nama ?? '-' }}
                                </div>

                                <small class="text-muted">
                                    {{ $booking->customer->no_hp ?? '-' }}
                                </small>
                            </td>

                            {{-- HEWAN --}}
                            <td>
                                <div class="fw-semibold text-dark">
                                    {{ $booking->pet->nama_pet ?? '-' }}
                                </div>

                                <small class="text-muted">
                                    {{ $booking->pet->jenis ?? '-' }}
                                </small>
                            </td>

                            {{-- LAYANAN --}}
                            <td>
                                <div class="fw-semibold text-dark">
                                    {{ $booking->service->nama_service ?? '-' }}
                                </div>

                                @if($booking->service)
                                    <small class="fw-semibold"
                                           style="color: #ff922b;">
                                        Rp {{ number_format($booking->service->harga, 0, ',', '.') }}
                                    </small>
                                @endif
                            </td>

                            {{-- JADWAL --}}
                            <td>
                                <div class="fw-semibold text-dark">
                                    {{ $booking->tanggal_booking?->format('d/m/Y') ?? '-' }}
                                </div>

                                <small class="text-muted">
                                    {{ $booking->jam_booking
                                        ? \Carbon\Carbon::parse($booking->jam_booking)->format('H:i')
                                        : '-'
                                    }}
                                </small>
                            </td>

                            {{-- STATUS --}}
                            <td>
                                <span class="status-badge {{ $statusConfig['class'] }}">
                                    <i class="bi {{ $statusConfig['icon'] }}"></i>
                                    {{ $statusConfig['label'] }}
                                </span>
                            </td>

                            {{-- UPDATE STATUS --}}
                            <td>

                                <form
                                    action="{{ route('admin.bookings.status', $booking) }}"
                                    method="POST"
                                    class="action-form"
                                >

                                    @csrf
                                    @method('PUT')

                                    <select
                                        name="status"
                                        class="form-select form-select-sm"
                                    >

                                        <option value="Menunggu"
                                            {{ $booking->status === 'Menunggu' ? 'selected' : '' }}>
                                            Menunggu
                                        </option>

                                        <option value="Dikonfirmasi"
                                            {{ $booking->status === 'Dikonfirmasi' ? 'selected' : '' }}>
                                            Dikonfirmasi
                                        </option>

                                        <option value="Selesai"
                                            {{ $booking->status === 'Selesai' ? 'selected' : '' }}>
                                            Selesai
                                        </option>

                                        <option value="Dibatalkan"
                                            {{ $booking->status === 'Dibatalkan' ? 'selected' : '' }}>
                                            Dibatalkan
                                        </option>

                                    </select>

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-orange"
                                        title="Simpan perubahan"
                                    >
                                        <i class="bi bi-check-lg"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        {{-- DATA KOSONG --}}
                        <tr>
                            <td colspan="7" class="text-center py-5">

                                <div class="d-flex flex-column align-items-center">

                                    <div class="empty-icon mb-3">
                                        <i class="bi bi-calendar-x"></i>
                                    </div>

                                    <p class="fw-semibold mb-1">
                                        Booking tidak ditemukan.
                                    </p>

                                    <p class="text-muted small mb-0">
                                        Belum ada booking atau coba ubah kata kunci pencarian.
                                    </p>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        @if($bookings->hasPages())
            <div class="d-flex justify-content-end mt-4">

                {{ $bookings->onEachSide(1)->withQueryString()->links('pagination::bootstrap-5') }}

            </div>
        @endif

    </div>

</div>

@endsection