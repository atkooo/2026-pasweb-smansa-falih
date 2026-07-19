@extends('layouts.admin')

@section('title', 'Laporan & Statistik - Paskibra')

@section('content')
<div class="mb-4 mt-2 d-flex justify-content-between align-items-center">
    <div>
        <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Laporan Sistem</h3>
        <p class="text-muted" style="font-size: 0.95rem;">Laporan data sistem Paskibra berdasarkan kategori.</p>
    </div>
    <a href="{{ route('laporan.export', request()->query()) }}" class="btn btn-success shadow-sm px-4" style="border-radius: 10px; font-weight: 600;">
        <i class="fas fa-file-csv mr-2"></i> Export CSV
    </a>
</div>

<div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem; overflow: hidden;">
    <div class="card-header bg-white border-0 pt-4 pb-0">
        <ul class="nav nav-tabs border-bottom-0">
            <li class="nav-item">
                <a class="nav-link {{ $kategori == 'pengguna' ? 'active font-weight-bold' : 'text-muted' }}" href="{{ route('laporan.index', ['kategori' => 'pengguna']) }}">
                    <i class="fas fa-users mr-1"></i> Pengguna
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $kategori == 'pendaftar' ? 'active font-weight-bold' : 'text-muted' }}" href="{{ route('laporan.index', ['kategori' => 'pendaftar']) }}">
                    <i class="fas fa-user-graduate mr-1"></i> Pendaftar
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $kategori == 'berita' ? 'active font-weight-bold' : 'text-muted' }}" href="{{ route('laporan.index', ['kategori' => 'berita']) }}">
                    <i class="fas fa-newspaper mr-1"></i> Berita
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $kategori == 'jadwal' ? 'active font-weight-bold' : 'text-muted' }}" href="{{ route('laporan.index', ['kategori' => 'jadwal']) }}">
                    <i class="fas fa-calendar-alt mr-1"></i> Jadwal
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body p-0 mt-3">
        <!-- Filter Form -->
        <div class="px-4 py-3 bg-light border-bottom mb-3">
            <form action="{{ route('laporan.index') }}" method="GET" class="form-row align-items-center">
                <input type="hidden" name="kategori" value="{{ $kategori }}">
                
                <div class="col-md-4 mb-2 mb-md-0">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari..." value="{{ request('search') }}">
                </div>
                
                @if($kategori == 'pengguna')
                    <div class="col-md-3 mb-2 mb-md-0">
                        <select name="role" class="form-control form-control-sm">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="pengurus" {{ request('role') == 'pengurus' ? 'selected' : '' }}>Pengurus</option>
                            <option value="calon_anggota" {{ request('role') == 'calon_anggota' ? 'selected' : '' }}>Calon Anggota</option>
                        </select>
                    </div>
                @elseif($kategori == 'pendaftar')
                    <div class="col-md-3 mb-2 mb-md-0">
                        <select name="status_pendaftaran" class="form-control form-control-sm">
                            <option value="">Semua Status Pendaftaran</option>
                            <option value="terverifikasi" {{ request('status_pendaftaran') == 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="menunggu" {{ request('status_pendaftaran') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2 mb-md-0">
                        <select name="status_kelulusan" class="form-control form-control-sm">
                            <option value="">Semua Status Kelulusan</option>
                            <option value="lulus" {{ request('status_kelulusan') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                            <option value="tidak_lulus" {{ request('status_kelulusan') == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                        </select>
                    </div>
                @elseif($kategori == 'berita')
                    <div class="col-md-3 mb-2 mb-md-0">
                        <select name="status" class="form-control form-control-sm">
                            <option value="">Semua Status</option>
                            <option value="diterbitkan" {{ request('status') == 'diterbitkan' ? 'selected' : '' }}>Diterbitkan</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                @elseif($kategori == 'jadwal')
                    <div class="col-md-3 mb-2 mb-md-0">
                        <select name="bulan" class="form-control form-control-sm">
                            <option value="">Semua Bulan</option>
                            @for($i=1; $i<=12; $i++)
                                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                            @endfor
                        </select>
                    </div>
                @endif
                
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm btn-block">Filter</button>
                </div>
            </form>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        @if($kategori == 'pengguna')
                            <th class="border-top-0 border-bottom-0 text-muted px-4">NO</th>
                            <th class="border-top-0 border-bottom-0 text-muted">NAMA LENGKAP</th>
                            <th class="border-top-0 border-bottom-0 text-muted">EMAIL</th>
                            <th class="border-top-0 border-bottom-0 text-muted">ROLE</th>
                            <th class="border-top-0 border-bottom-0 text-muted">TANGGAL DAFTAR</th>
                        @elseif($kategori == 'pendaftar')
                            <th class="border-top-0 border-bottom-0 text-muted px-4">NO</th>
                            <th class="border-top-0 border-bottom-0 text-muted">NAMA PESERTA</th>
                            <th class="border-top-0 border-bottom-0 text-muted">ASAL SEKOLAH</th>
                            <th class="border-top-0 border-bottom-0 text-muted">JENIS KELAMIN</th>
                            <th class="border-top-0 border-bottom-0 text-muted">STATUS PENDAFTARAN</th>
                            <th class="border-top-0 border-bottom-0 text-muted">STATUS KELULUSAN</th>
                        @elseif($kategori == 'berita')
                            <th class="border-top-0 border-bottom-0 text-muted px-4">NO</th>
                            <th class="border-top-0 border-bottom-0 text-muted">JUDUL</th>
                            <th class="border-top-0 border-bottom-0 text-muted">KATEGORI</th>
                            <th class="border-top-0 border-bottom-0 text-muted">STATUS</th>
                            <th class="border-top-0 border-bottom-0 text-muted">TANGGAL POSTING</th>
                        @elseif($kategori == 'jadwal')
                            <th class="border-top-0 border-bottom-0 text-muted px-4">NO</th>
                            <th class="border-top-0 border-bottom-0 text-muted">NAMA KEGIATAN</th>
                            <th class="border-top-0 border-bottom-0 text-muted">TANGGAL</th>
                            <th class="border-top-0 border-bottom-0 text-muted">WAKTU</th>
                            <th class="border-top-0 border-bottom-0 text-muted">TEMPAT</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $item)
                        <tr>
                            <td class="px-4 text-muted">{{ $data->firstItem() + $index }}</td>
                            @if($kategori == 'pengguna')
                                <td class="font-weight-600 text-dark">{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td><span class="badge badge-secondary">{{ $item->role }}</span></td>
                                <td>{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</td>
                            @elseif($kategori == 'pendaftar')
                                <td class="font-weight-600 text-dark">{{ $item->user->name ?? '-' }}</td>
                                <td>{{ $item->asal_sekolah }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>
                                    <span class="badge {{ $item->status_pendaftaran == 'terverifikasi' ? 'badge-success' : 'badge-warning' }}">
                                        {{ ucfirst($item->status_pendaftaran) }}
                                    </span>
                                </td>
                                <td>
                                    @if($item->status_kelulusan == 'lulus')
                                        <span class="badge badge-success">Lulus</span>
                                    @elseif($item->status_kelulusan == 'tidak_lulus')
                                        <span class="badge badge-danger">Tidak Lulus</span>
                                    @else
                                        <span class="badge badge-secondary">Belum Ditentukan</span>
                                    @endif
                                </td>
                            @elseif($kategori == 'berita')
                                <td class="font-weight-600 text-dark">{{ $item->judul }}</td>
                                <td>{{ $item->kategori ?? 'Umum' }}</td>
                                <td>
                                    <span class="badge {{ $item->status == 'diterbitkan' ? 'badge-success' : 'badge-warning' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td>{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</td>
                            @elseif($kategori == 'jadwal')
                                <td class="font-weight-600 text-dark">{{ $item->nama_kegiatan }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }} WIB</td>
                                <td>{{ $item->tempat }}</td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Tidak ada data untuk kategori ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-muted small">
                Menampilkan {{ $data->firstItem() ?? 0 }} sampai {{ $data->lastItem() ?? 0 }} dari {{ $data->total() }} entri
            </span>
            <div>
                {{ $data->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
