<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>PetCare - Pet Shop & Grooming</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>

        :root {
            --primary: #198754;
            --primary-dark: #146c43;
            --primary-light: #d1fae5;
            --dark: #111827;
            --muted: #6b7280;
            --light: #f8fafc;
            --orange: #f59e0b;
        }

        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            background: #ffffff;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            background: rgba(255, 255, 255, .94);
            backdrop-filter: blur(12px);
        }

        .navbar-brand {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--primary);
        }

        .navbar-brand:hover {
            color: var(--primary-dark);
        }

        .navbar-brand i {
            margin-right: 6px;
        }

        .nav-link {
            color: #4b5563;
            font-weight: 500;
            margin: 0 7px;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .btn-login {
            border: 1px solid var(--primary);
            color: var(--primary);
            border-radius: 10px;
            padding: 9px 20px;
            font-weight: 600;
        }

        .btn-login:hover {
            background: var(--primary);
            color: white;
        }

        /* =========================
           HERO
        ========================= */

        .hero {
            position: relative;
            overflow: hidden;
            padding: 105px 0 100px;
            background:
                radial-gradient(
                    circle at 90% 20%,
                    rgba(209, 250, 229, .8),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #ecfdf5 0%,
                    #ffffff 55%,
                    #fff7ed 100%
                );
        }

        .hero::before {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(25, 135, 84, .06);
            top: -100px;
            left: -80px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary-light);
            color: #047857;
            padding: 8px 15px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 22px;
        }

        .hero h1 {
            font-size: 3.5rem;
            line-height: 1.18;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .hero h1 span {
            color: var(--primary);
        }

        .hero-description {
            color: var(--muted);
            line-height: 1.8;
            max-width: 570px;
            margin-top: 22px;
        }

        .btn-primary-custom {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 11px;
            padding: 13px 24px;
            font-weight: 600;
            box-shadow: 0 8px 20px rgba(25, 135, 84, .18);
        }

        .btn-primary-custom:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-1px);
        }

        .btn-outline-custom {
            border: 1px solid #d1d5db;
            color: #374151;
            border-radius: 11px;
            padding: 13px 24px;
            font-weight: 600;
            background: white;
        }

        .btn-outline-custom:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* HERO VISUAL */

        .hero-visual {
            position: relative;
            padding: 25px;
        }

        .hero-card {
            position: relative;
            background: white;
            border-radius: 30px;
            padding: 45px 30px;
            box-shadow: 0 25px 60px rgba(15, 23, 42, .10);
            text-align: center;
        }

        .hero-pet-icon {
            width: 170px;
            height: 170px;
            margin: auto;
            border-radius: 50%;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-pet-icon i {
            font-size: 90px;
            color: var(--primary);
        }

        .floating-card {
            position: absolute;
            background: white;
            padding: 14px 18px;
            border-radius: 14px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .10);
        }

        .floating-card.top {
            top: 15px;
            right: -5px;
        }

     
.floating-card.bottom {
    bottom: 10px;
    left: -1px;
    transform: translateY(15px);
}

        .floating-card i {
            color: var(--primary);
        }

        /* =========================
           STATS
        ========================= */

        .stats {
            margin-top: -35px;
            position: relative;
            z-index: 2;
        }

        .stats-box {
            background: white;
            border-radius: 18px;
            box-shadow: 0 12px 35px rgba(15, 23, 42, .08);
            padding: 25px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 13px;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .stat-number {
            font-size: 1.15rem;
            font-weight: 700;
        }

        .stat-label {
            color: var(--muted);
            font-size: 12px;
        }

        /* =========================
           SECTION
        ========================= */

        .section-padding {
            padding: 90px 0;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--dark);
        }

        .section-subtitle {
            color: var(--muted);
            max-width: 650px;
            margin: 12px auto 0;
            line-height: 1.8;
        }

        .section-label {
            display: inline-block;
            color: var(--primary);
            background: var(--primary-light);
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        /* =========================
           PRODUCT
        ========================= */

        .product-section {
            background: #ffffff;
        }

        .product-card {
            border: 1px solid #eef2f7;
            border-radius: 18px;
            overflow: hidden;
            height: 100%;
            background: white;
            transition: .25s ease;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(15, 23, 42, .09);
        }

        .product-image {
            height: 210px;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: .3s;
        }

        .product-card:hover .product-image img {
            transform: scale(1.04);
        }

        .product-placeholder {
            width: 75px;
            height: 75px;
            border-radius: 20px;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
        }

        .product-body {
            padding: 20px;
        }

        .product-category {
            color: var(--primary);
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .product-name {
            font-size: 15px;
            font-weight: 700;
            margin-top: 6px;
            margin-bottom: 8px;
        }

        .product-price {
            color: var(--primary);
            font-size: 16px;
            font-weight: 700;
        }

        .product-stock {
            color: #9ca3af;
            font-size: 12px;
        }

        /* =========================
           SERVICE
        ========================= */

        .service-section {
            background: var(--light);
        }

        .service-card {
            background: white;
            border: 1px solid #eef2f7;
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            transition: .25s ease;
        }

        .service-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(15, 23, 42, .08);
        }

        .service-icon {
            width: 62px;
            height: 62px;
            border-radius: 16px;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            margin-bottom: 22px;
        }

        .service-card h5 {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .service-card p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

        .service-meta {
            display: flex;
            gap: 18px;
            margin-top: 18px;
            padding-top: 15px;
            border-top: 1px solid #f1f5f9;
            font-size: 12px;
            color: var(--muted);
        }

        .service-meta i {
            color: var(--primary);
            margin-right: 4px;
        }

        .service-price {
            color: var(--primary);
            font-weight: 700;
        }

        /* =========================
           WHY PETCARE
        ========================= */

        .why-card {
            padding: 25px 0;
        }

        .why-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 16px;
        }

        .why-card h6 {
            font-weight: 700;
        }

        .why-card p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        /* =========================
           CTA
        ========================= */

        .cta-section {
            padding: 30px 0 90px;
        }

        .cta {
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(
                    135deg,
                    #198754,
                    #146c43
                );
            color: white;
            border-radius: 28px;
            padding: 65px 45px;
        }

        .cta::after {
            content: "";
            position: absolute;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            border: 35px solid rgba(255,255,255,.08);
            right: -80px;
            top: -100px;
        }

        .cta h2 {
            font-weight: 800;
        }

        .cta p {
            color: rgba(255,255,255,.78);
            max-width: 600px;
            margin: 14px auto 25px;
        }

        .btn-light-custom {
            background: white;
            color: var(--primary);
            border: none;
            border-radius: 11px;
            padding: 13px 25px;
            font-weight: 700;
        }

        .btn-light-custom:hover {
            background: #f8fafc;
            color: var(--primary-dark);
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            background: #111827;
            color: #9ca3af;
            padding: 40px 0;
        }

        footer .brand {
            color: white;
            font-weight: 800;
            font-size: 1.15rem;
        }

        footer h6 {
            color: white;
            font-weight: 600;
            margin-bottom: 15px;
        }

        footer a {
            color: #9ca3af;
            text-decoration: none;
            font-size: 13px;
        }

        footer a:hover {
            color: white;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 992px) {

            .hero {
                padding: 80px 0;
            }

            .hero h1 {
                font-size: 2.8rem;
            }

            .hero-visual {
                margin-top: 50px;
            }

            .stats {
        

    </style>

</head>

<body>


{{-- =====================================================
     NAVBAR
===================================================== --}}

<nav class="navbar navbar-expand-lg sticky-top border-bottom">

    <div class="container">

        <a class="navbar-brand"
           href="{{ route('landing') }}">

            <i class="bi bi-heart-fill"></i>
            PetCare

        </a>


        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarPetCare"
        >

            <span class="navbar-toggler-icon"></span>

        </button>


        <div
            class="collapse navbar-collapse"
            id="navbarPetCare"
        >

            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link" href="#home">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#produk">
                        Produk
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#layanan">
                        Grooming
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#tentang">
                        Tentang
                    </a>
                </li>

            </ul>


            <a href="{{ route('login') }}"
               class="btn btn-login">

                <i class="bi bi-box-arrow-in-right me-1"></i>

                Login

            </a>

        </div>

    </div>

</nav>


{{-- =====================================================
     HERO
===================================================== --}}

<section class="hero" id="home">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <div class="hero-badge">

                    <i class="bi bi-stars"></i>

                    Semua kebutuhan hewan dalam satu tempat

                </div>


                <h1>

                    Rawat Hewan Kesayangan

                    <span>Lebih Mudah</span>

                    Bersama PetCare

                </h1>


                <p class="hero-description">

                    Temukan produk kebutuhan hewan,
                    booking grooming, dan kelola data
                    hewan kesayangan Anda dengan mudah
                    melalui satu platform.

                </p>


                <div class="d-flex gap-3 mt-4 flex-wrap">

                    <a href="{{ route('register') }}"
                       class="btn btn-primary-custom">

                        <i class="bi bi-person-plus me-2"></i>

                        Daftar Sekarang

                    </a>


                    <a href="#produk"
                       class="btn btn-outline-custom">

                        Lihat Produk

                        <i class="bi bi-arrow-down ms-1"></i>

                    </a>

                </div>

            </div>


            <div class="col-lg-6">

                <div class="hero-visual">

                    <div class="hero-card">

                        <div class="hero-pet-icon">

                            <i class="bi bi-heart-pulse-fill"></i>

                        </div>

                        <h4 class="fw-bold mt-4">

                            Care. Love. PetCare.

                        </h4>

                        <p class="text-muted small mb-0">

                            Produk dan layanan terbaik
                            untuk sahabat berbulu Anda.

                        </p>

                    </div>


                    <div class="floating-card top">

                        <div class="d-flex align-items-center gap-2">

                            <i class="bi bi-check-circle-fill"></i>

                            <div>

                                <small class="text-muted d-block">
                                    Layanan
                                </small>

                                <strong class="small">
                                    Grooming tersedia
                                </strong>

                            </div>

                        </div>

                    </div>


                    <div class="floating-card bottom">

                        <div class="d-flex align-items-center gap-2">

                            <i class="bi bi-bag-heart-fill"></i>

                            <div>

                                <small class="text-muted d-block">
                                    Belanja
                                </small>

                                <strong class="small">
                                    Mudah & praktis
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     STATS
===================================================== --}}

<section class="stats">

    <div class="container">

        <div class="stats-box">

            <div class="row g-4">

                <div class="col-md-4">

                    <div class="stat-item">

                        <div class="stat-icon">

                            <i class="bi bi-box-seam"></i>

                        </div>

                        <div>

                            <div class="stat-number">
                                Produk Pet Shop
                            </div>

                            <div class="stat-label">
                                Kebutuhan hewan tersedia
                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="stat-item">

                        <div class="stat-icon">

                            <i class="bi bi-scissors"></i>

                        </div>

                        <div>

                            <div class="stat-number">
                                Grooming
                            </div>

                            <div class="stat-label">
                                Layanan perawatan hewan
                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="stat-item">

                        <div class="stat-icon">

                            <i class="bi bi-calendar-check"></i>

                        </div>

                        <div>

                            <div class="stat-number">
                                Booking Online
                            </div>

                            <div class="stat-label">
                                Atur jadwal dengan mudah
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     PRODUK UNGGULAN
===================================================== --}}

