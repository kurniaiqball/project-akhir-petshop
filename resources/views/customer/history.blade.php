@extends('layouts.customer')

@section('title', 'Riwayat Booking - PetCare')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-1">Riwayat Booking</h2>
    <p class="text-muted mb-0">
        Lihat riwayat booking grooming hewanmu.
    </p>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"></button>
    </div>
@endif

@if($bookings->count())
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hewan</th>
                            <th>Layanan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $booking->pet->nama_pet }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $booking->pet->jenis }}
                                    </small>
                                </td>

                                <td>
                                    {{ $booking->service->nama_service }}
                                    <br>
                                    <small class="text-muted">
                                        Rp {{ number_format($booking->service->harga, 0, ',', '.') }}
                                    </small>
                                </td>

                                <td>
                                    {{ $booking->tanggal_booking->format('d/m/Y') }}
                                </td>

                                <td>
                                    {{ substr($booking->jam_booking, 0, 5) }}
                                </td>

                                <td>
                                    @if($booking->status === 'Menunggu')
                                        <span class="badge bg-warning text-dark">
                                            Menunggu
                                        </span>
                                    @elseif($booking->status === 'Dikonfirmasi')
                                        <span class="badge bg-primary">
                                            Dikonfirmasi
                                        </span>
                                    @elseif($booking->status === 'Selesai')
                                        <span class="badge bg-success">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Dibatalkan
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $bookings->links() }}
            </div>

        </div>
    </div>

@else

    <div class="card border-0 shadow-sm">
        <div class="card-body p-5 text-center">

            <i class="bi bi-calendar-x text-muted"
               style="font-size: 60px;"></i>

            <h5 class="fw-bold mt-3">
                Belum Ada Booking
            </h5>

            <p class="text-muted">
                Kamu belum memiliki riwayat booking grooming.
            </p>

            <a href="{{ route('customer.booking') }}"
               class="btn btn-success">
                <i class="bi bi-calendar-plus me-1"></i>
                Buat Booking
            </a>

        </div>
    </div>

@endif

@endsection