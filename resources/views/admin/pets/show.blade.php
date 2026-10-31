
@extends('layouts.admin')

@section('title', 'Detail Hewan - PetCare')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Detail Hewan</h2>
            <p class="text-muted mb-0">
                Informasi lengkap hewan peliharaan.
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.pets.index') }}"
               class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>

            <a href="{{ route('admin.pets.edit', $pet->id_pet) }}"
               class="btn btn-primary">
                <i class="bi bi-pencil me-1"></i>
                Edit Hewan
            </a>
        </div>
    </div>

    {{-- Informasi utama --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-body p-4 p-md-5">

            <div class="text-center mb-4">

                <div class="mb-3">
                    @if (
                        $pet->foto &&
                        \Illuminate\Support\Facades\Storage::disk('public')->exists($pet->foto)
                    )
                        <img
                            src="{{ asset('storage/' . $pet->foto) }}"
                            alt="Foto {{ $pet->nama_pet }}"
                            class="rounded-circle img-thumbnail"
                            width="120"
                            height="120"
                        >
                    @else
                        <div class="rounded-circle bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center"
                             style="width: 120px; height: 120px;">
                            @if (strtolower($pet->jenis) === 'kucing')
                                <i class="bi bi-emoji-smile fs-1"></i>
                            @elseif (strtolower($pet->jenis) === 'anjing')
                                <i class="bi bi-heart fs-1"></i>
                            @else
                                <i class="bi bi-paw fs-1"></i>
                            @endif
                        </div>
                    @endif
                </div>

                <h3 class="fw-bold mb-2">{{ $pet->nama_pet }}</h3>

                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                    {{ $pet->jenis }}
                </span>
            </div>

            <hr class="my-4">

            <div class="row g-4">

                {{-- ID Hewan --}}
                <div class="col-md-4">
                    <div class="text-muted small mb-1">ID Hewan</div>
                    <div class="fw-semibold text-dark">
                        {{ $pet->id_pet }}
                    </div>
                </div>

                {{-- Pemilik --}}
                <div class="col-md-4">
                    <div class="text-muted small mb-1">Pemilik Hewan</div>
                    <div class="fw-semibold text-dark">
                        {{ $pet->customer->nama ?? 'Customer tidak ditemukan' }}
                    </div>
                </div>

                {{-- Jenis --}}
                <div class="col-md-4">
                    <div class="text-muted small mb-1">Jenis Hewan</div>
                    <div class="fw-semibold text-dark">
                        {{ $pet->jenis }}
                    </div>
                </div>

                {{-- Ras --}}
                <div class="col-md-4">
                    <div class="text-muted small mb-1">Ras</div>
                    <div class="fw-semibold text-dark">
                        {{ $pet->ras ?: '-' }}
                    </div>
                </div>

                {{-- Jenis Kelamin --}}
                <div class="col-md-4">
                    <div class="text-muted small mb-1">Jenis Kelamin</div>
                    <div class="fw-semibold text-dark">
                        @if ($pet->jenis_kelamin === 'Jantan')
                            <i class="bi bi-gender-male text-primary me-1"></i>
                        @else
                            <i class="bi bi-gender-female text-danger me-1"></i>
                        @endif

                        {{ $pet->jenis_kelamin }}
                    </div>
                </div>

                {{-- Umur --}}
                <div class="col-md-4">
                    <div class="text-muted small mb-1">Umur</div>
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

                {{-- Catatan --}}
                <div class="col-12">
                    <div class="text-muted small mb-1">Catatan</div>
                    <div class="text-dark">
                        {{ $pet->catatan ?: 'Tidak ada catatan.' }}
                    </div>
                </div>

                {{-- Tanggal dibuat --}}
                <div class="col-md-6">
                    <div class="text-muted small mb-1">Tanggal Ditambahkan</div>
                    <div class="fw-semibold text-dark">
                        {{ $pet->created_at?->format('d M Y, H:i') ?? '-' }}
                    </div>
                </div>

                {{-- Terakhir diperbarui --}}
                <div class="col-md-6">
                    <div class="text-muted small mb-1">Terakhir Diperbarui</div>
                    <div class="fw-semibold text-dark">
                        {{ $pet->updated_at?->format('d M Y, H:i') ?? '-' }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Riwayat Booking --}}
    <div class="card border-0 shadow-sm rounded-3">

        <div class="card-header bg-white border-0 p-4">
            <h5 class="fw-bold mb-1">
                <i class="bi bi-calendar-check text-primary me-2"></i>
                Riwayat Booking
            </h5>

            <p class="text-muted small mb-0">
                Daftar booking yang terkait dengan hewan ini.
            </p>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">ID Booking</th>
                        <th class="py-3">Service</th>
                        <th class="py-3">Tanggal</th>
                        <th class="py-3">Jam</th>
                        <th class="py-3">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pet->bookings as $booking)
                        <tr>

                            {{-- ID Booking --}}
                            <td class="px-4">
                                {{ $booking->id_booking }}
                            </td>

                            {{-- Nama Service --}}
                            <td>
                                {{ $booking->service->nama_service ?? '-' }}
                            </td>

                            {{-- Tanggal Booking --}}
                            <td>
                                {{ $booking->tanggal_booking?->format('d/m/Y') ?? '-' }}
                            </td>

                            {{-- Jam Booking --}}
                            <td>
                                {{ $booking->jam_booking
                                    ? \Carbon\Carbon::parse($booking->jam_booking)->format('H:i')
                                    : '-'
                                }}
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

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bi bi-calendar2-x fs-2 text-muted"></i>

                                <p class="fw-semibold mt-2 mb-1">
                                    Belum ada riwayat booking
                                </p>

                                <p class="text-muted small mb-0">
                                    Hewan ini belum memiliki booking.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
