
@extends('layouts.admin')

@section('title', 'Layanan - Galaxy Petshop')

@section('page-title', 'Layanan')

@section('page-description')
    Kelola layanan grooming dan perawatan hewan di Galaxy Petshop.
@endsection

@section('content')

<style>
    /* ================================
       SERVICE PAGE
    ================================= */

    .service-page {
        width: 100%;
        min-width: 0;
    }

    .service-page .service-card {
        border: 0;
        border-radius: 16px;
        overflow: hidden;
    }

    .service-page .service-card-body {
        padding: 24px;
    }

    /* TOOLBAR */

    .service-page .service-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 24px;
    }

    .service-page .service-search {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        flex: 1;
        min-width: 0;
    }

    .service-page .service-search-input {
        width: 230px;
        max-width: 100%;
    }

    .service-page .service-search-input .form-control {
        min-height: 40px;
    }

    .service-page .service-add-btn {
        white-space: nowrap;
        min-height: 40px;
    }

    /* TABLE */

    .service-page .service-table-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border-radius: 10px;
    }

    .service-page .service-table {
        width: 100%;
        min-width: 850px;
        margin-bottom: 0;
    }

    .service-page .service-table th {
        white-space: nowrap;
        vertical-align: middle;
    }

    .service-page .service-table td {
        vertical-align: middle;
    }

    .service-page .service-table tbody tr:last-child td {
        border-bottom: 0;
    }

    /* SERVICE INFO */

    .service-page .service-info {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 180px;
    }

    .service-page .service-image {
        width: 48px;
        height: 48px;
        min-width: 48px;
        object-fit: cover;
        border-radius: 10px;
    }

    .service-page .service-image-placeholder {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .service-page .service-name {
        font-weight: 600;
        color: #292929;
        overflow-wrap: anywhere;
    }

    .service-page .service-description {
        min-width: 160px;
        max-width: 260px;
        white-space: normal;
        overflow-wrap: anywhere;
        line-height: 1.5;
    }

    /* ACTION */

    .service-page .service-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        white-space: nowrap;
    }

    .service-page .service-actions .btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .service-page .service-actions form {
        margin: 0;
    }

    /* PAGINATION */

    .service-page .service-pagination {
        margin-top: 22px;
        overflow-x: auto;
    }

    .service-page .service-pagination .pagination {
        flex-wrap: wrap;
        gap: 3px;
    }

    /* TABLET */

    @media (max-width: 991.98px) {
        .service-page .service-card-body {
            padding: 20px;
        }

        .service-page .service-table {
            min-width: 820px;
        }
    }

    /* MOBILE */

    @media (max-width: 767.98px) {
        .service-page .service-card-body {
            padding: 16px;
        }

        .service-page .service-toolbar {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }

        .service-page .service-search {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto auto;
            width: 100%;
            gap: 7px;
        }

        .service-page .service-search-input {
            width: 100%;
            min-width: 0;
        }

        .service-page .service-search .btn {
            min-height: 40px;
            min-width: 40px;
        }

        .service-page .service-add-btn {
            width: 100%;
            justify-content: center;
        }

        .service-page .service-table {
            min-width: 800px;
        }

        .service-page .service-pagination .pagination {
            flex-wrap: nowrap;
            width: max-content;
        }
    }

    /* SMALL MOBILE */

    @media (max-width: 400px) {
        .service-page .service-card-body {
            padding: 12px;
        }

        .service-page .service-search {
            grid-template-columns: minmax(0, 1fr) auto;
        }

        .service-page .service-search .btn-reset {
            grid-column: 2;
        }
    }
</style>

<div class="service-page">

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
    <div class="card shadow-sm service-card">

        <div class="card-body service-card-body">

            {{-- TOOLBAR --}}
            <div class="service-toolbar">

                {{-- SEARCH --}}
                <form
                    action="{{ route('admin.services.index') }}"
                    method="GET"
                    class="service-search"
                >

                    <div class="service-search-input">
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
                        aria-label="Cari layanan"
                    >
                        <i class="bi bi-search"></i>
                    </button>

                    {{-- RESET --}}
                    @if (request()->filled('search'))
                        <a
                            href="{{ route('admin.services.index') }}"
                            class="btn btn-outline-secondary btn-reset"
                            title="Reset pencarian"
                            aria-label="Reset pencarian"
                        >
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif

                </form>

                {{-- TAMBAH LAYANAN --}}
                <a
                    href="{{ route('admin.services.create') }}"
                    class="btn btn-orange px-3 service-add-btn"
                >
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Layanan
                </a>

            </div>

            {{-- TABLE --}}
            <div class="service-table-wrapper">

                <table class="table table-hover align-middle service-table">

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

                                    <div class="service-info">

                                        {{-- FOTO LAYANAN --}}
                                        @if ($service->foto)

                                            <img
                                                src="{{ asset('storage/' . $service->foto) }}"
                                                alt="{{ $service->nama_service }}"
                                                class="service-image"
                                                loading="lazy"
                                            >

                                        @else

                                            <div class="service-image-placeholder bg-orange-soft">
                                                <i class="bi bi-scissors text-orange fs-5"></i>
                                            </div>

                                        @endif

                                        <div>
                                            <div class="service-name">
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
                                    <span class="badge rounded-pill bg-orange-soft text-orange px-3 py-2 text-nowrap">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ $service->durasi }} menit
                                    </span>
                                </td>

                                {{-- DESKRIPSI --}}
                                <td>
                                    <div class="service-description">
                                        @if ($service->deskripsi)

                                            <span class="text-muted">
                                                {{ Str::limit($service->deskripsi, 60) }}
                                            </span>

                                        @else

                                            <span class="text-muted">-</span>

                                        @endif
                                    </div>
                                </td>

                                {{-- AKSI --}}
                                <td>

                                    <div class="service-actions">

                                        {{-- DETAIL --}}
                                        <a
                                            href="{{ route('admin.services.show', $service) }}"
                                            class="btn btn-sm btn-outline-orange"
                                            title="Detail"
                                            aria-label="Detail layanan"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.services.edit', $service) }}"
                                            class="btn btn-sm btn-outline-warning"
                                            title="Edit"
                                            aria-label="Edit layanan"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        {{-- HAPUS --}}
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
                                                aria-label="Hapus layanan"
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

                <div class="service-pagination">
                    {{ $services->withQueryString()->links('pagination::bootstrap-5') }}
                </div>

            @endif

        </div>

    </div>

</div>

@endsection
