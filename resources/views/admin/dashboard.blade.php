@extends('layouts.admin')

@section('title', 'Admin Dashboard - Paskibra Ganesha')

@section('content')
    <!-- ADMIN DASHBOARD -->
    
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <div>
            <h3 class="font-weight-bold dashboard-title" >Dashboard Admin</h3>
            <p class="text-muted mb-0 dashboard-subtitle" >Paskibra Management</p>
        </div>
    </div>

    <!-- Metrics Cards -->
    <div class="row mb-2">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-card-gradient bg-gradient-red-1">
                <div class="stat-info">
                    <span class="value">{{ $totalPengguna }}</span>
                    <span class="label">Total Pengguna</span>
                </div>
                <div class="icon-circle"><i class="fas fa-users"></i></div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-card-gradient bg-gradient-white">
                <div class="stat-info">
                    <span class="value">{{ $totalCalon }}</span>
                    <span class="label">Calon Anggota</span>
                </div>
                <div class="icon-circle"><i class="fas fa-user-graduate"></i></div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-card-gradient bg-gradient-red-2">
                <div class="stat-info">
                    <span class="value">{{ $totalPengurus }}</span>
                    <span class="label">Pengurus Aktif</span>
                </div>
                <div class="icon-circle"><i class="fas fa-user-tie"></i></div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-card-gradient" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">
                <div class="stat-info">
                    <span class="value">{{ $totalPendaftar }}</span>
                    <span class="label">Total Pendaftar</span>
                </div>
                <div class="icon-circle" style="color: #059669;"><i class="fas fa-file-signature"></i></div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Chart Section -->
        <div class="col-lg-8 col-md-12 mb-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 1rem;">
                <div class="card-header bg-white border-0 pt-4">
                    <h3 class="m-0 card-title-modern">Statistik Pendaftar (7 Hari Terakhir)</h3>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 250px; width: 100%;">
                        <canvas id="registrationChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4 col-md-12 mb-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 1rem;">
                <div class="card-header bg-white border-0 pt-4">
                    <h3 class="m-0 card-title-modern">Akses Cepat</h3>
                </div>
                <div class="card-body d-flex flex-column pt-3">
                    <a href="{{ route('users.index') }}" class="btn-soft btn-soft-primary text-decoration-none">
                        <span><i class="fas fa-user-plus mr-2"></i> Kelola Pengguna</span>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </a>
                    <a href="{{ route('jadwal.index') }}" class="btn-soft btn-soft-primary text-decoration-none">
                        <span><i class="fas fa-calendar-alt mr-2"></i> Kelola Jadwal</span>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </a>
                    <a href="{{ route('laporan.index') }}" class="btn-soft btn-soft-primary text-decoration-none mb-0">
                        <span><i class="fas fa-chart-pie mr-2"></i> Laporan Sistem</span>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <!-- Recent Activities / Pendaftaran -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 1rem;">
                <div class="card-header bg-white border-0 pt-4 d-flex justify-content-between align-items-center">
                    <h3 class="m-0 card-title-modern">Pendaftar Terbaru</h3>
                    <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-sm btn-light rounded-pill px-3 border text-muted">Lihat semua <i class="fas fa-chevron-right ml-1" style="font-size:0.7rem;"></i></a>
                </div>
                <div class="card-body">
                    <ul class="timeline-modern mt-2">
                        @forelse($pendaftarTerbaru as $pendaftar)
                            <li>
                                <span class="time"><i class="far fa-clock mr-2"></i> {{ $pendaftar->created_at->diffForHumans() }}</span>
                                <span class="desc text-dark font-weight-bold">{{ $pendaftar->user->name ?? $pendaftar->nama_panggilan }}</span>
                                <span class="d-block text-muted small mt-1">Asal: {{ $pendaftar->asal_sekolah }}</span>
                            </li>
                        @empty
                            <li class="text-muted">Belum ada pendaftar terbaru.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Upcoming Schedules -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 1rem;">
                <div class="card-header bg-white border-0 pt-4 d-flex justify-content-between align-items-center">
                    <h3 class="m-0 card-title-modern">Jadwal Mendatang</h3>
                    <a href="{{ route('jadwal.index') }}" class="btn btn-sm btn-light rounded-pill px-3 border text-muted">Lihat semua <i class="fas fa-chevron-right ml-1" style="font-size:0.7rem;"></i></a>
                </div>
                <div class="card-body">
                    <ul class="timeline-modern mt-2">
                        @forelse($jadwalMendatang as $jadwal)
                            <li>
                                <span class="time"><i class="far fa-calendar mr-2"></i> {{ \Carbon\Carbon::parse($jadwal->tanggal_kegiatan)->translatedFormat('d M Y') }} - {{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }}</span>
                                <span class="desc text-dark font-weight-bold">{{ $jadwal->nama_kegiatan }}</span>
                                <span class="d-block text-muted small mt-1"><i class="fas fa-map-marker-alt mr-1"></i> {{ $jadwal->tempat }}</span>
                            </li>
                        @empty
                            <li class="text-muted">Tidak ada jadwal kegiatan dalam waktu dekat.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('registrationChart').getContext('2d');
        var registrationChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Pendaftar Baru',
                    data: {!! json_encode($data) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: 'rgba(59, 130, 246, 1)',
                    pointRadius: 4,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endsection
