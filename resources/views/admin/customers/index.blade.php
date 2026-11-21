
@extends('layouts.admin')

@section('title', 'Customer - Galaxy Petshop')

@section('page-title', 'Customer')

@section('page-description')
    Kelola data customer Galaxy Petshop.
@endsection

@section('content')

@push('styles')
<style>
    /* ================================
       CUSTOMER PAGE
    ================================= */
    .customer-page {
        width: 100%;
        min-width: 0;
    }

    .customer-card {
        border: none;
        border-radius: 15px;
        min-width: 0;
    }

    /* BUTTON */
    .customer-page .btn {
        border-radius: 9px;
    }

    .customer-page .btn-orange {
        background-color: #ff922b;
        border-color: #ff922b;
        color: white;
    }

    .customer-page .btn-orange:hover {
        background-color: #f07812;
        border-color: #f07812;
        color: white;
    }

    /* TABLE */
    .customer-page .table thead th {
        background-color: #fff3e6;
        color: #754016;
        border-bottom: 2px solid #ff922b;
        white-space: nowrap;
    }

    .customer-page .table tbody tr:hover {
        background-color: #fffaf5;
    }

    .customer-page .form-control:focus {
        border-color: #ff922b;
        box-shadow: 0 0 0 0.2rem rgba(255, 146, 43, .15);
    }

    /* AVATAR */
    .customer-avatar {
        width: 44px;
        height: 44px;
        object-fit: cover;
        border: 2px solid #ffe0bd;
        flex-shrink: 0;
    }

    .customer-avatar-placeholder {
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        background: #fff0df;
        color: #ff922b;
    }

    /* SEARCH */
    .customer-search {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        width: 100%;
    }

    .customer-search-input {
        width: 100%;
        max-width: 480px;
    }

    /* CUSTOMER INFO */
    .customer-info {
        min-width: 0;
        overflow-wrap: anywhere;
    }

    .customer-email,
    .customer-phone {
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    /* TABLE WRAPPER */
    .customer-table-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .customer-table {
        min-width: 850px;
        margin-bottom: 0;
    }

    .customer-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
    }

    /* PAGINATION */
    .customer-pagination {
        display: flex;
        justify-content: flex-end;
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
    }

    .customer-pagination .pagination {
        flex-wrap: wrap;
    }

    /* ================================
       TABLET
    ================================= */
    @media (max-width: 991.98px) {
        .customer-card-body {
            padding: 1.25rem !important;
        }

        .customer-search-input {
            flex: 1;
            width: auto;
            max-width: none;
        }

        .customer-table {
            min-width: 800px;
        }
    }

    /* ================================
       MOBILE
    ================================= */
    @media (max-width: 575.98px) {
        .customer-card-body {
            padding: 1rem !important;
        }

        .customer-search {
            display: grid;
            grid-template-columns: 1fr auto;
            width: 100%;
            gap: 8px;
        }

        .customer-search-input {
            grid-column: 1 / -1;
            width: 100%;
            min-width: 0;
            max-width: none;
        }

        .customer-search .btn {
            justify-content: center;
        }

        .customer-table {
            min-width: 760px;
        }

        .customer-pagination {
            justify-content: flex-start;
        }

        .customer-pagination .pagination {
            flex-wrap: nowrap;
        }
    }

    /* ================================
       EXTRA SMALL MOBILE
    ================================= */
    @media (max-width: 360px) {
        .customer-card-body {
            padding: 0.75rem !important;
        }

        .customer-search {
            grid-template-columns: 1fr;
        }

        .customer-search-input {
            grid-column: auto;
        }

        .customer-search .btn {
            width: 100%;
        }
    }
</style>
@endpush

