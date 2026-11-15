
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f58220">

    <title>Login - Galaxy Petshop</title>

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

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
        }

        .login-card {
            border: 1px solid rgba(245, 130, 32, .12);
            border-radius: 22px;
            overflow: hidden;
            background: #fff;
        }

        .login-card .card-body {
            padding: 40px;
        }

        .brand-logo {
            width: 150px;
            height: 110px;
            object-fit: contain;
            margin-bottom: 15px;
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

        .form-check-input:checked {
            background-color: var(--galaxy-orange);
            border-color: var(--galaxy-orange);
        }

        .form-check-input:focus {
            border-color: var(--galaxy-orange);
            box-shadow: 0 0 0 .2rem rgba(245, 130, 32, .15);
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

        @media (max-width: 576px) {
            .login-card .card-body {
                padding: 30px 22px;
            }

            .brand-logo {
                width: 130px;
                height: 95px;
            }
        }
    </style>

</head>

<body>

<div class="login-wrapper">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-6 col-lg-5">

                <div class="card login-card shadow-lg">

                    <div class="card-body">

                        {{-- HEADER --}}
                        <div class="text-center mb-4">

                            <img
                                src="{{ asset('images/logopet.png') }}"
                                alt="Logo Galaxy Petshop"
                                class="brand-logo"
                            >

                            <h3 class="fw-bold brand-title mb-1">
                                Selamat Datang!
                            </h3>

                            <h5 class="fw-bold mb-2">
                                Galaxy Petshop
                            </h5>

                            <div class="login-divider"></div>

                            <p class="text-muted mb-0">
                                Login untuk mengakses akunmu
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

                                <i class="bi bi-exclamation-circle me-2"></i>

                                {{ $errors->first() }}

                            </div>

                        @endif


                        {{-- LOGIN FORM --}}
                        <form
                            action="{{ route('login.process') }}"
                            method="POST"
                        >

                            @csrf


                            {{-- USERNAME / EMAIL --}}
                            <div class="mb-3">

                                <label
                                    for="login"
                                    class="form-label fw-semibold"
                                >
                                    Username atau Email
                                </label>

                                <input
                                    type="text"
                                    id="login"
                                    name="login"
                                    class="form-control @error('login') is-invalid @enderror"
                                    value="{{ old('login') }}"
                                    placeholder="Masukkan username atau email"
                                    required
                                    autofocus
                                >

                                @error('login')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- PASSWORD --}}
                            <div class="mb-3">

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
                                    class="form-control"
                                    placeholder="Masukkan password"
                                    required
                                >

                            </div>


                            {{-- REMEMBER ME --}}
                            <div class="form-check mb-4">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="remember"
                                    value="1"
                                    id="remember"
                                >

                                <label
                                    class="form-check-label text-secondary"
                                    for="remember"
                                >
                                    Ingat saya
                                </label>

                            </div>


                            {{-- LOGIN BUTTON --}}
                            <button
                                type="submit"
                                class="btn btn-orange w-100 py-2 fw-semibold"
                            >

                                <i class="bi bi-box-arrow-in-right me-2"></i>

                                Login

                            </button>

                        </form>


                        {{-- REGISTER --}}
                        <div class="text-center mt-4">

                            <span class="text-muted">
                                Belum punya akun?
                            </span>

                            <a
                                href="{{ route('register') }}"
                                class="register-link fw-bold text-decoration-none"
                            >
                                Daftar sekarang
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


{{-- Bootstrap JS --}}
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>
</html>
