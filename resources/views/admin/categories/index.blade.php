
@extends('layouts.admin')

@section('title', 'Kategori - Galaxy Petshop')

@section('page-title', 'Kategori')

@section('page-description')
    Kelola kategori produk Galaxy Petshop.
@endsection

@section('content')

@push('styles')
<style>
    .btn-orange {
        background-color: #f58220;
        border-color: #f58220;
        color: #fff;
    }

    .btn-orange:hover {
        background-color: #df6d10;
        border-color: #df6d10;
        color: #fff;
    }

    .table thead th {
        background-color: #fff3e6;
        color: #754016;
        border-bottom: 2px solid #f58220;
    }

    .category-card {
        border-radius: 14px;
    }

    .form-control {
        border-radius: 9px;
    }

    .btn {
        border-radius: 9px;
    }

    .table tbody tr:hover {
        background-color: #fffaf5;
    }
</style>
@endpush

{{-- NOTIFIKASI SUCCESS --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- NOTIFIKASI ERROR --}}
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- CONTENT --}}
<div class="card category-card border-0 shadow-sm">
    <div class="card-body p-3 p-md-4">

        {{-- TOOLBAR --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            {{-- SEARCH --}}
            <form
                action="{{ route('admin.categories.index') }}"
                method="GET"
                class="d-flex gap-2 flex-wrap"
            >

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    style="width: 320px; max-width: 100%;"
                    placeholder="Cari kategori..."
                    value="{{ request('search') }}"
                >

                <button type="submit" class="btn btn-orange">
                    <i class="bi bi-search"></i>
                    Cari
                </button>

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
                class="btn btn-orange"
            >
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Kategori
            </a>

        </div>

        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th width="70" class="px-3">No</th>
                        <th>Nama Kategori</th>
                        <th width="140" class="text-center">Aksi</th>
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
                            <td>
                                <span class="fw-semibold">
                                    {{ $category->nama_category }}
                                </span>
                            </td>

                            {{-- AKSI --}}
                            <td>
                                <div class="d-flex gap-2 justify-content-center">

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.categories.edit', $category) }}"
                                        class="btn btn-sm btn-outline-warning"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('admin.categories.destroy', $category) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
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

            <div class="mt-4">
                {{ $categories->withQueryString()->links('pagination::bootstrap-5') }}
            </div>

        @endif

    </div>
</div>

@endsection
