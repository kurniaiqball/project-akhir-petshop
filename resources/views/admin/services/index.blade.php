
@extends('layouts.admin')

@section('title', 'Layanan - Galaxy Petshop')

@section('page-title', 'Layanan')

@section('page-description')
    Kelola layanan grooming dan perawatan hewan di Galaxy Petshop.
@endsection

@section('content')

{{-- ALERT SUCCESS --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- ALERT ERROR --}}
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- CARD LAYANAN --}}
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">

    <div class="card-body p-4">

        {{-- TOOLBAR --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            {{-- SEARCH --}}
            <form
                action="{{ route('admin.services.index') }}"
                method="GET"
                class="d-flex align-items-center gap-2 flex-wrap"
            >

                <div style="width: 230px;">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari layanan..."
                        value="{{ request('search') }}"
                    >
                </div>

                {{-- CARI --}}
                <button
                    type="submit"
                    class="btn btn-orange"
                    title="Cari layanan"
                >
                    <i class="bi bi-search"></i>
                </button>

                {{-- RESET --}}
                @if (request()->filled('search'))
                    <a
                        href="{{ route('admin.services.index') }}"
                        class="btn btn-outline-secondary"
                        title="Reset pencarian"
                    >
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                @endif

            </form>

            {{-- TAMBAH LAYANAN --}}
            <a
                href="{{ route('admin.services.create') }}"
                class="btn btn-orange px-3"
            >
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Layanan
            </a>

        </div>

        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead style="background-color: #fff2e6;">
                    <tr>

                        <th class="px-3 py-3 text-secondary small" width="60">
                            No
                        </th>

                        <th class="py-3 text-secondary small">
                            Layanan
                        </th>

                        <th class="py-3 text-secondary small">
                            Harga
                        </th>

                        <th class="py-3 text-secondary small">
                            Durasi
                        </th>

                        <th class="py-3 text-secondary small">
                            Deskripsi
                        </th>

                        <th width="140" class="text-center py-3 text-secondary small">
                            Aksi
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @forelse ($services as $service)

                        <tr>

                            {{-- NO --}}
                            <td class="px-3 text-muted">
                                {{ $services->firstItem() + $loop->index }}
                            </td>

                            {{-- LAYANAN --}}
                            <td>

                                <div class="d-flex align-items-center">

                                    {{-- FOTO LAYANAN --}}
                                    @if ($service->foto)

                                        <img
                                            src="{{ asset('storage/' . $service->foto) }}"
                                            alt="{{ $service->nama_service }}"
                                            width="48"
                                            height="48"
                                            class="rounded-3 me-3 object-fit-cover"
                                        >

                                    @else

                                        <div
                                            class="bg-orange-soft rounded-3 d-flex align-items-center justify-content-center me-3"
                                            style="width: 48px; height: 48px; flex-shrink: 0;"
                                        >
                                            <i class="bi bi-scissors text-orange fs-5"></i>
                                        </div>

                                    @endif

                                    <div>
                                        <div class="fw-semibold text-dark">
                                            {{ $service->nama_service }}
                                        </div>

                                        <small class="text-muted">
                                            ID #{{ $service->id_service }}
                                        </small>
                                    </div>

                                </div>

                            </td>

                            {{-- HARGA --}}
                            <td class="fw-bold text-orange text-nowrap">
                                Rp {{ number_format($service->harga, 0, ',', '.') }}
                            </td>

                            {{-- DURASI --}}
                            <td>
                                <span class="badge rounded-pill bg-orange-soft text-orange px-3 py-2">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $service->durasi }} menit
                                </span>
                            </td>

                            {{-- DESKRIPSI --}}
                            <td>
                                @if ($service->deskripsi)

                                    <span class="text-muted">
                                        {{ Str::limit($service->deskripsi, 60) }}
                                    </span>

                                @else

                                    <span class="text-muted">-</span>

                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td>

                                <div class="d-flex align-items-center justify-content-center gap-1">

                                    {{-- DETAIL --}}
                                    <a
                                        href="{{ route('admin.services.show', $service) }}"
                                        class="btn btn-sm btn-outline-orange"
                                        title="Detail"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.services.edit', $service) }}"
                                        class="btn btn-sm btn-outline-warning"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('admin.services.destroy', $service) }}"
                                        method="POST"
                                        class="m-0"
                                        onsubmit="return confirm('Yakin ingin menghapus layanan ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Hapus"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center py-5">

                                <div class="text-muted">

                                    <div class="feature-icon mx-auto mb-3">
                                        <i class="bi bi-scissors"></i>
                                    </div>

                                    <p class="fw-semibold mb-1">
                                        Layanan tidak ditemukan.
                                    </p>

                                    <p class="small mb-0">
                                        Coba ubah kata kunci atau tambahkan layanan baru.
                                    </p>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        @if ($services->hasPages())

            <div class="mt-4">
                {{ $services->withQueryString()->links('pagination::bootstrap-5') }}
            </div>

        @endif

    </div>

</div>

@endsection
