@extends('layouts.admin')

@section('title', 'Admin Dashboard - Paskibra Ganesha')

@section('content')
    <!-- ADMIN DASHBOARD -->
    
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <div>
            <h3 class="font-weight-bold dashboard-title" >Dashboard Admin</h3>
            <p class="text-muted mb-0 dashboard-subtitle" >Paskibra Management</p>
        </div>
        <div class="d-none d-md-flex align-items-center gap-3" style="gap: 1rem;">
            <!-- Global toggle is in the top navbar -->
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
                    <h3 class="m-0 card-title-modern" >Akses Cepat</h3>
                </div>
                <div class="card-body d-flex flex-column pt-3">
                    <button class="btn-soft btn-soft-primary">
                        <span><i class="fas fa-user-plus mr-2"></i> Tambah Pengguna</span>
                        <i class="fas fa-chevron-right text-muted" ></i>
                    </button>
                    <button class="btn-soft btn-soft-primary">
                        <span><i class="fas fa-calendar-alt mr-2"></i> Kelola Jadwal</span>
                        <i class="fas fa-chevron-right text-muted" ></i>
                    </button>
                    <button class="btn-soft btn-soft-primary mb-0">
                        <span><i class="fas fa-chart-pie mr-2"></i> Laporan Aktivitas</span>
                        <i class="fas fa-chevron-right text-muted" ></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="col-lg-8 col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="m-0 card-title-modern" >Aktivitas Terbaru</h3>
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
@endsection
