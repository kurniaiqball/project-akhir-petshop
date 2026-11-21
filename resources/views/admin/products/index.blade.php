
@extends('layouts.admin')

@section('title', 'Produk - Galaxy Petshop')
@section('page-title', 'Produk')

@section('page-description')
    Kelola produk yang tersedia di Galaxy Petshop.
@endsection

@section('content')

<style>
    /* =========================
       PRODUCT PAGE
    ========================= */
    .product-page {
        width: 100%;
        min-width: 0;
    }

    .product-card {
        min-width: 0;
    }

    .product-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .product-filter {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        flex: 1;
        min-width: 0;
    }

    .product-search {
        width: 230px;
        max-width: 100%;
    }

    .product-category {
        width: 180px;
        max-width: 100%;
    }

    .product-table-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .product-table {
        min-width: 750px;
        margin-bottom: 0;
    }

    .product-table td,
    .product-table th {
        vertical-align: middle;
    }

    .product-name {
        min-width: 0;
        overflow-wrap: anywhere;
    }

    .product-image {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        object-fit: cover;
    }

    .product-placeholder {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
    }

    .product-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        white-space: nowrap;
    }

    .product-pagination {
        overflow-x: auto;
        max-width: 100%;
    }

    /* =========================
       TABLET
    ========================= */
    @media (max-width: 991.98px) {
        .product-card-body {
            padding: 1.25rem !important;
        }

        .product-toolbar {
            align-items: stretch;
        }

        .product-filter {
            width: 100%;
        }

        .product-search {
            flex: 1;
            width: auto;
        }

        .product-category {
            flex: 1;
            width: auto;
        }
    }

    /* =========================
       MOBILE
    ========================= */
    @media (max-width: 575.98px) {
        .product-card-body {
            padding: 1rem !important;
        }

        .product-toolbar {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }

        .product-filter {
            display: grid;
            grid-template-columns: 1fr auto;
            width: 100%;
            gap: 8px;
        }

        .product-search {
            grid-column: 1 / -1;
            width: 100%;
        }

        .product-category {
            width: 100%;
            min-width: 0;
        }

        .product-filter .btn {
            min-height: 38px;
        }

        .product-add-button {
            width: 100%;
            justify-content: center;
        }

        .product-table {
            min-width: 700px;
        }

        .product-pagination .pagination {
            flex-wrap: nowrap;
        }
    }

    /* =========================
       VERY SMALL MOBILE
    ========================= */
    @media (max-width: 360px) {
        .product-card-body {
            padding: 0.75rem !important;
        }

        .product-filter {
            grid-template-columns: 1fr;
        }

        .product-search {
            grid-column: auto;
        }

        .product-filter .btn {
            width: 100%;
        }
    }
</style>

