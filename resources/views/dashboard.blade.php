@extends('layouts.admin')

@section('title', 'Dashboard - Paskibra Ganesha')

@section('content')
@if(auth()->user()->role === 'admin')
    <!-- ADMIN DASHBOARD -->
    
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <div>
            <h3 class="font-weight-bold" style="color: #111827; letter-spacing: -0.5px; margin-bottom: 0.2rem;">Dashboard</h3>
            <p class="text-muted mb-0" style="font-size: 0.95rem;">Paskibra Management</p>
        </div>
        <div class="d-none d-md-flex align-items-center gap-3" style="gap: 1rem;">
            <!-- Removed local toggle. The global toggle is now in the top navbar -->
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="stat-card-gradient bg-gradient-red-1">
                <div class="stat-info">
                    <span class="value">{{ \App\Models\User::count() }}</span>
                    <span class="label">Total Pengguna</span>
                </div>
                <div class="icon-circle"><i class="fas fa-users"></i></div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="stat-card-gradient bg-gradient-white">
                <div class="stat-info">
                    <span class="value">{{ \App\Models\User::where('role', 'calon_anggota')->count() }}</span>
                    <span class="label">Calon Anggota</span>
                </div>
                <div class="icon-circle"><i class="fas fa-user-graduate"></i></div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="stat-card-gradient bg-gradient-red-2">
                <div class="stat-info">
                    <span class="value">{{ \App\Models\User::where('role', 'pengurus')->count() }}</span>
                    <span class="label">Pengurus Aktif</span>
                </div>
                <div class="icon-circle"><i class="fas fa-user-tie"></i></div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Quick Actions -->
        <div class="col-lg-4 col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h3 class="m-0" style="font-weight: 700; font-size: 1.1rem; color: #111827;">Akses Cepat</h3>
                </div>
                <div class="card-body d-flex flex-column pt-3">
                    <button class="btn-soft btn-soft-primary">
                        <span><i class="fas fa-user-plus mr-2"></i> Tambah Pengguna</span>
                        <i class="fas fa-chevron-right text-muted" style="font-size: 0.85rem;"></i>
                    </button>
                    <button class="btn-soft btn-soft-primary">
                        <span><i class="fas fa-calendar-alt mr-2"></i> Kelola Jadwal</span>
                        <i class="fas fa-chevron-right text-muted" style="font-size: 0.85rem;"></i>
                    </button>
                    <button class="btn-soft btn-soft-primary mb-0">
                        <span><i class="fas fa-chart-pie mr-2"></i> Laporan Aktivitas</span>
                        <i class="fas fa-chevron-right text-muted" style="font-size: 0.85rem;"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="col-lg-8 col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="m-0" style="font-weight: 700; font-size: 1.1rem; color: #111827;">Aktivitas Terbaru</h3>
                    <button class="btn btn-sm btn-light rounded-pill px-3 border text-muted" style="margin-left: auto;">Lihat semua <i class="fas fa-chevron-right ml-1" style="font-size:0.7rem;"></i></button>
                </div>
                <div class="card-body">
                    <ul class="timeline-modern mt-2">
                        <li>
                            <span class="time"><i class="far fa-clock mr-2"></i> Hari ini, 10:23 AM</span>
                            <span class="desc">Budi Santoso mendaftar sebagai Calon Anggota</span>
                        </li>
                        <li>
                            <span class="time"><i class="far fa-clock mr-2"></i> Kemarin, 14:50 PM</span>
                            <span class="desc">Admin memperbarui jadwal Seleksi Fisik</span>
                        </li>
                        <li>
                            <span class="time"><i class="far fa-clock mr-2"></i> 2 hari yang lalu</span>
                            <span class="desc">Siti Aminah diangkat menjadi Pengurus</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@elseif(auth()->user()->role === 'pengurus')
    <!-- PENGURUS DASHBOARD -->
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <div>
            <h4 class="font-weight-bold" style="color: #111827; letter-spacing: -0.5px;">Halo, {{ explode(' ', auth()->user()->nama_lengkap)[0] }}!</h4>
            <p class="text-muted mb-0" style="font-size: 0.95rem;">Berikut adalah rekap pendaftaran calon anggota terbaru.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <p class="text-muted font-weight-bold mb-0 text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Pendaftaran Baru</p>
                        <div style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                    <h2 class="font-weight-bold mb-3 text-dark">{{ \App\Models\FormulirPendaftaran::where('status_pendaftaran', 'pending')->count() ?? 0 }}</h2>
                    <div class="d-flex align-items-center">
                        <span class="text-success font-weight-bold" style="font-size: 0.9rem;"><i class="fas fa-arrow-up mr-1"></i> +{{ rand(5,15) }}%</span> 
                        <span class="text-muted ml-2" style="font-size: 0.9rem;">vs bulan lalu</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <p class="text-muted font-weight-bold mb-0 text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Pendaftar Disetujui</p>
                        <div style="background: rgba(16, 185, 129, 0.1); color: #10b981; width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                            <i class="fas fa-check-double"></i>
                        </div>
                    </div>
                    <h2 class="font-weight-bold mb-3 text-dark">{{ \App\Models\FormulirPendaftaran::where('status_pendaftaran', 'approved')->count() ?? 0 }}</h2>
                    <div class="d-flex align-items-center">
                        <span class="text-success font-weight-bold" style="font-size: 0.9rem;"><i class="fas fa-arrow-up mr-1"></i> +{{ rand(5,15) }}%</span> 
                        <span class="text-muted ml-2" style="font-size: 0.9rem;">vs bulan lalu</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <p class="text-muted font-weight-bold mb-0 text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Pendaftar Ditolak</p>
                        <div style="background: rgba(239, 68, 68, 0.1); color: #ef4444; width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <h2 class="font-weight-bold mb-3 text-dark">{{ \App\Models\FormulirPendaftaran::where('status_pendaftaran', 'rejected')->count() ?? 0 }}</h2>
                    <div class="d-flex align-items-center">
                        <span class="text-danger font-weight-bold" style="font-size: 0.9rem;"><i class="fas fa-arrow-down mr-1"></i> -{{ rand(2,10) }}%</span> 
                        <span class="text-muted ml-2" style="font-size: 0.9rem;">vs bulan lalu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Dashboard Features -->
        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h5 class="font-weight-bold m-0 text-dark"><i class="fas fa-th-large text-primary mr-2"></i> Menu Utama Pengurus</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        
                        <!-- 1. Melihat Data Pendaftar -->
                        <div class="col-md-4 mb-4">
                            <a href="#" class="text-decoration-none">
                                <div class="card h-100 border bg-light action-card" style="border-radius: 0.75rem; transition: transform 0.2s;">
                                    <div class="card-body text-center p-4">
                                        <div style="width: 60px; height: 60px; background: rgba(59, 130, 246, 0.1); border-radius: 50%; margin: 0 auto;" class="d-flex align-items-center justify-content-center mb-3">
                                            <i class="fas fa-users text-primary" style="font-size: 1.5rem;"></i>
                                        </div>
                                        <h6 class="font-weight-bold text-dark">Data Pendaftar</h6>
                                        <p class="text-muted small mb-0">Lihat & kelola semua calon anggota</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- 2. Melakukan Verifikasi Berkas -->
                        <div class="col-md-4 mb-4">
                            <a href="#" class="text-decoration-none">
                                <div class="card h-100 border bg-light action-card" style="border-radius: 0.75rem; transition: transform 0.2s;">
                                    <div class="card-body text-center p-4">
                                        <div style="width: 60px; height: 60px; background: rgba(245, 158, 11, 0.1); border-radius: 50%; margin: 0 auto;" class="d-flex align-items-center justify-content-center mb-3">
                                            <i class="fas fa-file-signature text-warning" style="font-size: 1.5rem;"></i>
                                        </div>
                                        <h6 class="font-weight-bold text-dark">Verifikasi Berkas</h6>
                                        <p class="text-muted small mb-0">Periksa & validasi dokumen pendaftar</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- 3. Menginput Hasil Seleksi -->
                        <div class="col-md-4 mb-4">
                            <a href="#" class="text-decoration-none">
                                <div class="card h-100 border bg-light action-card" style="border-radius: 0.75rem; transition: transform 0.2s;">
                                    <div class="card-body text-center p-4">
                                        <div style="width: 60px; height: 60px; background: rgba(16, 185, 129, 0.1); border-radius: 50%; margin: 0 auto;" class="d-flex align-items-center justify-content-center mb-3">
                                            <i class="fas fa-clipboard-check text-success" style="font-size: 1.5rem;"></i>
                                        </div>
                                        <h6 class="font-weight-bold text-dark">Input Hasil Seleksi</h6>
                                        <p class="text-muted small mb-0">Masukkan nilai & status kelulusan fisik, dll</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- 4. Mengelola Pengumuman Hasil -->
                        <div class="col-md-4 mb-4">
                            <a href="#" class="text-decoration-none">
                                <div class="card h-100 border bg-light action-card" style="border-radius: 0.75rem; transition: transform 0.2s;">
                                    <div class="card-body d-flex align-items-center p-4">
                                        <div style="width: 50px; height: 50px; background: rgba(139, 92, 246, 0.1); border-radius: 50%;" class="d-flex align-items-center justify-content-center mr-3">
                                            <i class="fas fa-bullhorn text-purple" style="color: #8b5cf6; font-size: 1.25rem;"></i>
                                        </div>
                                        <div>
                                            <h6 class="font-weight-bold text-dark mb-1">Pengumuman Hasil</h6>
                                            <p class="text-muted small mb-0">Buat & kelola pengumuman kelulusan akhir</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>


                        
                        <style>
                            .action-card:hover {
                                transform: translateY(-5px);
                                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
                                background-color: #ffffff !important;
                            }
                        </style>

                    </div>
                </div>
            </div>
        </div>
    </div>

