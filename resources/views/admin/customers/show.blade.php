
@extends('layouts.admin')

@section('title', 'Detail Customer - PetCare')

@section('page-title', 'Detail Customer')

@section('page-description')
    Informasi lengkap customer.
@endsection

@section('content')

{{-- Informasi Customer --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="row">

            <div class="col-md-2 text-center mb-3 mb-md-0">

                @if ($customer->foto)
                    <img
                        src="{{ asset('storage/' . $customer->foto) }}"
                        alt="Foto {{ $customer->nama }}"
                        width="90"
                        height="90"
                        class="rounded-circle object-fit-cover border border-3 border-success-subtle mx-auto"
                    >
                @else
                    <div class="bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center mx-auto p-4">
                        <i class="bi bi-person display-6"></i>
                    </div>
                @endif

            </div>

            <div class="col-md-10">

                <h4 class="fw-bold mb-1">
                    {{ $customer->nama }}
                </h4>

                <p class="text-muted mb-3">
                    {{ '@' . ($customer->user->username ?? '-') }}
                </p>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block mb-1">Email</small>
                        <span class="fw-semibold">
                            {{ $customer->email }}
                        </span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block mb-1">Nomor HP</small>
                        <span class="fw-semibold">
                            {{ $customer->no_hp ?? '-' }}
                        </span>
                    </div>

                    <div class="col-md-12">
                        <small class="text-muted d-block mb-1">Alamat</small>
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

                            @if ($pet->jenis_kelamin === 'Jantan')
                                <span class="badge bg-primary align-self-start">
                                    <i class="bi bi-gender-male me-1"></i>
                                    Jantan
                                </span>
                            @elseif ($pet->jenis_kelamin === 'Betina')
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

                            @php
                                $status = strtolower($booking->status ?? '');
                            @endphp

                            @if ($status === 'menunggu')
                                <span class="badge bg-warning text-dark align-self-start">
                                    {{ $booking->status }}
                                </span>
                            @elseif ($status === 'dikonfirmasi')
                                <span class="badge bg-primary align-self-start">
                                    {{ $booking->status }}
                                </span>
                            @elseif ($status === 'selesai')
                                <span class="badge bg-success align-self-start">
                                    {{ $booking->status }}
                                </span>
                            @elseif ($status === 'dibatalkan')
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

            <table class="table table-hover align-middle">

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

                            <td class="fw-semibold">
                                Rp {{ number_format($transaction->total, 0, ',', '.') }}
                            </td>

                            <td>
                                @php
                                    $status = strtolower($transaction->status ?? '');
                                @endphp

                                @if ($status === 'pending')
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-clock me-1"></i>
                                        Pending
                                    </span>
                                @elseif ($status === 'diproses')
                                    <span class="badge bg-primary">
                                        <i class="bi bi-arrow-repeat me-1"></i>
                                        Diproses
                                    </span>
                                @elseif ($status === 'siap diambil')
                                    <span class="badge bg-info text-dark">
                                        <i class="bi bi-bag-check me-1"></i>
                                        Siap Diambil
                                    </span>
                                @elseif ($status === 'selesai')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Selesai
                                    </span>
                                @elseif ($status === 'dibatalkan')
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

{{-- Tombol kembali --}}
<div class="d-flex justify-content-end mb-4">
    <a
        href="{{ route('admin.customers.index') }}"
        class="btn btn-outline-secondary"
    >
        <i class="bi bi-arrow-left me-1"></i>
        Kembali
    </a>
</div>

@endsection
