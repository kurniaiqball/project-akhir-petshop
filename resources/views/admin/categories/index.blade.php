
@extends('layouts.admin')

@section('title', 'Kategori - Galaxy Petshop')

@section('page-title', 'Kategori')

@section('page-description')
    Kelola kategori produk Galaxy Petshop.
@endsection

@section('content')

@push('styles')
<style>
    /* ===============================
       CATEGORY PAGE
    =============================== */
    .category-page {
        width: 100%;
        min-width: 0;
    }

    .category-card {
        border-radius: 14px;
        min-width: 0;
    }

    .category-page .btn-orange {
        background-color: #f58220;
        border-color: #f58220;
        color: #fff;
    }

    .category-page .btn-orange:hover {
        background-color: #df6d10;
        border-color: #df6d10;
        color: #fff;
    }

    .category-page .form-control {
        border-radius: 9px;
    }

    .category-page .btn {
        border-radius: 9px;
    }

    .category-page .table thead th {
        background-color: #fff3e6;
        color: #754016;
        border-bottom: 2px solid #f58220;
        white-space: nowrap;
    }

    .category-page .table tbody tr:hover {
        background-color: #fffaf5;
    }

    /* TOOLBAR */
    .category-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .category-search-form {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        flex: 1;
        min-width: 0;
    }

    .category-search-input {
        width: 320px;
        max-width: 100%;
    }

    .category-add-btn {
        white-space: nowrap;
    }

    /* TABLE */
    .category-table-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .category-table {
        min-width: 500px;
        margin-bottom: 0;
    }

    .category-name {
        overflow-wrap: anywhere;
    }

    .category-actions {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    /* PAGINATION */
    .category-pagination {
        max-width: 100%;
        overflow-x: auto;
    }

    .category-pagination .pagination {
        flex-wrap: wrap;
    }

    /* ===============================
       TABLET
    =============================== */
    @media (max-width: 991.98px) {
        .category-toolbar {
            align-items: stretch;
        }

        .category-search-form {
            width: 100%;
        }

        .category-search-input {
            flex: 1;
            width: auto;
        }
    }

    /* ===============================
       MOBILE
    =============================== */
    @media (max-width: 575.98px) {
        .category-card-body {
            padding: 16px !important;
        }

        .category-toolbar {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }

        .category-search-form {
            display: grid;
            grid-template-columns: 1fr auto;
            width: 100%;
            gap: 8px;
        }

        .category-search-input {
            width: 100%;
            min-width: 0;
            grid-column: 1 / -1;
        }

        .category-search-form .btn {
            justify-content: center;
        }

        .category-add-btn {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .category-table {
            min-width: 460px;
        }

        .category-pagination .pagination {
            flex-wrap: nowrap;
        }
    }

    /* ===============================
       EXTRA SMALL MOBILE
    =============================== */
    @media (max-width: 360px) {
        .category-card-body {
            padding: 12px !important;
        }

        .category-search-form {
            grid-template-columns: 1fr;
        }

        .category-search-input {
            grid-column: auto;
        }

        .category-search-form .btn {
            width: 100%;
        }
    }
</style>
@endpush

<div class="category-page">

    {{-- NOTIFIKASI SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3"
             role="alert">

            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>
        </div>
    @endif

    {{-- NOTIFIKASI ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3"
             role="alert">

            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>
        </div>
    @endif

    {{-- CONTENT --}}
    <div class="card category-card border-0 shadow-sm">

        <div class="card-body category-card-body p-3 p-md-4">

            {{-- TOOLBAR --}}
            <div class="category-toolbar mb-4">

                {{-- SEARCH --}}
                <form
                    action="{{ route('admin.categories.index') }}"
                    method="GET"
                    class="category-search-form"
                >

                    <input
                        type="text"
                        name="search"
                        class="form-control category-search-input"
                        placeholder="Cari kategori..."
                        value="{{ request('search') }}"
                    >

                    {{-- BUTTON SEARCH --}}
                    <button type="submit" class="btn btn-orange">
                        <i class="bi bi-search me-1"></i>
                        Cari
                    </button>

                    {{-- RESET --}}
                    @if(request('search'))
                        <a
                            href="{{ route('admin.categories.index') }}"
                            class="btn btn-outline-secondary"
                    >
                            <i class="bi bi-arrow-counterclockwise me-1"></i>
                            Reset
                        </a>
                    @endif

                </form>

                {{-- TAMBAH KATEGORI --}}
                <a
                    href="{{ route('admin.categories.create') }}"
                    class="btn btn-orange category-add-btn"
                >
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Kategori
                </a>

            </div>

            {{-- TABLE --}}
            <div class="category-table-wrapper rounded-3">

                <table class="table table-hover category-table align-middle">

                    <thead>
                        <tr>
                            <th width="70" class="px-3 py-3">
                                No
                            </th>

                            <th class="py-3">
                                Nama Kategori
                            </th>

                            <th width="140" class="text-center py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($categories as $category)

                            <tr>

                                {{-- NOMOR --}}
                                <td class="px-3 text-muted">
                                    {{ $categories->firstItem() + $loop->index }}
                                </td>

                                {{-- NAMA KATEGORI --}}
                                <td class="category-name">
                                    <span class="fw-semibold">
                                        {{ $category->nama_category }}
                                    </span>
                                </td>

                                {{-- AKSI --}}
                                <td>
                                    <div class="category-actions">

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.categories.edit', $category) }}"
                                            class="btn btn-sm btn-outline-warning"
                                            title="Edit"
                                            aria-label="Edit kategori"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.categories.destroy', $category) }}"
                                            method="POST"
                                            class="m-0"
                                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Hapus"
                                                aria-label="Hapus kategori"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            {{-- EMPTY --}}
                            <tr>
                                <td colspan="3" class="text-center py-5">

                                    <i class="bi bi-folder2-open fs-1 text-warning"></i>

                                    <div class="mt-2 fw-semibold text-muted">
                                        Belum ada kategori
                                    </div>

                                    <small class="text-muted">
                                        Silakan tambahkan kategori baru.
                                    </small>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINATION --}}
            @if($categories->hasPages())

                <div class="category-pagination mt-4">
                    {{ $categories->withQueryString()->links('pagination::bootstrap-5') }}
                </div>

            @endif

        </div>
    </div>

</div>

@endsection
