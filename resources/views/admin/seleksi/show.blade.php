@extends('layouts.admin')

@section('title', 'Input Nilai Seleksi - Paskibra')

@section('content')
    <div class="mb-4 mt-2 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Input Nilai Seleksi</h3>
            <p class="text-muted" style="font-size: 0.95rem;">Peserta:
                <strong>{{ strtoupper($pendaftaran->user->nama_lengkap ?? $pendaftaran->nama_panggilan) }}</strong></p>
        </div>
        <a href="{{ route('seleksi.index') }}" class="btn btn-light shadow-sm"
            style="border-radius: 10px; font-weight: 600;">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>


    @php
        $isLocked = in_array($pendaftaran->status_kelulusan, ['LOLOS', 'TIDAK LOLOS']);
        $isPengurus = auth()->user()->role === 'pengurus';
    @endphp

    @if(!$isPengurus)
        <div class="mb-4 p-4" style="border-radius: 1rem; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); box-shadow: 0 8px 24px rgba(59,130,246,0.08); border: 1px solid rgba(59,130,246,0.12);">
            <div class="d-flex align-items-start">
                <div class="mr-4 flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width:52px;height:52px;background:linear-gradient(135deg,#3b82f6,#2563eb);box-shadow:0 6px 16px rgba(59,130,246,0.30);">
                    <i class="fas fa-eye text-white" style="font-size:1.1rem;"></i>
                </div>
                <div>
                    <span class="badge badge-pill mb-2 text-white" style="background:linear-gradient(135deg,#3b82f6,#2563eb);font-size:0.7rem;letter-spacing:1px;padding:4px 12px;">👁 MODE LIHAT</span>
                    <h6 class="font-weight-bold text-dark mb-1">Mode Lihat (Admin Only)</h6>
                    <p class="mb-0 text-muted small">Input nilai seleksi dan penetapan kelulusan akhir hanya dapat dilakukan oleh role <strong>Pengurus</strong>.</p>
                </div>
            </div>
        </div>
    @endif

    @if($isLocked)
        <div class="mb-4 p-4" style="border-radius: 1rem; background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); box-shadow: 0 8px 24px rgba(245,158,11,0.10); border: 1px solid rgba(245,158,11,0.15);">
            <div class="d-flex align-items-start">
                <div class="mr-4 flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width:52px;height:52px;background:linear-gradient(135deg,#f59e0b,#d97706);box-shadow:0 6px 16px rgba(245,158,11,0.35);">
                    <i class="fas fa-lock text-white" style="font-size:1rem;"></i>
                </div>
                <div>
                    <span class="badge badge-pill mb-2 text-white" style="background:linear-gradient(135deg,#f59e0b,#d97706);font-size:0.7rem;letter-spacing:1px;padding:4px 12px;">🔒 TERKUNCI</span>
                    <h6 class="font-weight-bold text-dark mb-1">Status Kelulusan Telah Ditetapkan ({{ $pendaftaran->status_kelulusan }})</h6>
                    <p class="mb-0 text-muted small">Input/edit nilai dan perubahan status kelulusan peserta ini telah dikunci dan tidak dapat diubah lagi.</p>
                </div>
            </div>
        </div>
    @endif

    @if($errors->any())
        <x-alert type="danger">
            <ul class="mb-0 pl-4">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-alert>
    @endif

    <div class="row">
        <!-- Formulir Input Nilai -->
        <div class="col-lg-5 col-md-12 mb-4">
            <div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h6 class="font-weight-bold text-dark mb-0" style="text-transform: uppercase; letter-spacing: 0.5px;">
                        FORM INPUT NILAI</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('seleksi.store', $pendaftaran->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="font-weight-600 text-muted small text-uppercase">Jenis Seleksi (Kriteria)</label>
                            <select name="jenis_seleksi" class="form-control" required {{ ($isLocked || !$isPengurus) ? 'disabled' : '' }}
                                style="border-radius: 8px;">
                                <option value="">-- Pilih Kriteria --</option>
                                @foreach($kriterias as $k)
                                    <option value="{{ $k->nama }}">{{ $k->nama }} (Bobot: {{ $k->bobot }}%)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-600 text-muted small text-uppercase">Nilai</label>
                            <input type="number" name="nilai" class="form-control" required {{ ($isLocked || !$isPengurus) ? 'disabled' : '' }} style="border-radius: 8px;" placeholder="0 - 100" min="0" max="100" step="0.01">
                        </div>
                        <div class="form-group mb-2">
                            <label class="font-weight-600 text-muted small text-uppercase">Status Kelulusan</label>
                            <div class="d-flex align-items-center bg-light p-2"
                                style="border-radius: 8px; border: 1px solid #e9ecef;">
                                <i class="fas fa-magic text-primary mr-2"></i>
                                <small class="text-muted mb-0">Status lulus akan dihitung <strong>otomatis</strong>
                                    berdasarkan batas nilai kriteria.</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-600 text-muted small text-uppercase">Keterangan (Opsional)</label>
                            <textarea name="keterangan" class="form-control" {{ ($isLocked || !$isPengurus) ? 'disabled' : '' }}
                                style="border-radius: 8px;" rows="3" placeholder="Catatan khusus..."></textarea>
                        </div>
                        @if($isLocked)
                            <button type="button" disabled class="btn btn-secondary btn-block font-weight-bold"
                                style="border-radius: 8px;"><i class="fas fa-lock mr-2"></i> Form Terkunci</button>
                        @elseif(!$isPengurus)
                            <button type="button" disabled class="btn btn-secondary btn-block font-weight-bold"
                                style="border-radius: 8px;"><i class="fas fa-eye mr-2"></i> Mode Lihat (Admin)</button>
                        @else
                            <button type="submit" class="btn btn-primary btn-block"
                                style="border-radius: 8px; font-weight: 600;">Simpan Nilai</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <!-- Riwayat Nilai Peserta -->
        <div class="col-lg-7 col-md-12">
            <div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h6 class="font-weight-bold text-dark mb-0" style="text-transform: uppercase; letter-spacing: 0.5px;">
                        RIWAYAT NILAI PESERTA</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="vertical-align: middle;">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-top-0 border-bottom-0 text-muted px-4"
                                        style="font-size: 0.85rem; font-weight: 600;">KRITERIA</th>
                                    <th class="border-top-0 border-bottom-0 text-muted text-center"
                                        style="font-size: 0.85rem; font-weight: 600;">NILAI</th>
                                    <th class="border-top-0 border-bottom-0 text-muted text-center"
                                        style="font-size: 0.85rem; font-weight: 600;">STATUS</th>
                                    <th class="border-top-0 border-bottom-0 text-muted text-right px-4"
                                        style="font-size: 0.85rem; font-weight: 600;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendaftaran->hasilSeleksi as $hasil)
                                    <tr>
                                        <td class="px-4 py-3 align-middle font-weight-bold text-dark">
                                            {{ $hasil->jenis_seleksi }}</td>
                                        <td class="py-3 align-middle text-center font-weight-bold text-primary">
                                            {{ rtrim(rtrim(number_format($hasil->nilai, 14, '.', ''), '0'), '.') }}</td>
                                        <td class="py-3 align-middle text-center">
                                            @if($hasil->status_lulus === 'lulus')
                                                <span class="badge badge-success px-3 py-2 rounded-pill">Lulus</span>
                                            @else
                                                <span class="badge badge-danger px-3 py-2 rounded-pill">Tidak Lulus</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 align-middle text-right">
                                            @if($isLocked || !$isPengurus)
                                                <button disabled class="btn btn-sm btn-light text-muted rounded-circle"
                                                    title="{{ !$isPengurus ? 'Mode Lihat (Admin)' : 'Nilai Terkunci' }}">
                                                    <i class="fas {{ !$isPengurus ? 'fa-eye' : 'fa-lock' }}"></i>
                                                </button>
                                            @else
                                                <form action="{{ route('seleksi.destroy', $hasil->id) }}" method="POST"
                                                    class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-light text-danger rounded-circle"
                                                        title="Hapus">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">Belum ada nilai yang diinputkan
                                            untuk peserta ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Penetapan Hasil Akhir -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h6 class="font-weight-bold text-dark mb-0" style="text-transform: uppercase; letter-spacing: 0.5px;">
                        PENETAPAN KELULUSAN AKHIR</h6>
                </div>
                <div class="card-body">
                    @if($isLocked || !$isPengurus)
                        <div class="row align-items-center">
                            <div class="col-md-8 mb-3 mb-md-0">
                                <p class="text-muted mb-2">
                                    @if($isLocked)
                                        Status kelulusan akhir peserta telah ditetapkan dan dikunci. Nilai dan status tidak dapat diubah kembali.
                                    @else
                                        Status kelulusan akhir hanya dapat ditentukan dan disimpan oleh <strong>Pengurus</strong>.
                                    @endif
                                </p>
                                <div class="d-flex align-items-center">
                                    <label class="mr-3 font-weight-bold mb-0">Status saat ini:</label>
                                    @if($pendaftaran->status_kelulusan === 'LOLOS')
                                        <span class="badge badge-success px-3 py-2" style="font-size: 0.9rem;"><i
                                                class="fas fa-check-circle mr-1"></i> LOLOS</span>
                                    @elseif($pendaftaran->status_kelulusan === 'TIDAK LOLOS')
                                        <span class="badge badge-danger px-3 py-2" style="font-size: 0.9rem;"><i
                                                class="fas fa-times-circle mr-1"></i> TIDAK LOLOS</span>
                                    @else
                                        <span class="badge badge-secondary px-3 py-2" style="font-size: 0.9rem;">MENUNGGU</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <select disabled class="form-control font-weight-bold bg-light"
                                        style="border-radius: 8px 0 0 8px;">
                                        <option selected>{{ $pendaftaran->status_kelulusan ?? 'Menunggu' }}</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary font-weight-bold" disabled type="button"
                                            style="border-radius: 0 8px 8px 0;">
                                            <i class="fas {{ !$isPengurus ? 'fa-eye' : 'fa-lock' }} mr-1"></i>
                                            {{ !$isPengurus ? 'Mode Lihat' : 'Terkunci' }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <form action="{{ route('seleksi.kelulusan', $pendaftaran->id) }}" method="POST">
                            @csrf
                            <div class="row align-items-center">
                                <div class="col-md-8 mb-3 mb-md-0">
                                    <p class="text-muted mb-2">Tentukan apakah peserta ini lulus seleksi akhir Paskibra atau
                                        tidak. Keputusan ini akan ditampilkan di halaman status seleksi milik calon peserta.</p>
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 font-weight-bold mb-0">Status Saat Ini:</label>
                                        <span class="badge badge-secondary px-3 py-2" style="font-size: 0.9rem;">MENUNGGU</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <select name="status_kelulusan" class="form-control font-weight-bold" required
                                            style="border-radius: 8px 0 0 8px;">
                                            <option value="Menunggu" {{ is_null($pendaftaran->status_kelulusan) ? 'selected' : '' }}>Menunggu</option>
                                            <option value="LOLOS" {{ $pendaftaran->status_kelulusan === 'LOLOS' ? 'selected' : '' }}>LOLOS</option>
                                            <option value="TIDAK LOLOS" {{ $pendaftaran->status_kelulusan === 'TIDAK LOLOS' ? 'selected' : '' }}>TIDAK LOLOS</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary font-weight-bold" type="submit"
                                                style="border-radius: 0 8px 8px 0;">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection