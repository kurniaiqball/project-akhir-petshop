@extends('layouts.admin')

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
        class="btn btn-success"
    >
        <i class="bi bi-plus-lg me-1"></i>
        Tambah Layanan
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
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
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>
    </div>
@endif

<div class="card border-0 shadow-sm">

    <div class="card-body">

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
                    class="btn btn-success w-100"
                >
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

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Layanan</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Deskripsi</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($services as $service)

                        <tr>

                            <td>
                                {{ $services->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <div class="fw-semibold">
                                    {{ $service->nama_service }}
                                </div>
                            </td>

                            <td>
                                <span class="fw-semibold text-success">
                                    Rp {{ number_format($service->harga, 0, ',', '.') }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-primary-subtle text-primary">
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
                                        class="btn btn-sm btn-outline-info"
                                        title="Detail"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a
                                        href="{{ route('admin.services.edit', $service) }}"
                                        class="btn btn-sm btn-outline-warning"
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
                            <td
                                colspan="6"
                                class="text-center py-5"
                            >
                                <div class="text-muted">

                                    <i
                                        class="bi bi-scissors fs-1 d-block mb-3"
                                    ></i>

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

        @if($services->hasPages())
            <div class="mt-3">
                {{ $services->links() }}
            </div>
        @endif

    </div>

</div>

@endsection