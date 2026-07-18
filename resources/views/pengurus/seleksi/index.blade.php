@extends('layouts.admin')

@section('title', 'Proses Seleksi - Paskibra Ganesha')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <div>
        <h3 class="font-weight-bold text-dark mb-0">Proses Seleksi</h3>
        <p class="text-muted mb-0">Kelola nilai dan tahapan seleksi calon anggota yang berkasnya telah disetujui</p>
    </div>
</div>

<div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
    <div class="card-body p-4">
        <!-- Filter & Search -->
        <form action="{{ route('seleksi.index') }}" method="GET" class="mb-4">
            <div class="row gx-2 gy-2">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-right-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-left-0 bg-light" placeholder="Cari nama atau NISN..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 font-weight-bold">Cari</button>
                </div>
                @if(request('search'))
                <div class="col-md-2">
                    <a href="{{ route('seleksi.index') }}" class="btn btn-light w-100 border text-muted">Reset</a>
                </div>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="border-bottom-0 py-3 text-uppercase text-muted" style="font-size: 0.8rem; width: 60px;">No</th>
                        <th class="border-bottom-0 py-3 text-uppercase text-muted" style="font-size: 0.8rem;">Nama Lengkap / NISN</th>
                        <th class="border-bottom-0 py-3 text-uppercase text-muted" style="font-size: 0.8rem;">Asal Sekolah</th>
                        <th class="border-bottom-0 py-3 text-uppercase text-muted" style="font-size: 0.8rem;">Progres Seleksi</th>
                        <th class="border-bottom-0 py-3 text-uppercase text-muted text-center" style="font-size: 0.8rem; width: 120px;">Kelola Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesertas as $index => $p)
                    <tr>
                        <td class="text-muted font-weight-bold">{{ $pesertas->firstItem() + $index }}</td>
                        <td>
                            <div class="font-weight-bold text-dark">{{ $p->user->nama_lengkap }}</div>
                            <div class="small text-muted">{{ $p->user->nisn }}</div>
                        </td>
                        <td>{{ $p->asal_sekolah }}</td>
                        <td>
                            @php
                                $totalTes = $p->hasilSeleksi->count();
                                $lulus = $p->hasilSeleksi->where('status_lulus', 1)->count();
                                $gagal = $p->hasilSeleksi->where('status_lulus', 0)->count();
                            @endphp
                            
                            @if($totalTes == 0)
                                <span class="badge bg-light text-muted border px-2 py-1"><i class="fas fa-minus mr-1"></i> Belum ada tes</span>
                            @else
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="small font-weight-bold text-dark mb-1">{{ $totalTes }} Tahapan Dinilai</div>
                                        <div class="d-flex text-muted" style="font-size: 0.75rem;">
                                            <span class="text-success mr-2"><i class="fas fa-check"></i> {{ $lulus }} Lulus</span>
                                            <span class="text-danger"><i class="fas fa-times"></i> {{ $gagal }} Gagal</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('seleksi.show', $p->id) }}" class="btn btn-sm btn-light border text-primary font-weight-bold px-3 rounded-pill">
                                <i class="fas fa-edit mr-1"></i> Nilai
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted mb-3"><i class="fas fa-users-slash" style="font-size: 3rem; opacity: 0.5;"></i></div>
                            <h6 class="font-weight-bold">Tidak ada peserta seleksi</h6>
                            <p class="text-muted small mb-0">Hanya pendaftar yang berkasnya berstatus "Disetujui" yang akan muncul di sini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $pesertas->links() }}
        </div>
    </div>
</div>
@endsection
