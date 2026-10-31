
@extends('layouts.admin')

@section('title', 'Data Hewan - PetCare')

@section('page-title', 'Data Hewan')

@section('page-description')
    Kelola data hewan peliharaan pelanggan PetCare.
@endsection

@section('content')

{{-- Pesan sukses --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Tutup"></button>
    </div>
@endif

{{-- Pesan error --}}
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Tutup"></button>
    </div>
@endif

{{-- Tombol tambah --}}
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.pets.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>
        Tambah Hewan
    </a>
</div>

{{-- Card tabel --}}
<div class="card border-0 shadow-sm">

    <div class="card-body">

        {{-- Header dan pencarian --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

            <div>
                <h5 class="fw-bold mb-1">Daftar Hewan Peliharaan</h5>
                <small class="text-muted">
                    Total data pada halaman ini: {{ $pets->count() }} hewan
                </small>
            </div>

            <div class="col-md-4">
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

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="petTable">

                <thead class="table-light">
                    <tr>
                        <th width="70">No</th>
                        <th>Nama Hewan</th>
                        <th>Jenis</th>
                        <th>Ras</th>
                        <th>Kelamin</th>
                        <th>Customer</th>
                        <th class="text-center" width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pets as $pet)
                        <tr>

                            {{-- Nomor --}}
                            <td class="text-muted">
                                {{ $pets->firstItem() + $loop->index }}
                            </td>

                            {{-- Nama dan foto hewan --}}
                            <td>
                                <div class="d-flex align-items-center gap-3">

                                    @if (
                                        $pet->foto &&
                                        \Illuminate\Support\Facades\Storage::disk('public')->exists($pet->foto)
                                    )
                                        <img
                                            src="{{ asset('storage/' . $pet->foto) }}"
                                            alt="Foto {{ $pet->nama_pet }}"
                                            width="42"
                                            height="42"
                                            class="rounded-circle object-fit-cover"
                                            loading="lazy"
                                        >
                                    @else
                                        <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center p-2">
                                            @if (strtolower($pet->jenis) === 'kucing')
                                                <i class="bi bi-emoji-smile"></i>
                                            @elseif (strtolower($pet->jenis) === 'anjing')
                                                <i class="bi bi-heart"></i>
                                            @else
                                                <i class="bi bi-paw"></i>
                                            @endif
                                        </div>
                                    @endif

                                    <div>
                                        <div class="fw-semibold">
                                            {{ $pet->nama_pet }}
                                        </div>

                                        <small class="text-muted">
                                            ID: {{ $pet->id_pet }}
                                        </small>
                                    </div>

                                </div>
                            </td>

                            {{-- Jenis --}}
                            <td>
                                <span class="badge bg-primary">
                                    {{ $pet->jenis }}
                                </span>
                            </td>

                            {{-- Ras --}}
                            <td>
                                {{ $pet->ras ?: '-' }}
                            </td>

                            {{-- Kelamin --}}
                            <td>
                                @if ($pet->jenis_kelamin === 'Jantan')
                                    <span class="text-primary">
                                        <i class="bi bi-gender-male me-1"></i>
                                        Jantan
                                    </span>
                                @else
                                    <span class="text-danger">
                                        <i class="bi bi-gender-female me-1"></i>
                                        Betina
                                    </span>
                                @endif
                            </td>

                            {{-- Customer --}}
                            <td>
                                @if ($pet->customer)
                                    <div class="fw-semibold">
                                        {{ $pet->customer->nama }}
                                    </div>

                                    <small class="text-muted">
                                        ID: {{ $pet->customer->id_customer }}
                                    </small>
                                @else
                                    <span class="text-muted">
                                        Customer tidak ditemukan
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td>
                                <div class="d-flex justify-content-center gap-2">

                                    <a
                                        href="{{ route('admin.pets.show', $pet->id_pet) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Detail"
                                        aria-label="Detail hewan"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a
                                        href="{{ route('admin.pets.edit', $pet->id_pet) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Edit"
                                        aria-label="Edit hewan"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

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

                                {{-- Modal konfirmasi hapus --}}
                                <div
                                    class="modal fade"
                                    id="deletePet{{ $pet->id_pet }}"
                                    tabindex="-1"
                                    aria-labelledby="deletePetLabel{{ $pet->id_pet }}"
                                    aria-hidden="true"
                                >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">

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
                                                    aria-label="Tutup"
                                                ></button>
                                            </div>

                                            <div class="modal-body">
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
                                <i class="bi bi-paw fs-1 text-muted"></i>

                                <p class="fw-semibold mt-3 mb-1">
                                    Belum ada data hewan
                                </p>

                                <p class="text-muted small mb-3">
                                    Tambahkan data hewan untuk mulai mengelolanya.
                                </p>

                                <a
                                    href="{{ route('admin.pets.create') }}"
                                    class="btn btn-primary btn-sm"
                                >
                                    <i class="bi bi-plus-lg me-1"></i>
                                    Tambah Hewan
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        @if ($pets->hasPages())
            <div class="d-flex justify-content-end mt-4">
                {{ $pets->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</div>

{{-- Pencarian tabel pada halaman aktif --}}
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
