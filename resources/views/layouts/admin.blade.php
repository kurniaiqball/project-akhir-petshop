
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f58220">

    <title>@yield('title', 'Admin - Galaxy Petshop')</title>

    {{-- Bootstrap 5.3.3 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --galaxy-orange: #f58220;
            --galaxy-orange-dark: #d96812;
            --galaxy-orange-soft: #fff2e6;
            --galaxy-ink: #29231f;
            --galaxy-border: #f0e5dc;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background-color: #fffaf6;
            color: var(--galaxy-ink);
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        /* ================= SIDEBAR ================= */

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background-color: #fff;
            border-right: 1px solid var(--galaxy-border);
            box-shadow: 3px 0 15px rgba(80, 48, 20, .03);
            padding: 20px !important;
            flex-shrink: 0;
        }

        .sidebar-inner {
            display: flex;
            flex-direction: column;
            min-height: calc(100vh - 40px);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 5px;
        }

        .brand-logo {
            width: 65px;
            height: 60px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .brand-name {
            font-size: 17px;
            font-weight: 800;
            color: var(--galaxy-orange);
            line-height: 1.3;
        }

        .brand-location {
            font-size: 11px;
            font-weight: 600;
            color: #555;
            letter-spacing: .3px;
        }

        .brand-subtitle {
            font-size: 12px;
            color: #999;
        }

        /* MENU */

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            color: #555;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 5px;
            transition: all .2s ease;
            font-weight: 500;
            white-space: nowrap;
        }

        .sidebar .nav-link i {
            font-size: 17px;
            min-width: 23px;
        }

        .sidebar .nav-link:hover {
            background-color: var(--galaxy-orange-soft);
            color: var(--galaxy-orange-dark);
            transform: translateX(3px);
        }

        .sidebar .nav-link.active {
            background-color: var(--galaxy-orange-soft);
            color: var(--galaxy-orange-dark);
            font-weight: 700;
            border-left: 3px solid var(--galaxy-orange);
        }

        .sidebar hr {
            border-color: var(--galaxy-border);
            opacity: 1;
        }

        .sidebar-logout {
            margin-top: auto;
        }

        /* ================= MAIN CONTENT ================= */

        .main-content {
            min-width: 0;
            flex: 1;
            min-height: 100vh;
            background-color: #fffaf6;
            padding: 28px !important;
        }

        .page-header {
            background: #fff;
            border: 1px solid var(--galaxy-border);
            border-radius: 15px;
            padding: 20px 24px;
            box-shadow: 0 3px 12px rgba(80, 48, 20, .03);
        }

        .page-header h3 {
            color: var(--galaxy-ink);
            font-size: 23px;
        }

        .page-header p {
            color: #888;
            font-size: 14px;
        }

        /* ================= STAT CARD ================= */

        .stat-card {
            height: 100%;
            border: 1px solid var(--galaxy-border);
            border-radius: 15px;
            background-color: #fff;
            transition: all .2s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(80, 48, 20, .08);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            background-color: var(--galaxy-orange-soft);
            color: var(--galaxy-orange);
            flex-shrink: 0;
        }

        /* ================= BUTTON ================= */

        .btn-orange {
            background-color: var(--galaxy-orange);
            border-color: var(--galaxy-orange);
            color: #fff;
            border-radius: 10px;
        }

        .btn-orange:hover {
            background-color: var(--galaxy-orange-dark);
            border-color: var(--galaxy-orange-dark);
            color: #fff;
        }

        .btn-outline-orange {
            border: 1px solid var(--galaxy-orange);
            color: var(--galaxy-orange-dark);
            border-radius: 10px;
        }

        .btn-outline-orange:hover {
            background-color: var(--galaxy-orange);
            color: #fff;
        }

        /* ================= OTHER ELEMENTS ================= */

        .text-orange {
            color: var(--galaxy-orange) !important;
        }

        .bg-orange-soft {
            background-color: var(--galaxy-orange-soft) !important;
        }

        /* Mencegah tabel merusak layout */

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Mencegah gambar keluar dari container */

        img {
            max-width: 100%;
        }

        /* ================= MOBILE TOPBAR ================= */

        .mobile-topbar {
            display: none;
            background-color: #fff;
            border-bottom: 1px solid var(--galaxy-border);
            padding: 12px 16px;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .mobile-brand {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .mobile-brand img {
            width: 42px;
            height: 42px;
            object-fit: contain;
        }

        .mobile-brand-name {
            font-weight: 800;
            font-size: 14px;
            color: var(--galaxy-orange);
        }

        .mobile-brand-subtitle {
            font-size: 10px;
            color: #777;
        }

        .mobile-menu-btn {
            width: 42px;
            height: 42px;
            border: 1px solid var(--galaxy-border);
            background: var(--galaxy-orange-soft);
            color: var(--galaxy-orange-dark);
            border-radius: 10px;
            font-size: 21px;
        }

        /* ================= TABLET ================= */

        @media (max-width: 991.98px) {
            .sidebar {
                width: 230px;
            }

            .main-content {
                padding: 22px !important;
            }

            .page-header {
                padding: 18px;
            }
        }

        /* ================= MOBILE ================= */

        @media (max-width: 767.98px) {

            .mobile-topbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .sidebar {
                width: 280px;
                min-height: 100%;
                height: 100%;
                border-right: none;
                padding: 20px !important;
            }

            .sidebar-inner {
                min-height: calc(100vh - 40px);
            }

            .main-content {
                width: 100%;
                min-height: calc(100vh - 66px);
                padding: 16px !important;
            }

            .page-header {
                padding: 16px;
                margin-bottom: 20px !important;
                border-radius: 12px;
            }

            .page-header h3 {
                font-size: 19px;
            }

            .page-header p {
                font-size: 13px;
                line-height: 1.5;
            }

            .stat-card {
                border-radius: 12px;
            }

            .stat-icon {
                width: 43px;
                height: 43px;
                font-size: 19px;
            }

            .btn {
                font-size: 13px;
            }
        }

        /* ================= SMALL MOBILE ================= */

        @media (max-width: 400px) {

            .main-content {
                padding: 12px !important;
            }

            .page-header {
                padding: 14px;
            }

            .page-header h3 {
                font-size: 17px;
            }

            .mobile-brand img {
                width: 36px;
                height: 36px;
            }

            .mobile-brand-name {
                font-size: 13px;
            }

            .sidebar {
                width: 260px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- ================= MOBILE TOPBAR ================= --}}

    <nav class="mobile-topbar">

        <div class="mobile-brand">

            <img src="{{ asset('images/logopet.png') }}" alt="Logo Galaxy Petshop">

            <div>
                <div class="mobile-brand-name">GALAXY PETSHOP</div>
                <div class="mobile-brand-subtitle">Admin Panel</div>
            </div>

        </div>

        <button
            class="mobile-menu-btn"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#adminSidebar"
            aria-controls="adminSidebar"
            aria-label="Buka menu navigasi"
        >
            <i class="bi bi-list"></i>
        </button>

    </nav>


    <div class="d-flex">

        {{-- ================= SIDEBAR ================= --}}

        <aside
            class="sidebar offcanvas-md offcanvas-start"
            tabindex="-1"
            id="adminSidebar"
            aria-labelledby="sidebarLabel"
        >

            <div class="sidebar-inner">

                {{-- BRAND --}}

                <div class="mb-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div class="brand">

                            <img
                                src="{{ asset('images/logopet.png') }}"
                                alt="Logo Galaxy Petshop"
                                class="brand-logo"
                            >

                            <div>
                                <div class="brand-name">GALAXY</div>
                                <div class="brand-location">PETSHOP</div>
                                <div class="brand-location">PUCANG GADING</div>
                            </div>

                        </div>

                        {{-- Tombol tutup khusus mobile --}}

                        <button
                            type="button"
                            class="btn-close d-md-none"
                            data-bs-dismiss="offcanvas"
                            aria-label="Tutup menu"
                        ></button>

                    </div>

                    <div class="brand-subtitle px-2 mt-2" id="sidebarLabel">
                        <i class="bi bi-grid me-1"></i>
                        Admin Panel
                    </div>

                </div>


                {{-- MENU --}}

                <ul class="nav flex-column">

                    <li class="nav-item">
                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        >
                            <i class="bi bi-speedometer2 me-2"></i>
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="{{ route('admin.products.index') }}"
                            class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
                        >
                            <i class="bi bi-box-seam me-2"></i>
                            Produk
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="{{ route('admin.categories.index') }}"
                            class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                        >
                            <i class="bi bi-tags me-2"></i>
                            Kategori
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="{{ route('admin.customers.index') }}"
                            class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}"
                        >
                            <i class="bi bi-people me-2"></i>
                            Customer
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="{{ route('admin.pets.index') }}"
                            class="nav-link {{ request()->routeIs('admin.pets.*') ? 'active' : '' }}"
                        >
                            <i class="bi bi-heart me-2"></i>
                            Hewan
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="{{ route('admin.services.index') }}"
                            class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"
                        >
                            <i class="bi bi-scissors me-2"></i>
                            Layanan
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="{{ route('admin.bookings.index') }}"
                            class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}"
                        >
                            <i class="bi bi-calendar-check me-2"></i>
                            Booking
                        </a>
                    </li>

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

                <div class="sidebar-logout">

                    <hr class="my-4">

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button
                            type="submit"
                            class="btn btn-outline-orange w-100 py-2 fw-semibold"
                        >
                            <i class="bi bi-box-arrow-right me-2"></i>
                            Logout
                        </button>

                    </form>

                </div>

            </div>

        </aside>


        {{-- ================= MAIN CONTENT ================= --}}

        <main class="main-content">

            {{-- PAGE HEADER --}}

            <div class="page-header mb-4">

                <h3 class="fw-bold mb-1">
                    @yield('page-title')
                </h3>

                <p class="mb-0">
                    @yield('page-description')
                </p>

            </div>


            {{-- CONTENT --}}

            @yield('content')

        </main>

    </div>


    {{-- BOOTSTRAP JS --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
