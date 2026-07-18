@extends("layouts.app")

@section("title", "Beranda - Paskibra Ganesha")

@section("hero")


<!-- Hero Section -->
<section style="position: relative; min-height: 85vh; background-image: url('{{ isset($informasi['beranda_background']) ? asset($informasi['beranda_background']) : '/images/fotoawal.png' }}'); background-size: cover; background-position: center; background-attachment: fixed; display: flex; align-items: center; justify-content: center; padding-top: 4rem;">
    <!-- Modern Gradient Overlay -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.8) 100%); z-index: 1;"></div>
    
    <div class="position-relative w-100 px-3" style="z-index:2;">
        <div class="row align-items-center justify-content-center mb-5 mt-5 text-center">
            <div class="col-12" style="animation: fadeInDown 1s ease-out;">
                <h5 class="fw-bold mb-4 text-white" style="letter-spacing: 2px; text-transform: uppercase; font-size: 0.95rem; opacity: 0.9;">Sistem Informasi Seleksi Penerimaan Anggota</h5>
                <h1 class="hero-title mb-3">{{ $informasi['beranda_judul'] ?? 'PASKIBRA GANESHA' }}</h1>
                <h4 class="fw-bold text-white mt-2 hero-subtitle">{{ $informasi['beranda_subjudul'] ?? 'SMA NEGERI 1 PONTIANAK' }}</h4>
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
                            {{ $informasi['beranda_deskripsi'] ?? 'Website Paskibra Ganesha SMA Negeri 1 Pontianak hadir sebagai media informasi serta sistem informasi seleksi penerimaan anggota yang bertujuan untuk memudahkan calon anggota dalam memperoleh informasi, melakukan pendaftaran, dan mengikuti proses seleksi secara lebih efektif dan terstruktur.' }}
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
        @php
            $defaultDocs = [
                1 => 'Surat Izin Orang Tua',
                2 => "Perpang TNI<br>No. 57 & 58",
                3 => "Buku Teks Utama<br>Pancasila Kelas X",
                4 => 'Tabel Penilaian Fisik'
            ];
        @endphp
        @for($i = 1; $i <= 4; $i++)
            @php
                $title = !empty($informasi['doc'.$i.'_judul']) ? nl2br(e($informasi['doc'.$i.'_judul'])) : $defaultDocs[$i];
                $link = isset($informasi['doc'.$i.'_file']) ? asset($informasi['doc'.$i.'_file']) : '#';
            @endphp
            <x-frontend.doc-card 
                title="{!! $title !!}" 
                link="{{ $link }}" 
            />
        @endfor
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
                        {!! nl2br($informasi['sejarah_singkat'] ?? 'Berawal dari keberhasilan Akhdan Wahyu, Dian Astiningsih, dan Nudi Wicaksono yang terpilih sebagai Paskibraka tingkat Provinsi dan Nasional pada tahun 1991-1992, muncul semangat untuk membentuk wadah pembinaan bagi generasi penerus di SMA Negeri 1 Pontianak. Berbekal pengalaman dan dedikasi mereka, <strong style="color: #000; font-weight: 600;">lahirlah Paskibra SMA Negeri 1 Pontianak</strong> sebagai organisasi yang berkomitmen membina karakter, kedisiplinan, jiwa kepemimpinan, serta semangat nasionalisme bagi para siswa.') !!}
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
        <x-frontend.step-card 
            number="01" 
            icon="far fa-file-alt" 
            title="Administrasi" 
            description="Memverifikasi kelengkapan dan keabsahan berkas pendaftar sesuai dengan persyaratan yang telah ditentukan." 
        />
        
        <x-frontend.step-card 
            number="02" 
            icon="fas fa-clipboard-list" 
            title="Kesehatan & Parade" 
            description="Menilai kesehatan secara menyeluruh, postur tubuh ideal, dan penampilan kesamaptaan jasmani." 
        />
        
        <x-frontend.step-card 
            number="03" 
            icon="fas fa-running" 
            title="Samapta" 
            description="Mengukur kemampuan fisik dasar, daya tahan kardiovaskuler, kecepatan, dan kekuatan otot tubuh." 
        />
        
        <x-frontend.step-card 
            number="04" 
            icon="fas fa-shoe-prints" 
            title="PBB" 
            description="Menilai kemampuan dasar baris-berbaris, ketegasan, dan kebenaran gerakan sesuai Peraturan Panglima TNI." 
        />
        
        <x-frontend.step-card 
            number="05" 
            icon="fas fa-users" 
            title="Kepribadian" 
            description="Menilai wawasan kebangsaan, intelegensia umum, motivasi, karakter, kepemimpinan, dan komitmen." 
        />
        
        <x-frontend.step-card 
            number="06" 
            icon="fas fa-award" 
            title="Hasil Akhir" 
            description="Hasil seleksi secara kumulatif akan diumumkan secara transparan melalui akun masing-masing Calon Anggota." 
        />
    </div>
</section>
@endsection
