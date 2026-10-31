<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Registrasi - PetCare</title>


    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    {{-- Bootstrap Icons --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <style>

        body {
            background: #f5f7f9;
        }

        .register-card {
            border: none;
            border-radius: 16px;
        }

        .brand-icon {
            width: 65px;
            height: 65px;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 11px 14px;
        }

        .btn {
            border-radius: 10px;
        }

    </style>

</head>


<body>


<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-6">


            {{-- Card --}}
            <div class="card register-card shadow-sm">

                <div class="card-body p-4 p-md-5">


                    {{-- Header --}}
                    <div class="text-center mb-4">

                        <div
                            class="brand-icon bg-success-subtle rounded-3 d-flex align-items-center justify-content-center mx-auto mb-3"
                        >

                            <i
                                class="bi bi-heart-pulse text-success fs-2"
                            ></i>

                        </div>


                        <h3 class="fw-bold mb-1">
                            Buat Akun PetCare
                        </h3>

                        <p class="text-muted mb-0">
                            Daftar sebagai customer PetCare
                        </p>

                    </div>


                    {{-- Success --}}
                    @if(session('success'))

                        <div
                            class="alert alert-success alert-dismissible fade show"
                            role="alert"
                        >

                            <i class="bi bi-check-circle me-2"></i>

                            {{ session('success') }}

                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                            ></button>

                        </div>

                    @endif


                    {{-- Error --}}
                    @if($errors->any())

                        <div class="alert alert-danger">

                            <div class="fw-semibold mb-2">
                                Registrasi gagal:
                            </div>

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    {{-- Form --}}
                    <form
                        action="{{ route('register.process') }}"
                        method="POST"
                    >

                        @csrf


                        {{-- Nama --}}
                        <div class="mb-3">

                            <label
                                for="nama"
                                class="form-label fw-semibold"
                            >
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama') }}"
                                placeholder="Masukkan nama lengkap"
                                required
                                autofocus
                            >

                            @error('nama')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Username --}}
                        <div class="mb-3">

                            <label
                                for="username"
                                class="form-label fw-semibold"
                            >
                                Username
                            </label>

                            <input
                                type="text"
                                id="username"
                                name="username"
                                class="form-control @error('username') is-invalid @enderror"
                                value="{{ old('username') }}"
                                placeholder="Contoh: johndoe"
                                required
                            >

                            <small class="text-muted">
                                Gunakan huruf, angka, underscore, atau tanda hubung.
                            </small>

                            @error('username')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Email --}}
                        <div class="mb-3">

                            <label
                                for="email"
                                class="form-label fw-semibold"
                            >
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="nama@email.com"
                                required
                            >

                            @error('email')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <div class="row">


                            {{-- No HP --}}
                            <div class="col-md-6 mb-3">

                                <label
                                    for="no_hp"
                                    class="form-label fw-semibold"
                                >
                                    No. HP
                                </label>

                                <input
                                    type="text"
                                    id="no_hp"
                                    name="no_hp"
                                    class="form-control @error('no_hp') is-invalid @enderror"
                                    value="{{ old('no_hp') }}"
                                    placeholder="08xxxxxxxxxx"
                                >

                                @error('no_hp')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Password --}}
                            <div class="col-md-6 mb-3">

                                <label
                                    for="password"
                                    class="form-label fw-semibold"
                                >
                                    Password
                                </label>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Minimal 8 karakter"
                                    required
                                >

                                @error('password')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>


                        {{-- Alamat --}}
                        <div class="mb-3">

                            <label
                                for="alamat"
                                class="form-label fw-semibold"
                            >
                                Alamat
                            </label>

                            <textarea
                                id="alamat"
                                name="alamat"
                                class="form-control @error('alamat') is-invalid @enderror"
                                rows="3"
                                placeholder="Masukkan alamat"
                            >{{ old('alamat') }}</textarea>

                            @error('alamat')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Konfirmasi Password --}}
                        <div class="mb-4">

                            <label
                                for="password_confirmation"
                                class="form-label fw-semibold"
                            >
                                Konfirmasi Password
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Ulangi password"
                                required
                            >

                        </div>


                        {{-- Submit --}}
                        <button
                            type="submit"
                            class="btn btn-success w-100 py-2"
                        >

                            <i class="bi bi-person-plus me-1"></i>

                            Daftar Sekarang

                        </button>

                    </form>


                    {{-- Login --}}
                    <div class="text-center mt-4">

                        <span class="text-muted">
                            Sudah punya akun?
                        </span>

                        <a
                            href="{{ route('login') }}"
                            class="text-success fw-semibold text-decoration-none"
                        >
                            Login di sini
                        </a>

                    </div>


                </div>

            </div>

        </div>

    </div>

</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>

</html>