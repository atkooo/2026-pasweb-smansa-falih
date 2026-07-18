@extends('layouts.admin')

@section('title', 'Set Seleksi & Kriteria - Paskibra')

@section('content')
<div class="mb-4 mt-2 d-flex justify-content-between align-items-center">
    <div>
        <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Set Seleksi & Kriteria</h3>
        <p class="text-muted" style="font-size: 0.95rem;">Kelola standar bobot penilaian (PBB, Samapta, Kepribadian).</p>
    </div>
    <button type="button" class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#modalTambah" style="border-radius: 10px; font-weight: 600;">
        <i class="fas fa-plus mr-2"></i> Tambah Kriteria
    </button>
</div>

<div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
    <div class="card-header bg-white border-bottom pt-4 pb-3">
        <h6 class="font-weight-bold text-dark mb-0" style="text-transform: uppercase; letter-spacing: 0.5px;">PENGATURAN KRITERIA & BOBOT</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="vertical-align: middle;">
                <thead class="bg-light">
                    <tr>
                        <th class="border-top-0 border-bottom-0 text-muted px-4" style="font-size: 0.85rem; font-weight: 600;">NO</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600;">NAMA KRITERIA</th>
                        <th class="border-top-0 border-bottom-0 text-muted text-center" style="font-size: 0.85rem; font-weight: 600;">MIN. LULUS</th>
                        <th class="border-top-0 border-bottom-0 text-muted text-center" style="font-size: 0.85rem; font-weight: 600;">BOBOT (%)</th>
                        <th class="border-top-0 border-bottom-0 text-muted text-right px-4" style="font-size: 0.85rem; font-weight: 600;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalBobot = 0; @endphp
                    @forelse($kriterias as $index => $k)
                    @php $totalBobot += $k->bobot; @endphp
                    <tr>
                        <td class="px-4 py-3 align-middle">{{ $index + 1 }}</td>
                        <td class="py-3 align-middle font-weight-bold text-dark">{{ $k->nama }}</td>
                        <td class="py-3 align-middle text-center">
                            <span class="badge badge-warning px-3 py-2 rounded-pill text-dark">{{ $k->nilai_minimal_lulus }}</span>
                        </td>
                        <td class="py-3 align-middle text-center">
                            <span class="badge badge-info px-3 py-2 rounded-pill text-white">{{ $k->bobot }} %</span>
                        </td>
                        <td class="px-4 py-3 align-middle text-right">
                            <button type="button" class="btn btn-sm btn-light text-primary rounded-circle mr-1" data-toggle="modal" data-target="#modalEdit{{ $k->id }}" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('kriteria.destroy', $k->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kriteria ini? Ini dapat memengaruhi perhitungan nilai seleksi.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger rounded-circle" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit{{ $k->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $k->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content" style="border-radius: 1rem; border: none;">
                                <div class="modal-header border-bottom-0 pb-0">
                                    <h5 class="modal-title font-weight-bold" id="modalEditLabel{{ $k->id }}">Edit Kriteria</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('kriteria.update', $k->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="font-weight-600 text-muted small text-uppercase">Nama Kriteria</label>
                                            <input type="text" name="nama" class="form-control" value="{{ $k->nama }}" required style="border-radius: 8px;">
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="font-weight-600 text-muted small text-uppercase">Bobot (%)</label>
                                            <input type="number" name="bobot" class="form-control" value="{{ $k->bobot }}" min="0" max="100" required style="border-radius: 8px;">
                                            <small class="text-muted mt-1 d-block">Angka dari 0 hingga 100.</small>
                                        </div>
                                        <div class="form-group mt-3 mb-0">
                                            <label class="font-weight-600 text-muted small text-uppercase">Nilai Minimal Lulus</label>
                                            <input type="number" step="0.01" name="nilai_minimal_lulus" class="form-control" value="{{ $k->nilai_minimal_lulus }}" min="0" max="100" required style="border-radius: 8px;">
                                            <small class="text-muted mt-1 d-block">Batas nilai agar otomatis lolos.</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top-0 pt-0">
                                        <button type="button" class="btn btn-light" data-dismiss="modal" style="border-radius: 8px; font-weight: 500;">Batal</button>
                                        <button type="submit" class="btn btn-primary" style="border-radius: 8px; font-weight: 600;">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">Belum ada kriteria yang ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-light">
                    <tr>
                        <td colspan="2" class="text-right font-weight-bold text-dark py-3">TOTAL BOBOT :</td>
                        <td class="text-center font-weight-bold py-3">
                            <span class="badge {{ $totalBobot == 100 ? 'badge-success' : 'badge-danger' }} px-3 py-2 rounded-pill text-white">{{ $totalBobot }} %</span>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@if($totalBobot != 100)
<div class="alert alert-warning border mt-3" style="border-radius: 12px;">
    <i class="fas fa-exclamation-triangle mr-2"></i> Peringatan: Total bobot saat ini adalah <strong>{{ $totalBobot }}%</strong>. Disarankan total keseluruhan bobot kriteria berjumlah tepat <strong>100%</strong> agar kalkulasi nilai seleksi akurat.
</div>
@endif

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 1rem; border: none;">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title font-weight-bold" id="modalTambahLabel">Tambah Kriteria Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('kriteria.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-600 text-muted small text-uppercase">Nama Kriteria</label>
                        <input type="text" name="nama" class="form-control" required style="border-radius: 8px;" placeholder="Contoh: Tes Wawancara">
                    </div>
                    <div class="form-group mb-0">
                        <label class="font-weight-600 text-muted small text-uppercase">Bobot (%)</label>
                        <input type="number" name="bobot" class="form-control" required style="border-radius: 8px;" placeholder="Contoh: 20" min="0" max="100">
                    </div>
                    <div class="form-group mt-3 mb-0">
                        <label class="font-weight-600 text-muted small text-uppercase">Nilai Minimal Lulus</label>
                        <input type="number" step="0.01" name="nilai_minimal_lulus" class="form-control" required style="border-radius: 8px;" placeholder="Contoh: 75" min="0" max="100">
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light" data-dismiss="modal" style="border-radius: 8px; font-weight: 500;">Batal</button>
                    <button type="submit" class="btn btn-primary" style="border-radius: 8px; font-weight: 600;">Tambah Kriteria</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
