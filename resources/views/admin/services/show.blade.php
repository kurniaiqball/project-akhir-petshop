
@extends('layouts.admin')

@section('title', 'Detail Layanan - Galaxy Petshop')

@section('page-title', 'Detail Layanan')

@section('page-description')
    Informasi lengkap layanan grooming dan perawatan hewan.
@endsection

@section('content')

<div class="mb-4">

    <a href="{{ route('admin.services.index') }}"
       class="text-decoration-none text-muted">
        <i class="bi bi-arrow-left me-1"></i>
        Kembali ke Layanan
    </a>

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-3">

        <div>
            <h4 class="fw-bold mb-1">Detail Layanan</h4>
            <p class="text-muted mb-0">
                Informasi lengkap layanan Galaxy Petshop.
            </p>
        </div>

        <a href="{{ route('admin.services.edit', $service) }}"
           class="btn btn-orange">
            <i class="bi bi-pencil me-1"></i>
            Edit Layanan
        </a>

    </div>

</div>

<div class="row g-4">

    {{-- INFORMASI LAYANAN --}}
    <div class="col-lg-5">

        <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-body p-4">

                {{-- FOTO DAN NAMA LAYANAN --}}
                <div class="text-center mb-4">

                    @if($service->foto)

                        <img
                            src="{{ asset('storage/' . $service->foto) }}"
                            alt="{{ $service->nama_service }}"
                            class="img-fluid rounded-4 mb-3"
                            style="width: 100%; max-height: 260px; object-fit: cover;"
                        >

                    @else

                        <div class="bg-orange-soft rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 110px; height: 110px;">
                            <i class="bi bi-scissors text-orange"
                               style="font-size: 45px;"></i>
                        </div>

                    @endif

                    <h4 class="fw-bold mb-1">
                        {{ $service->nama_service }}
                    </h4>

                    <p class="text-muted mb-0">
                        Layanan Grooming dan Perawatan Hewan
                    </p>

                </div>

                <hr class="text-muted">

                {{-- HARGA --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Harga</span>

                    <strong class="text-orange">
                        Rp {{ number_format($service->harga, 0, ',', '.') }}
                    </strong>
                </div>

                {{-- DURASI --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Durasi</span>

                    <span class="badge bg-orange-soft text-orange rounded-pill px-3 py-2">
                        {{ $service->durasi }} menit
                    </span>
                </div>

                <hr class="text-muted">

                {{-- DESKRIPSI --}}
                <div class="mt-3">

                    <h6 class="fw-bold mb-2">
                        Deskripsi Layanan
                    </h6>

                    @if($service->deskripsi)

                        <p class="text-muted mb-0">
                            {{ $service->deskripsi }}
                        </p>

                    @else

                        <p class="text-muted fst-italic mb-0">
                            Belum ada deskripsi untuk layanan ini.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

    {{-- RIWAYAT BOOKING --}}
    <div class="col-lg-7">

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            <div class="card-body p-4">

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">

                    <div>
                        <h5 class="fw-bold mb-1">
                            Riwayat Booking
                        </h5>

                        <small class="text-muted">
                            Daftar booking yang menggunakan layanan ini.
                        </small>
                    </div>

                    <span class="badge bg-orange-soft text-orange rounded-pill px-3 py-2">
                        {{ $service->bookings->count() }} Booking
                    </span>

                </div>

                @if($service->bookings->count() > 0)

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead>
                                <tr style="background-color: #fff2e6;">
                                    <th class="py-3">ID Booking</th>
                                    <th class="py-3">Tanggal</th>
                                    <th class="py-3">Jam</th>
                                    <th class="py-3">Status</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($service->bookings as $booking)

                                    <tr>

                                        <td class="fw-semibold">
                                            #{{ $booking->id_booking }}
                                        </td>

                                        <td>
                                            {{ $booking->tanggal_booking?->format('d/m/Y') ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $booking->jam_booking ?? '-' }}
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

                        <div class="bg-orange-soft rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 75px; height: 75px;">
                            <i class="bi bi-calendar-x text-orange"
                               style="font-size: 32px;"></i>
                        </div>

                        <h6 class="fw-bold mb-1">
                            Belum Ada Booking
                        </h6>

                        <p class="text-muted mb-0">
                            Belum ada booking yang menggunakan layanan ini.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection
