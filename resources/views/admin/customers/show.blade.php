
@extends('layouts.admin')

@section('title', 'Detail Customer - Galaxy Petshop')

@section('page-title', 'Detail Customer')

@section('page-description')
    Informasi lengkap customer Galaxy Petshop.
@endsection

@section('content')

@push('styles')
<style>
    .customer-card {
        border: none;
        border-radius: 15px;
    }

    .section-icon {
        color: #ff922b;
    }

    .customer-profile {
        border: 3px solid #ffe0bd;
    }

    .info-label {
        color: #888;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .table thead th {
        background-color: #fff3e6;
        color: #754016;
        border-bottom: 2px solid #ff922b;
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

    .btn {
        border-radius: 9px;
    }

    .pet-item,
    .booking-item {
        border-radius: 10px;
        transition: .2s;
    }

    .pet-item:hover,
    .booking-item:hover {
        background-color: #fffaf5;
    }
</style>
@endpush

{{-- INFORMASI CUSTOMER --}}
<div class="card customer-card shadow-sm mb-4">

    <div class="card-body p-4">

        <div class="row">

            {{-- FOTO CUSTOMER --}}
            <div class="col-md-2 text-center mb-3 mb-md-0">

                @if($customer->foto)

                    <img
                        src="{{ asset('storage/' . $customer->foto) }}"
                        alt="Foto {{ $customer->nama }}"
                        width="90"
                        height="90"
                        class="rounded-circle object-fit-cover customer-profile mx-auto"
                    >

                @else

                    <div
                        class="rounded-circle d-flex align-items-center justify-content-center mx-auto customer-profile"
                        style="width:90px;height:90px;background:#fff0df;color:#ff922b;"
                    >
                        <i class="bi bi-person display-6"></i>
                    </div>

                @endif

            </div>

            {{-- DATA CUSTOMER --}}
            <div class="col-md-10">

                <h4 class="fw-bold mb-1">
                    {{ $customer->nama }}
                </h4>

                <p class="text-muted mb-3">
                    {{ '@' . ($customer->user->username ?? '-') }}
                </p>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <div class="info-label">Email</div>

                        <span class="fw-semibold">
                            <i class="bi bi-envelope me-1 section-icon"></i>
                            {{ $customer->email }}
                        </span>

                    </div>

                    <div class="col-md-6 mb-3">

                        <div class="info-label">Nomor HP</div>

                        <span class="fw-semibold">
                            <i class="bi bi-telephone me-1 section-icon"></i>
                            {{ $customer->no_hp ?? '-' }}
                        </span>

                    </div>

                    <div class="col-md-12">

                        <div class="info-label">Alamat</div>

                        <span class="fw-semibold">
                            <i class="bi bi-geo-alt me-1 section-icon"></i>
                            {{ $customer->alamat ?? '-' }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="row">

    {{-- HEWAN PELIHARAAN --}}
    <div class="col-lg-6 mb-4">

        <div class="card customer-card shadow-sm h-100">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <h5 class="fw-bold mb-0">
                    <i class="bi bi-heart me-2 section-icon"></i>
                    Hewan Peliharaan
                </h5>

                <small class="text-muted">
                    Daftar hewan milik customer.
                </small>

            </div>

            <div class="card-body p-4">

                @forelse($customer->pets as $pet)

                    <div class="border p-3 mb-2 pet-item">

                        <div class="d-flex justify-content-between">

                            <div>

                                <div class="fw-semibold">
                                    {{ $pet->nama_pet }}
                                </div>

                                <small class="text-muted">
                                    {{ $pet->jenis }}

                                    @if($pet->ras)
                                        • {{ $pet->ras }}
                                    @endif
                                </small>

                            </div>

                            @if($pet->jenis_kelamin === 'Jantan')

                                <span class="badge bg-primary align-self-start">
                                    <i class="bi bi-gender-male me-1"></i>
                                    Jantan
                                </span>

                            @elseif($pet->jenis_kelamin === 'Betina')

                                <span class="badge bg-danger align-self-start">
                                    <i class="bi bi-gender-female me-1"></i>
                                    Betina
                                </span>

                            @else

                                <span class="badge bg-secondary align-self-start">
                                    {{ $pet->jenis_kelamin ?? '-' }}
                                </span>

                            @endif

                        </div>

                    </div>

                @empty

                    <div class="text-center py-4">

                        <i class="bi bi-heart fs-1 section-icon"></i>

                        <p class="text-muted mb-0 mt-2">
                            Belum memiliki hewan peliharaan.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

    {{-- BOOKING GROOMING --}}
    <div class="col-lg-6 mb-4">

        <div class="card customer-card shadow-sm h-100">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <h5 class="fw-bold mb-0">
                    <i class="bi bi-calendar-check me-2 section-icon"></i>
                    Booking Grooming
                </h5>

                <small class="text-muted">
                    Riwayat booking customer.
                </small>

            </div>

            <div class="card-body p-4">

                @forelse($customer->bookings->take(5) as $booking)

                    <div class="border p-3 mb-2 booking-item">

                        <div class="d-flex justify-content-between">

                            <div>

                                <div class="fw-semibold">
                                    {{ $booking->service->nama_service ?? '-' }}
                                </div>

                                <small class="text-muted">

                                    {{ $booking->pet->nama_pet ?? '-' }}

                                    •

                                    {{ $booking->tanggal_booking?->format('d/m/Y') ?? '-' }}

                                </small>

                            </div>

                            @php
                                $status = strtolower($booking->status ?? '');
                            @endphp

                            @if($status === 'menunggu')

                                <span class="badge bg-warning text-dark align-self-start">
                                    {{ $booking->status }}
                                </span>

                            @elseif($status === 'dikonfirmasi')

                                <span class="badge bg-primary align-self-start">
                                    {{ $booking->status }}
                                </span>

                            @elseif($status === 'selesai')

                                <span class="badge bg-success align-self-start">
                                    {{ $booking->status }}
                                </span>

                            @elseif($status === 'dibatalkan')

                                <span class="badge bg-danger align-self-start">
                                    {{ $booking->status }}
                                </span>

                            @else

                                <span class="badge bg-secondary align-self-start">
                                    {{ $booking->status ?? '-' }}
                                </span>

                            @endif

                        </div>

                    </div>

                @empty

                    <div class="text-center py-4">

                        <i class="bi bi-calendar-x fs-1 section-icon"></i>

                        <p class="text-muted mb-0 mt-2">
                            Belum memiliki booking.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

{{-- RIWAYAT TRANSAKSI --}}
<div class="card customer-card shadow-sm mb-4">

    <div class="card-header bg-white border-0 pt-4 px-4">

        <h5 class="fw-bold mb-1">
            <i class="bi bi-receipt me-2 section-icon"></i>
            Riwayat Transaksi
        </h5>

        <small class="text-muted">
            Daftar transaksi customer Galaxy Petshop.
        </small>

    </div>

    <div class="card-body p-4">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($customer->transactions as $transaction)

                        <tr>

                            <td class="fw-semibold">
                                #{{ $transaction->id_transaction }}
                            </td>

                            <td>
                                <i class="bi bi-calendar3 me-1 section-icon"></i>

                                {{ $transaction->tanggal?->format('d/m/Y H:i') ?? '-' }}
                            </td>

                            <td class="fw-semibold text-nowrap">
                                Rp {{ number_format($transaction->total, 0, ',', '.') }}
                            </td>

                            <td>

                                @php
                                    $status = strtolower($transaction->status ?? '');
                                @endphp

                                @if($status === 'pending')

                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-clock me-1"></i>
                                        Pending
                                    </span>

                                @elseif($status === 'diproses')

                                    <span class="badge bg-primary">
                                        <i class="bi bi-arrow-repeat me-1"></i>
                                        Diproses
                                    </span>

                                @elseif($status === 'siap diambil')

                                    <span class="badge bg-info text-dark">
                                        <i class="bi bi-bag-check me-1"></i>
                                        Siap Diambil
                                    </span>

                                @elseif($status === 'selesai')

                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Selesai
                                    </span>

                                @elseif($status === 'dibatalkan')

                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Dibatalkan
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        {{ $transaction->status ?? '-' }}
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center py-5">

                                <i class="bi bi-receipt fs-1 section-icon"></i>

                                <p class="text-muted mb-0 mt-2">
                                    Belum ada transaksi.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

{{-- TOMBOL KEMBALI --}}
<div class="d-flex justify-content-end mb-4">

    <a
        href="{{ route('admin.customers.index') }}"
        class="btn btn-orange px-4"
    >
        <i class="bi bi-arrow-left me-1"></i>
        Kembali
    </a>

</div>

@endsection