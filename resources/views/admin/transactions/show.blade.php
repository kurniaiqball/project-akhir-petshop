@extends('layouts.admin')

@section('title', 'Detail Transaksi - PetCare')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-1">
            Detail Transaksi #{{ $transaction->id_transaction }}
        </h2>

        <p class="text-muted mb-0">
            Informasi lengkap transaksi customer.
        </p>
    </div>

    <a href="{{ route('admin.transactions.index') }}"
       class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>
        Kembali
    </a>

</div>


{{-- INFORMASI CUSTOMER --}}

<div class="card border-0 shadow-sm mb-4">

    <div class="card-body">

        <h5 class="fw-bold mb-3">
            <i class="bi bi-person me-2"></i>
            Informasi Customer
        </h5>

        <div class="row">

            <div class="col-md-4 mb-3">
                <small class="text-muted d-block">
                    Nama Customer
                </small>

                <strong>
                    {{ $transaction->customer->nama }}
                </strong>
            </div>

            <div class="col-md-4 mb-3">
                <small class="text-muted d-block">
                    Email
                </small>

                <strong>
                    {{ $transaction->customer->email }}
                </strong>
            </div>

            <div class="col-md-4 mb-3">
                <small class="text-muted d-block">
                    No. HP
                </small>

                <strong>
                    {{ $transaction->customer->no_hp ?? '-' }}
                </strong>
            </div>

        </div>

    </div>

</div>


{{-- INFORMASI TRANSAKSI --}}

<div class="card border-0 shadow-sm mb-4">

    <div class="card-body">

        <h5 class="fw-bold mb-3">
            <i class="bi bi-receipt me-2"></i>
            Informasi Transaksi
        </h5>

        <div class="row">

            <div class="col-md-4 mb-3">

                <small class="text-muted d-block">
                    ID Transaksi
                </small>

                <strong>
                    #{{ $transaction->id_transaction }}
                </strong>

            </div>

            <div class="col-md-4 mb-3">

                <small class="text-muted d-block">
                    Tanggal
                </small>

                <strong>
                    {{ $transaction->tanggal->format('d/m/Y H:i') }}
                </strong>

            </div>

            <div class="col-md-4 mb-3">

                <small class="text-muted d-block">
                    Status
                </small>

               
@if($transaction->status === 'Pending')

    <span class="badge bg-warning text-dark">
        Pending
    </span>

@elseif($transaction->status === 'Diproses')

    <span class="badge bg-primary">
        Diproses
    </span>

@elseif($transaction->status === 'Siap Diambil')

    <span class="badge bg-info text-dark">
        <i class="bi bi-box-seam me-1"></i>
        Siap Diambil
    </span>

@elseif($transaction->status === 'Selesai')

    <span class="badge bg-success">
        <i class="bi bi-check-circle me-1"></i>
        Selesai
    </span>

@elseif($transaction->status === 'Dibatalkan')

    <span class="badge bg-danger">
        <i class="bi bi-x-circle me-1"></i>
        Dibatalkan
    </span>

@else

    <span class="badge bg-secondary">
        {{ $transaction->status }}
    </span>

@endif


            </div>

        </div>

    </div>

</div>


{{-- DETAIL PRODUK --}}

<div class="card border-0 shadow-sm">

    <div class="card-body">

        <h5 class="fw-bold mb-4">
            <i class="bi bi-box-seam me-2"></i>
            Detail Produk
        </h5>

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($transaction->details as $detail)

                        <tr>

                            <td>
                                <strong>
                                    {{ $detail->product->nama_product }}
                                </strong>
                            </td>

                            <td>
                                {{ $detail->product->category->nama_category ?? '-' }}
                            </td>

                            <td>
                                Rp {{ number_format(
                                    $detail->harga,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </td>

                            <td>
                                {{ $detail->jumlah }}
                            </td>

                            <td class="fw-semibold">
                                Rp {{ number_format(
                                    $detail->subtotal,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

                <tfoot>

                    <tr>

                        <td colspan="4"
                            class="text-end fw-bold">

                            Total

                        </td>

                        <td class="fw-bold fs-5">

                            Rp {{ number_format(
                                $transaction->total,
                                0,
                                ',',
                                '.'
                            ) }}

                        </td>

                    </tr>

                </tfoot>

            </table>

        </div>

    </div>

</div>

@endsection