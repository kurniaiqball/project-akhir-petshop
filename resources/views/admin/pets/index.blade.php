
@extends('layouts.admin')

@section('title', 'Data Hewan - Galaxy Petshop')

@section('page-title', 'Data Hewan')

@section('page-description')
    Kelola data hewan peliharaan pelanggan Galaxy Petshop.
@endsection

@section('content')

@push('styles')
<style>
    /* =========================================
       PET PAGE
    ========================================= */
    .pet-page {
        width: 100%;
        min-width: 0;
    }

    .pet-card {
        min-width: 0;
        border: none;
    }

    /* BUTTON */
    .pet-page .btn-orange {
        background-color: #f58220;
        border-color: #f58220;
        color: #fff;
    }

    .pet-page .btn-orange:hover {
        background-color: #df6d10;
        border-color: #df6d10;
        color: #fff;
    }

    .pet-page .btn {
        border-radius: 9px;
    }

    /* TOOLBAR */
    .pet-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .pet-toolbar-info {
        min-width: 0;
    }

    .pet-search-wrapper {
        width: 280px;
        max-width: 100%;
    }

    /* TABLE */
    .pet-table-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .pet-table {
        min-width: 950px;
        margin-bottom: 0;
    }

    .pet-page .pet-table thead th {
        background-color: #fff2e6;
        white-space: nowrap;
    }

    .pet-page .pet-table td,
    .pet-page .pet-table th {
        vertical-align: middle;
    }

    .pet-page .pet-table tbody tr:hover {
        background-color: #fffaf5;
    }

    /* PET IMAGE */
    .pet-avatar {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        object-fit: cover;
    }

    .pet-avatar-placeholder {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
    }

    /* PET NAME */
    .pet-info {
        min-width: 0;
        overflow-wrap: anywhere;
    }

    /* CUSTOMER */
    .pet-customer {
        min-width: 120px;
        overflow-wrap: anywhere;
    }

    /* ACTIONS */
    .pet-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        white-space: nowrap;
    }

    /* MODAL */
    .pet-page .modal-dialog {
        width: auto;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .pet-page .modal-content {
        border-radius: 16px;
    }

    /* PAGINATION */
    .pet-pagination {
        max-width: 100%;
        overflow-x: auto;
    }

    .pet-pagination .pagination {
        flex-wrap: wrap;
    }

    /* =========================================
       TABLET
    ========================================= */
    @media (max-width: 991.98px) {
        .pet-card-body {
            padding: 1.25rem !important;
        }

        .pet-toolbar {
            align-items: stretch;
        }

        .pet-toolbar-info {
            width: 100%;
        }

        .pet-search-wrapper {
            width: 100%;
            max-width: 400px;
        }

        .pet-table {
            min-width: 900px;
        }
    }

    /* =========================================
       MOBILE
    ========================================= */
    @media (max-width: 575.98px) {
        .pet-card-body {
            padding: 1rem !important;
        }

        .pet-toolbar {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }

        .pet-toolbar-info h5 {
            font-size: 1rem;
        }

        .pet-search-wrapper {
            width: 100%;
            max-width: none;
        }

        .pet-add-button {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pet-table {
            min-width: 850px;
        }

        .pet-pagination .pagination {
            flex-wrap: nowrap;
        }

        /* Modal on mobile */
        .pet-page .modal-dialog {
            max-width: none;
            width: auto;
            margin: 0.75rem;
        }

        .pet-page .modal-footer {
            flex-wrap: wrap;
        }

        .pet-page .modal-footer .btn {
            flex: 1;
        }
    }

    /* =========================================
       EXTRA SMALL MOBILE
    ========================================= */
    @media (max-width: 360px) {
        .pet-card-body {
            padding: 0.75rem !important;
        }

        .pet-page .modal-dialog {
            margin: 0.5rem;
        }

        .pet-page .modal-body {
            padding: 1rem;
        }

        .pet-page .modal-footer {
            padding: 0.75rem;
        }
    }
</style>
@endpush

<div class="pet-page">

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
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

    {{-- ALERT ERROR --}}
    @if (session('error'))
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

    {{-- TOMBOL TAMBAH --}}
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('admin.pets.create') }}"
           class="btn btn-orange pet-add-button px-3">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Hewan
        </a>
    </div>

    {{-- CARD HEWAN --}}
    <div class="card pet-card shadow-sm rounded-4 overflow-hidden">

        <div class="card-body pet-card-body p-4">

            {{-- TOOLBAR --}}
            <div class="pet-toolbar mb-4">

                {{-- INFO --}}
                <div class="pet-toolbar-info">
                    <h5 class="fw-bold text-dark mb-1">
                        Daftar Hewan Peliharaan
                    </h5>

                    <small class="text-muted">
                        Total data: {{ $pets->total() }} hewan
                    </small>
                </div>

                {{-- SEARCH --}}
                <div class="pet-search-wrapper">
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-search text-muted"></i>
                        </span>

                        <input
                            type="text"
                            id="searchPet"
                            class="form-control"
                            placeholder="Cari nama, jenis, atau pemilik..."
                            aria-label="Cari hewan"
                        >
                    </div>
                </div>

            </div>

            {{-- TABLE --}}
            <div class="pet-table-wrapper rounded-3">

                <table class="table table-hover pet-table align-middle"
                       id="petTable">

                    <thead>
                        <tr>
                            <th class="px-3 py-3 text-secondary small"
                                width="60">
                                No
                            </th>

                            <th class="py-3 text-secondary small">
                                Hewan
                            </th>

                            <th class="py-3 text-secondary small">
                                Jenis
                            </th>

                            <th class="py-3 text-secondary small">
                                Ras
                            </th>

                            <th class="py-3 text-secondary small">
                                Kelamin
                            </th>

                            <th class="py-3 text-secondary small">
                                Customer
                            </th>

                            <th width="140"
                                class="text-center py-3 text-secondary small">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($pets as $pet)

                            <tr class="pet-data-row">

                                {{-- NOMOR --}}
                                <td class="px-3 text-muted">
                                    {{ $pets->firstItem() + $loop->index }}
                                </td>

                                {{-- HEWAN --}}
                                <td>
                                    <div class="d-flex align-items-center">

                                        @if (
                                            $pet->foto &&
                                            \Illuminate\Support\Facades\Storage::disk('public')->exists($pet->foto)
                                        )

                                            <img
                                                src="{{ asset('storage/' . $pet->foto) }}"
                                                alt="Foto {{ $pet->nama_pet }}"
                                                class="pet-avatar rounded-3 me-3"
                                                loading="lazy"
                                            >

                                        @else

                                            <div class="pet-avatar-placeholder bg-orange-soft rounded-3 d-flex align-items-center justify-content-center me-3">

                                                @if (strtolower($pet->jenis) === 'kucing')
                                                    <i class="bi bi-emoji-smile text-orange fs-5"></i>
                                                @elseif (strtolower($pet->jenis) === 'anjing')
                                                    <i class="bi bi-heart text-orange fs-5"></i>
                                                @else
                                                    <i class="bi bi-paw text-orange fs-5"></i>
                                                @endif

                                            </div>

                                        @endif

                                        <div class="pet-info">

                                            <div class="fw-semibold text-dark">
                                                {{ $pet->nama_pet }}
                                            </div>

                                            <small class="text-muted">
                                                ID #{{ $pet->id_pet }}
                                            </small>

                                        </div>

                                    </div>
                                </td>

                                {{-- JENIS --}}
                                <td>
                                    <span class="badge rounded-pill bg-orange-soft text-orange px-3 py-2">
                                        {{ $pet->jenis }}
                                    </span>
                                </td>

                                {{-- RAS --}}
                                <td class="text-muted">
                                    {{ $pet->ras ?: '-' }}
                                </td>

                                {{-- KELAMIN --}}
                                <td>
                                    @if ($pet->jenis_kelamin === 'Jantan')

                                        <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                                            <i class="bi bi-gender-male me-1"></i>
                                            Jantan
                                        </span>

                                    @elseif ($pet->jenis_kelamin === 'Betina')

                                        <span class="badge rounded-pill bg-danger-subtle text-danger px-3 py-2">
                                            <i class="bi bi-gender-female me-1"></i>
                                            Betina
                                        </span>

                                    @else

                                        <span class="badge rounded-pill bg-secondary-subtle text-secondary px-3 py-2">
                                            -
                                        </span>

                                    @endif
                                </td>

                                {{-- CUSTOMER --}}
                                <td>
                                    <div class="pet-customer">

                                        @if ($pet->customer)

                                            <div class="fw-semibold text-dark">
                                                {{ $pet->customer->nama }}
                                            </div>

                                            <small class="text-muted">
                                                ID #{{ $pet->customer->id_customer }}
                                            </small>

                                        @else

                                            <span class="text-muted small">
                                                Customer tidak ditemukan
                                            </span>

                                        @endif

                                    </div>
                                </td>

                                {{-- AKSI --}}
                                <td>
                                    <div class="pet-actions">

                                        {{-- DETAIL --}}
                                        <a
                                            href="{{ route('admin.pets.show', $pet->id_pet) }}"
                                            class="btn btn-sm btn-outline-orange"
                                            title="Detail"
                                            aria-label="Detail hewan"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.pets.edit', $pet->id_pet) }}"
                                            class="btn btn-sm btn-outline-warning"
                                            title="Edit"
                                            aria-label="Edit hewan"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        {{-- HAPUS --}}
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Hapus"
                                            aria-label="Hapus hewan"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deletePet{{ $pet->id_pet }}"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </div>

                                    {{-- MODAL HAPUS --}}
                                    <div
                                        class="modal fade"
                                        id="deletePet{{ $pet->id_pet }}"
                                        tabindex="-1"
                                        aria-labelledby="deletePetLabel{{ $pet->id_pet }}"
                                        aria-hidden="true"
                                    >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow rounded-4">

                                                <div class="modal-header">
                                                    <h5
                                                        class="modal-title fw-bold"
                                                        id="deletePetLabel{{ $pet->id_pet }}"
                                                    >
                                                        Konfirmasi Hapus
                                                    </h5>

                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"
                                                    ></button>
                                                </div>

                                                <div class="modal-body text-start">
                                                    Apakah kamu yakin ingin menghapus data hewan
                                                    <strong>{{ $pet->nama_pet }}</strong>?

                                                    <p class="text-muted small mb-0 mt-2">
                                                        Hewan yang memiliki riwayat booking mungkin
                                                        tidak dapat dihapus.
                                                    </p>
                                                </div>

                                                <div class="modal-footer">

                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal"
                                                    >
                                                        Batal
                                                    </button>

                                                    <form
                                                        action="{{ route('admin.pets.destroy', $pet->id_pet) }}"
                                                        method="POST"
                                                    >
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                                class="btn btn-danger">
                                                            <i class="bi bi-trash me-1"></i>
                                                            Ya, Hapus
                                                        </button>
                                                    </form>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr class="pet-empty-row">
                                <td colspan="7" class="text-center py-5">

                                    <div class="text-muted">

                                        <div class="feature-icon mx-auto mb-3">
                                            <i class="bi bi-paw"></i>
                                        </div>

                                        <p class="fw-semibold mb-1">
                                            Belum ada data hewan.
                                        </p>

                                        <p class="small mb-3">
                                            Tambahkan hewan untuk mulai mengelolanya.
                                        </p>

                                        <a
                                            href="{{ route('admin.pets.create') }}"
                                            class="btn btn-orange btn-sm"
                                        >
                                            <i class="bi bi-plus-lg me-1"></i>
                                            Tambah Hewan
                                        </a>

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                        {{-- EMPTY SEARCH --}}
                        <tr id="petSearchEmpty" style="display: none;">
                            <td colspan="7" class="text-center py-4">
                                <i class="bi bi-search fs-3 d-block mb-2 text-muted"></i>

                                <div class="fw-semibold text-muted">
                                    Hewan tidak ditemukan.
                                </div>

                                <small class="text-muted">
                                    Coba kata kunci yang lain.
                                </small>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

            {{-- PAGINATION --}}
            @if ($pets->hasPages())
                <div class="pet-pagination mt-4">
                    {{ $pets->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            @endif

        </div>
    </div>

</div>

{{-- SEARCH TABEL --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchPet');
    const table = document.getElementById('petTable');

    if (!searchInput || !table) return;

    const tableRows = table.querySelectorAll('.pet-data-row');
    const emptyMessage = document.getElementById('petSearchEmpty');

    searchInput.addEventListener('input', function () {

        const keyword = this.value.toLowerCase().trim();
        let visibleCount = 0;

        tableRows.forEach(function (row) {

            const rowText = row.textContent.toLowerCase();
            const isMatch = rowText.includes(keyword);

            row.style.display = isMatch ? '' : 'none';

            if (isMatch) {
                visibleCount++;
            }

        });

        if (emptyMessage) {
            emptyMessage.style.display =
                (keyword !== '' && visibleCount === 0) ? '' : 'none';
        }

    });

});
</script>

@endsection