@else
    <!-- CALON ANGGOTA DASHBOARD -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 1rem; overflow: hidden;">
                <div class="card-body p-4 p-md-5">
                    <div class="row align-items-center">
                        <!-- Left Side: Profile Info -->
                        <div class="col-md-8 d-flex align-items-center mb-4 mb-md-0">
                            <!-- Avatar -->
                            <div class="position-relative mr-4 mr-md-5">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white font-weight-bold" 
                                     style="width: 130px; height: 130px; background-color: #ff0000; font-size: 3.5rem; border: 4px solid #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
                                    {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}
                                </div>
                                <div class="position-absolute bg-white rounded-circle d-flex align-items-center justify-content-center shadow" 
                                     style="width: 32px; height: 32px; bottom: 8px; right: 8px; cursor: pointer; border: 1px solid #eaeaea;">
                                    <i class="fas fa-plus text-secondary" style="font-size: 0.85rem;"></i>
                                </div>
                            </div>
                            
                            <!-- Profile Data -->
                            <div>
                                <h3 class="font-weight-bold mb-1" style="color: #0b1c3f; letter-spacing: -0.5px; text-transform: uppercase;">
                                    {{ auth()->user()->nama_lengkap }}
                                </h3>
                                <h6 class="mb-4" style="color: #ff0000; font-weight: 600;">Calon Anggota Paskibra SMA Negeri 1 Pontianak</h6>
                                
                                <div class="d-flex align-items-start mb-3">
                                    <i class="fas fa-user mt-1 mr-3 text-danger" style="width: 18px; text-align: center;"></i>
                                    <div>
                                        <p class="text-muted mb-0" style="font-size: 0.85rem;">NISN / NIK</p>
                                        <p class="font-weight-bold mb-0 text-dark">{{ auth()->user()->username ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start mb-3">
                                    <i class="fas fa-map-marker-alt mt-1 mr-3 text-danger" style="width: 18px; text-align: center;"></i>
                                    <div>
                                        <p class="text-muted mb-0" style="font-size: 0.85rem;">Alamat</p>
                                        <p class="font-weight-bold mb-0 text-dark">
                                            @php
                                                $formulir = auth()->user()->formulirPendaftaran;
                                                echo $formulir ? strtoupper($formulir->alamat) : 'BELUM DIISI';
                                            @endphp
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-phone mt-1 mr-3 text-danger" style="width: 18px; text-align: center;"></i>
                                    <div>
                                        <p class="text-muted mb-0" style="font-size: 0.85rem;">Phone</p>
                                        <p class="font-weight-bold mb-0 text-dark">{{ auth()->user()->no_hp ?? 'Belum diisi' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Badge / Logo -->
                        <div class="col-md-4 text-center d-flex flex-column justify-content-center align-items-center" style="border-left: 1px solid #f0f0f0;">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo Paskibra" style="width: 160px; height: auto;" class="mb-3">
                            <h6 class="font-weight-bold text-secondary" style="text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;">
                                Paskibra Ganesha<br>SMA Negeri 1 Pontianak
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Content (Bottom Clipboard Card) -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
                    <i class="fas fa-clipboard-check text-success mb-3" style="font-size: 6rem; opacity: 0.7;"></i>
                    <h3 class="font-weight-bold text-dark mb-2">Selamat Datang di Portal Calon Anggota</h3>
                    <p class="text-muted" style="font-size: 1.1rem;">Lengkapi formulir pendaftaran Anda dan pantau status kelulusan melalui menu di sebelah kiri.</p>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
