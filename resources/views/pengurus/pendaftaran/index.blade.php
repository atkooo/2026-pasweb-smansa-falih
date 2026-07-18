@extends('layouts.admin')

@section('title', 'Kelola Pendaftaran - Paskibra Ganesha')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <div>
        <h3 class="font-weight-bold text-dark mb-0">Kelola Pendaftaran</h3>
        <p class="text-muted mb-0">Daftar calon anggota yang mendaftar</p>
    </div>
</div>

<div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
    <div class="card-body p-4">
        <!-- Filter & Search -->
        <form action="{{ route('pendaftaran.index') }}" method="GET" class="mb-4">
            <div class="row gx-2 gy-2">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-right-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-left-0 bg-light" placeholder="Cari nama atau NISN..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select form-control bg-light">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Review</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 font-weight-bold">Filter</button>
                </div>
                @if(request('search') || request('status'))
                <div class="col-md-2">
                    <a href="{{ route('pendaftaran.index') }}" class="btn btn-light w-100 border text-muted">Reset</a>
                </div>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="border-bottom-0 py-3 text-uppercase text-muted" style="font-size: 0.8rem;">Tanggal Daftar</th>
                        <th class="border-bottom-0 py-3 text-uppercase text-muted" style="font-size: 0.8rem;">Nama Lengkap / NISN</th>
                        <th class="border-bottom-0 py-3 text-uppercase text-muted" style="font-size: 0.8rem;">Asal Sekolah</th>
                        <th class="border-bottom-0 py-3 text-uppercase text-muted" style="font-size: 0.8rem;">Status</th>
                        <th class="border-bottom-0 py-3 text-uppercase text-muted text-center" style="font-size: 0.8rem; width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftarans as $p)
                    <tr>
                        <td class="text-muted">{{ $p->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            <div class="font-weight-bold text-dark">{{ $p->user->nama_lengkap }}</div>
                            <div class="small text-muted">{{ $p->user->nisn }}</div>
                        </td>
                        <td>{{ $p->asal_sekolah }}</td>
                        <td>
                            @if($p->status_pendaftaran == 'pending')
                                <span class="badge" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; padding: 0.5em 0.75em;"><i class="fas fa-clock mr-1"></i> Pending</span>
                            @elseif($p->status_pendaftaran == 'approved')
                                <span class="badge" style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 0.5em 0.75em;"><i class="fas fa-check mr-1"></i> Disetujui</span>
                            @elseif($p->status_pendaftaran == 'rejected')
                                <span class="badge" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 0.5em 0.75em;"><i class="fas fa-times mr-1"></i> Ditolak</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pendaftaran.show', $p->id) }}" class="btn btn-sm btn-light border text-primary font-weight-bold px-3 rounded-pill">
                                Review
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted mb-3"><i class="fas fa-inbox" style="font-size: 3rem; opacity: 0.5;"></i></div>
                            <h6 class="font-weight-bold">Tidak ada pendaftar ditemukan</h6>
                            <p class="text-muted small mb-0">Coba ubah kata kunci pencarian atau filter status.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $pendaftarans->links() }}
        </div>
    </div>
</div>
@endsection