<div class="product-page">

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3"
             role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3"
             role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    {{-- CARD PRODUK --}}
    <div class="card product-card border-0 shadow-sm rounded-4 overflow-hidden">

        <div class="card-body product-card-body p-4">

            {{-- TOOLBAR --}}
            <div class="product-toolbar mb-4">

                {{-- SEARCH & FILTER --}}
                <form action="{{ route('admin.products.index') }}"
                      method="GET"
                      class="product-filter">

                    {{-- SEARCH --}}
                    <input
                        type="text"
                        name="search"
                        class="form-control product-search"
                        placeholder="Cari produk..."
                        value="{{ request('search') }}"
                    >

                    {{-- FILTER KATEGORI --}}
                    <select name="category"
                            class="form-select product-category"
                            aria-label="Filter kategori">

                        <option value="">Semua Kategori</option>

                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id_category }}"
                                {{ request('category') == $category->id_category ? 'selected' : '' }}
                            >
                                {{ $category->nama_category }}
                            </option>
                        @endforeach

                    </select>

                    {{-- CARI --}}
                    <button type="submit"
                            class="btn btn-orange"
                            title="Cari produk">
                        <i class="bi bi-search"></i>
                    </button>

                    {{-- RESET --}}
                    @if (request()->filled('search') || request()->filled('category'))
                        <a href="{{ route('admin.products.index') }}"
                           class="btn btn-outline-secondary"
                           title="Reset pencarian">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif

                </form>

                {{-- TAMBAH PRODUK --}}
                <a href="{{ route('admin.products.create') }}"
                   class="btn btn-orange product-add-button d-flex align-items-center px-3">
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Produk
                </a>

            </div>

            {{-- TABLE --}}
            <div class="product-table-wrapper rounded-3">

                <table class="table table-hover product-table align-middle">

                    <thead style="background-color: #fff2e6;">
                        <tr>
                            <th class="px-3 py-3 text-secondary small" width="60">
                                No
                            </th>

                            <th class="py-3 text-secondary small">
                                Produk
                            </th>

                            <th class="py-3 text-secondary small">
                                Kategori
                            </th>

                            <th class="py-3 text-secondary small">
                                Harga
                            </th>

                            <th class="py-3 text-secondary small">
                                Stok
                            </th>

                            <th width="140"
                                class="text-center py-3 text-secondary small">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($products as $product)
                            <tr>

                                {{-- NOMOR --}}
                                <td class="px-3 text-muted">
                                    {{ $products->firstItem() + $loop->index }}
                                </td>

                                {{-- PRODUK --}}
                                <td>
                                    <div class="d-flex align-items-center">

                                        @if ($product->gambar)
                                            <img
                                                src="{{ asset('storage/' . $product->gambar) }}"
                                                alt="{{ $product->nama_product }}"
                                                class="product-image rounded-3 me-3"
                                            >
                                        @else
                                            <div class="product-placeholder bg-orange-soft rounded-3 d-flex align-items-center justify-content-center me-3">
                                                <i class="bi bi-box-seam text-orange fs-5"></i>
                                            </div>
                                        @endif

                                        <div class="product-name">
                                            <div class="fw-semibold text-dark">
                                                {{ $product->nama_product }}
                                            </div>

                                            <small class="text-muted">
                                                ID #{{ $product->id_product }}
                                            </small>
                                        </div>

                                    </div>
                                </td>

                                {{-- KATEGORI --}}
                                <td>
                                    <span class="badge rounded-pill bg-orange-soft text-orange px-3 py-2">
                                        {{ $product->category->nama_category ?? '-' }}
                                    </span>
                                </td>

                                {{-- HARGA --}}
                                <td class="fw-bold text-orange text-nowrap">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </td>

                                {{-- STOK --}}
                                <td>
                                    @if ($product->stok > 0)
                                        <span class="badge rounded-pill text-white px-3 py-2"
                                              style="background-color: orange;">
                                            <i class="bi bi-check-circle me-1"></i>
                                            {{ $product->stok }}
                                        </span>
                                    @else
                                        <span class="badge rounded-pill bg-danger-subtle text-danger px-3 py-2">
                                            <i class="bi bi-x-circle me-1"></i>
                                            Habis
                                        </span>
                                    @endif
                                </td>

                                {{-- AKSI --}}
                                <td>
                                    <div class="product-actions">

                                        {{-- DETAIL --}}
                                        <a href="{{ route('admin.products.show', $product) }}"
                                           class="btn btn-sm btn-outline-orange"
                                           title="Detail"
                                           aria-label="Detail produk">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                           class="btn btn-sm btn-outline-warning"
                                           title="Edit"
                                           aria-label="Edit produk">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.products.destroy', $product) }}"
                                            method="POST"
                                            class="m-0"
                                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Hapus"
                                                    aria-label="Hapus produk">
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
                                            <i class="bi bi-box-seam"></i>
                                        </div>

                                        <p class="fw-semibold mb-1">
                                            Produk tidak ditemukan.
                                        </p>

                                        <p class="small mb-0">
                                            Coba ubah kata kunci atau filter kategori.
                                        </p>

                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>

            {{-- PAGINATION --}}
            @if ($products->hasPages())
                <div class="product-pagination mt-4">
                    {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            @endif

        </div>
    </div>

</div>

@endsection
