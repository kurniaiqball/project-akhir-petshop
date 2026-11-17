<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f58220">
    <title>Galaxy Petshop | Pet Shop & Grooming</title>

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
        }

        html { scroll-behavior: smooth; }
        body { color: var(--galaxy-ink); }
        .text-orange { color: var(--galaxy-orange) !important; }
        .bg-orange { background-color: var(--galaxy-orange) !important; }
        .bg-orange-soft { background-color: var(--galaxy-orange-soft) !important; }
        .btn-orange {
            --bs-btn-color: #fff;
            --bs-btn-bg: var(--galaxy-orange);
            --bs-btn-border-color: var(--galaxy-orange);
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: var(--galaxy-orange-dark);
            --bs-btn-hover-border-color: var(--galaxy-orange-dark);
            --bs-btn-focus-shadow-rgb: 245, 130, 32;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: var(--galaxy-orange-dark);
            --bs-btn-active-border-color: var(--galaxy-orange-dark);
        }
        .btn-outline-orange {
            --bs-btn-color: var(--galaxy-orange-dark);
            --bs-btn-border-color: var(--galaxy-orange);
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: var(--galaxy-orange);
            --bs-btn-hover-border-color: var(--galaxy-orange);
        }
        .navbar-brand img { width: 76px; height: 58px; object-fit: contain; }
        .hero {
            background:
                radial-gradient(circle at 85% 18%, rgba(245,130,32,.15), transparent 27%),
                linear-gradient(135deg, #fffaf5 0%, #fff 58%, #fff1e3 100%);
        }
        .hero-logo {
            width: min(100%, 420px);
            max-height: 340px;
            object-fit: contain;
            filter: drop-shadow(0 16px 24px rgba(80, 48, 20, .10));
        }
        .eyebrow {
            color: var(--galaxy-orange-dark);
            letter-spacing: .12em;
            font-size: .76rem;
            font-weight: 800;
            text-transform: uppercase;
        }
        .section-title { letter-spacing: -.035em; }
        .feature-icon {
            width: 54px; height: 54px;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 16px;
            color: var(--galaxy-orange-dark);
            background: var(--galaxy-orange-soft);
            font-size: 1.45rem;
            flex-shrink: 0;
        }
        .soft-card {
            border: 1px solid rgba(245,130,32,.12);
            border-radius: 1.25rem;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .soft-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 2rem rgba(80, 48, 20, .09) !important;
        }
        .product-image { object-fit: cover; }
        .cta-panel {
            background: linear-gradient(115deg, #f58220, #e66f17);
            border-radius: 1.5rem;
        }
        footer a:hover { color: #fff !important; }
        section[id] { scroll-margin-top: 88px; }
    </style>
</head>

<body class="bg-white">
    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg bg-white sticky-top border-bottom shadow-sm">
        <div class="container py-2">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('landing') }}" aria-label="Galaxy Petshop - Beranda">
                <img src="{{ asset('images/logopet.png') }}" alt="Logo Galaxy Petshop">
                <span class="fw-bold lh-sm">
                    <span class="d-block text-orange fs-5">GALAXY</span>
                    <small class="d-block text-dark" style="font-size:.7rem; letter-spacing:.08em;">PETSHOP</small>
                </span>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarGalaxy" aria-controls="navbarGalaxy"
                    aria-expanded="false" aria-label="Buka navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarGalaxy">
                <ul class="navbar-nav mx-auto my-3 my-lg-0 gap-lg-3">
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#home">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#produk">Produk</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#layanan">Grooming</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#tentang">Tentang Kami</a></li>
                </ul>

                <div class="d-grid d-lg-flex gap-2">
                    @auth
                        @if(auth()->user()->role === 'customer')
                            <a href="{{ route('customer.products') }}" class="btn btn-orange px-4">
                                <i class="bi bi-bag me-1"></i>Belanja
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-orange px-4">Login</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-orange px-4">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-orange px-4">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{-- HERO --}}
        <section id="home" class="hero overflow-hidden">
            <div class="container py-5">
                <div class="row align-items-center g-5 py-lg-4">
                    <div class="col-lg-6">
                        <span class="badge rounded-pill bg-white text-orange border border-warning-subtle px-3 py-2 mb-4">
                            <i class="bi bi-stars me-1"></i> Sahabat terbaik hewan kesayangan
                        </span>
                        <h1 class="display-3 fw-bold lh-sm mb-4">
                            Semua kebutuhan si manis, <span class="text-orange">ada di Galaxy.</span>
                        </h1>
                        <p class="fs-5 text-secondary mb-4">
                            Temukan kebutuhan hewan kesayangan mulai dari makanan, perlengkapan,
                            hingga layanan grooming dalam satu tempat.
                        </p>
                        <div class="d-flex flex-column flex-sm-row gap-3">
                            <a href="#produk" class="btn btn-orange btn-lg px-4">
                                Jelajahi Produk <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                            <a href="#layanan" class="btn btn-outline-orange btn-lg px-4">Lihat Layanan</a>
                        </div>
                        <div class="d-flex flex-wrap gap-3 gap-md-4 mt-5 text-secondary small">
                            <span><i class="bi bi-check-circle-fill text-orange me-1"></i> Produk pilihan</span>
                            <span><i class="bi bi-check-circle-fill text-orange me-1"></i> Grooming nyaman</span>
                            <span><i class="bi bi-check-circle-fill text-orange me-1"></i> Pelayanan ramah</span>
                        </div>
                    </div>

                   
<div class="col-lg-6 text-center">

    <div class="row g-3 justify-content-center text-start">

        <!-- CARD 1: PET SHOP -->
        <div class="col-8">
            <div class="bg-orange text-white rounded-4 p-3 shadow-sm h-100">
                <span class="feature-icon mb-3">
                    <i class="bi bi-bag-heart"></i>
                </span>
                <h2 class="h6 fw-bold mb-1">Pet Shop</h2>
                <p class="small text-white mb-0">
                    Kebutuhan harian hewan kesayangan.
                </p>
            </div>
        </div>

        <!-- CARD 2: GROOMING -->
        <div class="col-8">
            <div class="bg-orange text-white rounded-4 p-3 h-100 shadow-sm">
                <span class="d-inline-flex align-items-center justify-content-center rounded-3 bg-white text-orange p-3 mb-3">
                    <i class="bi bi-scissors fs-4"></i>
                </span>
                <h2 class="h6 fw-bold mb-3">Grooming</h2>
                <p class="small text-white-50 mb-0">
                    Perawatan agar tetap bersih dan nyaman.
                </p>
            </div>
        </div>

    </div>
</div>

                            

                  
                </div>
            </div>
        </section>

        {{-- KEUNGGULAN --}}
        <section class="py-4 border-bottom">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-3">
                            <span class="feature-icon"><i class="bi bi-box-seam"></i></span>
                            <div><div class="fw-bold">Kebutuhan lebih lengkap</div><div class="small text-secondary">Cari produk dalam satu tempat</div></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-3">
                            <span class="feature-icon"><i class="bi bi-heart"></i></span>
                            <div><div class="fw-bold">Perawatan penuh perhatian</div><div class="small text-secondary">Kenyamanan hewan jadi prioritas</div></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-3">
                            <span class="feature-icon"><i class="bi bi-calendar-check"></i></span>
                            <div><div class="fw-bold">Booking praktis</div><div class="small text-secondary">Atur jadwal layanan dengan mudah</div></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- PRODUK --}}
        <section id="produk" class="py-5">
            <div class="container py-lg-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4 mb-lg-5">
                    <div>
                        <span class="eyebrow">Pilihan untuk sahabat berbulu</span>
                        <h2 class="display-6 fw-bold section-title mt-2 mb-2">Produk favorit</h2>
                        <p class="text-secondary mb-0">Berbagai kebutuhan untuk menemani hari-hari hewan kesayangan.</p>
                    </div>
                    @auth
                        @if(auth()->user()->role === 'customer')
                            <a href="{{ route('customer.products') }}" class="btn btn-outline-orange flex-shrink-0">
                                Lihat Semua Produk <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-orange flex-shrink-0">
                            Lihat Semua Produk <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    @endauth
                </div>

                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 g-md-4 align-items-stretch">
                    @forelse($products as $product)
                        <div class="col">
                            <article class="card soft-card h-100 shadow-sm overflow-hidden d-flex flex-column">
                                <div class="ratio ratio-4x3 bg-orange-soft">
                                    @if($product->gambar)
                                        <img src="{{ asset('storage/' . $product->gambar) }}"
                                             alt="{{ $product->nama_product }}"
                                             class="w-100 h-100 product-image" loading="lazy">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center text-orange">
                                            <i class="bi bi-box-seam display-4"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body p-3 p-md-4 d-flex flex-column flex-grow-1">
                                    <span class="small text-orange fw-bold text-uppercase mb-2">
                                        {{ $product->category->nama_category ?? 'Produk' }}
                                    </span>
                                    <h3 class="h6 fw-bold mb-3">{{ $product->nama_product }}</h3>
                                    <div class="mt-auto">
                                        <div class="fw-bold text-orange text-nowrap">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                                        <div class="small text-secondary mt-1">Stok {{ $product->stok }}</div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center bg-orange-soft rounded-4 py-5 px-3">
                                <i class="bi bi-box-seam display-4 text-orange"></i>
                                <p class="text-secondary mt-3 mb-0">Belum ada produk yang tersedia.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- GROOMING --}}
        <section id="layanan" class="bg-orange-soft py-5">
            <div class="container py-lg-4">
                <div class="row align-items-end g-3 mb-4 mb-lg-5">
                    <div class="col-lg-7">
                        <span class="eyebrow">Waktunya dimanjakan</span>
                        <h2 class="display-6 fw-bold section-title mt-2 mb-2">Grooming penuh perhatian.</h2>
                    </div>
                    <div class="col-lg-5">
                        <p class="text-secondary mb-0">Pilih layanan perawatan untuk membantu menjaga kebersihan dan kenyamanan hewan kesayangan.</p>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 g-md-4 align-items-stretch">
                    @forelse($services as $service)
                        <div class="col">
                            <article class="card soft-card h-100 shadow-sm overflow-hidden">

                                {{-- FOTO GROOMING --}}
                                <div class="ratio ratio-16x9 bg-white">
                                    @if(!empty($service->foto))
                                        <img
                                            src="{{ asset('storage/' . $service->foto) }}"
                                            alt="Foto {{ $service->nama_service }}"
                                            class="w-100 h-100"
                                            style="object-fit: cover;"
                                            loading="lazy"
                                        >
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-orange-soft text-orange">
                                            <i class="bi bi-scissors display-3"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="card-body p-4 d-flex flex-column h-100">
                                    <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
                                        <span class="feature-icon"><i class="bi bi-scissors"></i></span>
                                        <span class="badge rounded-pill bg-light text-secondary border px-3 py-2">
                                            <i class="bi bi-clock me-1"></i>{{ $service->durasi }} menit
                                        </span>
                                    </div>

                                    <h3 class="h5 fw-bold mb-3">{{ $service->nama_service }}</h3>

                                    <p class="text-secondary mb-4 flex-grow-1">
                                        {{ $service->deskripsi ?: 'Layanan perawatan hewan untuk menjaga kebersihan dan kenyamanan hewan kesayangan.' }}
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center gap-2 border-top pt-3 mt-auto">
                                        <span class="small text-secondary">Mulai dari</span>
                                        <span class="fw-bold text-orange text-nowrap">
                                            Rp {{ number_format($service->harga, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center bg-white rounded-4 py-5 px-3">
                                <i class="bi bi-scissors display-4 text-orange"></i>
                                <p class="text-secondary mt-3 mb-0">Belum ada layanan grooming.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="text-center mt-4 mt-lg-5">
                    <a href="{{ route('login') }}" class="btn btn-orange btn-lg px-4">
                        <i class="bi bi-calendar-check me-2"></i>Booking Grooming
                    </a>
                </div>
            </div>
        </section>

        {{-- TENTANG --}}
        <section id="tentang" class="py-5">
            <div class="container py-lg-4">
                <div class="row align-items-center g-4 g-lg-5">
                    <div class="col-lg-5">
                        <span class="eyebrow">Kenalan dengan kami</span>
                        <h2 class="display-6 fw-bold section-title mt-2 mb-3">Lebih dari sekadar pet shop.</h2>
                        <p class="text-secondary mb-4">
                            Galaxy Petshop hadir untuk membantu memenuhi kebutuhan hewan kesayangan,
                            mulai dari produk pilihan hingga layanan grooming.
                        </p>
                        <a href="{{ route('register') }}" class="btn btn-orange px-4">
                            Bergabung Sekarang <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="col-lg-7">
                        <div class="row row-cols-1 row-cols-sm-2 g-4">
                            <div class="col">
                                <div class="h-100 border-start border-3 border-warning ps-3">
                                    <i class="bi bi-box-seam fs-3 text-orange mb-3 d-inline-block"></i>
                                    <h3 class="h6 fw-bold">Produk pilihan</h3>
                                    <p class="text-secondary small mb-0">Kebutuhan hewan tersedia dalam satu tempat.</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="h-100 border-start border-3 border-warning ps-3">
                                    <i class="bi bi-calendar2-check fs-3 text-orange mb-3 d-inline-block"></i>
                                    <h3 class="h6 fw-bold">Booking praktis</h3>
                                    <p class="text-secondary small mb-0">Atur jadwal grooming dengan lebih mudah.</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="h-100 border-start border-3 border-warning ps-3">
                                    <i class="bi bi-heart-pulse fs-3 text-orange mb-3 d-inline-block"></i>
                                    <h3 class="h6 fw-bold">Peduli hewan</h3>
                                    <p class="text-secondary small mb-0">Mengutamakan kenyamanan hewan kesayangan.</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="h-100 border-start border-3 border-warning ps-3">
                                    <i class="bi bi-receipt fs-3 text-orange mb-3 d-inline-block"></i>
                                    <h3 class="h6 fw-bold">Informasi terarah</h3>
                                    <p class="text-secondary small mb-0">Informasi produk dan layanan lebih mudah ditemukan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- CTA --}}
        <section class="pb-5">
            <div class="container">
                <div class="cta-panel text-white p-4 p-md-5 shadow-sm">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <span class="badge bg-white text-orange rounded-pill px-3 py-2 mb-3">Yuk, mulai sekarang!</span>
                            <h2 class="display-6 fw-bold mb-3">Berikan yang terbaik untuk sahabat kesayangan.</h2>
                            <p class="text-white-50 mb-0">Jelajahi produk dan layanan Galaxy Petshop untuk menemani perawatan hewan kesayangan Anda.</p>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg text-orange fw-bold px-4">
                                <i class="bi bi-person-plus me-2"></i>Buat Akun
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- FOOTER --}}
    <footer class="bg-dark text-white-50 py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <a href="{{ route('landing') }}" class="text-white text-decoration-none fw-bold fs-4 d-inline-flex align-items-center gap-2">
                        <img src="{{ asset('images/logopet.png') }}" alt="" width="58" height="44" style="object-fit:contain;">
                        <span>GALAXY <span class="text-orange">PETSHOP</span></span>
                    </a>
                    <p class="small mt-3 mb-0">Tempat memenuhi kebutuhan dan perawatan hewan kesayangan Anda.</p>
                </div>
                <div class="col-6 col-lg-3">
                    <h3 class="h6 text-white fw-bold mb-3">Navigasi</h3>
                    <ul class="list-unstyled d-grid gap-2 small mb-0">
                        <li><a href="#home" class="link-light link-opacity-75 text-decoration-none">Beranda</a></li>
                        <li><a href="#produk" class="link-light link-opacity-75 text-decoration-none">Produk</a></li>
                        <li><a href="#layanan" class="link-light link-opacity-75 text-decoration-none">Grooming</a></li>
                        <li><a href="#tentang" class="link-light link-opacity-75 text-decoration-none">Tentang Kami</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-4">
                    <h3 class="h6 text-white fw-bold mb-3">Akun</h3>
                    <ul class="list-unstyled d-grid gap-2 small mb-0">
                        <li><a href="{{ route('login') }}" class="link-light link-opacity-75 text-decoration-none">Login</a></li>
                        <li><a href="{{ route('register') }}" class="link-light link-opacity-75 text-decoration-none">Daftar</a></li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <div class="d-flex flex-column flex-sm-row justify-content-between gap-2 small">
                <span>© {{ date('Y') }} Kelompok 8 XII PPLG 2.</span>
                <span>Pet Shop &amp; Grooming</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
