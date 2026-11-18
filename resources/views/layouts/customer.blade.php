<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta name="theme-color" content="#f58220">

    <title>@yield('title', 'Galaxy Petshop')</title>

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- Bootstrap Icons --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >
</head>

<body class="bg-white">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg bg-white sticky-top border-bottom shadow-sm">
        <div class="container py-2">

            {{-- BRAND / LOGO --}}
            <a
                href="{{ route('customer.dashboard') }}"
                class="navbar-brand d-flex align-items-center gap-2 text-decoration-none"
            >
                <img
                    src="{{ asset('images/logopet.png') }}"
                    alt="Logo Galaxy Petshop"
                    width="65"
                    height="52"
                    style="object-fit: contain;"
                >

                <span class="fw-bold lh-sm">
                    <span class="d-block fs-5" style="color: #f58220;">
                        GALAXY
                    </span>

                    <small class="d-block text-dark"
                        style="font-size: .7rem; letter-spacing: .08em;">
                        PETSHOP PUCANG GADING
                    </small>
                </span>
            </a>


            {{-- TOGGLE NAVBAR --}}
            <button
                class="navbar-toggler border-0 shadow-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarCustomer"
                aria-controls="navbarCustomer"
                aria-expanded="false"
                aria-label="Buka navigasi"
            >
                <span class="navbar-toggler-icon"></span>
            </button>


            {{-- NAVIGATION --}}
            <div class="collapse navbar-collapse" id="navbarCustomer">

                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2 mt-3 mt-lg-0">

                    {{-- Dashboard --}}
                    <li class="nav-item">
                        <a
                            href="{{ route('customer.dashboard') }}"
                            class="nav-link fw-semibold text-dark"
                        >
                            <i class="bi bi-house me-1" style="color: #f58220;"></i>
                            Dashboard
                        </a>
                    </li>

                    {{-- Booking --}}
                    <li class="nav-item">
                        <a
                            href="{{ route('customer.booking') }}"
                            class="nav-link fw-semibold text-dark"
                        >
                            <i class="bi bi-calendar-check me-1" style="color: #f58220;"></i>
                            Booking
                        </a>
                    </li>

                    {{-- History Booking --}}
                    <li class="nav-item">
                        <a
                            href="{{ route('customer.history') }}"
                            class="nav-link fw-semibold text-dark"
                        >
                            <i class="bi bi-clock-history me-1" style="color: #f58220;"></i>
                            History Booking
                        </a>
                    </li>

                    {{-- History Transaksi --}}
                    <li class="nav-item">
                        <a
                            href="{{ route('customer.transactions') }}"
                            class="nav-link fw-semibold text-dark"
                        >
                            <i class="bi bi-receipt me-1" style="color: #f58220;"></i>
                            History Transaksi
                        </a>
                    </li>

                    {{-- Profil --}}
                    <li class="nav-item">
                        <a
                            href="{{ route('customer.profile') }}"
                            class="nav-link fw-semibold"
                            style="color: #d96812;"
                        >
                            <i class="bi bi-person-circle me-1"></i>
                            Profil Saya
                        </a>
                    </li>

                    {{-- Logout --}}
                    <li class="nav-item">
                        <form
                            action="{{ route('logout') }}"
                            method="POST"
                            class="mb-0"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="btn btn-outline-danger btn-sm fw-semibold"
                                style="border-color: #f58220; color: dark;"
                            >
                                <i class="bi bi-box-arrow-right me-1"></i>
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>

            </div>

        </div>
    </nav>


    {{-- MAIN CONTENT --}}
    <main class="container py-4">
        @yield('content')
    </main>


    {{-- BOOTSTRAP JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>