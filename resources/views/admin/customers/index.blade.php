
@extends('layouts.admin')

@section('title', 'Customer - Galaxy Petshop')

@section('page-title', 'Customer')

@section('page-description')
    Kelola data customer Galaxy Petshop.
@endsection

@section('content')

@push('styles')
<style>
    .customer-card {
        border: none;
        border-radius: 15px;
    }

    .btn-orange {
        background-color: #ff922b;
        border-color: #ff922b;
        color: white;
    }

    .btn-orange:hover {
        background-color: #f07812;
        border-color: #f07812;
        color: white;
    }

    .table thead th {
        background-color: #fff3e6;
        color: #754016;
        border-bottom: 2px solid #ff922b;
    }

    .table tbody tr:hover {
        background-color: #fffaf5;
    }

    .form-control:focus {
        border-color: #ff922b;
        box-shadow: 0 0 0 0.2rem rgba(255,146,43,.15);
    }

    .customer-avatar {
        width: 44px;
        height: 44px;
        object-fit: cover;
        border: 2px solid #ffe0bd;
    }

    .btn {
        border-radius: 9px;
    }
</style>
@endpush

{{-- NOTIFIKASI SUCCESS --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- NOTIFIKASI ERROR --}}
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- CARD CUSTOMER --}}
<div class="card customer-card shadow-sm">

    <div class="card-body p-3 p-md-4">

        {{-- SEARCH --}}
        <form
            action="{{ route('admin.customers.index') }}"
            method="GET"
            class="row g-2 mb-4"
        >

            <div class="col-md-6">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari nama, email, atau nomor HP..."
                    value="{{ request('search') }}"
                >
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-orange">
                    <i class="bi bi-search me-1"></i>
                    Cari
                </button>
            </div>

            @if(request('search'))
                <div class="col-auto">
                    <a
                        href="{{ route('admin.customers.index') }}"
                        class="btn btn-outline-secondary"
                    >
                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Reset
                    </a>
                </div>
            @endif

        </form>

        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th width="70" class="px-3">No</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th width="120" class="text-center">Aksi</th>
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

                                    @if($customer->foto)

                                        <img
                                            src="{{ asset('storage/' . $customer->foto) }}"
                                            alt="Foto {{ $customer->nama }}"
                                            class="customer-avatar rounded-circle me-3"
                                        >

                                    @else

                                        <div
                                            class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width:44px;height:44px;background:#fff0df;color:#ff922b;"
                                        >
                                            <i class="bi bi-person fs-5"></i>
                                        </div>

                                    @endif

                                    <div>

                                        <div class="fw-semibold">
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
                            <td>
                                {{ $customer->email }}
                            </td>

                            {{-- NO HP --}}
                            <td>
                                {{ $customer->no_hp ?? '-' }}
                            </td>

                            {{-- AKSI --}}
                            <td>
                                <div class="d-flex gap-2 justify-content-center">

                                    {{-- DETAIL --}}
                                    <a
                                        href="{{ route('admin.customers.show', $customer) }}"
                                        class="btn btn-sm btn-outline-warning"
                                        title="Detail Customer"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('admin.customers.destroy', $customer) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus customer ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Hapus Customer"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

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
        <div class="d-flex justify-content-end mt-4">

            {{ $customers->onEachSide(1)->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>

@endsection