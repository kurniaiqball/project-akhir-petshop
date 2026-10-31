<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Admin - PetCare')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>

        body {
            background-color: #f5f7fb;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #e5e7eb;
        }

        .brand {
            font-size: 22px;
            font-weight: 700;
            color: #198754;
        }

        .sidebar .nav-link {
            color: #555;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 5px;
            transition: 0.2s;
        }

        .sidebar .nav-link:hover {
            background-color: #f1f8f4;
            color: #198754;
        }

        .sidebar .nav-link.active {
            background-color: #e8f5ee;
            color: #198754;
        }

        .main-content {
            min-height: 100vh;
        }

        .stat-card {
            border: none;
            border-radius: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

    </style>

    @stack('styles')

</head>


<body>

<div class="container-fluid">

    <div class="row">

        {{-- ================= SIDEBAR ================= --}}

        <aside class="col-md-3 col-lg-2 sidebar p-3">

            {{-- BRAND --}}

            <div class="mb-4 px-2">

                <div class="brand">
                    🐾 Galaxy Petshop Pucang Gading
                </div>

                <small class="text-muted">
                    Admin Panel
                </small>

            </div>


            {{-- MENU --}}

            <ul class="nav flex-column">

                {{-- DASHBOARD --}}
                <li class="nav-item">

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    >
                        <i class="bi bi-speedometer2 me-2"></i>
                        Dashboard
                    </a>

                </li>


                {{-- PRODUK --}}
                <li class="nav-item">

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-box-seam me-2"></i>
                        Produk
                    </a>

                </li>


                {{-- KATEGORI --}}
                <li class="nav-item">

                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-tags me-2"></i>
                        Kategori
                    </a>

                </li>


                {{-- CUSTOMER --}}
                <li class="nav-item">

                    <a
                        href="{{ route('admin.customers.index') }}"
                        class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-people me-2"></i>
                        Customer
                    </a>

                </li>


                {{-- HEWAN --}}
                <li class="nav-item">

                    <a
                        href="{{ route('admin.pets.index') }}"
                        class="nav-link {{ request()->routeIs('admin.pets.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-heart me-2"></i>
                        Hewan
                    </a>

                </li>


                {{-- LAYANAN --}}
                <li class="nav-item">

                    <a
                        href="{{ route('admin.services.index') }}"
                        class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-scissors me-2"></i>
                        Layanan
                    </a>

                </li>


                {{-- BOOKING --}}
                <li class="nav-item">

                    <a
                        href="{{ route('admin.bookings.index') }}"
                        class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-calendar-check me-2"></i>
                        Booking
                    </a>

                </li>


                {{-- TRANSAKSI --}}
                <li class="nav-item">

                    <a
                        href="{{ route('admin.transactions.index') }}"
                        class="nav-link {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-receipt me-2"></i>
                        Transaksi
                    </a>

                </li>

            </ul>


            {{-- LOGOUT --}}

            <hr>

            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="btn btn-outline-danger w-100"
                >
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </button>

            </form>

        </aside>


        {{-- ================= MAIN CONTENT ================= --}}

        <main class="col-md-9 col-lg-10 main-content p-4">

            {{-- PAGE HEADER --}}

            <div class="mb-4">

                <h3 class="fw-bold mb-1">
                    @yield('page-title')
                </h3>

                <p class="text-muted mb-0">
                    @yield('page-description')
                </p>

            </div>


            {{-- CONTENT --}}

            @yield('content')

        </main>

    </div>

</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

@stack('scripts')

</body>

</html>