<section class="section-padding product-section"
         id="produk">

    <div class="container">

        <div class="d-flex justify-content-between
                    align-items-end
                    mb-5
                    flex-wrap
                    gap-3">

            <div>

                <span class="section-label">

                    PET SHOP

                </span>

                <h2 class="section-title mb-0">

                    Produk Unggulan

                </h2>

                <p class="text-muted mt-2 mb-0">

                    Pilihan produk yang tersedia
                    di PetCare.

                </p>

            </div>


            @auth

                @if(auth()->user()->role === 'customer')

                    <a href="{{ route('customer.products') }}"
                       class="btn btn-outline-custom">

                        Lihat Semua Produk

                        <i class="bi bi-arrow-right ms-1"></i>

                    </a>

                @endif

            @else

                <a href="{{ route('login') }}"
                   class="btn btn-outline-custom">

                    Lihat Produk

                    <i class="bi bi-arrow-right ms-1"></i>

                </a>

            @endauth

        </div>


        <div class="row g-4">

            @forelse($products as $product)

                <div class="col-6 col-lg-3">

                    <div class="product-card">

                        <div class="product-image">

                            @if($product->gambar)

                                <img
                                    src="{{ asset('storage/' . $product->gambar) }}"
                                    alt="{{ $product->nama_product }}"
                                >

                            @else

                                <div class="product-placeholder">

                                    <i class="bi bi-box-seam"></i>

                                </div>

                            @endif

                        </div>


                        <div class="product-body">

                            <div class="product-category">

                                {{ $product->category->nama_category ?? 'Produk' }}

                            </div>


                            <div class="product-name">

                                {{ $product->nama_product }}

                            </div>


                            <div class="d-flex
                                        justify-content-between
                                        align-items-center">

                                <div class="product-price">

                                    Rp {{ number_format(
                                        $product->harga,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </div>


                                <div class="product-stock">

                                    Stok {{ $product->stok }}

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="text-center
                                py-5
                                text-muted">

                        <i class="bi bi-box-seam fs-1 d-block mb-3"></i>

                        Belum ada produk yang tersedia.

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>


{{-- =====================================================
     GROOMING
===================================================== --}}

<section class="section-padding service-section"
         id="layanan">

    <div class="container">

        <div class="text-center mb-5">

            <span class="section-label">

                GROOMING

            </span>

            <h2 class="section-title">

                Layanan Grooming

            </h2>

            <p class="section-subtitle">

                Berikan perawatan terbaik untuk hewan
                kesayangan dengan layanan grooming
                yang tersedia di PetCare.

            </p>

        </div>


        <div class="row g-4">

            @forelse($services as $service)

                <div class="col-md-4">

                    <div class="service-card">

                        <div class="service-icon">

                            <i class="bi bi-scissors"></i>

                        </div>


                        <h5>

                            {{ $service->nama_service }}

                        </h5>


                        <p>

                            {{ $service->deskripsi
                                ?: 'Layanan perawatan hewan dari PetCare untuk menjaga kebersihan dan kenyamanan hewan kesayangan.' }}

                        </p>


                        <div class="service-meta">

                            <div>

                                <i class="bi bi-clock"></i>

                                {{ $service->durasi }} menit

                            </div>


                            <div class="service-price">

                                Rp {{ number_format(
                                    $service->harga,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="text-center
                                py-5
                                text-muted">

                        <i class="bi bi-scissors fs-1 d-block mb-3"></i>

                        Belum ada layanan grooming.

                    </div>

                </div>

            @endforelse

        </div>


        <div class="text-center mt-5">

            <a href="{{ route('login') }}"
               class="btn btn-primary-custom">

                <i class="bi bi-calendar-check me-2"></i>

                Booking Grooming

            </a>

        </div>

    </div>

</section>


{{-- =====================================================
     WHY PETCARE
===================================================== --}}

<section class="section-padding"
         id="tentang">

    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-5">

                <span class="section-label">

                    TENTANG PETCARE

                </span>

                <h2 class="section-title">

                    Semua kebutuhan hewan,
                    lebih praktis.

                </h2>

                <p class="text-muted mt-3"
                   style="line-height:1.8">

                    PetCare dirancang untuk memudahkan
                    customer dalam mengelola kebutuhan
                    hewan kesayangan, mulai dari data hewan,
                    produk, grooming, hingga riwayat transaksi.

                </p>


                <a href="{{ route('register') }}"
                   class="btn btn-primary-custom mt-2">

                    Bergabung dengan PetCare

                    <i class="bi bi-arrow-right ms-1"></i>

                </a>

            </div>


            <div class="col-lg-7">

                <div class="row g-4">

                    <div class="col-md-6">

                        <div class="why-card">

                            <div class="why-icon">

                                <i class="bi bi-box-seam"></i>

                            </div>

                            <h6>

                                Produk Lengkap

                            </h6>

                            <p>

                                Berbagai kebutuhan hewan
                                tersedia dalam satu platform.

                            </p>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="why-card">

                            <div class="why-icon">

                                <i class="bi bi-calendar2-check"></i>

                            </div>

                            <h6>

                                Booking Mudah

                            </h6>

                            <p>

                                Atur jadwal grooming tanpa
                                perlu proses yang rumit.

                            </p>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="why-card">

                            <div class="why-icon">

                                <i class="bi bi-heart-pulse"></i>

                            </div>

                            <h6>

                                Data Hewan Terorganisir

                            </h6>

                            <p>

                                Simpan informasi hewan kesayangan
                                dengan lebih teratur.

                            </p>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="why-card">

                            <div class="why-icon">

                                <i class="bi bi-receipt"></i>

                            </div>

                            <h6>

                                Riwayat Transaksi

                            </h6>

                            <p>

                                Pantau pembelian dan aktivitas
                                layanan melalui akun Anda.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     CTA
===================================================== --}}

<section class="cta-section">

    <div class="container">

        <div class="cta text-center">

            <h2>

                Siap merawat hewan kesayangan
                dengan lebih mudah?

            </h2>

            <p>

                Buat akun PetCare dan nikmati kemudahan
                mengelola produk, hewan, grooming,
                dan transaksi dalam satu platform.

            </p>


            <a href="{{ route('register') }}"
               class="btn btn-light-custom">

                <i class="bi bi-person-plus me-2"></i>

                Buat Akun Gratis

            </a>

        </div>

    </div>

</section>


{{-- =====================================================
     FOOTER
===================================================== --}}

<footer>

    <div class="container">

        <div class="row g-4">

            <div class="col-lg-5">

                <div class="brand">

                    <i class="bi bi-heart-fill me-1"></i>

                    PetCare

                </div>

                <p class="small mt-3 mb-0">

                    Sistem informasi manajemen
                    pet shop dan grooming untuk
                    membantu perawatan hewan
                    kesayangan menjadi lebih mudah.

                </p>

            </div>


            <div class="col-6 col-lg-3">

                <h6>

                    Navigasi

                </h6>

                <div class="d-flex flex-column gap-2">

                    <a href="#home">
                        Home
                    </a>

                    <a href="#produk">
                        Produk
                    </a>

                    <a href="#layanan">
                        Grooming
                    </a>

                    <a href="#tentang">
                        Tentang
                    </a>

                </div>

            </div>


            <div class="col-6 col-lg-4">

                <h6>

                    Akun

                </h6>

                <div class="d-flex flex-column gap-2">

                    <a href="{{ route('login') }}">
                        Login
                    </a>

                    <a href="{{ route('register') }}">
                        Register
                    </a>

                </div>

            </div>

        </div>


        <hr class="border-secondary my-4">


        <div class="d-flex
                    justify-content-between
                    flex-wrap
                    gap-2
                    small">

            <span>

                © {{ date('Y') }} PetCare

            </span>

            <span>

                Pet Shop & Grooming

            </span>

        </div>

    </div>

</footer>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>