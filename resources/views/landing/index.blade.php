<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0d6efd">
    <title>PetCare - Pet Shop & Grooming</title>

    {{-- Bootstrap 5.3.3 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-white text-dark">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg bg-white sticky-top border-bottom shadow-sm">
        <div class="container py-2">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-4 text-primary" href="{{ route('landing') }}">
                <span class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-3 p-2">
                    <i class="bi bi-heart-pulse-fill"></i>
                </span>
                PetCare
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarPetCare" aria-controls="navbarPetCare"
                    aria-expanded="false" aria-label="Buka navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarPetCare">
                <ul class="navbar-nav mx-auto my-3 my-lg-0 gap-lg-3">
                    <li class="nav-item"><a class="nav-link fw-medium" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium" href="#produk">Produk</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium" href="#layanan">Grooming</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium" href="#tentang">Tentang</a></li>
                </ul>

                <div class="d-grid d-lg-flex gap-2">
                    @auth
                        @if(auth()->user()->role === 'customer')
                            <a href="{{ route('customer.products') }}" class="btn btn-primary px-4">
                                <i class="bi bi-bag me-1"></i>Belanja
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary px-4">Login</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary px-4">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary px-4">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{-- HERO --}}
        <section id="home" class="bg-primary-subtle overflow-hidden">
            <div class="container py-5">
                <div class="row align-items-center g-5 py-lg-4">
                    <div class="col-lg-6">
                        <span class="badge rounded-pill bg-white text-primary border border-primary-subtle px-3 py-2 mb-4">
                            <i class="bi bi-stars me-1"></i> Teman terbaik untuk perawatan hewan
                        </span>

                        <h1 class="display-3 fw-bold lh-sm mb-4">
                            Semua kebutuhan si kecil, <span class="text-primary">lebih mudah.</span>
                        </h1>

                        <p class="fs-5 text-secondary mb-4">
                            Dari makanan favorit sampai jadwal grooming, temukan kebutuhan hewan kesayanganmu dalam satu tempat.
                        </p>

                        <div class="d-flex flex-column flex-sm-row gap-3">
                            <a href="#produk" class="btn btn-primary btn-lg px-4">
                                Mulai Jelajahi <i class="bi bi-arrow-up-right ms-2"></i>
                            </a>
                            <a href="#layanan" class="btn btn-outline-primary btn-lg px-4">
                                Lihat Grooming
                            </a>
                        </div>

                        <div class="d-flex flex-wrap align-items-center gap-3 gap-md-4 mt-5 text-secondary small">
                            <span><i class="bi bi-check-circle-fill text-primary me-1"></i> Produk pilihan</span>
                            <span><i class="bi bi-check-circle-fill text-primary me-1"></i> Booking praktis</span>
                            <span><i class="bi bi-check-circle-fill text-primary me-1"></i> Data hewan rapi</span>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row g-3 align-items-stretch">
                            <div class="col-7">
                                <div class="bg-white rounded-4 shadow-sm p-3 p-md-4 h-100 d-flex flex-column">
                                    <div class="ratio ratio-4x3 rounded-4 bg-primary-subtle overflow-hidden">
                                        <div class="d-flex align-items-center justify-content-center text-primary">
                                            <i class="bi bi-heart-pulse-fill" style="font-size: 7rem;"></i>
                                        </div>
                                    </div>
                                    <div class="pt-3 mt-auto">
                                        <span class="small text-primary fw-semibold">PETCARE DAILY</span>
                                        <h2 class="h5 fw-bold mb-1">Sayangi mereka setiap hari.</h2>
                                        <p class="small text-secondary mb-0">Perhatian kecil, berarti besar.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5 d-flex flex-column gap-3">
                                <div class="bg-white rounded-4 shadow-sm p-3 p-md-4 flex-fill">
                                    <span class="d-inline-flex bg-primary-subtle text-primary rounded-3 p-3 mb-3">
                                        <i class="bi bi-bag-heart fs-3"></i>
                                    </span>
                                    <h3 class="h6 fw-bold mb-1">Pet Shop</h3>
                                    <p class="small text-secondary mb-0">Kebutuhan hariannya.</p>
                                </div>
                                <div class="bg-primary text-white rounded-4 p-3 p-md-4 flex-fill">
                                    <i class="bi bi-scissors fs-2 mb-3 d-inline-block"></i>
                                    <h3 class="h6 fw-bold mb-1">Grooming</h3>
                                    <p class="small text-white-50 mb-0">Biar tetap bersih dan nyaman.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- HIGHLIGHTS --}}
        <section class="py-4 border-bottom">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-3">
                            <span class="bg-primary-subtle text-primary rounded-3 p-3">
                                <i class="bi bi-box-seam fs-4"></i>
                            </span>
                            <div>
                                <div class="fw-semibold">Kebutuhan dalam satu tempat</div>
                                <div class="small text-secondary">Cari produk tanpa ribet</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-3">
                            <span class="bg-primary-subtle text-primary rounded-3 p-3">
                                <i class="bi bi-scissors fs-4"></i>
                            </span>
                            <div>
                                <div class="fw-semibold">Perawatan lebih praktis</div>
                                <div class="small text-secondary">Lihat pilihan layanan grooming</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-3">
                            <span class="bg-primary-subtle text-primary rounded-3 p-3">
                                <i class="bi bi-calendar-check fs-4"></i>
                            </span>
                            <div>
                                <div class="fw-semibold">Booking lebih mudah</div>
                                <div class="small text-secondary">Atur jadwal secara online</div>
                            </div>
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
                        <span class="text-primary fw-semibold small text-uppercase">Temukan favorit mereka</span>
                        <h2 class="display-6 fw-bold mt-2 mb-2">Pilihan produk</h2>
                        <p class="text-secondary mb-0">Berbagai kebutuhan untuk menemani hari-hari hewan kesayangan.</p>
                    </div>

                    @auth
                        @if(auth()->user()->role === 'customer')
                            <a href="{{ route('customer.products') }}" class="btn btn-outline-primary flex-shrink-0">
                                Lihat Semua Produk <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary flex-shrink-0">
                            Lihat Semua Produk <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    @endauth
                </div>

                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 g-md-4 align-items-stretch">
                    @forelse($products as $product)
                        <div class="col">
                            <article class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden d-flex flex-column">
                                <div class="ratio ratio-4x3 bg-body-tertiary">
                                    @if($product->gambar)
                                        <img src="{{ asset('storage/' . $product->gambar) }}"
                                             alt="{{ $product->nama_product }}"
                                             class="w-100 h-100 object-fit-cover"
                                             loading="lazy">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center text-primary">
                                            <i class="bi bi-box-seam display-4"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="card-body p-3 p-md-4 d-flex flex-column flex-grow-1">
                                    <span class="small text-primary fw-semibold text-uppercase mb-2">
                                        {{ $product->category->nama_category ?? 'Produk' }}
                                    </span>
                                    <h3 class="h6 fw-semibold mb-3">{{ $product->nama_product }}</h3>

                                    <div class="mt-auto">
                                        <div class="fw-bold text-primary text-nowrap">
                                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                                        </div>
                                        <div class="small text-secondary mt-1">
                                            Stok {{ $product->stok }}
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center bg-body-tertiary rounded-4 py-5 px-3">
                                <i class="bi bi-box-seam display-4 text-secondary"></i>
                                <p class="text-secondary mt-3 mb-0">Belum ada produk yang tersedia.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- GROOMING --}}
        <section id="layanan" class="bg-body-tertiary py-5">
            <div class="container py-lg-4">
                <div class="row align-items-end g-3 mb-4 mb-lg-5">
                    <div class="col-lg-7">
                        <span class="text-primary fw-semibold small text-uppercase">Waktunya dimanjakan</span>
                        <h2 class="display-6 fw-bold mt-2 mb-2">Grooming yang mereka butuhkan.</h2>
                    </div>
                    <div class="col-lg-5">
                        <p class="text-secondary mb-0">
                            Pilih layanan perawatan untuk membantu menjaga kebersihan dan kenyamanan hewan kesayangan.
                        </p>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 g-md-4 align-items-stretch">
                    @forelse($services as $service)
                        <div class="col">
                            <article class="card h-100 border-0 shadow-sm rounded-4">
                                <div class="card-body p-4 d-flex flex-column h-100">
                                    <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
                                        <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex p-3">
                                            <i class="bi bi-scissors fs-4"></i>
                                        </span>
                                        <span class="badge rounded-pill bg-light text-secondary border px-3 py-2">
                                            <i class="bi bi-clock me-1"></i>{{ $service->durasi }} menit
                                        </span>
                                    </div>

                                    <h3 class="h5 fw-bold mb-3">{{ $service->nama_service }}</h3>
                                    <p class="text-secondary mb-4 flex-grow-1">
                                        {{ $service->deskripsi ?: 'Layanan perawatan hewan dari PetCare untuk menjaga kebersihan dan kenyamanan hewan kesayangan.' }}
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center gap-2 border-top pt-3 mt-auto">
                                        <span class="small text-secondary">Mulai dari</span>
                                        <span class="fw-bold text-primary text-nowrap">
                                            Rp {{ number_format($service->harga, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center bg-white rounded-4 py-5 px-3">
                                <i class="bi bi-scissors display-4 text-secondary"></i>
                                <p class="text-secondary mt-3 mb-0">Belum ada layanan grooming.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="text-center mt-4 mt-lg-5">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4">
                        <i class="bi bi-calendar-check me-2"></i>Booking Grooming
                    </a>
                </div>
            </div>
        </section>

        {{-- TENTANG PETCARE --}}
        <section id="tentang" class="py-5">
            <div class="container py-lg-4">
                <div class="row align-items-center g-4 g-lg-5">
                    <div class="col-lg-5">
                        <span class="text-primary fw-semibold small text-uppercase">Kenalan dengan PetCare</span>
                        <h2 class="display-6 fw-bold mt-2 mb-3">Lebih dari sekadar pet shop.</h2>
                        <p class="text-secondary mb-4 flex-grow-1">
                            PetCare dirancang untuk memudahkan customer mengelola kebutuhan hewan kesayangan,
                            mulai dari data hewan, produk, grooming, hingga riwayat transaksi.
                        </p>
                        <a href="{{ route('register') }}" class="btn btn-primary px-4">
                            Gabung dengan PetCare <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>

                    <div class="col-lg-7">
                        <div class="row row-cols-1 row-cols-sm-2 g-4">
                            <div class="col">
                                <div class="h-100 border-start border-3 border-primary ps-3">
                                    <i class="bi bi-box-seam fs-3 text-primary mb-3 d-inline-block"></i>
                                    <h3 class="h6 fw-bold">Produk mudah ditemukan</h3>
                                    <p class="text-secondary small mb-0">Berbagai kebutuhan hewan tersedia dalam satu platform.</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="h-100 border-start border-3 border-primary ps-3">
                                    <i class="bi bi-calendar2-check fs-3 text-primary mb-3 d-inline-block"></i>
                                    <h3 class="h6 fw-bold">Booking lebih praktis</h3>
                                    <p class="text-secondary small mb-0">Atur jadwal grooming melalui proses yang mudah.</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="h-100 border-start border-3 border-primary ps-3">
                                    <i class="bi bi-heart-pulse fs-3 text-primary mb-3 d-inline-block"></i>
                                    <h3 class="h6 fw-bold">Data hewan terorganisir</h3>
                                    <p class="text-secondary small mb-0">Simpan informasi hewan kesayangan dengan lebih teratur.</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="h-100 border-start border-3 border-primary ps-3">
                                    <i class="bi bi-receipt fs-3 text-primary mb-3 d-inline-block"></i>
                                    <h3 class="h6 fw-bold">Riwayat transaksi</h3>
                                    <p class="text-secondary small mb-0">Pantau pembelian dan aktivitas layanan melalui akun Anda.</p>
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
                <div class="bg-primary text-white rounded-4 p-4 p-md-5">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <span class="badge bg-white text-primary rounded-pill px-3 py-2 mb-3">Saatnya mulai</span>
                            <h2 class="display-6 fw-bold mb-3">Perawatan mereka, sekarang lebih gampang.</h2>
                            <p class="text-white-50 mb-0">
                                Buat akun PetCare dan nikmati kemudahan mengelola produk, hewan, grooming,
                                dan transaksi dalam satu platform.
                            </p>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg text-primary fw-semibold px-4">
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
                    <a href="{{ route('landing') }}" class="text-white text-decoration-none fw-bold fs-4">
                        <i class="bi bi-heart-pulse-fill text-primary me-2"></i>PetCare
                    </a>
                    <p class="small mt-3 mb-0">
                        Sistem informasi manajemen pet shop dan grooming untuk membantu perawatan
                        hewan kesayangan menjadi lebih mudah.
                    </p>
                </div>

                <div class="col-6 col-lg-3">
                    <h3 class="h6 text-white fw-semibold mb-3">Navigasi</h3>
                    <ul class="list-unstyled d-grid gap-2 small mb-0">
                        <li><a href="#home" class="link-light link-opacity-75 link-opacity-100-hover text-decoration-none">Home</a></li>
                        <li><a href="#produk" class="link-light link-opacity-75 link-opacity-100-hover text-decoration-none">Produk</a></li>
                        <li><a href="#layanan" class="link-light link-opacity-75 link-opacity-100-hover text-decoration-none">Grooming</a></li>
                        <li><a href="#tentang" class="link-light link-opacity-75 link-opacity-100-hover text-decoration-none">Tentang</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-4">
                    <h3 class="h6 text-white fw-semibold mb-3">Akun</h3>
                    <ul class="list-unstyled d-grid gap-2 small mb-0">
                        <li><a href="{{ route('login') }}" class="link-light link-opacity-75 link-opacity-100-hover text-decoration-none">Login</a></li>
                        <li><a href="{{ route('register') }}" class="link-light link-opacity-75 link-opacity-100-hover text-decoration-none">Register</a></li>
                    </ul>
                </div>
            </div>

            <hr class="border-secondary my-4">

            <div class="d-flex flex-column flex-sm-row justify-content-between gap-2 small">
                <span>© {{ date('Y') }} PetCare</span>
                <span>Pet Shop &amp; Grooming</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
