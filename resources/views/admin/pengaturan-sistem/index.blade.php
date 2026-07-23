@extends('layouts.admin')

@section('title', 'Pengaturan Sistem Pendaftaran - Paskibra Ganesha')
@section('page-title', 'Pengaturan Sistem Pendaftaran')

@section('content')
    <div class="mb-4 mt-2">
        <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Pengaturan Sistem Pendaftaran</h3>
        <p class="text-muted" style="font-size: 0.95rem;">Kelola status penerimaan calon anggota baru dan atur tahun periode
            aktif.</p>
    </div>

    @if(auth()->user()->role !== 'pengurus')
        <div class="mb-4 p-4" style="border-radius: 1rem; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); box-shadow: 0 8px 24px rgba(59,130,246,0.08); border: 1px solid rgba(59,130,246,0.12);">
            <div class="d-flex align-items-start">
                <div class="mr-4 shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width:52px;height:52px;background:linear-gradient(135deg,#3b82f6,#2563eb);box-shadow:0 6px 16px rgba(59,130,246,0.30);">
                    <i class="fas fa-eye text-white" style="font-size:1.1rem;"></i>
                </div>
                <div>
                    <span class="badge badge-pill mb-2 text-white" style="background:linear-gradient(135deg,#3b82f6,#2563eb);font-size:0.7rem;letter-spacing:1px;padding:4px 12px;">👁 MODE LIHAT</span>
                    <h6 class="font-weight-bold text-dark mb-1">Mode Lihat (Admin Only)</h6>
                    <p class="mb-0 text-muted small">Pembukaan/penutupan pendaftaran serta pengaturan tahun periode aktif hanya dapat dikelola oleh role <strong>Pengurus</strong>.</p>
                </div>
            </div>
        </div>
    @endif

    <div class="row">

        {{-- ============================================================ --}}
        {{-- CARD 1: STATUS PENDAFTARAN (TOGGLE) --}}
        {{-- ============================================================ --}}
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                            style="width: 44px; height: 44px; background: {{ $statusPendaftaran === 'buka' ? 'rgba(16,185,129,0.12)' : 'rgba(239,68,68,0.10)' }};">
                            <i class="fas {{ $statusPendaftaran === 'buka' ? 'fa-door-open text-success' : 'fa-door-closed text-danger' }}"
                                style="font-size: 1.1rem;"></i>
                        </div>
                        <div>
                            <h6 class="font-weight-bold text-dark mb-0">Status Pendaftaran</h6>
                            <small class="text-muted">Buka atau tutup formulir pendaftaran calon anggota</small>
                        </div>
                    </div>

                    {{-- Status Badge --}}
                    <div class="d-flex align-items-center mb-4 py-3 px-4 rounded-lg"
                        style="background: {{ $statusPendaftaran === 'buka' ? 'rgba(16,185,129,0.08)' : 'rgba(239,68,68,0.07)' }}; border-radius: 0.75rem; border: 1.5px solid {{ $statusPendaftaran === 'buka' ? 'rgba(16,185,129,0.3)' : 'rgba(239,68,68,0.2)' }};">
                        <div class="mr-3">
                            <span class="badge badge-pill px-3 py-2 font-weight-bold"
                                style="font-size: 0.85rem; background-color: {{ $statusPendaftaran === 'buka' ? '#10b981' : '#ef4444' }}; color: #fff;">
                                {{ $statusPendaftaran === 'buka' ? '● BUKA' : '● TUTUP' }}
                            </span>
                        </div>
                        <div>
                            @if($statusPendaftaran === 'buka')
                                <p class="mb-0 text-success font-weight-bold" style="font-size: 0.9rem;">Pendaftaran Sedang
                                    Berjalan</p>
                                <small class="text-muted">Calon anggota baru dapat mengisi formulir pendaftaran.</small>
                            @else
                                <p class="mb-0 text-danger font-weight-bold" style="font-size: 0.9rem;">Pendaftaran Ditutup</p>
                                <small class="text-muted">Formulir pendaftaran tidak dapat diakses oleh calon anggota.</small>
                            @endif
                        </div>
                    </div>

                    {{-- Toggle Button --}}
                    <form action="{{ route('admin.pengaturan-sistem.toggle') }}" method="POST" id="form-toggle-status"
                        class="{{ auth()->user()->role === 'pengurus' ? 'confirm-form' : '' }}">
                        @csrf
                        <button type="submit" id="btn-toggle-status" class="btn btn-block font-weight-bold py-2 {{ auth()->user()->role !== 'pengurus' ? 'disabled opacity-50' : '' }}" {{ auth()->user()->role !== 'pengurus' ? 'disabled' : '' }} style="border-radius: 0.6rem; font-size: 0.95rem;
                                background-color: {{ $statusPendaftaran === 'buka' ? '#ef4444' : '#10b981' }};
                                color: #fff; border: none; transition: all 0.2s;">
                            @if(auth()->user()->role !== 'pengurus')
                                <i class="fas fa-eye mr-2"></i> Mode Lihat (Khusus Pengurus)
                            @elseif($statusPendaftaran === 'buka')
                                <i class="fas fa-lock mr-2"></i> Tutup Pendaftaran Sekarang
                            @else
                                <i class="fas fa-lock-open mr-2"></i> Buka Pendaftaran Sekarang
                            @endif
                        </button>
                    </form>

                    <p class="text-muted text-center mt-3 mb-0" style="font-size: 0.78rem;">
                        <i class="fas fa-info-circle mr-1"></i>
                        Perubahan status berlaku secara langsung setelah dikonfirmasi.
                    </p>
                </div>
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- CARD 2: TAHUN PERIODE AKTIF --}}
        {{-- ============================================================ --}}
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                            style="width: 44px; height: 44px; background: rgba(99,102,241,0.1);">
                            <i class="fas fa-calendar-alt text-primary" style="font-size: 1.1rem;"></i>
                        </div>
                        <div>
                            <h6 class="font-weight-bold text-dark mb-0">Tahun Periode Aktif</h6>
                            <small class="text-muted">Tahun angkatan yang sedang berjalan</small>
                        </div>
                    </div>

                    {{-- Tampilan Tahun Aktif Saat Ini --}}
                    <div class="text-center py-3 mb-4 rounded-lg"
                        style="background: rgba(99,102,241,0.06); border-radius: 0.75rem; border: 1.5px solid rgba(99,102,241,0.2);">
                        <p class="text-muted mb-1"
                            style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Periode Aktif Saat
                            Ini</p>
                        <h1 class="font-weight-bold mb-0" style="font-size: 3rem; color: #4f46e5; letter-spacing: -2px;">
                            {{ $tahunAktif }}</h1>
                        <small class="text-muted">Angkatan {{ $tahunAktif }}</small>
                    </div>

                    {{-- Form Ganti Tahun --}}
                    <form action="{{ route('admin.pengaturan-sistem.update') }}" method="POST" class="{{ auth()->user()->role === 'pengurus' ? 'confirm-form' : '' }}"
                        data-confirm-title="Konfirmasi Ganti Tahun Aktif"
                        data-confirm-text="Anda akan mengubah tahun periode aktif. Data dari tahun sebelumnya akan otomatis menjadi arsip."
                        data-confirm-icon="warning">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="font-weight-600 text-muted small text-uppercase mb-2">Ganti Tahun Periode
                                Aktif</label>
                            <div class="input-group">
                                <input type="number" name="tahun_aktif" id="input-tahun-aktif"
                                    class="form-control @error('tahun_aktif') is-invalid @enderror"
                                    value="{{ old('tahun_aktif', $tahunAktif) }}" min="2000" max="2100" required {{ auth()->user()->role !== 'pengurus' ? 'disabled' : '' }}
                                    style="border-radius: 0.5rem 0 0 0.5rem; font-size: 1rem; font-weight: 600;">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary font-weight-bold" {{ auth()->user()->role !== 'pengurus' ? 'disabled' : '' }}
                                        style="border-radius: 0 0.5rem 0.5rem 0;">
                                        <i class="fas fa-save mr-1"></i> Simpan
                                    </button>
                                </div>
                                @error('tahun_aktif')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </form>

                    <div class="alert mb-0 py-2 px-3"
                        style="background: rgba(245,158,11,0.08); border: 1px solid rgba(245,158,11,0.3); border-radius: 0.5rem;">
                        <small class="text-warning font-weight-bold">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            Mengganti tahun aktif tidak akan menghapus data tahun sebelumnya. Data lama tetap tersimpan
                            sebagai arsip.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- CARD 3: ARSIP PER ANGKATAN --}}
    {{-- ============================================================ --}}
    <div class="card border-0 shadow-sm" style="border-radius: 1rem;">
        <div class="card-header bg-white border-bottom pt-4 pb-3" style="border-radius: 1rem 1rem 0 0;">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                        style="width: 38px; height: 38px; background: rgba(107,114,128,0.1);">
                        <i class="fas fa-archive text-secondary"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold text-dark mb-0"
                            style="text-transform: uppercase; letter-spacing: 0.5px;">Rekap Arsip Per Angkatan</h6>
                        <small class="text-muted">Ringkasan data pendaftar dari setiap tahun periode</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="vertical-align: middle;">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-top-0 border-bottom-0 text-muted px-4"
                                style="font-size: 0.82rem; font-weight: 700;">TAHUN / ANGKATAN</th>
                            <th class="border-top-0 border-bottom-0 text-muted text-center"
                                style="font-size: 0.82rem; font-weight: 700;">TOTAL PENDAFTAR</th>
                            <th class="border-top-0 border-bottom-0 text-muted text-center"
                                style="font-size: 0.82rem; font-weight: 700;">DISETUJUI</th>
                            <th class="border-top-0 border-bottom-0 text-muted text-center"
                                style="font-size: 0.82rem; font-weight: 700;">DINYATAKAN LULUS</th>
                            <th class="border-top-0 border-bottom-0 text-muted text-center"
                                style="font-size: 0.82rem; font-weight: 700;">TIDAK LULUS</th>
                            <th class="border-top-0 border-bottom-0 text-muted text-center"
                                style="font-size: 0.82rem; font-weight: 700;">STATUS</th>
                            <th class="border-top-0 border-bottom-0 text-muted text-right px-4"
                                style="font-size: 0.82rem; font-weight: 700;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($arsipPerTahun as $arsip)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle mr-3 d-flex align-items-center justify-content-center"
                                            style="width: 36px; height: 36px; min-width: 36px;
                                                background: {{ $arsip->tahun_periode == $tahunAktif ? 'rgba(99,102,241,0.12)' : 'rgba(107,114,128,0.08)' }};">
                                            <i class="fas fa-calendar {{ $arsip->tahun_periode == $tahunAktif ? 'text-primary' : 'text-secondary' }}"
                                                style="font-size: 0.8rem;"></i>
                                        </div>
                                        <div>
                                            <span class="font-weight-bold text-dark"
                                                style="font-size: 1rem;">{{ $arsip->tahun_periode }}</span>
                                            <br>
                                            <small class="text-muted">Angkatan {{ $arsip->tahun_periode }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 text-center">
                                    <span class="font-weight-bold"
                                        style="font-size: 1.1rem; color: #1f2937;">{{ $arsip->total_pendaftar }}</span>
                                    <br><small class="text-muted">pendaftar</small>
                                </td>
                                <td class="py-3 text-center">
                                    <span class="badge badge-pill px-3 py-2"
                                        style="background: rgba(16,185,129,0.1); color: #059669; font-size: 0.85rem; font-weight: 600;">
                                        {{ $arsip->total_approved }}
                                    </span>
                                </td>
                                <td class="py-3 text-center">
                                    <span class="badge badge-pill px-3 py-2"
                                        style="background: rgba(16,185,129,0.1); color: #059669; font-size: 0.85rem; font-weight: 600;">
                                        {{ $arsip->total_lulus }}
                                    </span>
                                </td>
                                <td class="py-3 text-center">
                                    <span class="badge badge-pill px-3 py-2"
                                        style="background: rgba(239,68,68,0.08); color: #dc2626; font-size: 0.85rem; font-weight: 600;">
                                        {{ $arsip->total_tidak_lulus }}
                                    </span>
                                </td>
                                <td class="py-3 text-center">
                                    @if($arsip->tahun_periode == $tahunAktif)
                                        <span class="badge badge-pill px-3 py-2 font-weight-bold"
                                            style="background: {{ $statusPendaftaran === 'buka' ? 'rgba(16,185,129,0.15)' : 'rgba(239,68,68,0.1)' }};
                                                       color: {{ $statusPendaftaran === 'buka' ? '#059669' : '#dc2626' }}; font-size: 0.8rem;">
                                            <i class="fas {{ $statusPendaftaran === 'buka' ? 'fa-circle text-success' : 'fa-circle text-danger' }}"
                                                style="font-size: 0.5rem; vertical-align: middle;"></i>
                                            {{ $statusPendaftaran === 'buka' ? 'Aktif · Buka' : 'Aktif · Tutup' }}
                                        </span>
                                    @else
                                        <span class="badge badge-pill px-3 py-2"
                                            style="background: rgba(107,114,128,0.1); color: #6b7280; font-size: 0.8rem;">
                                            <i class="fas fa-archive mr-1" style="font-size: 0.7rem;"></i> Arsip
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('admin.pendaftaran.index', ['tahun_periode' => $arsip->tahun_periode]) }}"
                                        class="btn btn-sm btn-outline-primary rounded-pill px-3 font-weight-bold"
                                        style="font-size: 0.8rem;">
                                        <i class="fas fa-eye mr-1"></i> Lihat Data
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-inbox mb-2" style="font-size: 2rem; display: block; opacity: 0.3;"></i>
                                    Belum ada data pendaftar di sistem.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('extra-js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.confirm-form').forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();

                    const title = form.dataset.confirmTitle || 'Konfirmasi tindakan';
                    const text = form.dataset.confirmText || 'Apakah Anda yakin ingin melanjutkan?';
                    const icon = form.dataset.confirmIcon || 'warning';

                    Swal.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        showCancelButton: true,
                        confirmButtonText: 'Ya, lanjutkan',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection