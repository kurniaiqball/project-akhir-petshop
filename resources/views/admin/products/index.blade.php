
@extends('layouts.admin')

@section('title', 'Produk - PetCare')

@section('page-title', 'Produk')

@section('page-description')
    Kelola produk yang tersedia di PetCare.
@endsection

@section('content')

{{-- ALERT SUCCESS --}}
@if (session('success'))
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

{{-- ALERT ERROR --}}
@if (session('error'))
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

{{-- CARD PRODUK --}}
<div class="card shadow-sm border-0">

    <div class="card-body">

        {{-- TOOLBAR --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            {{-- FORM PENCARIAN DAN FILTER --}}
            <form
                action="{{ route('admin.products.index') }}"
                method="GET"
                class="d-flex align-items-center gap-2 flex-wrap"
            >

                {{-- SEARCH PRODUK --}}
                <div style="width: 230px;">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari produk..."
                        value="{{ request('search') }}"
                    >
                </div>

                {{-- DROPDOWN KATEGORI --}}
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
                    class="btn btn-primary"
                    title="Cari produk"
                >
                    <i class="bi bi-search"></i>
                </button>

                {{-- RESET FILTER --}}
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
                class="btn btn-primary"
            >
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Produk
            </a>

        </div>


        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">
                    <tr>

                        <th class="px-3" width="60">
                            No
                        </th>

                        <th>
                            Produk
                        </th>

                        <th>
                            Kategori
                        </th>

                        <th>
                            Harga
                        </th>

                        <th>
                            Stok
                        </th>

                        <th width="140" class="text-center">
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
                                            class="rounded me-3 object-fit-cover"
                                        >

                                    @else

                                        <div
                                            class="bg-light rounded d-flex align-items-center justify-content-center me-3"
                                            style="width: 48px; height: 48px;"
                                        >
                                            <i class="bi bi-box text-secondary"></i>
                                        </div>

                                    @endif

                                    <div>

                                        <div class="fw-semibold">
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

                                <span class="badge bg-light text-dark border">
                                    {{ $product->category->nama_category ?? '-' }}
                                </span>

                            </td>

                            {{-- HARGA --}}
                            <td class="fw-semibold text-nowrap">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </td>

                            {{-- STOK --}}
                            <td>

                                @if ($product->stok > 0)

                                    <span class="badge bg-success">
                                        {{ $product->stok }}
                                    </span>

                                @else

                                    <span class="badge bg-danger">
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
                                        class="btn btn-sm btn-outline-primary"
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

                                    <i class="bi bi-box-seam fs-1 d-block mb-2"></i>

                                    <p class="mb-0">
                                        Produk tidak ditemukan.
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

            <div class="card-footer bg-white mt-3 border-0">
                {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
            </div>

        @endif

    </div>

</div>

@endsection