<div class="customer-page">

    {{-- NOTIFIKASI SUCCESS --}}
    @if(session('success'))
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

    {{-- NOTIFIKASI ERROR --}}
    @if(session('error'))
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

    {{-- CARD CUSTOMER --}}
    <div class="card customer-card shadow-sm">

        <div class="card-body customer-card-body p-3 p-md-4">

            {{-- SEARCH --}}
            <form
                action="{{ route('admin.customers.index') }}"
                method="GET"
                class="customer-search mb-4"
            >

                <input
                    type="text"
                    name="search"
                    class="form-control customer-search-input"
                    placeholder="Cari nama, email, atau nomor HP..."
                    value="{{ request('search') }}"
                >

                {{-- CARI --}}
                <button type="submit" class="btn btn-orange">
                    <i class="bi bi-search me-1"></i>
                    Cari
                </button>

                {{-- RESET --}}
                @if(request('search'))
                    <a
                        href="{{ route('admin.customers.index') }}"
                        class="btn btn-outline-secondary"
                    >
                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Reset
                    </a>
                @endif

            </form>

            {{-- TABLE --}}
            <div class="customer-table-wrapper rounded-3">

                <table class="table table-hover customer-table align-middle">

                    <thead>
                        <tr>
                            <th width="70" class="px-3 py-3">
                                No
                            </th>

                            <th class="py-3">
                                Customer
                            </th>

                            <th class="py-3">
                                Email
                            </th>

                            <th class="py-3">
                                No. HP
                            </th>

                            <th width="120" class="text-center py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($customers as $customer)

                            <tr>

                                {{-- NOMOR --}}
                                <td class="px-3 text-muted">
                                    {{ $customers->firstItem() + $loop->index }}
                                </td>

                                {{-- CUSTOMER --}}
                                <td>
                                    <div class="d-flex align-items-center">

                                        {{-- FOTO --}}
                                        @if($customer->foto)

                                            <img
                                                src="{{ asset('storage/' . $customer->foto) }}"
                                                alt="Foto {{ $customer->nama }}"
                                                class="customer-avatar rounded-circle me-3"
                                            >

                                        @else

                                            <div
                                                class="customer-avatar-placeholder rounded-circle d-flex align-items-center justify-content-center me-3"
                                            >
                                                <i class="bi bi-person fs-5"></i>
                                            </div>

                                        @endif

                                        {{-- INFORMASI CUSTOMER --}}
                                        <div class="customer-info">

                                            <div class="fw-semibold text-dark text-nowrap">
                                                {{ $customer->nama }}
                                            </div>

                                            @if($customer->user)
                                                <small class="text-muted">
                                                    {{ '@' . $customer->user->username }}
                                                </small>
                                            @endif

                                        </div>

                                    </div>
                                </td>

                                {{-- EMAIL --}}
                                <td class="customer-email text-nowrap">
                                    {{ $customer->email }}
                                </td>

                                {{-- NO HP --}}
                                <td class="customer-phone text-nowrap">
                                    {{ $customer->no_hp ?? '-' }}
                                </td>

                                {{-- AKSI --}}
                                <td>
                                    <div class="customer-actions">

                                        {{-- DETAIL --}}
                                        <a
                                            href="{{ route('admin.customers.show', $customer) }}"
                                            class="btn btn-sm btn-outline-warning"
                                            title="Detail Customer"
                                            aria-label="Detail customer"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.customers.destroy', $customer) }}"
                                            method="POST"
                                            class="m-0"
                                            onsubmit="return confirm('Yakin ingin menghapus customer ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Hapus Customer"
                                                aria-label="Hapus customer"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            {{-- DATA KOSONG --}}
                            <tr>
                                <td colspan="5" class="text-center py-5">

                                    <i class="bi bi-people fs-1 d-block mb-2"
                                       style="color:#ff922b;"></i>

                                    <div class="fw-semibold text-muted">
                                        Belum ada data customer.
                                    </div>

                                    <small class="text-muted">
                                        Data customer yang terdaftar akan muncul di sini.
                                    </small>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINATION --}}
            @if($customers->hasPages())
                <div class="customer-pagination mt-4">
                    {{ $customers->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @endif

        </div>
    </div>

</div>

@endsection
