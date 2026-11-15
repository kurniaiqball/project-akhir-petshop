
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f58220">

    <title>Registrasi - Galaxy Petshop</title>

    {{-- Bootstrap 5.3.3 --}}
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
        :root {
            --galaxy-orange: #f58220;
            --galaxy-orange-dark: #d96812;
            --galaxy-orange-soft: #fff2e6;
            --galaxy-ink: #29231f;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at top right, rgba(245, 130, 32, .13), transparent 35%),
                linear-gradient(135deg, #fffaf5, #ffffff, #fff2e6);
            color: var(--galaxy-ink);
        }

        .register-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
        }

        .register-card {
            border: 1px solid rgba(245, 130, 32, .12);
            border-radius: 22px;
            overflow: hidden;
            background: #fff;
        }

        .brand-logo {
            width: 150px;
            height: 110px;
            object-fit: contain;
            margin-bottom: 12px;
        }

        .brand-title {
            color: var(--galaxy-orange);
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 14px;
            border: 1px solid #e5e5e5;
        }

        .form-control:focus {
            border-color: var(--galaxy-orange);
            box-shadow: 0 0 0 .2rem rgba(245, 130, 32, .15);
        }

        textarea.form-control {
            resize: vertical;
        }

        .btn-orange {
            background-color: var(--galaxy-orange);
            border-color: var(--galaxy-orange);
            color: white;
            border-radius: 10px;
            transition: .2s ease;
        }

        .btn-orange:hover {
            background-color: var(--galaxy-orange-dark);
            border-color: var(--galaxy-orange-dark);
            color: white;
            transform: translateY(-2px);
        }

        .text-orange {
            color: var(--galaxy-orange) !important;
        }

        .register-link {
            color: var(--galaxy-orange);
            transition: .2s;
        }

        .register-link:hover {
            color: var(--galaxy-orange-dark);
        }

        .login-divider {
            height: 4px;
            width: 65px;
            background: var(--galaxy-orange);
            border-radius: 10px;
            margin: 15px auto 20px;
        }

        .form-label {
            color: var(--galaxy-ink);
        }

        @media (max-width: 576px) {
            .register-card .card-body {
                padding: 25px 20px !important;
            }

            .brand-logo {
                width: 130px;
                height: 95px;
            }
        }
    </style>

</head>

<body>

<div class="register-wrapper">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8 col-lg-6">

                {{-- REGISTER CARD --}}
                <div class="card register-card shadow-lg">

                    <div class="card-body p-4 p-md-5">

                        {{-- HEADER --}}
                        <div class="text-center mb-4">

                            <img
                                src="{{ asset('images/logopet.png') }}"
                                alt="Logo Galaxy Petshop"
                                class="brand-logo"
                            >

                            <h3 class="fw-bold brand-title mb-1">
                                Buat Akun Baru!
                            </h3>

                            <h5 class="fw-bold mb-2">
                                Galaxy Petshop
                            </h5>

                            <div class="login-divider"></div>

                            <p class="text-muted mb-0">
                                Daftar sebagai customer Galaxy Petshop
                            </p>

                        </div>


                        {{-- SUCCESS MESSAGE --}}
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


                        {{-- ERROR MESSAGE --}}
                        @if($errors->any())

                            <div class="alert alert-danger">

                                <div class="fw-semibold mb-2">
                                    <i class="bi bi-exclamation-circle me-2"></i>
                                    Registrasi gagal:
                                </div>

                                <ul class="mb-0">

                                    @foreach($errors->all() as $error)

                                        <li>{{ $error }}</li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        {{-- REGISTER FORM --}}
                        <form
                            action="{{ route('register.process') }}"
                            method="POST"
                        >

                            @csrf


                            {{-- NAMA --}}
                            <div class="mb-3">

                                <label for="nama" class="form-label fw-semibold">
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


                            {{-- USERNAME --}}
                            <div class="mb-3">

                                <label for="username" class="form-label fw-semibold">
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


                            {{-- EMAIL --}}
                            <div class="mb-3">

                                <label for="email" class="form-label fw-semibold">
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

                                {{-- NO HP --}}
                                <div class="col-md-6 mb-3">

                                    <label for="no_hp" class="form-label fw-semibold">
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


                                {{-- PASSWORD --}}
                                <div class="col-md-6 mb-3">

                                    <label for="password" class="form-label fw-semibold">
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


                            {{-- ALAMAT --}}
                            <div class="mb-3">

                                <label for="alamat" class="form-label fw-semibold">
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


                            {{-- KONFIRMASI PASSWORD --}}
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


                            {{-- SUBMIT --}}
                            <button
                                type="submit"
                                class="btn btn-orange w-100 py-2 fw-semibold"
                            >

                                <i class="bi bi-person-plus me-2"></i>

                                Daftar Sekarang

                            </button>

                        </form>


                        {{-- LOGIN --}}
                        <div class="text-center mt-4">

                            <span class="text-muted">
                                Sudah punya akun?
                            </span>

                            <a
                                href="{{ route('login') }}"
                                class="register-link fw-bold text-decoration-none"
                            >
                                Login di sini
                            </a>

                        </div>


                        {{-- BACK TO HOME --}}
                        <div class="text-center mt-3">

                            <a
                                href="{{ route('landing') }}"
                                class="text-secondary small text-decoration-none"
                            >

                                <i class="bi bi-arrow-left me-1"></i>

                                Kembali ke Beranda

                            </a>

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="text-center mt-4">

                    <small class="text-secondary">
                        © {{ date('Y') }} Galaxy Petshop.
                        All rights reserved.
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- BOOTSTRAP JS --}}
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>
</html>
