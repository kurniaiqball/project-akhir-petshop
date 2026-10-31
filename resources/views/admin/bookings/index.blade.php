
@extends('layouts.admin')

@section('title', 'Booking Grooming - PetCare')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Booking Grooming</h2>
        <p class="text-muted mb-0">
            Kelola jadwal grooming customer.
        </p>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Main Card --}}
    <div class="card border-0 shadow-sm rounded-3">

        {{-- Search & Filter --}}
        <div class="card-body p-4 border-bottom">

            <form
                action="{{ route('admin.bookings.index') }}"
                method="GET"
                class="row g-2"
            >

                {{-- Search --}}
                <div class="col-lg-6 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-search text-muted"></i>
                        </span>

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari customer, hewan, atau layanan..."
                            value="{{ request('search') }}"
                        >
                    </div>
                </div>

                {{-- Status Filter --}}
                <div class="col-lg-3 col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>

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

                {{-- Search Button --}}
                <div class="col-lg-1 col-md-1">
                    <button
                        type="submit"
                        class="btn btn-primary w-100"
                        title="Cari"
                    >
                        <i class="bi bi-search"></i>
                    </button>
                </div>

                {{-- Reset --}}
                <div class="col-lg-2 col-md-2">
                    <a
                        href="{{ route('admin.bookings.index') }}"
                        class="btn btn-outline-secondary w-100"
                    >
                        Reset
                    </a>
                </div>

            </form>

        </div>

        {{-- Table --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="py-3">Customer</th>
                        <th class="py-3">Hewan</th>
                        <th class="py-3">Layanan</th>
                        <th class="py-3">Jadwal</th>
                        <th class="py-3">Status</th>
                        <th class="py-3" width="190">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($bookings as $booking)

                        <tr>

                            {{-- No --}}
                            <td class="px-4 text-muted">
                                {{ $bookings->firstItem() + $loop->index }}
                            </td>

                            {{-- Customer --}}
                            <td>
                                <div class="fw-semibold text-dark">
                                    {{ $booking->customer->nama ?? '-' }}
                                </div>

                                <small class="text-muted">
                                    {{ $booking->customer->no_hp ?? '-' }}
                                </small>
                            </td>

                            {{-- Hewan --}}
                            <td>
                                <div class="fw-semibold text-dark">
                                    {{ $booking->pet->nama_pet ?? '-' }}
                                </div>

                                <small class="text-muted">
                                    {{ $booking->pet->jenis ?? '-' }}
                                </small>
                            </td>

                            {{-- Layanan --}}
                            <td>
                                <div class="fw-semibold text-dark">
                                    {{ $booking->service->nama_service ?? '-' }}
                                </div>

                                @if($booking->service)
                                    <small class="text-success fw-semibold">
                                        Rp {{ number_format($booking->service->harga, 0, ',', '.') }}
                                    </small>
                                @endif
                            </td>

                            {{-- Jadwal --}}
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

                            {{-- Status --}}
                            <td>
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

                                <span class="badge rounded-pill {{ $statusConfig['class'] }} px-3 py-2">
                                    <i class="bi {{ $statusConfig['icon'] }} me-1"></i>
                                    {{ $statusConfig['label'] }}
                                </span>
                            </td>

                            {{-- Update Status --}}
                            <td>
                                <form
                                    action="{{ route('admin.bookings.status', $booking) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('PUT')

                                    <div class="input-group">
                                        <select
                                            name="status"
                                            class="form-select form-select-sm"
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
                                            class="btn btn-primary btn-sm"
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
                            <td colspan="7" class="text-center py-5">

                                <i class="bi bi-calendar-x fs-1 text-muted"></i>

                                <p class="fw-semibold mt-3 mb-1">
                                    Belum ada booking
                                </p>

                                <p class="text-muted small mb-0">
                                    Booking customer akan muncul di sini.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        @if($bookings->hasPages())
            <div class="card-footer bg-white border-0 p-3">
                {{ $bookings->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>

</div>

@endsection
