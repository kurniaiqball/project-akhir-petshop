<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login - PetCare</title>


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <style>

        body {
            background: #f5f7f9;
        }

        .login-card {
            border: none;
            border-radius: 16px;
        }

        .brand-icon {
            width: 65px;
            height: 65px;
        }

        .form-control {
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

        <div class="col-md-6 col-lg-5">


            <div class="card login-card shadow-sm">

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
                            Selamat Datang di PetCare
                        </h3>

                        <p class="text-muted mb-0">
                            Login untuk mengakses akunmu
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

                            <i class="bi bi-exclamation-circle me-2"></i>

                            {{ $errors->first() }}

                        </div>

                    @endif


                    {{-- Login Form --}}
                    <form
                        action="{{ route('login.process') }}"
                        method="POST"
                    >

                        @csrf


                        {{-- Username / Email --}}
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


                        {{-- Password --}}
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


                        {{-- Remember --}}
                        <div class="form-check mb-4">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="remember"
                                value="1"
                                id="remember"
                            >

                            <label
                                class="form-check-label"
                                for="remember"
                            >
                                Ingat saya
                            </label>

                        </div>


                        {{-- Button --}}
                        <button
                            type="submit"
                            class="btn btn-success w-100 py-2"
                        >

                            <i class="bi bi-box-arrow-in-right me-1"></i>

                            Login

                        </button>

                    </form>


                    {{-- Register --}}
                    <div class="text-center mt-4">

                        <span class="text-muted">
                            Belum punya akun?
                        </span>

                        <a
                            href="{{ route('register') }}"
                            class="text-success fw-semibold text-decoration-none"
                        >
                            Daftar sekarang
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