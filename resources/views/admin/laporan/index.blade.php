@extends('layouts.admin')

@section('title', 'Laporan & Statistik - Paskibra')

@section('content')
<div class="mb-4 mt-2 d-flex justify-content-between align-items-center">
    <div>
        <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Laporan Sistem</h3>
        <p class="text-muted" style="font-size: 0.95rem;">Ringkasan statistik dan aktivitas sistem Paskibra.</p>
    </div>
    <button onclick="window.print()" class="btn btn-secondary shadow-sm px-4" style="border-radius: 10px; font-weight: 600;">
        <i class="fas fa-print mr-2"></i> Cetak Laporan
    </button>
</div>

<!-- Statistik Umum -->
<h5 class="font-weight-bold text-dark mb-3 mt-4" style="font-size: 1.1rem; letter-spacing: -0.3px;">Statistik Pengguna</h5>
<div class="row mb-4">
    <!-- Admin Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-0 h-100 stat-card" style="border-radius: 1.25rem; background: #ffffff; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 text-uppercase font-weight-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Total Admin</p>
                        <h2 class="font-weight-bold text-dark mb-0" style="font-size: 2.2rem; letter-spacing: -1px;">{{ $stats['total_admin'] }}</h2>
                    </div>
                    <div class="icon-shape bg-primary-soft text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #eff6ff;">
                        <i class="fas fa-user-shield fa-fw" style="font-size: 1.5rem; color: #3b82f6;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengurus Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-0 h-100 stat-card" style="border-radius: 1.25rem; background: #ffffff; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 text-uppercase font-weight-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Total Pengurus</p>
                        <h2 class="font-weight-bold text-dark mb-0" style="font-size: 2.2rem; letter-spacing: -1px;">{{ $stats['total_pengurus'] }}</h2>
                    </div>
                    <div class="icon-shape bg-success-soft text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #ecfdf5;">
                        <i class="fas fa-users-cog fa-fw" style="font-size: 1.5rem; color: #10b981;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Calon Anggota Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-0 h-100 stat-card" style="border-radius: 1.25rem; background: #ffffff; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 text-uppercase font-weight-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Calon Anggota</p>
                        <h2 class="font-weight-bold text-dark mb-0" style="font-size: 2.2rem; letter-spacing: -1px;">{{ $stats['total_calon'] }}</h2>
                    </div>
                    <div class="icon-shape bg-warning-soft text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #fffbeb;">
                        <i class="fas fa-user-graduate fa-fw" style="font-size: 1.5rem; color: #f59e0b;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Konten -->
<h5 class="font-weight-bold text-dark mb-3 mt-2" style="font-size: 1.1rem; letter-spacing: -0.3px;">Statistik Konten Publikasi</h5>
<div class="row mb-5">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100 stat-card" style="border-radius: 1.25rem; background: #ffffff;">
            <div class="card-body text-center p-4">
                <div class="d-inline-block rounded-circle mb-3" style="width: 50px; height: 50px; background-color: #f3f4f6; line-height: 50px;">
                    <i class="far fa-newspaper" style="font-size: 1.2rem; color: #6b7280;"></i>
                </div>
                <h3 class="font-weight-bold text-dark mb-1" style="font-size: 1.8rem;">{{ $stats['total_berita'] }}</h3>
                <p class="text-muted mb-0 font-weight-bold" style="font-size: 0.8rem; letter-spacing: 0.5px;">TOTAL BERITA</p>
                <div class="mt-2 text-success" style="font-size: 0.75rem; font-weight: 600;"><i class="fas fa-arrow-up mr-1"></i>{{ $stats['total_berita_diterbitkan'] }} Diterbitkan</div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100 stat-card" style="border-radius: 1.25rem; background: #ffffff;">
            <div class="card-body text-center p-4">
                <div class="d-inline-block rounded-circle mb-3" style="width: 50px; height: 50px; background-color: #f3f4f6; line-height: 50px;">
                    <i class="far fa-images" style="font-size: 1.2rem; color: #6b7280;"></i>
                </div>
                <h3 class="font-weight-bold text-dark mb-1" style="font-size: 1.8rem;">{{ $stats['total_foto'] }}</h3>
                <p class="text-muted mb-0 font-weight-bold" style="font-size: 0.8rem; letter-spacing: 0.5px;">TOTAL FOTO GALERI</p>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100 stat-card" style="border-radius: 1.25rem; background: #ffffff;">
            <div class="card-body text-center p-4">
                <div class="d-inline-block rounded-circle mb-3" style="width: 50px; height: 50px; background-color: #f3f4f6; line-height: 50px;">
                    <i class="far fa-calendar-alt" style="font-size: 1.2rem; color: #6b7280;"></i>
                </div>
                <h3 class="font-weight-bold text-dark mb-1" style="font-size: 1.8rem;">{{ $stats['total_jadwal'] }}</h3>
                <p class="text-muted mb-0 font-weight-bold" style="font-size: 0.8rem; letter-spacing: 0.5px;">TOTAL JADWAL</p>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 h-100 stat-card" style="border-radius: 1.25rem; background: linear-gradient(135deg, #2563eb, #1d4ed8); box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);">
            <div class="card-body text-center p-4">
                <div class="d-inline-block rounded-circle mb-3" style="width: 50px; height: 50px; background-color: rgba(255,255,255,0.2); line-height: 50px;">
                    <i class="fas fa-calendar-check text-white" style="font-size: 1.2rem;"></i>
                </div>
                <h3 class="font-weight-bold text-white mb-1" style="font-size: 1.8rem;">{{ $stats['jadwal_bulan_ini'] }}</h3>
                <p class="text-white-50 mb-0 font-weight-bold" style="font-size: 0.8rem; letter-spacing: 0.5px;">KEGIATAN BULAN INI</p>
                <div class="mt-2 text-white" style="font-size: 0.85rem; font-weight: 600;">{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Jadwal Bulan Ini -->
<div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem; overflow: hidden;">
    <div class="card-header bg-white border-0 pt-4 pb-3">
        <h5 class="card-title font-weight-bold text-dark mb-0">Rincian Kegiatan Bulan {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-top-0 border-bottom-0 text-muted px-4" style="font-size: 0.85rem; font-weight: 600;">NO</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600;">TANGGAL</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600;">WAKTU</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600;">NAMA KEGIATAN</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600;">TEMPAT</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwalBulanIni as $index => $jadwal)
                    <tr>
                        <td class="px-4 text-muted">{{ $index + 1 }}</td>
                        <td class="font-weight-bold text-dark">{{ \Carbon\Carbon::parse($jadwal->tanggal_kegiatan)->translatedFormat('d M Y') }}</td>
                        <td class="text-muted">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} WIB</td>
                        <td class="font-weight-600">{{ $jadwal->nama_kegiatan }}</td>
                        <td class="text-muted">{{ $jadwal->tempat }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            Tidak ada jadwal kegiatan untuk bulan ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .stat-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important;
    }
    @media print {
        body * {
            visibility: hidden;
        }
        #content-wrapper, #content-wrapper * {
            visibility: visible;
        }
        #content-wrapper {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .btn, .navbar, .sidebar {
            display: none !important;
        }
        .card {
            border: 1px solid #ddd !important;
            box-shadow: none !important;
        }
    }
</style>
@endsection
