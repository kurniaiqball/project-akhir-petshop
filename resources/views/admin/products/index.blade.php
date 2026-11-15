
@extends('layouts.admin')

@section('title', 'Produk - Galaxy Petshop')

@section('page-title', 'Produk')

@section('page-description')
    Kelola produk yang tersedia di Galaxy Petshop.
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


{{-- CARD PRODUK --}}
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">

    <div class="card-body p-4">

        {{-- TOOLBAR --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            {{-- SEARCH DAN FILTER --}}
            <form
                action="{{ route('admin.products.index') }}"
                method="GET"
                class="d-flex align-items-center gap-2 flex-wrap"
            >

                {{-- SEARCH --}}
                <div style="width: 230px;">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari produk..."
                        value="{{ request('search') }}"
                    >
                </div>

                {{-- FILTER KATEGORI --}}
                <div style="width: 165px;">
                    <select
                        name="category"
                        class="form-select"
                        aria-label="Filter kategori"
                    >
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
                </div>

                {{-- TOMBOL CARI --}}
                <button
                    type="submit"
                    class="btn btn-orange"
                    title="Cari produk"
                >
                    <i class="bi bi-search"></i>
                </button>

                {{-- RESET --}}
                @if (request()->filled('search') || request()->filled('category'))
                    <a
                        href="{{ route('admin.products.index') }}"
                        class="btn btn-outline-secondary"
                        title="Reset pencarian"
                    >
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                @endif

            </form>

            {{-- TAMBAH PRODUK --}}
            <a
                href="{{ route('admin.products.create') }}"
                class="btn btn-orange px-3"
            >
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Produk
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

                        <th width="140" class="text-center py-3 text-secondary small">
                            Aksi
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @forelse ($products as $product)

                        <tr>

                            {{-- NO --}}
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
                                            width="48"
                                            height="48"
                                            class="rounded-3 me-3 object-fit-cover"
                                        >

                                    @else

                                        <div
                                            class="bg-orange-soft rounded-3 d-flex align-items-center justify-content-center me-3"
                                            style="width: 48px; height: 48px;"
                                        >
                                            <i class="bi bi-box-seam text-orange fs-5"></i>
                                        </div>

                                    @endif

                                    <div>

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

                                    <span class="badge rounded-pill text-white px-3 py-2" style="background-color:orange;">
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

                                <div class="d-flex align-items-center justify-content-center gap-1">

                                    {{-- DETAIL --}}
                                    <a
                                        href="{{ route('admin.products.show', $product) }}"
                                        class="btn btn-sm btn-outline-orange"
                                        title="Detail"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.products.edit', $product) }}"
                                        class="btn btn-sm btn-outline-warning"
                                        title="Edit"
                                    >
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

            <div class="mt-4">
                {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
            </div>

        @endif

    </div>

</div>

@endsection
