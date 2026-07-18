@extends('layouts.admin')

@section('title', 'Kelola Nilai - Paskibra Ganesha')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <div>
        <a href="{{ route('seleksi.index') }}" class="text-muted text-decoration-none mb-2 d-inline-block"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Seleksi</a>
        <h3 class="font-weight-bold text-dark mb-0">Kelola Nilai: {{ $pendaftaran->nama_panggilan }}</h3>
    </div>
</div>

<div class="row">
    <!-- Form Input Nilai Baru -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h5 class="font-weight-bold m-0 text-dark"><i class="fas fa-plus-circle text-primary mr-2"></i> Tambah Nilai Tes</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('seleksi.store', $pendaftaran->id) }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-muted small">Jenis Seleksi / Tes</label>
                        <input type="text" name="jenis_seleksi" class="form-control" list="jenisTesList" required placeholder="Cth: Tes Fisik">
                        <datalist id="jenisTesList">
                            <option value="Tes Pengetahuan Umum (Tulis)"></option>
                            <option value="Tes Kesamaptaan / Fisik"></option>
                            <option value="Tes Peraturan Baris Berbaris (PBB)"></option>
                            <option value="Tes Wawancara / Mental Ideologi"></option>
                            <option value="Tes Keterampilan / Minat Bakat"></option>
                        </datalist>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-muted small">Nilai / Predikat</label>
                        <input type="text" name="nilai" class="form-control" required placeholder="Cth: 85 atau A">
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-muted small">Status Kelulusan</label>
                        <select name="status_lulus" class="form-select form-control" required>
                            <option value="1">Lulus</option>
                            <option value="0">Tidak Lulus</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label font-weight-bold text-muted small">Keterangan Tambahan (Opsional)</label>
                        <textarea name="keterangan" class="form-control" rows="2" placeholder="Cth: Kurang di bagian ketahanan fisik"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 font-weight-bold py-2 rounded-pill">
                        <i class="fas fa-save mr-2"></i> Simpan Nilai
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabel Rekap Nilai -->
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h5 class="font-weight-bold m-0 text-dark"><i class="fas fa-clipboard-list text-primary mr-2"></i> Rekap Nilai Seleksi</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-bottom-0 py-3 text-uppercase text-muted pl-4" style="font-size: 0.8rem;">Jenis Tes</th>
                                <th class="border-bottom-0 py-3 text-uppercase text-muted" style="font-size: 0.8rem;">Nilai</th>
                                <th class="border-bottom-0 py-3 text-uppercase text-muted" style="font-size: 0.8rem;">Keterangan</th>
                                <th class="border-bottom-0 py-3 text-uppercase text-muted" style="font-size: 0.8rem;">Status</th>
                                <th class="border-bottom-0 py-3 text-uppercase text-muted text-center pr-4" style="font-size: 0.8rem; width: 80px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendaftaran->hasilSeleksi as $hasil)
                            <tr>
                                <td class="pl-4 font-weight-bold text-dark">{{ $hasil->jenis_seleksi }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1 font-weight-bold" style="font-size: 0.9rem;">{{ $hasil->nilai }}</span>
                                </td>
                                <td><span class="text-muted small">{{ $hasil->keterangan ?: '-' }}</span></td>
                                <td>
                                    @if($hasil->status_lulus == 1)
                                        <span class="text-success font-weight-bold small"><i class="fas fa-check-circle mr-1"></i> Lulus</span>
                                    @else
                                        <span class="text-danger font-weight-bold small"><i class="fas fa-times-circle mr-1"></i> Gagal</span>
                                    @endif
                                </td>
                                <td class="text-center pr-4">
                                    <form action="{{ route('seleksi.destroy', $hasil->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data nilai ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger rounded-circle border" title="Hapus Nilai">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted mb-2"><i class="fas fa-clipboard text-light" style="font-size: 3rem;"></i></div>
                                    <h6 class="font-weight-bold text-muted">Belum ada nilai yang diinput</h6>
                                    <p class="text-muted small mb-0">Silakan tambahkan nilai tes melalui form di samping.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($pendaftaran->hasilSeleksi->count() > 0)
            <div class="card-footer bg-light border-top-0 p-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        @php
                            $totalLulus = $pendaftaran->hasilSeleksi->where('status_lulus', 1)->count();
                            $totalGagal = $pendaftaran->hasilSeleksi->where('status_lulus', 0)->count();
                        @endphp
                        <span class="text-muted small font-weight-bold">
                            Total: {{ $pendaftaran->hasilSeleksi->count() }} Tes
                            (<span class="text-success">{{ $totalLulus }} Lulus</span>, 
                            <span class="text-danger">{{ $totalGagal }} Gagal</span>)
                        </span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
