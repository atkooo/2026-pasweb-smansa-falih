@extends('layouts.admin')

@section('title', 'Pengurus Dashboard - Paskibra Ganesha')

@section('content')
    <!-- PENGURUS DASHBOARD -->
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <div>
            <h4 class="font-weight-bold dashboard-title" >Halo, {{ explode(' ', auth()->user()->nama_lengkap)[0] }}!</h4>
            <p class="text-muted mb-0 dashboard-subtitle" >Berikut adalah rekap pendaftaran calon anggota terbaru.</p>
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
                        <span class="text-primary font-weight-bold" style="font-size: 0.9rem;"><i class="fas fa-clock mr-1"></i> Perlu Verifikasi</span> 
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
                        <span class="text-success font-weight-bold" style="font-size: 0.9rem;"><i class="fas fa-check-circle mr-1"></i> Berkas Lolos</span> 
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
                        <span class="text-danger font-weight-bold" style="font-size: 0.9rem;"><i class="fas fa-times-circle mr-1"></i> Berkas Ditolak</span> 
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
                                <div class="card h-100 border bg-light action-card" style="border-radius: 0.75rem; ">
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
                                <div class="card h-100 border bg-light action-card" style="border-radius: 0.75rem; ">
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
                                <div class="card h-100 border bg-light action-card" style="border-radius: 0.75rem; ">
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
                                <div class="card h-100 border bg-light action-card" style="border-radius: 0.75rem; ">
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

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

