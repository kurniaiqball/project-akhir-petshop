
@extends('layouts.admin')

@section('title', 'Layanan - PetCare')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Layanan</h2>
        <p class="text-muted mb-0">
            Kelola layanan grooming dan perawatan hewan.
        </p>
    </div>

    <a
        href="{{ route('admin.services.create') }}"
        class="btn btn-primary"
    >
        <i class="bi bi-plus-lg me-1"></i>
        Tambah Layanan
    </a>
</div>

{{-- NOTIFIKASI --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>
    </div>
@endif

{{-- CONTENT --}}
<div class="card border-0 shadow-sm">
    <div class="card-body p-3">

        {{-- SEARCH --}}
        <form
            action="{{ route('admin.services.index') }}"
            method="GET"
            class="row g-2 mb-4"
        >
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-search"></i>
                    </span>

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari nama layanan..."
                        value="{{ request('search') }}"
                    >
                </div>
            </div>

            <div class="col-md-2">
                <button
                    type="submit"
                    class="btn btn-primary w-100"
                >
                    <i class="bi bi-search me-1"></i>
                    Cari
                </button>
            </div>

            <div class="col-md-2">
                <a
                    href="{{ route('admin.services.index') }}"
                    class="btn btn-outline-secondary w-100"
                >
                    Reset
                </a>
            </div>
        </form>

        {{-- TABLE --}}
        <div class="table-responsive">
            <table class="table align-middle mb-0">

                <thead>
                    <tr>
                        <th width="60" class="text-muted fw-semibold">No</th>
                        <th class="fw-semibold">Nama Layanan</th>
                        <th class="fw-semibold">Harga</th>
                        <th class="fw-semibold">Durasi</th>
                        <th class="fw-semibold">Deskripsi</th>
                        <th width="180" class="fw-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td class="text-muted">
                                {{ $services->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <span class="fw-semibold">
                                    {{ $service->nama_service }}
                                </span>
                            </td>

                           <td>
    <span class="fw-semibold text-primary text-nowrap">
        Rp {{ number_format($service->harga, 0, ',', '.') }}
    </span>
</td>

                            <td>
                                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $service->durasi }} menit
                                </span>
                            </td>

                            <td>
                                @if($service->deskripsi)
                                    <span class="text-muted">
                                        {{ Str::limit($service->deskripsi, 60) }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex gap-1">

                                    <a
                                        href="{{ route('admin.services.show', $service) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Detail"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a
                                        href="{{ route('admin.services.edit', $service) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form
                                        action="{{ route('admin.services.destroy', $service) }}"
                                        method="POST"
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
                                    <i class="bi bi-scissors fs-1 d-block mb-3"></i>

                                    <div class="fw-semibold">
                                        Belum ada layanan
                                    </div>

                                    <small>
                                        Silakan tambahkan layanan baru.
                                    </small>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- PAGINATION --}}
        @if($services->hasPages())
            <div class="mt-3">
                {{ $services->withQueryString()->links() }}
            </div>
        @endif

    </div>
</div>

@endsection
