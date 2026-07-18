@extends('layouts.admin')

@section('title', 'Formulir Pendaftaran - Paskibra Ganesha')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <div>
        <h3 class="font-weight-bold text-dark mb-0">Formulir Pendaftaran</h3>
        <p class="text-muted mb-0">Lengkapi biodata, data diri, data orang tua, dan unggah berkas Anda</p>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger shadow-sm border-0" style="border-radius: 0.75rem;">
                <h6 class="font-weight-bold mb-2"><i class="fas fa-exclamation-triangle mr-2"></i>Terdapat kesalahan pada isian form:</h6>
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Kategori A: Biodata -->
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 0.75rem;">
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h5 class="font-weight-bold text-primary mb-0"><i class="fas fa-user-circle mr-2"></i> A. Silahkan Lengkapi biodata anda</h5>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Nama Panggilan *</label>
                            <input type="text" name="nama_panggilan" class="form-control" value="{{ old('nama_panggilan') }}" required placeholder="Contoh: Budi">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Jenis Kelamin *</label>
                            <select name="jenis_kelamin" class="form-control form-select" required>
                                <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>Pilih Jenis Kelamin...</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki (Putra)</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan (Putri)</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Agama *</label>
                            <select name="agama" class="form-control form-select" required>
                                <option value="" disabled {{ old('agama') ? '' : 'selected' }}>Pilih Agama...</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">No. WhatsApp / HP *</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" required placeholder="Contoh: 081234567890">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Tempat Lahir *</label>
                            <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" required placeholder="Contoh: Jakarta">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Tanggal Lahir *</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Asal Sekolah *</label>
                            <input type="text" name="asal_sekolah" class="form-control" value="{{ old('asal_sekolah') }}" required placeholder="Contoh: SMA Negeri 1 Pontianak">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label font-weight-bold text-muted small">Alamat Lengkap *</label>
                        <textarea name="alamat" class="form-control" rows="3" required placeholder="Sertakan nama jalan, RT/RW, desa, kecamatan">{{ old('alamat') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Kategori B: Data Anda -->
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 0.75rem;">
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h5 class="font-weight-bold text-primary mb-0"><i class="fas fa-id-card mr-2"></i> B. Silahkan Lengkapi Data Anda</h5>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Tinggi Badan (cm) *</label>
                            <input type="number" name="tinggi_badan" class="form-control" value="{{ old('tinggi_badan') }}" required min="100" max="250" placeholder="Contoh: 170">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Berat Badan (kg) *</label>
                            <input type="number" name="berat_badan" class="form-control" value="{{ old('berat_badan') }}" required min="30" max="200" placeholder="Contoh: 60">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label font-weight-bold text-muted small">Riwayat Penyakit (Jika ada)</label>
                        <textarea name="riwayat_penyakit" class="form-control" rows="2" placeholder="Kosongkan jika tidak ada">{{ old('riwayat_penyakit') }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Cita-cita *</label>
                            <input type="text" name="cita_cita" class="form-control" value="{{ old('cita_cita') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Keterampilan / Bakat</label>
                            <input type="text" name="keterampilan" class="form-control" value="{{ old('keterampilan') }}" placeholder="Contoh: Menyanyi, Menari, Olahraga">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Ekskul yang diikuti selain paskibra</label>
                            <input type="text" name="ekskul_lain" class="form-control" value="{{ old('ekskul_lain') }}" placeholder="Contoh: Pramuka, PMR (Kosongkan jika tidak ada)">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label font-weight-bold text-muted small">Motivasi mengikuti paskibra *</label>
                        <textarea name="motivasi" class="form-control" rows="3" required>{{ old('motivasi') }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label font-weight-bold text-muted small">Apakah di SMP/MTs pernah mengikuti ekskul baris berbaris? *</label>
                        <select name="opsi_pilihan" class="form-control form-select" required>
                            <option value="" disabled {{ old('opsi_pilihan') ? '' : 'selected' }}>Pilih Jawaban...</option>
                            <option value="YA" {{ old('opsi_pilihan') == 'YA' ? 'selected' : '' }}>YA</option>
                            <option value="TIDAK" {{ old('opsi_pilihan') == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label font-weight-bold text-muted small">Motto Hidup *</label>
                        <input type="text" name="motto_hidup" class="form-control" value="{{ old('motto_hidup') }}" required>
                    </div>
                    
                    <h6 class="font-weight-bold text-primary mt-5 mb-3 border-bottom pb-2"><i class="fas fa-file-upload mr-2"></i> Unggah Berkas Persyaratan</h6>
                    <div class="alert alert-info border-0 shadow-sm" style="background: #eff6ff; border-radius: 0.5rem;">
                        <i class="fas fa-info-circle mr-2 text-primary"></i> <strong>Perhatian:</strong> Ukuran maksimal setiap file adalah <strong>2MB</strong>. Format: <strong>PDF, JPG, JPEG, PNG</strong>.
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Surat Izin Orang Tua/Wali *</label>
                            <input type="file" name="upload_surat_izin" class="form-control p-1" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Kartu Keluarga (KK) *</label>
                            <input type="file" name="upload_kk" class="form-control p-1" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Surat Keterangan Dokter *</label>
                            <input type="file" name="upload_skd" class="form-control p-1" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kategori C: Data Orang Tua -->
            <div class="card shadow-sm border-0 mb-5" style="border-radius: 0.75rem;">
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h5 class="font-weight-bold text-primary mb-0"><i class="fas fa-user-friends mr-2"></i> C. Silahkan Lengkapi Data Orang Tua</h5>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Nama Ayah *</label>
                            <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Pekerjaan Ayah *</label>
                            <input type="text" name="pekerjaan_ayah" class="form-control" value="{{ old('pekerjaan_ayah') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Nama Ibu *</label>
                            <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Pekerjaan Ibu *</label>
                            <input type="text" name="pekerjaan_ibu" class="form-control" value="{{ old('pekerjaan_ibu') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Nama Wali (Opsional)</label>
                            <input type="text" name="nama_wali" class="form-control" value="{{ old('nama_wali') }}" placeholder="Isi jika Anda tinggal bersama wali">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Nomor Telfon Ayah / Ibu / Wali *</label>
                            <input type="text" name="no_telp_ortu" class="form-control" value="{{ old('no_telp_ortu') }}" required placeholder="Contoh: 081234567890">
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mb-5">
                <a href="{{ route('dashboard') }}" class="btn btn-light border mr-3 px-4 font-weight-bold">Batal</a>
                <button type="submit" class="btn btn-primary px-5 font-weight-bold shadow-sm rounded-pill"><i class="fas fa-paper-plane mr-2"></i> Kirim Formulir Pendaftaran</button>
            </div>

        </form>
    </div>
</div>
@endsection
