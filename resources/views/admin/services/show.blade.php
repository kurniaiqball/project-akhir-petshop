@extends('layouts.admin')

@section('content')

<div class="mb-4">

    <a
        href="{{ route('admin.services.index') }}"
        class="text-decoration-none text-muted"
    >
        <i class="bi bi-arrow-left me-1"></i>
        Kembali ke Layanan
    </a>

    <div class="d-flex justify-content-between align-items-center mt-3">

        <div>
            <h2 class="fw-bold mb-1">
                Detail Layanan
            </h2>

            <p class="text-muted mb-0">
                Informasi lengkap layanan.
            </p>
        </div>

        <a
            href="{{ route('admin.services.edit', $service) }}"
            class="btn btn-warning"
        >
            <i class="bi bi-pencil me-1"></i>
            Edit
        </a>

    </div>

</div>

<div class="row g-4">

    <div class="col-lg-5">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <div class="text-center mb-4">

                    <div
                        class="rounded-circle bg-success-subtle d-inline-flex align-items-center justify-content-center"
                        style="width: 90px; height: 90px;"
                    >
                        <i
                            class="bi bi-scissors text-success"
                            style="font-size: 40px;"
                        ></i>
                    </div>

                    <h4 class="fw-bold mt-3 mb-1">
                        {{ $service->nama_service }}
                    </h4>

                    <p class="text-muted mb-0">
                        Layanan Grooming
                    </p>

                </div>

                <div class="border-top pt-3">

                    <div class="d-flex justify-content-between mb-3">

                        <span class="text-muted">
                            Harga
                        </span>

                        <strong class="text-success">
                            Rp {{ number_format($service->harga, 0, ',', '.') }}
                        </strong>

                    </div>

                    <div class="d-flex justify-content-between mb-3">

                        <span class="text-muted">
                            Durasi
                        </span>

                        <span class="badge bg-primary-subtle text-primary">
                            {{ $service->durasi }} menit
                        </span>

                    </div>

                </div>

                <div class="mt-4">

                    <h6 class="fw-bold">
                        Deskripsi
                    </h6>

                    @if($service->deskripsi)

                        <p class="text-muted mb-0">
                            {{ $service->deskripsi }}
                        </p>

                    @else

                        <p class="text-muted mb-0">
                            Tidak ada deskripsi.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-7">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>
                        <h5 class="fw-bold mb-1">
                            Riwayat Booking
                        </h5>

                        <small class="text-muted">
                            Booking yang menggunakan layanan ini
                        </small>
                    </div>

                    <span class="badge bg-success">
                        {{ $service->bookings->count() }} Booking
                    </span>

                </div>

                @if($service->bookings->count() > 0)

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead class="table-light">

                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Status</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach($service->bookings as $booking)

                                    <tr>

                                        <td>
                                            #{{ $booking->id_booking }}
                                        </td>

                                        <td>
                                            {{ $booking->tanggal_booking?->format('d/m/Y') }}
                                        </td>

                                        <td>
                                            {{ $booking->jam_booking }}
                                        </td>

                                        <td>

                                            @if($booking->status === 'Menunggu')

                                                <span class="badge bg-warning-subtle text-warning-emphasis">
                                                    Menunggu
                                                </span>

                                            @elseif($booking->status === 'Dikonfirmasi')

                                                <span class="badge bg-info-subtle text-info-emphasis">
                                                    Dikonfirmasi
                                                </span>

                                            @elseif($booking->status === 'Selesai')

                                                <span class="badge bg-success-subtle text-success-emphasis">
                                                    Selesai
                                                </span>

                                            @else

                                                <span class="badge bg-danger-subtle text-danger-emphasis">
                                                    Dibatalkan
                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="text-center py-5">

                        <i
                            class="bi bi-calendar-x text-muted"
                            style="font-size: 40px;"
                        ></i>

                        <p class="text-muted mt-3 mb-0">
                            Belum ada booking untuk layanan ini.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection