@extends("layouts.app")

@section("title", "Beranda - Paskibra Ganesha")

@section("hero")
<style>
    /* Prevent Horizontal Scroll */
    body {
        overflow-x: hidden;
    }

    /* Modern UI Enhancements */
    .glass-card {
        background: rgba(209, 0, 0, 0.85);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        border-radius: 1.25rem !important;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }
    .glass-card:hover {
        transform: translateY(20%) scale(1.02) !important;
        box-shadow: 0 25px 50px rgba(0,0,0,0.3);
    }
    .hero-title {
        font-size: clamp(2.5rem, 6vw, 6.5rem);
        line-height: 1.1;
        font-family: 'Arial Black', Impact, sans-serif;
        letter-spacing: 2px;
        background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0px 10px 20px rgba(0,0,0,0.3);
    }
    .hero-subtitle {
        font-size: clamp(1.2rem, 3vw, 2.5rem);
        letter-spacing: 3px;
        text-shadow: 0 5px 15px rgba(0,0,0,0.4);
    }
    .doc-card {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        border-radius: 1rem;
        padding: 1.5rem 1rem;
    }
    .doc-card:hover {
        background-color: #fff;
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(220, 53, 69, 0.1);
    }
    .doc-icon-wrapper {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #fff5f5, #ffe0e0);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem auto;
        transition: transform 0.3s ease;
        box-shadow: 0 8px 16px rgba(220,53,69,0.1);
    }
    .doc-card:hover .doc-icon-wrapper {
        transform: scale(1.1) rotate(5deg);
        background: linear-gradient(135deg, #ffe0e0, #ffc7c7);
    }
    .doc-line {
        width: 40%;
        height: 3px;
        background-color: #dc3545;
        margin: 15px auto;
        border-radius: 2px;
        transition: width 0.3s ease;
    }
    .doc-card:hover .doc-line {
        width: 70%;
    }
    .sejarah-card {
        border: none !important;
        border-radius: 1.2rem !important;
        box-shadow: 0 15px 35px rgba(0,0,0,0.06);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }
    .sejarah-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 45px rgba(209, 0, 0, 0.1);
    }
    .sejarah-img-wrapper {
        border: none !important;
        border-radius: 1.2rem !important;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        transition: transform 0.5s ease;
    }
    .sejarah-img-wrapper:hover {
        transform: scale(1.03);
    }
    .step-card {
        border-radius: 1.2rem !important;
        border: 1px solid rgba(0,0,0,0.03) !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04) !important;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background: #ffffff;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    .step-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(135deg, rgba(209,0,0,0.02) 0%, rgba(255,255,255,0) 100%);
        z-index: -1;
        opacity: 0;
        transition: opacity 0.4s ease;
    }
    .step-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(209, 0, 0, 0.12) !important;
        border-color: rgba(209, 0, 0, 0.1) !important;
    }
    .step-card:hover::before {
        opacity: 1;
    }
    .step-icon-bg {
        background: linear-gradient(135deg, #ffeeee, #ffc7c7);
        border-radius: 0.8rem;
        transition: transform 0.3s ease, background 0.3s ease;
    }
    .step-card:hover .step-icon-bg {
        transform: scale(1.1) rotate(-5deg);
        background: linear-gradient(135deg, #d10000, #ff4d4d);
    }
    .step-card:hover .step-icon-bg i {
        color: #ffffff !important;
    }
    .step-number {
        transition: color 0.3s ease;
    }
    .step-card:hover .step-number {
        color: rgba(209, 0, 0, 0.3) !important;
    }
</style>

<!-- Hero Section -->
<section style="position: relative; min-height: 85vh; background-image: url('/images/fotoawal.png'); background-size: cover; background-position: center; background-attachment: fixed; display: flex; align-items: center; justify-content: center; padding-top: 4rem;">
    <!-- Modern Gradient Overlay -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.8) 100%); z-index: 1;"></div>
    
    <div class="position-relative w-100 px-3" style="z-index:2;">
        <div class="row align-items-center justify-content-center mb-5 mt-5 text-center">
            <div class="col-12" style="animation: fadeInDown 1s ease-out;">
                <h5 class="fw-bold mb-4 text-white" style="letter-spacing: 2px; text-transform: uppercase; font-size: 0.95rem; opacity: 0.9;">Sistem Informasi Seleksi Penerimaan Anggota</h5>
                <h1 class="hero-title mb-3">PASKIBRA GANESHA</h1>
                <h4 class="fw-bold text-white mt-2 hero-subtitle">SMA NEGERI 1 PONTIANAK</h4>
            </div>
        </div>
        
        <!-- Floating Card -->
        <div class="row justify-content-center mt-4">
            <div class="col-xl-9 col-lg-10">
                <div class="card glass-card text-center" style="transform: translateY(25%);">
                    <div class="card-body p-4 p-md-5">
                        <div class="d-inline-block mb-4">
                            <h4 class="fw-bold mb-3" style="letter-spacing: 1px; font-size: 1.4rem; color: white;">SELAMAT DATANG</h4>
                            <div style="height: 3px; background: linear-gradient(90deg, transparent, #ffffff, transparent); width: 100%; border-radius: 2px;"></div>
                        </div>
                        <p class="mb-0 text-white" style="font-size: 1.15rem; line-height: 1.8; font-weight: 300; opacity: 0.95;">
                            Website Paskibra Ganesha SMA Negeri 1 Pontianak hadir sebagai media informasi serta sistem informasi seleksi penerimaan anggota yang bertujuan untuk memudahkan calon anggota dalam memperoleh informasi, melakukan pendaftaran, dan mengikuti proses seleksi secara lebih efektif dan terstruktur.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section("content")
<!-- Adjust top margin because of floating card -->
<div style="margin-top: 6rem;"></div>

<!-- Document Download Section -->
<section class="py-4 mb-2">
     <!-- Garis Merah -->
    <div class="container mb-5">
        <hr style=" border: 0; border-top: 3px solid #dc3545; opacity: 0.15; width: 80%; margin: 0 auto; border-radius: 2px;">
    </div>
    <div class="row justify-content-center text-center g-4">
        <!-- Doc 1 -->
        <div class="col-6 col-md-3">
            <div class="doc-card d-flex flex-column align-items-center h-100">
                <div class="doc-icon-wrapper">
                    <i class="far fa-file-pdf" style="font-size: 2.2rem; color: #dc3545;"></i>
                </div>
                <h6 class="fw-bold text-dark mt-2" style="font-size: 1rem; min-height: 45px; display: flex; align-items: center;">Surat Izin Orang Tua</h6>
                <div class="doc-line"></div>
                <a href="#" class="text-decoration-none fw-bold text-primary" style="font-size: 0.9rem; letter-spacing: 0.5px;">Download PDF <i class="fas fa-download ms-1 small"></i></a>
            </div>
        </div>
        <!-- Doc 2 -->
        <div class="col-6 col-md-3">
            <div class="doc-card d-flex flex-column align-items-center h-100">
                <div class="doc-icon-wrapper">
                    <i class="far fa-file-pdf" style="font-size: 2.2rem; color: #dc3545;"></i>
                </div>
                <h6 class="fw-bold text-dark mt-2" style="font-size: 1rem; min-height: 45px; display: flex; align-items: center; justify-content: center;">Perpang TNI<br>No. 57 & 58</h6>
                <div class="doc-line"></div>
                <a href="#" class="text-decoration-none fw-bold text-primary" style="font-size: 0.9rem; letter-spacing: 0.5px;">Download PDF <i class="fas fa-download ms-1 small"></i></a>
            </div>
        </div>
        <!-- Doc 3 -->
        <div class="col-6 col-md-3">
            <div class="doc-card d-flex flex-column align-items-center h-100">
                <div class="doc-icon-wrapper">
                    <i class="far fa-file-pdf" style="font-size: 2.2rem; color: #dc3545;"></i>
                </div>
                <h6 class="fw-bold text-dark mt-2" style="font-size: 1rem; min-height: 45px; display: flex; align-items: center; justify-content: center;">Buku Teks Utama<br>Pancasila Kelas X</h6>
                <div class="doc-line"></div>
                <a href="#" class="text-decoration-none fw-bold text-primary" style="font-size: 0.9rem; letter-spacing: 0.5px;">Download PDF <i class="fas fa-download ms-1 small"></i></a>
            </div>
        </div>
        <!-- Doc 4 -->
        <div class="col-6 col-md-3">
            <div class="doc-card d-flex flex-column align-items-center h-100">
                <div class="doc-icon-wrapper">
                    <i class="far fa-file-pdf" style="font-size: 2.2rem; color: #dc3545;"></i>
                </div>
                <h6 class="fw-bold text-dark mt-2" style="font-size: 1rem; min-height: 45px; display: flex; align-items: center;">Tabel Penilaian Fisik</h6>
                <div class="doc-line"></div>
                <a href="#" class="text-decoration-none fw-bold text-primary" style="font-size: 0.9rem; letter-spacing: 0.5px;">Download PDF <i class="fas fa-download ms-1 small"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Sejarah Section -->
<section class="mb-5 mt-2 position-relative" style="margin-left: calc(50% - 50vw); margin-right: calc(50% - 50vw); background: #ffffff; padding: 3.5rem 0; overflow: hidden; box-shadow: 0 -15px 40px rgba(0,0,0,0.02);">
    <!-- Decorative Elements -->
    <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(209,0,0,0.05) 0%, transparent 70%); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -50px; left: -50px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(209,0,0,0.03) 0%, transparent 70%); border-radius: 50%;"></div>

    <div class="container-fluid px-4 px-xl-5 position-relative z-1">
        <div class="mb-3 text-center text-md-start">
            <span class="d-inline-block text-white fw-bold px-4 py-2 mb-2 shadow-sm" style="background-color: #d10000; font-size: 1rem; letter-spacing: 2px; border-radius: 30px;">SEJARAH</span>
            <h2 class="fw-black mb-0 mt-2" style="color: #d10000; font-size: 2.5rem; font-weight: 900; letter-spacing: 0.5px; text-shadow: 2px 2px 4px rgba(0,0,0,0.05);">PASKIBRA SMA NEGERI 1 PONTIANAK</h2>
        </div>
        <div class="row align-items-stretch g-4">
            <div class="col-md-8 col-lg-9">
                <div class="h-100 p-4 p-md-5 bg-white d-flex flex-column sejarah-card">
                    <p style="font-size: 1.15rem; line-height: 1.9; text-align: justify; color: #444; margin-bottom: 2rem; font-weight: 300;">
                        Berawal dari keberhasilan Akhdan Wahyu, Dian Astiningsih, dan Nudi Wicaksono yang terpilih sebagai Paskibraka tingkat Provinsi dan Nasional pada tahun 1991-1992, muncul semangat untuk membentuk wadah pembinaan bagi generasi penerus di SMA Negeri 1 Pontianak. Berbekal pengalaman dan dedikasi mereka, <strong style="color: #000; font-weight: 600;">lahirlah Paskibra SMA Negeri 1 Pontianak</strong> sebagai organisasi yang berkomitmen membina karakter, kedisiplinan, jiwa kepemimpinan, serta semangat nasionalisme bagi para siswa.
                    </p>
                    <div class="mt-auto pt-2">
                        <a href="{{ route('sejarah') }}" class="text-decoration-none fw-bold d-inline-block" style="color: #d10000; font-size: 1.1rem; transition: transform 0.3s ease;" onmouseover="this.style.transform='translateX(5px)';" onmouseout="this.style.transform='translateX(0)';">
                            Lihat Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="h-100 bg-white p-2 sejarah-img-wrapper">
                    <img src="images/fotosejarah.png" alt="Paskibra SMA N 1 Pontianak" class="img-fluid w-100 h-100 object-fit-cover" style="border-radius: 1rem;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tahapan Penerimaan Anggota Section -->
<section class="py-2 mb-4 mt-2">
    <div class="text-center mb-4">
        <h6 class="fw-bold mb-2" style="color: #d10000; letter-spacing: 3px; font-size: 0.9rem;">PROSES SELEKSI</h6>
        <h2 class="fw-black text-dark mb-3" style="font-size: 2.5rem;">Tahapan Penerimaan Anggota</h2>
        <p class="text-muted mx-auto" style="max-width: 600px; font-size: 1.1rem;">Proses seleksi dilaksanakan secara transparan, profesional, dan terstruktur untuk menghasilkan kader terbaik.</p>
    </div>
    
    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 p-4 border-0 step-card">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <h3 class="fw-black mb-0 step-number" style="color: #e9ecef; font-size: 2.5rem; line-height: 1;">01</h3>
                    <div class="p-3 step-icon-bg">
                        <i class="far fa-file-alt" style="color: #d10000; font-size: 1.5rem;"></i>
                    </div>
                </div>
                <h5 class="fw-bold text-dark mb-3" style="font-size: 1.25rem;">Administrasi</h5>
                <p class="text-muted mb-0" style="line-height: 1.6;">Memverifikasi kelengkapan dan keabsahan berkas pendaftar sesuai dengan persyaratan yang telah ditentukan.</p>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 p-4 border-0 step-card">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <h3 class="fw-black mb-0 step-number" style="color: #e9ecef; font-size: 2.5rem; line-height: 1;">02</h3>
                    <div class="p-3 step-icon-bg">
                        <i class="fas fa-clipboard-list" style="color: #d10000; font-size: 1.5rem;"></i>
                    </div>
                </div>
                <h5 class="fw-bold text-dark mb-3" style="font-size: 1.25rem;">Kesehatan & Parade</h5>
                <p class="text-muted mb-0" style="line-height: 1.6;">Menilai kesehatan secara menyeluruh, postur tubuh ideal, dan penampilan kesamaptaan jasmani.</p>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 p-4 border-0 step-card">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <h3 class="fw-black mb-0 step-number" style="color: #e9ecef; font-size: 2.5rem; line-height: 1;">03</h3>
                    <div class="p-3 step-icon-bg">
                        <i class="fas fa-running" style="color: #d10000; font-size: 1.5rem;"></i>
                    </div>
                </div>
                <h5 class="fw-bold text-dark mb-3" style="font-size: 1.25rem;">Samapta</h5>
                <p class="text-muted mb-0" style="line-height: 1.6;">Mengukur kemampuan fisik dasar, daya tahan kardiovaskuler, kecepatan, dan kekuatan otot tubuh.</p>
            </div>
        </div>
        <!-- Card 4 -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 p-4 border-0 step-card">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <h3 class="fw-black mb-0 step-number" style="color: #e9ecef; font-size: 2.5rem; line-height: 1;">04</h3>
                    <div class="p-3 step-icon-bg">
                        <i class="fas fa-shoe-prints" style="color: #d10000; font-size: 1.5rem;"></i>
                    </div>
                </div>
                <h5 class="fw-bold text-dark mb-3" style="font-size: 1.25rem;">PBB</h5>
                <p class="text-muted mb-0" style="line-height: 1.6;">Menilai kemampuan dasar baris-berbaris, ketegasan, dan kebenaran gerakan sesuai Peraturan Panglima TNI.</p>
            </div>
        </div>
        <!-- Card 5 -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 p-4 border-0 step-card">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <h3 class="fw-black mb-0 step-number" style="color: #e9ecef; font-size: 2.5rem; line-height: 1;">05</h3>
                    <div class="p-3 step-icon-bg">
                        <i class="fas fa-users" style="color: #d10000; font-size: 1.5rem;"></i>
                    </div>
                </div>
                <h5 class="fw-bold text-dark mb-3" style="font-size: 1.25rem;">Kepribadian</h5>
                <p class="text-muted mb-0" style="line-height: 1.6;">Menilai wawasan kebangsaan, intelegensia umum, motivasi, karakter, kepemimpinan, dan komitmen.</p>
            </div>
        </div>
        <!-- Card 6 -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 p-4 border-0 step-card">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <h3 class="fw-black mb-0 step-number" style="color: #e9ecef; font-size: 2.5rem; line-height: 1;">06</h3>
                    <div class="p-3 step-icon-bg">
                        <i class="fas fa-award" style="color: #d10000; font-size: 1.5rem;"></i>
                    </div>
                </div>
                <h5 class="fw-bold text-dark mb-3" style="font-size: 1.25rem;">Hasil Akhir</h5>
                <p class="text-muted mb-0" style="line-height: 1.6;">Hasil seleksi secara kumulatif akan diumumkan secara transparan melalui akun masing-masing Calon Anggota.</p>
            </div>
        </div>
    </div>
</section>
@endsection
