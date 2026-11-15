
@extends('layouts.admin')

@section('title', 'Detail Hewan - Galaxy Petshop')

@section('page-title', 'Detail Hewan')

@section('page-description')
    Informasi lengkap hewan peliharaan pelanggan.
@endsection

@section('content')

<div class="container-fluid py-3">

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>
            <h4 class="fw-bold mb-1">Detail Hewan</h4>
            <p class="text-muted mb-0">
                Informasi lengkap hewan peliharaan pelanggan.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('admin.pets.index') }}"
               class="btn btn-outline-secondary rounded-3 px-3">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>

            <a href="{{ route('admin.pets.edit', $pet->id_pet) }}"
               class="btn btn-orange rounded-3 px-3">
                <i class="bi bi-pencil me-1"></i>
                Edit Hewan
            </a>

        </div>
    </div>

    {{-- INFORMASI UTAMA --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">

        <div class="card-body p-4 p-md-5">

            {{-- PROFIL HEWAN --}}
            <div class="d-flex flex-column flex-md-row align-items-center gap-4">

                {{-- FOTO --}}
                <div class="flex-shrink-0">

                    @if (
                        $pet->foto &&
                        \Illuminate\Support\Facades\Storage::disk('public')->exists($pet->foto)
                    )

                        <img
                            src="{{ asset('storage/' . $pet->foto) }}"
                            alt="Foto {{ $pet->nama_pet }}"
                            width="130"
                            height="130"
                            class="rounded-4 object-fit-cover shadow-sm"
                        >

                    @else

                        <div class="bg-orange-soft text-orange rounded-4 d-flex align-items-center justify-content-center"
                             style="width: 130px; height: 130px;">

                            @if (strtolower($pet->jenis) === 'kucing')
                                <i class="bi bi-emoji-smile" style="font-size: 3.5rem;"></i>
                            @elseif (strtolower($pet->jenis) === 'anjing')
                                <i class="bi bi-heart" style="font-size: 3.5rem;"></i>
                            @else
                                <i class="bi bi-paw" style="font-size: 3.5rem;"></i>
                            @endif

                        </div>

                    @endif

                </div>

                {{-- IDENTITAS HEWAN --}}
                <div class="text-center text-md-start">

                    <small class="text-muted fw-semibold">
                        PROFIL HEWAN
                    </small>

                    <h3 class="fw-bold text-dark mt-1 mb-2">
                        {{ $pet->nama_pet }}
                    </h3>

                    <span class="badge rounded-pill bg-orange-soft text-orange px-3 py-2">
                        <i class="bi bi-paw me-1"></i>
                        {{ $pet->jenis }}
                    </span>

                    <div class="text-muted small mt-2">
                        ID Hewan: #{{ $pet->id_pet }}
                    </div>

                </div>

            </div>

            <hr class="my-4">

            {{-- DETAIL HEWAN --}}
            <div class="d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-info-circle text-orange fs-5"></i>
                <h5 class="fw-bold mb-0">Informasi Hewan</h5>
            </div>

            <div class="row g-3">

                {{-- ID HEWAN --}}
                <div class="col-md-4">
                    <div class="bg-light rounded-3 p-3 h-100">
                        <div class="text-muted small mb-2">
                            ID Hewan
                        </div>

                        <div class="fw-semibold text-dark">
                            #{{ $pet->id_pet }}
                        </div>
                    </div>
                </div>

                {{-- PEMILIK --}}
                <div class="col-md-4">
                    <div class="bg-light rounded-3 p-3 h-100">
                        <div class="text-muted small mb-2">
                            Pemilik Hewan
                        </div>

                        <div class="fw-semibold text-dark">
                            <i class="bi bi-person text-orange me-1"></i>
                            {{ $pet->customer->nama ?? 'Customer tidak ditemukan' }}
                        </div>
                    </div>
                </div>

                {{-- JENIS --}}
                <div class="col-md-4">
                    <div class="bg-light rounded-3 p-3 h-100">
                        <div class="text-muted small mb-2">
                            Jenis Hewan
                        </div>

                        <div class="fw-semibold text-dark">
                            {{ $pet->jenis }}
                        </div>
                    </div>
                </div>

                {{-- RAS --}}
                <div class="col-md-4">
                    <div class="bg-light rounded-3 p-3 h-100">
                        <div class="text-muted small mb-2">
                            Ras
                        </div>

                        <div class="fw-semibold text-dark">
                            {{ $pet->ras ?: '-' }}
                        </div>
                    </div>
                </div>

                {{-- JENIS KELAMIN --}}
                <div class="col-md-4">
                    <div class="bg-light rounded-3 p-3 h-100">
                        <div class="text-muted small mb-2">
                            Jenis Kelamin
                        </div>

                        <div class="fw-semibold text-dark">

                            @if ($pet->jenis_kelamin === 'Jantan')
                                <i class="bi bi-gender-male text-primary me-1"></i>
                            @else
                                <i class="bi bi-gender-female text-danger me-1"></i>
                            @endif

                            {{ $pet->jenis_kelamin }}

                        </div>
                    </div>
                </div>

                {{-- UMUR --}}
                <div class="col-md-4">
                    <div class="bg-light rounded-3 p-3 h-100">
                        <div class="text-muted small mb-2">
                            Umur
                        </div>

                        <div class="fw-semibold text-dark">

                            @php
                                $tahun = (int) ($pet->umur_tahun ?? 0);
                                $bulan = (int) ($pet->umur_bulan ?? 0);
                            @endphp

                            @if ($tahun === 0 && $bulan === 0)
                                Belum diisi atau 0 bulan
                            @else
                                @if ($tahun > 0)
                                    {{ $tahun }} tahun
                                @endif

                                @if ($bulan > 0)
                                    {{ $bulan }} bulan
                                @endif
                            @endif

                        </div>
                    </div>
                </div>

                {{-- CATATAN --}}
                <div class="col-12">
                    <div class="bg-light rounded-3 p-3">

                        <div class="text-muted small mb-2">
                            <i class="bi bi-journal-text text-orange me-1"></i>
                            Catatan
                        </div>

                        <div class="text-dark">
                            {{ $pet->catatan ?: 'Tidak ada catatan.' }}
                        </div>

                    </div>
                </div>

            </div>

            {{-- INFORMASI WAKTU --}}
            <hr class="my-4">

            <div class="d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-clock-history text-orange fs-5"></i>
                <h5 class="fw-bold mb-0">Informasi Waktu</h5>
            </div>

            <div class="row g-3">

                <div class="col-md-6">
                    <div class="bg-light rounded-3 p-3">
                        <div class="text-muted small mb-2">
                            Tanggal Ditambahkan
                        </div>

                        <div class="fw-semibold text-dark">
                            <i class="bi bi-calendar-plus text-orange me-1"></i>
                            {{ $pet->created_at?->format('d M Y, H:i') ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="bg-light rounded-3 p-3">
                        <div class="text-muted small mb-2">
                            Terakhir Diperbarui
                        </div>

                        <div class="fw-semibold text-dark">
                            <i class="bi bi-calendar-check text-orange me-1"></i>
                            {{ $pet->updated_at?->format('d M Y, H:i') ?? '-' }}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- RIWAYAT BOOKING --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

        {{-- HEADER BOOKING --}}
        <div class="card-body p-4 pb-3">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">

                <div>
                    <h5 class="fw-bold mb-1">
                        <i class="bi bi-calendar-check text-orange me-2"></i>
                        Riwayat Booking
                    </h5>

                    <p class="text-muted small mb-0">
                        Daftar booking yang terkait dengan hewan ini.
                    </p>
                </div>

                <span class="badge rounded-pill bg-orange-soft text-orange px-3 py-2">
                    {{ $pet->bookings->count() }} Booking
                </span>

            </div>

        </div>

        {{-- TABLE BOOKING --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead style="background-color: #fff2e6;">
                    <tr>
                        <th class="px-4 py-3 text-secondary small">
                            ID Booking
                        </th>

                        <th class="py-3 text-secondary small">
                            Service
                        </th>

                        <th class="py-3 text-secondary small">
                            Tanggal
                        </th>

                        <th class="py-3 text-secondary small">
                            Jam
                        </th>

                        <th class="py-3 text-secondary small">
                            Status
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($pet->bookings as $booking)

                        <tr>

                            {{-- ID BOOKING --}}
                            <td class="px-4 fw-semibold text-dark">
                                #{{ $booking->id_booking }}
                            </td>

                            {{-- SERVICE --}}
                            <td>
                                {{ $booking->service->nama_service ?? '-' }}
                            </td>

                            {{-- TANGGAL --}}
                            <td class="text-nowrap">
                                {{ $booking->tanggal_booking?->format('d/m/Y') ?? '-' }}
                            </td>

                            {{-- JAM --}}
                            <td class="text-nowrap">
                                {{ $booking->jam_booking
                                    ? \Carbon\Carbon::parse($booking->jam_booking)->format('H:i')
                                    : '-'
                                }}
                            </td>

                            {{-- STATUS --}}
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

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center py-5">

                                <div class="text-muted">

                                    <div class="mb-3">
                                        <i class="bi bi-calendar2-x fs-1"></i>
                                    </div>

                                    <p class="fw-semibold mb-1">
                                        Belum ada riwayat booking.
                                    </p>

                                    <p class="small mb-0">
                                        Hewan ini belum memiliki booking.
                                    </p>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection