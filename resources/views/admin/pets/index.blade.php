
@extends('layouts.admin')

@section('title', 'Data Hewan - Galaxy Petshop')

@section('page-title', 'Data Hewan')

@section('page-description')
    Kelola data hewan peliharaan pelanggan Galaxy Petshop.
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

{{-- TOMBOL TAMBAH --}}
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.pets.create') }}" class="btn btn-orange px-3">
        <i class="bi bi-plus-lg me-1"></i>
        Tambah Hewan
    </a>
</div>

{{-- CARD HEWAN --}}
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">

    <div class="card-body p-4">

        {{-- TOOLBAR --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h5 class="fw-bold text-dark mb-1">
                    Daftar Hewan Peliharaan
                </h5>

                <small class="text-muted">
                    Total data: {{ $pets->total() }} hewan
                </small>
            </div>

            {{-- SEARCH --}}
            <div style="width: 280px; max-width: 100%;">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-search text-muted"></i>
                    </span>

                    <input
                        type="text"
                        id="searchPet"
                        class="form-control"
                        placeholder="Cari nama, jenis, atau pemilik..."
                    >
                </div>
            </div>

        </div>

        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0" id="petTable">

                <thead style="background-color: #fff2e6;">
                    <tr>
                        <th class="px-3 py-3 text-secondary small" width="60">
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

                        <th width="140" class="text-center py-3 text-secondary small">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($pets as $pet)

                        <tr>

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
                                            width="48"
                                            height="48"
                                            class="rounded-3 me-3 object-fit-cover"
                                            loading="lazy"
                                        >

                                    @else

                                        <div
                                            class="bg-orange-soft rounded-3 d-flex align-items-center justify-content-center me-3"
                                            style="width: 48px; height: 48px;"
                                        >
                                            @if (strtolower($pet->jenis) === 'kucing')
                                                <i class="bi bi-emoji-smile text-orange fs-5"></i>
                                            @elseif (strtolower($pet->jenis) === 'anjing')
                                                <i class="bi bi-heart text-orange fs-5"></i>
                                            @else
                                                <i class="bi bi-paw text-orange fs-5"></i>
                                            @endif
                                        </div>

                                    @endif

                                    <div>
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
                            </td>

                            {{-- AKSI --}}
                            <td>
                                <div class="d-flex align-items-center justify-content-center gap-1">

                                    {{-- DETAIL --}}
                                    <a
                                        href="{{ route('admin.pets.show', $pet->id_pet) }}"
                                        class="btn btn-sm btn-outline-orange"
                                        title="Detail"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.pets.edit', $pet->id_pet) }}"
                                        class="btn btn-sm btn-outline-warning"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    {{-- HAPUS --}}
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Hapus"
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

                                                    <button type="submit" class="btn btn-danger">
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

                        <tr>
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

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        @if ($pets->hasPages())

            <div class="mt-4">
                {{ $pets->withQueryString()->links('pagination::bootstrap-5') }}
            </div>

        @endif

    </div>

</div>

{{-- SEARCH TABEL --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchPet');
    const tableRows = document.querySelectorAll('#petTable tbody tr');

    searchInput.addEventListener('input', function () {

        const keyword = this.value.toLowerCase().trim();

        tableRows.forEach(function (row) {

            const rowText = row.textContent.toLowerCase();

            row.style.display = rowText.includes(keyword) ? '' : 'none';

        });

    });

});
</script>

@endsection