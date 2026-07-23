@extends('layouts.admin')

@section('title', 'Profil Pengguna - Paskibra Ganesha')

@section('page-title', 'Profil Pengguna')

@section('content')
    <div class="row">
        <!-- Left Column: Summary Profile Card -->
        <div class="{{ $user->formulirPendaftaran ? 'col-lg-4 col-md-5 mb-4' : 'col-md-6 col-lg-5 mx-auto mb-4' }}">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 1rem;">
                <div class="card-body text-center pt-5 pb-5 d-flex flex-column justify-content-between">
                    <div>
                        <!-- Form Terpisah Khusus Auto-Upload Foto Profil -->
                        <form id="quickAvatarForm" action="{{ route('pengaturan.update') }}" method="POST" enctype="multipart/form-data" class="d-none">
                            @csrf
                            <input type="file" id="quickAvatarInput" name="foto" accept="image/*" onchange="document.getElementById('quickAvatarForm').submit();">
                        </form>

                        <!-- Form Hapus Foto Profil -->
                        <form id="hapusFotoForm" action="{{ route('pengaturan.hapusFoto') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                        <div class="mb-4 d-flex justify-content-center">
                            <div class="position-relative d-inline-block">
                                @if($user->foto)
                                    <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $user->nama_lengkap }}"
                                        class="rounded-circle shadow"
                                        style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #ef4444 !important; cursor: pointer;" onclick="document.getElementById('quickAvatarInput').click();" title="Klik untuk mengubah foto profil">
                                    
                                    <!-- Tombol Kamera (Ganti Foto) -->
                                    <div class="position-absolute bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow" style="bottom: 2px; right: 2px; width: 34px; height: 34px; border: 2px solid white; cursor: pointer;" onclick="document.getElementById('quickAvatarInput').click();" title="Ganti Foto Profil">
                                        <i class="fas fa-camera" style="font-size: 0.85rem;"></i>
                                    </div>
                                    <!-- Tombol Sampah (Hapus Foto) -->
                                    <div class="position-absolute bg-danger text-white rounded-circle d-flex align-items-center justify-content-center shadow" style="bottom: 2px; left: 2px; width: 34px; height: 34px; border: 2px solid white; cursor: pointer;" onclick="if(confirm('Apakah Anda yakin ingin menghapus foto profil ini?')) document.getElementById('hapusFotoForm').submit();" title="Hapus Foto Profil">
                                        <i class="fas fa-trash-alt" style="font-size: 0.85rem;"></i>
                                    </div>
                                @else
                                    <div
                                        style="width: 120px; height: 120px; border-radius: 50%; background-color: #ef4444; color: white; border: 4px solid #e9ecef; display: flex; align-items: center; justify-content: center; font-size: 3.5rem; font-weight: bold; cursor: pointer;" onclick="document.getElementById('quickAvatarInput').click();" title="Klik untuk memilih foto profil">
                                        {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                                    </div>
                                    <div class="position-absolute bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow" style="bottom: 2px; right: 2px; width: 34px; height: 34px; border: 2px solid white; cursor: pointer;" onclick="document.getElementById('quickAvatarInput').click();" title="Pilih Foto Profil">
                                        <i class="fas fa-camera" style="font-size: 0.85rem;"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <h4 class="font-weight-bold text-dark mb-2">{{ $user->nama_lengkap }}</h4>
                        <p class="text-muted mb-3">
                            @if($user->role === 'admin')
                                <span class="badge badge-danger px-4 py-2 rounded-pill"
                                    style="font-size: 0.9rem;">Administrator</span>
                            @elseif($user->role === 'pengurus')
                                <span class="badge badge-primary px-4 py-2 rounded-pill"
                                    style="font-size: 0.9rem;">Pengurus</span>
                            @elseif($user->role === 'anggota')
                                <span class="badge badge-success px-4 py-2 rounded-pill" style="font-size: 0.9rem;"><i
                                        class="fas fa-check-circle mr-1"></i> Anggota Paskibra</span>
                            @else
                                <span class="badge badge-info px-4 py-2 rounded-pill" style="font-size: 0.9rem;">Calon
                                    Anggota</span>
                            @endif
                        </p>

                        <div class="mt-4 pt-3 border-top text-left px-2">
                            <div class="d-flex mb-3">
                                <div class="mr-3 text-primary" style="font-size: 1.25rem; width: 30px; text-center;">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 font-weight-bold text-dark">NISN / NIP / ID Login</h6>
                                    <p class="text-muted mb-0">{{ $user->nisn ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="d-flex mb-3">
                                <div class="mr-3 text-primary" style="font-size: 1.25rem; width: 30px; text-center;">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 font-weight-bold text-dark">Bergabung Sejak</h6>
                                    <p class="text-muted mb-0">{{ $user->created_at->format('d M Y') }}</p>
                                </div>
                            </div>

                            @if($user->formulirPendaftaran)
                                <div class="d-flex">
                                    <div class="mr-3 text-success" style="font-size: 1.25rem; width: 30px; text-center;">
                                        <i class="fas fa-clipboard-check"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 font-weight-bold text-dark">Formulir Pendaftaran</h6>
                                        <p class="text-muted mb-0">Periode {{ $user->formulirPendaftaran->tahun_periode }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex flex-column gap-2">
                        <a href="{{ route('pengaturan.index') }}"
                            class="btn btn-outline-primary rounded-pill font-weight-bold mb-2">
                            <i class="fas fa-cog mr-2"></i> Pengaturan Akun
                        </a>
                        @if($user->role === 'anggota' || ($user->formulirPendaftaran && $user->formulirPendaftaran->status_kelulusan === 'LOLOS'))
                            <button type="button" class="btn btn-warning rounded-pill font-weight-bold text-dark shadow-sm"
                                data-toggle="modal" data-target="#ktaModal">
                                <i class="fas fa-id-card mr-2"></i> Cetak Kartu Anggota (KTA)
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if($user->formulirPendaftaran)
            @php
                $fp = $user->formulirPendaftaran;
            @endphp
            <!-- Right Column: Detail Formulir Pendaftaran -->
            <div class="col-lg-8 col-md-7 mb-4">
                <div class="card shadow-sm border-0" style="border-radius: 1rem;">
                    <div class="card-header bg-white border-bottom pt-4 pb-3 d-flex justify-content-between align-items-center">
                        <h5 class="font-weight-bold m-0 text-dark">
                            <i class="fas fa-id-badge text-primary mr-2"></i> Informasi Formulir Pendaftaran
                        </h5>
                        @if($fp->status_pendaftaran === 'approved' || $fp->status_pendaftaran === 'verified')
                            <span class="badge badge-success px-3 py-2 rounded-pill font-weight-bold">
                                <i class="fas fa-check-circle mr-1"></i> Berkas Terverifikasi
                            </span>
                        @elseif($fp->status_pendaftaran === 'revision')
                            <span class="badge badge-warning text-dark px-3 py-2 rounded-pill font-weight-bold" style="background-color: #fef3c7; color: #d97706;">
                                <i class="fas fa-edit mr-1"></i> Perlu Revisi Berkas
                            </span>
                        @elseif($fp->status_pendaftaran === 'rejected')
                            <span class="badge badge-danger px-3 py-2 rounded-pill font-weight-bold">
                                <i class="fas fa-times-circle mr-1"></i> Berkas Ditolak
                            </span>
                        @else
                            <span class="badge badge-warning text-dark px-3 py-2 rounded-pill font-weight-bold" style="background-color: #fef3c7; color: #d97706;">
                                <i class="fas fa-clock mr-1"></i> Menunggu Verifikasi (Pending)
                            </span>
                        @endif
                    </div>
                    <div class="card-body p-4">

                        @if($fp->status_pendaftaran === 'pending')
                            <div class="mb-4 p-4" style="border-radius: 1rem; background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); box-shadow: 0 8px 24px rgba(245,158,11,0.10); border: 1px solid rgba(245,158,11,0.15);">
                                <div class="d-flex align-items-start">
                                    <div class="mr-4 shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width:52px;height:52px;background:linear-gradient(135deg,#f59e0b,#d97706);box-shadow:0 6px 16px rgba(245,158,11,0.35);">
                                        <i class="fas fa-hourglass-half text-white" style="font-size:1.1rem;"></i>
                                    </div>
                                    <div>
                                        <span class="badge badge-pill mb-2 text-white" style="background:linear-gradient(135deg,#f59e0b,#d97706);font-size:0.7rem;letter-spacing:1px;padding:4px 12px;">⏳ DALAM REVIEW</span>
                                        <h6 class="font-weight-bold text-dark mb-1">Pendaftaran Dalam Proses Review</h6>
                                        <p class="text-muted small mb-0">Berkas formulir pendaftaran Anda telah diterima dan saat ini sedang berada dalam tahap pemeriksaan (review) oleh tim Pengurus.</p>
                                    </div>
                                </div>
                            </div>
                        @elseif($fp->status_pendaftaran === 'revision')
                            <div class="mb-4 p-4" style="border-radius: 1rem; background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%); box-shadow: 0 8px 24px rgba(217,119,6,0.10); border: 1px solid rgba(217,119,6,0.15);">
                                <div class="d-flex align-items-start">
                                    <div class="mr-4 shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width:52px;height:52px;background:linear-gradient(135deg,#f97316,#ea580c);box-shadow:0 6px 16px rgba(249,115,22,0.35);">
                                        <i class="fas fa-pen text-white" style="font-size:1.1rem;"></i>
                                    </div>
                                    <div>
                                        <span class="badge badge-pill mb-2 text-white" style="background:linear-gradient(135deg,#f97316,#ea580c);font-size:0.7rem;letter-spacing:1px;padding:4px 12px;">✎ PERLU REVISI</span>
                                        <h6 class="font-weight-bold text-dark mb-1">Perlu Revisi Berkas</h6>
                                        <p class="text-muted small mb-1">Pengurus meminta Anda memperbarui data/berkas pendaftaran. Catatan Pengurus:</p>
                                        <div class="bg-white p-2 rounded border text-dark small mb-2"><em>"{{ $fp->catatan_verifikasi ?: 'Mohon periksa kembali berkas pendaftaran Anda.' }}"</em></div>
                                        <a href="{{ route('pendaftaran.edit') }}" class="btn btn-sm btn-warning text-white rounded-pill font-weight-bold"><i class="fas fa-edit mr-1"></i> Perbarui Formulir Sekarang</a>
                                    </div>
                                </div>
                            </div>
                        @elseif($fp->status_pendaftaran === 'rejected')
                            <div class="mb-4 p-4" style="border-radius: 1rem; background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%); box-shadow: 0 8px 24px rgba(239,68,68,0.10); border: 1px solid rgba(239,68,68,0.15);">
                                <div class="d-flex align-items-start">
                                    <div class="mr-4 shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width:52px;height:52px;background:linear-gradient(135deg,#ef4444,#dc2626);box-shadow:0 6px 16px rgba(239,68,68,0.35);">
                                        <i class="fas fa-times text-white" style="font-size:1.2rem;"></i>
                                    </div>
                                    <div>
                                        <span class="badge badge-pill mb-2 text-white" style="background:linear-gradient(135deg,#ef4444,#dc2626);font-size:0.7rem;letter-spacing:1px;padding:4px 12px;">✕ DITOLAK</span>
                                        <h6 class="font-weight-bold text-dark mb-1">Berkas Ditolak</h6>
                                        <p class="text-muted small mb-0">Mohon maaf, berkas pendaftaran Anda belum dapat disetujui pada periode ini.</p>
                                        @if($fp->catatan_verifikasi)
                                            <div class="bg-white p-2 rounded border text-danger small mt-1"><em>Catatan: {{ $fp->catatan_verifikasi }}</em></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($fp->status_kelulusan === 'LOLOS' || $user->role === 'anggota')
                            <!-- Section 0: Status & Transkrip Nilai Kelulusan -->
                            <div class="p-3 mb-4 rounded border"
                                style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-color: #86efac !important;">
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <div>
                                        <span class="badge badge-success px-3 py-2 rounded-pill font-weight-bold mb-2">
                                            <i class="fas fa-medal mr-1"></i> STATUS: RESMI LOLOS SELEKSI
                                        </span>
                                        <h6 class="font-weight-bold text-dark mb-1">Penerimaan Anggota Paskibra Periode
                                            {{ $fp->tahun_periode }}</h6>
                                        <p class="text-muted small mb-0"><i class="fas fa-certificate text-success mr-1"></i>
                                            Selamat! Dinyatakan lulus seluruh tahapan seleksi fisik & akademik.</p>
                                    </div>
                                    @if(isset($kriterias) && $kriterias->count() > 0)
                                        @php
                                            $totalScore = 0;
                                            foreach ($kriterias as $k) {
                                                $h = $fp->hasilSeleksi->where('jenis_seleksi', $k->nama)->first();
                                                $totalScore += floatval($h->nilai ?? 0) * ($k->bobot / 100);
                                            }
                                        @endphp
                                        <div class="text-right mt-3 mt-md-0">
                                            <small class="text-muted d-block font-weight-bold">Akumulasi Nilai Akhir</small>
                                            <span class="font-weight-bold text-success"
                                                style="font-size: 1.5rem;">{{ number_format($totalScore, 2) }}</span>
                                            <small class="text-muted">/ 100</small>
                                        </div>
                                    @endif
                                </div>

                                @if(isset($kriterias) && $kriterias->count() > 0)
                                    <hr class="my-3" style="border-color: #bbf7d0;">
                                    <div class="row">
                                        @foreach($kriterias as $k)
                                            @php
                                                $hasilK = $fp->hasilSeleksi->where('jenis_seleksi', $k->nama)->first();
                                                $nilaiK = $hasilK ? floatval($hasilK->nilai) : 0;
                                                $isLulusK = $hasilK && $hasilK->status_lulus === 'lulus';
                                            @endphp
                                            <div class="col-md-3 col-sm-6 mb-2">
                                                <div class="p-2 bg-white rounded border shadow-sm">
                                                    <small class="text-muted d-block text-truncate"
                                                        style="font-size: 0.75rem; font-weight: 600;">{{ $k->nama }}</small>
                                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                                        <span class="font-weight-bold text-dark"
                                                            style="font-size: 0.95rem;">{{ number_format($nilaiK, 1) }}</span>
                                                        @if($hasilK)
                                                            <span class="badge {{ $isLulusK ? 'badge-success' : 'badge-danger' }}"
                                                                style="font-size: 0.7rem;">
                                                                {{ $isLulusK ? 'Lulus' : 'Tidak' }}
                                                            </span>
                                                        @else
                                                            <span class="badge badge-secondary" style="font-size: 0.7rem;">-</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- Section 1: Biodata Pribadi -->
                        <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-user mr-2"></i> Biodata Pribadi & Kontak
                        </h6>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Nama Panggilan</div>
                            <div class="col-sm-8 text-dark font-weight-bold">{{ $fp->nama_panggilan }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Tempat, Tanggal Lahir</div>
                            <div class="col-sm-8 text-dark">{{ $fp->tempat_lahir }},
                                {{ \Carbon\Carbon::parse($fp->tanggal_lahir)->format('d F Y') }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Jenis Kelamin / Agama</div>
                            <div class="col-sm-8 text-dark">{{ $fp->jenis_kelamin }} / {{ $fp->agama }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">No. WhatsApp / HP</div>
                            <div class="col-sm-8 text-dark">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $fp->no_hp) }}" target="_blank"
                                    class="text-success text-decoration-none font-weight-bold">
                                    <i class="fab fa-whatsapp mr-1"></i> {{ $fp->no_hp }}
                                </a>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Alamat Rumah</div>
                            <div class="col-sm-8 text-dark">{{ $fp->alamat }}</div>
                        </div>

                        <hr class="my-4">

                        <!-- Section 2: Data Akademik & Fisik -->
                        <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-graduation-cap mr-2"></i> Data Sekolah &
                            Fisik</h6>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Asal Sekolah</div>
                            <div class="col-sm-8 text-dark font-weight-bold">{{ $fp->asal_sekolah }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Tinggi & Berat Badan</div>
                            <div class="col-sm-8 text-dark">{{ $fp->tinggi_badan }} cm / {{ $fp->berat_badan }} kg</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Riwayat Penyakit</div>
                            <div class="col-sm-8 text-dark">{{ $fp->riwayat_penyakit ?: 'Tidak ada' }}</div>
                        </div>

                        <hr class="my-4">

                        <!-- Section 3: Data Tambahan & Motivasi -->
                        <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-star mr-2"></i> Minat & Motivasi</h6>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Pengalaman PBB (SMP/MTs)</div>
                            <div class="col-sm-8 text-dark"><span
                                    class="badge badge-info px-3 py-1 rounded-pill">{{ $fp->opsi_pilihan === 'YA' ? 'Pernah (YA)' : 'Belum (TIDAK)' }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Cita-cita</div>
                            <div class="col-sm-8 text-dark">{{ $fp->cita_cita }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Keterampilan Khusus</div>
                            <div class="col-sm-8 text-dark">{{ $fp->keterampilan ?: '-' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Ekskul Lain</div>
                            <div class="col-sm-8 text-dark">{{ $fp->ekskul_lain ?: '-' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Motivasi</div>
                            <div class="col-sm-8 text-dark">{{ $fp->motivasi }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Motto Hidup</div>
                            <div class="col-sm-8 text-dark"><em>"{{ $fp->motto_hidup }}"</em></div>
                        </div>

                        <hr class="my-4">

                        <!-- Section 4: Data Orang Tua -->
                        <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-users mr-2"></i> Data Orang Tua / Wali
                        </h6>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Nama Ayah / Pekerjaan</div>
                            <div class="col-sm-8 text-dark">{{ $fp->nama_ayah }} ({{ $fp->pekerjaan_ayah }})</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Nama Ibu / Pekerjaan</div>
                            <div class="col-sm-8 text-dark">{{ $fp->nama_ibu }} ({{ $fp->pekerjaan_ibu }})</div>
                        </div>
                        @if($fp->nama_wali)
                            <div class="row mb-3">
                                <div class="col-sm-4 text-muted font-weight-bold">Nama Wali</div>
                                <div class="col-sm-8 text-dark">{{ $fp->nama_wali }}</div>
                            </div>
                        @endif
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">No. Telepon Ortu</div>
                            <div class="col-sm-8 text-dark">{{ $fp->no_telp_ortu }}</div>
                        </div>

                        <hr class="my-4">

                        <!-- Section 5: Dokumen Berkas -->
                        <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-file-pdf mr-2"></i> Berkas Dokumen
                            Terlampir</h6>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="p-3 border rounded bg-light text-center">
                                    <i class="fas fa-file-pdf text-danger mb-2" style="font-size: 2rem;"></i>
                                    <h6 class="font-weight-bold text-dark small mb-2">Surat Izin Ortu</h6>
                                    <a href="{{ asset('storage/' . $fp->upload_surat_izin) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary rounded-pill font-weight-bold px-3">
                                        <i class="fas fa-download mr-1"></i> Unduh / Lihat
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="p-3 border rounded bg-light text-center">
                                    <i class="fas fa-file-pdf text-danger mb-2" style="font-size: 2rem;"></i>
                                    <h6 class="font-weight-bold text-dark small mb-2">Surat Ket. Dokter</h6>
                                    <a href="{{ asset('storage/' . $fp->upload_skd) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary rounded-pill font-weight-bold px-3">
                                        <i class="fas fa-download mr-1"></i> Unduh / Lihat
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="p-3 border rounded bg-light text-center">
                                    <i class="fas fa-file-image text-info mb-2" style="font-size: 2rem;"></i>
                                    <h6 class="font-weight-bold text-dark small mb-2">Kartu Keluarga (KK)</h6>
                                    <a href="{{ asset('storage/' . $fp->upload_kk) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary rounded-pill font-weight-bold px-3">
                                        <i class="fas fa-download mr-1"></i> Unduh / Lihat
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Modal Kartu Tanda Anggota (KTA) Digital -->
    <div class="modal fade" id="ktaModal" tabindex="-1" role="dialog" aria-labelledby="ktaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 1.25rem; overflow: hidden;">
                <div
                    class="modal-header bg-dark text-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="modal-title font-weight-bold mb-0" id="ktaModalLabel">
                        <i class="fas fa-id-card text-warning mr-2"></i> Kartu Tanda Anggota (KTA) Digital
                    </h5>
                    <button type="button" class="close text-white opacity-100" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4 bg-light text-center">

                    <div id="ktaPrintArea" class="d-flex flex-column align-items-center">
                        <!-- KTA Depan (Front Card) -->
                        <div class="kta-card shadow-lg text-left position-relative mb-3"
                            style="width: 480px; max-width: 100%; height: 280px; border-radius: 18px; background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #1e3a8a 100%); color: white; padding: 22px; box-shadow: 0 15px 35px rgba(0,0,0,0.35) !important; border: 2px solid #fbbf24; overflow: hidden;">

                            <!-- Watermark Pattern -->
                            <div class="position-absolute"
                                style="right: -40px; bottom: -40px; opacity: 0.12; pointer-events: none;">
                                <img src="{{ asset('images/logo.webp') }}" style="width: 280px; height: auto;">
                            </div>

                            <!-- KTA Header -->
                            <div class="d-flex align-items-center justify-content-between pb-2 mb-3"
                                style="border-bottom: 1px dashed rgba(251, 191, 36, 0.5);">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('images/sman1ptk-logo.webp') }}" style="height: 40px; width: auto;"
                                        class="mr-2">
                                    <div>
                                        <h6 class="font-weight-bold mb-0 text-uppercase text-warning"
                                            style="font-size: 0.78rem; letter-spacing: 0.8px;">PASKIBRA GANESHA</h6>
                                        <small class="d-block text-light"
                                            style="font-size: 0.65rem; opacity: 0.9; letter-spacing: 0.3px;">SMA NEGERI 1
                                            PONTIANAK</small>
                                    </div>
                                </div>
                                <img src="{{ asset('images/logo.webp') }}" style="height: 40px; width: auto;">
                            </div>

                            <!-- KTA Body -->
                            <div class="row align-items-center mt-2">
                                <div class="col-4 text-center">
                                    <div class="position-relative d-inline-block">
                                        @if($user->foto)
                                            <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $user->nama_lengkap }}"
                                                class="rounded-circle shadow"
                                                style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #fbbf24; margin: 0 auto; display: block;">
                                        @else
                                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-white font-weight-bold shadow"
                                                style="width: 80px; height: 80px; font-size: 2rem; color: #1e3a8a; border: 3px solid #fbbf24; margin: 0 auto;">
                                                {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div class="position-absolute bg-success rounded-circle d-flex align-items-center justify-content-center shadow"
                                            style="width: 22px; height: 22px; bottom: 2px; right: 2px; border: 2px solid white;">
                                            <i class="fas fa-check text-white" style="font-size: 0.6rem;"></i>
                                        </div>
                                    </div>
                                    <span class="badge badge-warning text-dark font-weight-bold mt-2 d-block mx-auto"
                                        style="font-size: 0.62rem; border-radius: 10px; width: fit-content; padding: 4px 10px;">ANGGOTA
                                        RESMI</span>
                                </div>
                                <div class="col-8 pl-1">
                                    <h6 class="font-weight-bold text-white mb-1 text-truncate"
                                        style="font-size: 1rem; letter-spacing: 0.3px;">
                                        {{ strtoupper($user->nama_lengkap) }}
                                    </h6>
                                    <p class="mb-1 text-warning font-weight-bold" style="font-size: 0.78rem;">
                                        NO. KTA:
                                        KTA-{{ $user->formulirPendaftaran->tahun_periode ?? date('Y') }}/00{{ $user->id }}
                                    </p>
                                    <div style="font-size: 0.73rem; opacity: 0.95;" class="text-light">
                                        <div class="mb-1"><i class="fas fa-id-badge text-warning mr-1"
                                                style="width: 14px;"></i> NISN: <strong>{{ $user->nisn ?? '-' }}</strong>
                                        </div>
                                        <div class="mb-1 text-truncate"><i class="fas fa-school text-warning mr-1"
                                                style="width: 14px;"></i>
                                            {{ $user->formulirPendaftaran->asal_sekolah ?? 'SMA Negeri 1 Pontianak' }}</div>
                                        <div><i class="fas fa-medal text-warning mr-1" style="width: 14px;"></i>
                                            Angkatan: <strong>{{ \App\Helpers\RomanHelper::getAngkatanRomawi($user->formulirPendaftaran->tahun_periode ?? date('Y')) }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- KTA Footer -->
                            <div class="position-absolute d-flex justify-content-between align-items-end"
                                style="bottom: 14px; left: 22px; right: 22px;">
                                <small class="text-light" style="font-size: 0.6rem; opacity: 0.8;"><i
                                        class="fas fa-shield-alt text-warning mr-1"></i> Card Verification Token
                                    Signed</small>
                                <div class="bg-white p-1 rounded shadow-sm">
                                    <i class="fas fa-qrcode text-dark" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="button" onclick="window.print()"
                            class="btn btn-warning font-weight-bold rounded-pill px-4 shadow-sm text-dark">
                            <i class="fas fa-print mr-2"></i> Cetak / Simpan KTA (Print / PDF)
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden !important;
            }

            #ktaPrintArea,
            #ktaPrintArea * {
                visibility: visible !important;
            }

            #ktaPrintArea {
                position: fixed !important;
                left: 50% !important;
                top: 30% !important;
                transform: translate(-50%, -50%) !important;
                width: 100% !important;
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
            }
        }
    </style>
@endsection