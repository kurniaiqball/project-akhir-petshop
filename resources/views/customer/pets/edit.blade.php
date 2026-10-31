@extends('layouts.customer')

@section('title', 'Edit Hewan - PetCare')

@section('content')

<div class="mb-4">

    <h2 class="fw-bold mb-1">
        Edit Hewan
    </h2>

    <p class="text-muted mb-0">
        Perbarui data hewan peliharaanmu.
    </p>

</div>


<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        @if($errors->any())

            <div class="alert alert-danger">

                <strong>
                    Terdapat kesalahan:
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('customer.pets.update', $pet) }}"
            method="POST"
        >

            @csrf

            @method('PUT')


            {{-- Nama --}}
            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Nama Hewan
                </label>

                <input
                    type="text"
                    name="nama_pet"
                    class="form-control"
                    value="{{ old('nama_pet', $pet->nama_pet) }}"
                    required
                >

            </div>


            <div class="row">


                {{-- Jenis --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Jenis Hewan
                    </label>

                    <input
                        type="text"
                        name="jenis"
                        class="form-control"
                        value="{{ old('jenis', $pet->jenis) }}"
                        required
                    >

                </div>


                {{-- Ras --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Ras
                    </label>

                    <input
                        type="text"
                        name="ras"
                        class="form-control"
                        value="{{ old('ras', $pet->ras) }}"
                    >

                </div>


                {{-- Jenis Kelamin --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Jenis Kelamin
                    </label>

                    <select
                        name="jenis_kelamin"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih Jenis Kelamin --
                        </option>

                        <option
                            value="Jantan"
                            {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'Jantan' ? 'selected' : '' }}
                        >
                            Jantan
                        </option>

                        <option
                            value="Betina"
                            {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'Betina' ? 'selected' : '' }}
                        >
                            Betina
                        </option>

                    </select>

                </div>

            </div>


            {{-- Umur --}}
            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Umur
                </label>

                <div class="row g-2">

                    <div class="col-md-6">

                        <div class="input-group">

                            <input
                                type="number"
                                name="umur_tahun"
                                class="form-control"
                                value="{{ old('umur_tahun', $pet->umur_tahun) }}"
                                min="0"
                                max="100"
                                placeholder="0"
                            >

                            <span class="input-group-text">
                                Tahun
                            </span>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="input-group">

                            <input
                                type="number"
                                name="umur_bulan"
                                class="form-control"
                                value="{{ old('umur_bulan', $pet->umur_bulan) }}"
                                min="0"
                                max="11"
                                placeholder="0"
                            >

                            <span class="input-group-text">
                                Bulan
                            </span>

                        </div>

                    </div>

                </div>

                <small class="text-muted">
                    Isi bulan dengan angka 0–11.
                </small>

            </div>


            {{-- Catatan --}}
            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Catatan
                </label>

                <textarea
                    name="catatan"
                    class="form-control"
                    rows="4"
                    placeholder="Catatan tambahan"
                >{{ old('catatan', $pet->catatan) }}</textarea>

            </div>


            {{-- Button --}}
            <div class="d-flex gap-2">

                <a
                    href="{{ route('customer.pets.index') }}"
                    class="btn btn-light"
                >
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="bi bi-check-lg me-1"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection