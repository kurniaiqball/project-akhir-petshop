
@extends('layouts.admin')

@section('content')
<style>
    .pet-page {
        color: #334155;
    }

    .pet-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
    }

    .pet-avatar {
        width: 42px;
        height: 42px;
        min-width: 42px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eff6ff;
        font-size: 18px;
    }

    .pet-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .pet-table th {
        background: #f8fafc;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
        white-space: nowrap;
        padding: 15px 16px;
    }

    .pet-table td {
        padding: 15px 16px;
        vertical-align: middle;
    }

    .pet-table tbody tr:hover {
        background: #f8fafc;
    }

    .pet-search {
        max-width: 320px;
    }

    .pet-search .form-control {
        border-radius: 10px;
    }

    .pet-action {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }

    .pet-type-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 12px;
        font-weight: 600;
    }

    .pet-pagination {
        padding: 16px;
    }

    @media (max-width: 768px) {
        .pet-search {
            max-width: 100%;
            width: 100%;
        }
    }
</style>

<div class="container-fluid py-4 pet-page">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Data Hewan</h2>
            <p class="text-muted mb-0">
                Kelola data hewan peliharaan pelanggan PetCare.
            </p>
        </div>

        <a href="{{ route('admin.pets.create') }}"
           class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Hewan
        </a>
    </div>

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

    {{-- Card tabel --}}
    <div class="card pet-card shadow-sm">

        <div class="card-header bg-white border-0 p-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                <div>
                    <h5 class="fw-bold mb-1">Daftar Hewan Peliharaan</h5>
                    <small class="text-muted">
                        Total data pada halaman ini: {{ $pets->count() }} hewan
                    </small>
                </div>

                <div class="pet-search">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>

                        <input type="text"
                               id="searchPet"
                               class="form-control border-start-0"
                               placeholder="Cari nama, jenis, atau pemilik...">
                    </div>
                </div>

            </div>
        </div>

        <div class="table-responsive">
            <table class="table pet-table mb-0" id="petTable">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Hewan</th>
                        <th>Jenis</th>
                        <th>Ras</th>
                        <th>Kelamin</th>
                        <th>Customer</th>
                        <th class="text-center">Aksi</th>
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

                                    <div class="pet-avatar">
                                        @if (
                                            $pet->foto &&
                                            \Illuminate\Support\Facades\Storage::disk('public')->exists($pet->foto)
                                        )
                                            <img
                                                src="{{ asset('storage/' . $pet->foto) }}"
                                                alt="Foto {{ $pet->nama_pet }}"
                                                loading="lazy"
                                            >
                                        @else
                                            @if (strtolower($pet->jenis) === 'kucing')
                                                <i class="bi bi-emoji-smile text-primary"></i>
                                            @elseif (strtolower($pet->jenis) === 'anjing')
                                                <i class="bi bi-heart text-primary"></i>
                                            @else
                                                <i class="bi bi-paw text-primary"></i>
                                            @endif
                                        @endif
                                    </div>

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
                                <span class="pet-type-badge">
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
                                    <div class="fw-medium">
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
                                <div class="d-flex justify-content-center gap-1">

                                    <a href="{{ route('admin.pets.show', $pet->id_pet) }}"
                                       class="btn btn-sm btn-outline-info pet-action"
                                       title="Detail"
                                       aria-label="Detail hewan">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.pets.edit', $pet->id_pet) }}"
                                       class="btn btn-sm btn-outline-primary pet-action"
                                       title="Edit"
                                       aria-label="Edit hewan">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger pet-action"
                                            title="Hapus"
                                            aria-label="Hapus hewan"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deletePet{{ $pet->id_pet }}">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </div>

                                {{-- Modal konfirmasi hapus --}}
                                <div class="modal fade"
                                     id="deletePet{{ $pet->id_pet }}"
                                     tabindex="-1"
                                     aria-labelledby="deletePetLabel{{ $pet->id_pet }}"
                                     aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">

                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold"
                                                    id="deletePetLabel{{ $pet->id_pet }}">
                                                    Konfirmasi Hapus
                                                </h5>

                                                <button type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Tutup"></button>
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
                                                <button type="button"
                                                        class="btn btn-light border"
                                                        data-bs-dismiss="modal">
                                                    Batal
                                                </button>

                                                <form action="{{ route('admin.pets.destroy', $pet->id_pet) }}"
                                                      method="POST">
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

                                <a href="{{ route('admin.pets.create') }}"
                                   class="btn btn-primary btn-sm">
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
            <div class="pet-pagination border-top">
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
