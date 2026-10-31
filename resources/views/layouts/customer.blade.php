<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>@yield('title', 'PetCare')</title>

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

<body class="bg-light">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">

            {{-- Brand --}}
            <a
                href="{{ route('customer.dashboard') }}"
                class="navbar-brand fw-bold text-success"
            >
                <i class="bi bi-heart-fill me-2"></i>
                PetCare
            </a>

            {{-- Navigation --}}
            <div class="d-flex align-items-center gap-3 flex-wrap">

                <a
                    href="{{ route('customer.dashboard') }}"
                    class="text-decoration-none text-dark"
                >
                    <i class="bi bi-house me-1"></i>
                    Dashboard
                </a>

                <a
                    href="{{ route('customer.booking') }}"
                    class="text-decoration-none text-dark"
                >
                    <i class="bi bi-calendar-check me-1"></i>
                    Booking
                </a>

                <a
                    href="{{ route('customer.history') }}"
                    class="text-decoration-none text-dark"
                >
                    <i class="bi bi-clock-history me-1"></i>
                    History Booking
                </a>

                <a
                    href="{{ route('customer.transactions') }}"
                    class="text-decoration-none text-dark"
                >
                    <i class="bi bi-receipt me-1"></i>
                    History Transaksi
                </a>

                {{-- Profil --}}
                <a
                    href="{{ route('customer.profile') }}"
                    class="text-decoration-none text-success fw-semibold"
                >
                    <i class="bi bi-person-circle me-1"></i>
                    Profil Saya
                </a>

                {{-- Logout --}}
                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="mb-0"
                >
                    @csrf

                    <button
                        type="submit"
                        class="btn btn-outline-danger btn-sm"
                    >
                        <i class="bi bi-box-arrow-right me-1"></i>
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </nav>

    {{-- Main Content --}}
    <main class="container py-4">
        @yield('content')
    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>