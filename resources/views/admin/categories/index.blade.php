@extends('layouts.admin')

@section('title', 'Kategori - PetCare')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-1">
            Kategori
        </h2>

        <p class="text-muted mb-0">
            Kelola kategori produk pet shop.
        </p>
    </div>


    <a
        href="{{ route('admin.categories.create') }}"
        class="btn btn-success"
    >
        <i class="bi bi-plus-lg me-1"></i>
        Tambah Kategori
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

        <div class="d-flex justify-content-between align-items-center mb-3">

            <form
                action="{{ route('admin.categories.index') }}"
                method="GET"
                class="d-flex gap-2"
            >

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    style="width: 320px;"
                    placeholder="Cari kategori..."
                    value="{{ request('search') }}"
                >

                <button
                    type="submit"
                    class="btn btn-outline-success"
                >
                    <i class="bi bi-search"></i>
                </button>


                @if(request('search'))

                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="btn btn-outline-secondary"
                    >
                        Reset
                    </a>

                @endif

            </form>

        </div>


        {{-- TABLE --}}

        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead>

                    <tr>

                        <th
                            width="70"
                            class="text-muted fw-semibold"
                        >
                            No
                        </th>

                        <th class="fw-semibold">
                            Nama Kategori
                        </th>

                        <th
                            width="140"
                            class="fw-semibold"
                        >
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($categories as $category)

                        <tr>

                            {{-- NO --}}

                            <td class="text-muted">

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

                                <div class="d-flex gap-1">

                                    <a
                                        href="{{ route('admin.categories.edit', $category) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>


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

                            <td
                                colspan="3"
                                class="text-center py-5"
                            >

                                <i class="bi bi-folder2-open fs-1 text-muted"></i>

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

            <div class="mt-3">

                {{ $categories->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection