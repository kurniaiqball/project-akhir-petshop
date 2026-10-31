@extends('layouts.admin')

@section('title', 'Produk - PetCare')

@section('page-title', 'Produk')

@section('page-description')
    Kelola produk yang tersedia di PetCare.
@endsection

@section('content')

@if (session('success'))
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

@if (session('error'))
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

    <div class="card-body p-4">

        {{-- TOOLBAR --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <form
                action="{{ route('admin.products.index') }}"
                method="GET"
                class="d-flex"
                style="width: 320px;"
            >

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari produk..."
                    value="{{ request('search') }}"
                >

                <button
                    type="submit"
                    class="btn btn-success ms-2 px-3"
                >
                    <i class="bi bi-search"></i>
                </button>

            </form>


            <a
                href="{{ route('admin.products.create') }}"
                class="btn btn-success"
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

                        <th width="60">
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

                        <th width="140">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($products as $product)

                        <tr>

                            {{-- NO --}}
                            <td class="text-muted">
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
                                            class="rounded me-3"
                                            style="object-fit: cover;"
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
                            <td class="fw-semibold">

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

                                <div class="d-flex gap-1">

                                    <a
                                        href="{{ route('admin.products.show', $product) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Detail"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>


                                    <a
                                        href="{{ route('admin.products.edit', $product) }}"
                                        class="btn btn-sm btn-outline-warning"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>


                                    <form
                                        action="{{ route('admin.products.destroy', $product) }}"
                                        method="POST"
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

                            <td
                                colspan="6"
                                class="text-center py-5"
                            >

                                <i class="bi bi-box-seam fs-1 text-muted"></i>

                                <div class="mt-2 text-muted">
                                    Belum ada produk.
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

                {{ $products->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection