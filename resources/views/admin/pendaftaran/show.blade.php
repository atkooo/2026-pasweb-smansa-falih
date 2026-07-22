@extends('layouts.admin')

@section('title', 'Detail Pendaftaran - Paskibra Ganesha')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <div>
        <a href="{{ route('admin.pendaftaran.index') }}" class="text-muted text-decoration-none mb-2 d-inline-block"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar</a>
        <h3 class="font-weight-bold text-dark mb-0">Detail Pendaftar: {{ $pendaftaran->nama_panggilan }}</h3>
    </div>
    <div>
        @if($pendaftaran->status_pendaftaran == 'pending')
            <span class="badge" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; padding: 0.6em 1em; font-size: 0.9rem;"><i class="fas fa-clock mr-1"></i> Menunggu Review</span>
        @elseif($pendaftaran->status_pendaftaran == 'approved')
            <span class="badge" style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 0.6em 1em; font-size: 0.9rem;"><i class="fas fa-check mr-1"></i> Disetujui</span>
        @elseif($pendaftaran->status_pendaftaran == 'revision')
            <span class="badge" style="background: rgba(245, 158, 11, 0.1); color: #d97706; padding: 0.6em 1em; font-size: 0.9rem;"><i class="fas fa-edit mr-1"></i> Revisi Berkas</span>
        @elseif($pendaftaran->status_pendaftaran == 'rejected')
            <span class="badge" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 0.6em 1em; font-size: 0.9rem;"><i class="fas fa-times mr-1"></i> Ditolak</span>
        @endif
    </div>
</div>

<div class="row">
    <!-- Kolom Kiri: Biodata -->
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h5 class="font-weight-bold m-0 text-dark"><i class="fas fa-user-circle text-primary mr-2"></i> Biodata Lengkap</h5>
            </div>
            <div class="card-body p-4">
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Nama Lengkap</div>
                    <div class="col-sm-8 text-dark">{{ $pendaftaran->user->nama_lengkap }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">NISN</div>
                    <div class="col-sm-8 text-dark">{{ $pendaftaran->user->nisn }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Nama Panggilan</div>
                    <div class="col-sm-8 text-dark">{{ $pendaftaran->nama_panggilan }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Tempat, Tanggal Lahir</div>
                    <div class="col-sm-8 text-dark">{{ $pendaftaran->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->format('d F Y') }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Agama</div>
                    <div class="col-sm-8 text-dark">{{ $pendaftaran->agama }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Jenis Kelamin</div>
                    <div class="col-sm-8 text-dark">{{ $pendaftaran->jenis_kelamin }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">No. HP (WhatsApp)</div>
                    <div class="col-sm-8 text-dark">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pendaftaran->no_hp) }}" target="_blank" class="text-success text-decoration-none">
                            <i class="fab fa-whatsapp mr-1"></i> {{ $pendaftaran->no_hp }}
                        </a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Alamat Lengkap</div>
                    <div class="col-sm-8 text-dark">{{ $pendaftaran->alamat }}</div>
                </div>
                
                <hr class="my-4">
                
                <h6 class="font-weight-bold text-dark mb-3"><i class="fas fa-school text-primary mr-2"></i> Data Akademik & Fisik</h6>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Asal Sekolah</div>
                    <div class="col-sm-8 text-dark">{{ $pendaftaran->asal_sekolah }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Tinggi / Berat Badan</div>
                    <div class="col-sm-8 text-dark">{{ $pendaftaran->tinggi_badan }} cm / {{ $pendaftaran->berat_badan }} kg</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Riwayat Penyakit</div>
                    <div class="col-sm-8 text-dark">{{ $pendaftaran->riwayat_penyakit ?: 'Tidak ada' }}</div>
                </div>
                
                <hr class="my-4">
                
                <h6 class="font-weight-bold text-dark mb-3"><i class="fas fa-star text-primary mr-2"></i> Profil Ekstra</h6>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Cita-cita</div>
                    <div class="col-sm-8 text-dark">{{ $pendaftaran->cita_cita }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Keterampilan Khusus</div>
                    <div class="col-sm-8 text-dark">{{ $pendaftaran->keterampilan ?: '-' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Ekskul Lain yg Diikuti</div>
                    <div class="col-sm-8 text-dark">{{ $pendaftaran->ekskul_lain ?: '-' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Motivasi Ikut Paskibra</div>
                    <div class="col-sm-8 text-dark">{{ $pendaftaran->motivasi }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Pengalaman PBB (SMP/MTs)</div>
                    <div class="col-sm-8 text-dark">{{ $pendaftaran->opsi_pilihan === 'YA' ? 'Pernah (YA)' : 'Belum (TIDAK)' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Motto Hidup</div>
                    <div class="col-sm-8 text-dark"><em>"{{ $pendaftaran->motto_hidup }}"</em></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Dokumen & Aksi -->
    <div class="col-md-4 mb-4">
        <!-- Card Tindakan -->
        <div class="card shadow-sm border-0 mb-4" style="border-radius: 0.75rem;">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h5 class="font-weight-bold m-0 text-dark"><i class="fas fa-gavel text-primary mr-2"></i> Tindakan Review</h5>
            </div>
            <div class="card-body p-4">
                @if(in_array($pendaftaran->status_pendaftaran, ['approved', 'rejected']))
                    <div class="alert alert-{{ $pendaftaran->status_pendaftaran == 'approved' ? 'success' : 'danger' }} mb-4 p-3 rounded-lg" style="font-size: 0.9rem;">
                        <i class="fas fa-lock mr-2"></i> Pendaftaran ini telah <strong>{{ $pendaftaran->status_pendaftaran == 'approved' ? 'Disetujui' : 'Ditolak' }}</strong> dan statusnya sudah dikunci.
                    </div>
                @else
                    <p class="text-muted small mb-4">Pilih tindakan untuk berkas formulir calon anggota ini. Tindakan akan mengubah status seleksi.</p>
                @endif
                
                <form action="{{ route('admin.pendaftaran.updateStatus', $pendaftaran->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="form-group mb-3">
                        <label for="catatan_verifikasi" class="font-weight-bold text-muted small">Catatan (Opsional)</label>
                        <textarea class="form-control" name="catatan_verifikasi" id="catatan_verifikasi" rows="2" placeholder="Alasan penolakan / revisi" {{ in_array($pendaftaran->status_pendaftaran, ['approved', 'rejected']) ? 'disabled' : '' }}>{{ $pendaftaran->catatan_verifikasi }}</textarea>
                    </div>

                    <button type="submit" name="status_pendaftaran" value="approved" class="btn btn-success w-100 font-weight-bold py-2 mb-2 rounded-pill {{ in_array($pendaftaran->status_pendaftaran, ['approved', 'rejected']) ? 'disabled opacity-50' : '' }}" {{ in_array($pendaftaran->status_pendaftaran, ['approved', 'rejected']) ? 'disabled' : '' }}>
                        <i class="fas fa-check mr-2"></i> Setujui 
                    </button>
                    
                    <button type="submit" name="status_pendaftaran" value="revision" class="btn btn-warning w-100 font-weight-bold py-2 mb-2 rounded-pill text-white {{ in_array($pendaftaran->status_pendaftaran, ['approved', 'rejected', 'revision']) ? 'disabled opacity-50' : '' }}" {{ in_array($pendaftaran->status_pendaftaran, ['approved', 'rejected', 'revision']) ? 'disabled' : '' }}>
                        <i class="fas fa-edit mr-2"></i> Minta Update (Revisi)
                    </button>

                    <button type="submit" name="status_pendaftaran" value="rejected" class="btn btn-danger w-100 font-weight-bold py-2 mb-3 rounded-pill {{ in_array($pendaftaran->status_pendaftaran, ['approved', 'rejected']) ? 'disabled opacity-50' : '' }}" {{ in_array($pendaftaran->status_pendaftaran, ['approved', 'rejected']) ? 'disabled' : '' }}>
                        <i class="fas fa-times mr-2"></i> Tolak
                    </button>
                    
                    @if(!in_array($pendaftaran->status_pendaftaran, ['approved', 'rejected']) && $pendaftaran->status_pendaftaran != 'pending')
                    <hr>
                    <button type="submit" name="status_pendaftaran" value="pending" class="btn btn-light border text-muted w-100 font-weight-bold py-2 rounded-pill">
                        <i class="fas fa-undo mr-2"></i> Kembalikan ke Pending
                    </button>
                    @endif
                </form>
            </div>
        </div>

        <!-- Card Dokumen Pendukung -->
        <div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h5 class="font-weight-bold m-0 text-dark"><i class="fas fa-folder-open text-primary mr-2"></i> Dokumen Berkas</h5>
            </div>
            <div class="card-body p-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 py-3 d-flex align-items-center justify-content-between border-bottom">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-file-pdf text-danger mr-3" style="font-size: 1.5rem;"></i>
                            <div>
                                <h6 class="mb-0 font-weight-bold text-dark">Surat Izin Ortu</h6>
                                <small class="text-muted">PDF Document</small>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $pendaftaran->upload_surat_izin) }}" target="_blank" class="btn btn-sm btn-light border rounded-circle" title="Lihat/Unduh">
                            <i class="fas fa-download text-primary"></i>
                        </a>
                    </li>
                    <li class="list-group-item px-0 py-3 d-flex align-items-center justify-content-between border-bottom">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-file-pdf text-danger mr-3" style="font-size: 1.5rem;"></i>
                            <div>
                                <h6 class="mb-0 font-weight-bold text-dark">Surat Keterangan Dokter</h6>
                                <small class="text-muted">PDF Document</small>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $pendaftaran->upload_skd) }}" target="_blank" class="btn btn-sm btn-light border rounded-circle" title="Lihat/Unduh">
                            <i class="fas fa-download text-primary"></i>
                        </a>
                    </li>
                    <li class="list-group-item px-0 py-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-file-image text-info mr-3" style="font-size: 1.5rem;"></i>
                            <div>
                                <h6 class="mb-0 font-weight-bold text-dark">Kartu Keluarga (KK)</h6>
                                <small class="text-muted">Image / PDF</small>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $pendaftaran->upload_kk) }}" target="_blank" class="btn btn-sm btn-light border rounded-circle" title="Lihat/Unduh">
                            <i class="fas fa-download text-primary"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
