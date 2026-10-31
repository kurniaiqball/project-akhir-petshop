@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Customer</h2>
        <p class="text-muted mb-0">
            Kelola data customer PetCare.
        </p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}
    </div>
@endif

<div class="card border-0 shadow-sm">

    <div class="card-body">

        {{-- Search --}}
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

                <button
                    type="submit"
                    class="btn btn-outline-success"
                >
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
                        Reset
                    </a>

                </div>

            @endif

        </form>

        {{-- Table --}}
        <div class="table-responsive">

            <table class="table align-middle">

                <thead class="table-light">

                    <tr>
                        <th width="70">No</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th width="150">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($customers as $customer)

                        <tr>

                            <td>
                                {{ $customers->firstItem() + $loop->index }}
                            </td>

                            <td>

                                <div class="d-flex align-items-center">

                                    <div
                                        class="bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 42px; height: 42px;"
                                    >
                                        <i class="bi bi-person"></i>
                                    </div>

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

                            <td>
                                {{ $customer->email }}
                            </td>

                            <td>
                                {{ $customer->no_hp ?? '-' }}
                            </td>

                            <td>

                                <a
                                    href="{{ route('admin.customers.show', $customer) }}"
                                    class="btn btn-sm btn-outline-primary"
                                    title="Detail"
                                >
                                    <i class="bi bi-eye"></i>
                                </a>

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
                                        title="Hapus"
                                    >
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center py-5"
                            >

                                <i
                                    class="bi bi-people fs-1 text-muted"
                                ></i>

                                <div class="mt-2 text-muted">
                                    Belum ada data customer.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

       <div class="d-flex justify-content-end">
            {{ $customers->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>

    </div>

</div>

@endsection