@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Detail Customer</h2>
        <p class="text-muted mb-0">
            Informasi lengkap customer.
        </p>
    </div>

    <a
        href="{{ route('admin.customers.index') }}"
        class="btn btn-secondary"
    >
        <i class="bi bi-arrow-left me-1"></i>
        Kembali
    </a>
</div>

{{-- Informasi Customer --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="row">

            <div class="col-md-2 text-center mb-3 mb-md-0">

                @if ($customer->foto)
                    <img
                        src="{{ asset('storage/' . $customer->foto) }}"
                        alt="Foto {{ $customer->nama }}"
                        class="customer-profile-photo mx-auto"
                    >
                @else
                    <div
                        class="bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center mx-auto"
                        style="width: 90px; height: 90px;"
                    >
                        <i class="bi bi-person fs-1"></i>
                    </div>
                @endif

            </div>

            <div class="col-md-10">

                <h4 class="fw-bold">
                    {{ $customer->nama }}
                </h4>

                <p class="text-muted mb-3">
                    {{ '@' . ($customer->user->username ?? '-') }}
                </p>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Email</small>
                        <span class="fw-semibold">
                            {{ $customer->email }}
                        </span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Nomor HP</small>
                        <span class="fw-semibold">
                            {{ $customer->no_hp ?? '-' }}
                        </span>
                    </div>

                    <div class="col-md-12">
                        <small class="text-muted d-block">Alamat</small>
                        <span class="fw-semibold">
                            {{ $customer->alamat ?? '-' }}
                        </span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<div class="row">

    {{-- Hewan --}}
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white border-0 pt-4">
                <h5 class="fw-bold mb-0">
                    <i class="bi bi-heart me-2 text-danger"></i>
                    Hewan Peliharaan
                </h5>
            </div>

            <div class="card-body">

                @forelse ($customer->pets as $pet)
                    <div class="border rounded p-3 mb-2">
                        <div class="d-flex justify-content-between">

                            <div>
                                <div class="fw-semibold">
                                    {{ $pet->nama_pet }}
                                </div>

                                <small class="text-muted">
                                    {{ $pet->jenis }}

                                    @if ($pet->ras)
                                        • {{ $pet->ras }}
                                    @endif
                                </small>
                            </div>

                            <span class="badge bg-light text-dark">
                                {{ $pet->jenis_kelamin }}
                            </span>

                        </div>
                    </div>
                @empty
                    <p class="text-muted mb-0">
                        Belum memiliki hewan peliharaan.
                    </p>
                @endforelse

            </div>
        </div>
    </div>

    {{-- Booking --}}
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white border-0 pt-4">
                <h5 class="fw-bold mb-0">
                    <i class="bi bi-calendar-check me-2 text-success"></i>
                    Booking Grooming
                </h5>
            </div>

            <div class="card-body">

                @forelse ($customer->bookings->take(5) as $booking)
                    <div class="border rounded p-3 mb-2">
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

                            <span class="badge bg-success-subtle text-success">
                                {{ $booking->status }}
                            </span>

                        </div>
                    </div>
                @empty
                    <p class="text-muted mb-0">
                        Belum memiliki booking.
                    </p>
                @endforelse

            </div>
        </div>
    </div>

</div>

{{-- Transaksi --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white border-0 pt-4">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-receipt me-2 text-primary"></i>
            Riwayat Transaksi
        </h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">

            <table class="table align-middle">

                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($customer->transactions as $transaction)
                        <tr>
                            <td>
                                #{{ $transaction->id_transaction }}
                            </td>

                            <td>
                                {{ $transaction->tanggal?->format('d/m/Y H:i') ?? '-' }}
                            </td>

                            <td>
                                Rp {{ number_format($transaction->total, 0, ',', '.') }}
                            </td>

                            <td>
                                <span class="badge bg-secondary">
                                    {{ $transaction->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                colspan="4"
                                class="text-center text-muted py-4"
                            >
                                Belum ada transaksi.
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>
        </div>
    </div>
</div>

<style>
    .customer-profile-photo {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #d1fae5;
        display: block;
    }
</style>

@endsection