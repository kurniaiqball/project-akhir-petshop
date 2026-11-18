
@extends('layouts.customer')

@section('title', 'Riwayat Booking - PetCare')

@section('content')

<div class="mb-4">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
        <div>
            <h2 class="fw-bold mb-1" style="color: #29231f;">
                <i class="bi bi-calendar2-check me-2" style="color: #f58220;"></i>
                Riwayat Booking
            </h2>

            <p class="text-muted mb-0">
                Lihat riwayat booking grooming hewanmu.
            </p>
        </div>

        @if($bookings->count())
            <span class="badge rounded-pill px-3 py-2 align-self-start align-self-sm-center"
                  style="background-color: #fff2e6; color: #d96812;">
                {{ $bookings->total() }} Booking
            </span>
        @endif
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
@endif

@if($bookings->count())

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-3 p-md-4">

            <div class="mb-3">
                <h5 class="fw-bold mb-1" style="color: #29231f;">
                    Daftar Booking
                </h5>

                <p class="text-muted small mb-0">
                    Informasi jadwal dan status booking grooming.
                </p>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr class="text-muted">
                            <th class="py-3">#</th>
                            <th class="py-3">Hewan</th>
                            <th class="py-3">Layanan</th>
                            <th class="py-3">Tanggal</th>
                            <th class="py-3">Jam</th>
                            <th class="py-3">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td class="text-muted">
                                    {{ $bookings->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <div class="fw-semibold text-nowrap" style="color: #29231f;">
                                        {{ $booking->pet->nama_pet }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $booking->pet->jenis }}
                                    </small>
                                </td>

                                <td>
                                    <div class="fw-semibold text-nowrap" style="color: #29231f;">
                                        {{ $booking->service->nama_service }}
                                    </div>

                                    <small class="text-muted text-nowrap">
                                        Rp {{ number_format($booking->service->harga, 0, ',', '.') }}
                                    </small>
                                </td>

                                <td class="text-nowrap">
                                    {{ $booking->tanggal_booking->format('d/m/Y') }}
                                </td>

                                <td class="text-nowrap">
                                    {{ substr($booking->jam_booking, 0, 5) }}
                                </td>

                                {{-- STATUS TETAP MENGGUNAKAN KODE ASLI --}}
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

            <div class="mt-4">
                {{ $bookings->links() }}
            </div>

        </div>
    </div>

@else

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body text-center py-5 px-3 px-md-5">

            <div class="mb-3">
                <i class="bi bi-calendar2-x"
                   style="font-size: 60px; color: #f58220;"></i>
            </div>

            <h5 class="fw-bold mt-3" style="color: #29231f;">
                Belum Ada Booking
            </h5>

            <p class="text-muted mb-4">
                Kamu belum memiliki riwayat booking grooming.
            </p>

            <a href="{{ route('customer.booking') }}"
               class="btn text-white px-4 py-2"
               style="background-color: #f58220; border-color: #f58220;">

                <i class="bi bi-calendar-plus me-1"></i>
                Buat Booking
            </a>

        </div>
    </div>

@endif

@endsection
