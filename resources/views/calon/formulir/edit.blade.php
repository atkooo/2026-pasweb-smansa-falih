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

        <form action="{{ route('pendaftaran.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <!-- Kategori A: Biodata -->
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 0.75rem;">
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h5 class="font-weight-bold text-primary mb-0"><i class="fas fa-user-circle mr-2"></i> A. Silahkan Lengkapi biodata anda</h5>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Nama Panggilan *</label>
                            <input type="text" name="nama_panggilan" class="form-control" value="{{ old('nama_panggilan', $formulir->nama_panggilan ?? '') }}" required placeholder="Contoh: Budi">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Jenis Kelamin *</label>
                            <select name="jenis_kelamin" class="form-control form-select" required>
                                <option value="" disabled {{ old('jenis_kelamin', $formulir->jenis_kelamin ?? '') ? '' : 'selected' }}>Pilih Jenis Kelamin...</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $formulir->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki (Putra)</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $formulir->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan (Putri)</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Agama *</label>
                            <select name="agama" class="form-control form-select" required>
                                <option value="" disabled {{ old('agama', $formulir->agama ?? '') ? '' : 'selected' }}>Pilih Agama...</option>
                                <option value="Islam" {{ old('agama', $formulir->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama', $formulir->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama', $formulir->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama', $formulir->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama', $formulir->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama', $formulir->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">No. WhatsApp / HP *</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $formulir->no_hp ?? '') }}" required placeholder="Contoh: 081234567890">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Tempat Lahir *</label>
                            <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $formulir->tempat_lahir ?? '') }}" required placeholder="Contoh: Jakarta">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Tanggal Lahir *</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $formulir->tanggal_lahir ?? '') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Asal Sekolah *</label>
                            <input type="text" name="asal_sekolah" class="form-control" value="{{ old('asal_sekolah', $formulir->asal_sekolah ?? '') }}" required placeholder="Contoh: SMA Negeri 1 Pontianak">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label font-weight-bold text-muted small">Alamat Lengkap *</label>
                        <textarea name="alamat" class="form-control" rows="3" required placeholder="Sertakan nama jalan, RT/RW, desa, kecamatan">{{ old('alamat', $formulir->alamat ?? '') }}</textarea>
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
                            <input type="number" name="tinggi_badan" class="form-control" value="{{ old('tinggi_badan', $formulir->tinggi_badan ?? '') }}" required min="100" max="250" placeholder="Contoh: 170">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Berat Badan (kg) *</label>
                            <input type="number" name="berat_badan" class="form-control" value="{{ old('berat_badan', $formulir->berat_badan ?? '') }}" required min="30" max="200" placeholder="Contoh: 60">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label font-weight-bold text-muted small">Riwayat Penyakit (Jika ada)</label>
                        <textarea name="riwayat_penyakit" class="form-control" rows="2" placeholder="Kosongkan jika tidak ada">{{ old('riwayat_penyakit', $formulir->riwayat_penyakit ?? '') }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Cita-cita *</label>
                            <input type="text" name="cita_cita" class="form-control" value="{{ old('cita_cita', $formulir->cita_cita ?? '') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Keterampilan / Bakat</label>
                            <input type="text" name="keterampilan" class="form-control" value="{{ old('keterampilan', $formulir->keterampilan ?? '') }}" placeholder="Contoh: Menyanyi, Menari, Olahraga">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Ekskul yang diikuti selain paskibra</label>
                            <input type="text" name="ekskul_lain" class="form-control" value="{{ old('ekskul_lain', $formulir->ekskul_lain ?? '') }}" placeholder="Contoh: Pramuka, PMR (Kosongkan jika tidak ada)">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label font-weight-bold text-muted small">Motivasi mengikuti paskibra *</label>
                        <textarea name="motivasi" class="form-control" rows="3" required>{{ old('motivasi', $formulir->motivasi ?? '') }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label font-weight-bold text-muted small">Apakah di SMP/MTs pernah mengikuti ekskul baris berbaris? *</label>
                        <select name="opsi_pilihan" class="form-control form-select" required>
                            <option value="" disabled {{ old('opsi_pilihan', $formulir->opsi_pilihan ?? '') ? '' : 'selected' }}>Pilih Jawaban...</option>
                            <option value="YA" {{ old('opsi_pilihan', $formulir->opsi_pilihan ?? '') == 'YA' ? 'selected' : '' }}>YA</option>
                            <option value="TIDAK" {{ old('opsi_pilihan', $formulir->opsi_pilihan ?? '') == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label font-weight-bold text-muted small">Motto Hidup *</label>
                        <input type="text" name="motto_hidup" class="form-control" value="{{ old('motto_hidup', $formulir->motto_hidup ?? '') }}" required>
                    </div>
                    
                    <h6 class="font-weight-bold text-primary mt-5 mb-3 border-bottom pb-2"><i class="fas fa-file-upload mr-2"></i> Unggah Berkas Persyaratan</h6>
                    <div style="background: #fff3cd; border-left: 4px solid #f59e0b; border-radius: 0.5rem; padding: 0.75rem 1rem; margin-bottom: 1rem;">
                        <span style="color: #92400e; font-size: 0.875rem;">
                            <i class="fas fa-exclamation-triangle mr-2" style="color: #d97706;"></i>
                            <strong style="color: #78350f;">Perhatian:</strong> Ukuran maksimal setiap file adalah <strong style="color: #78350f;">2MB</strong>. Format yang diterima: <strong style="color: #78350f;">PDF, JPG, JPEG, PNG</strong>.
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Surat Izin Orang Tua/Wali</label>
                            @if(isset($formulir) && $formulir->upload_surat_izin)
                                <div class="mb-2">
                                    <button type="button" onclick="openPreviewModal('{{ asset('storage/' . $formulir->upload_surat_izin) }}', 'pdf')" class="btn btn-sm btn-outline-secondary rounded-pill">
                                        <i class="fas fa-eye mr-1"></i> Lihat Berkas Saat Ini
                                    </button>
                                </div>
                            @endif
                            <input type="file" id="file_surat_izin" name="upload_surat_izin" class="form-control p-1" accept=".pdf,.jpg,.jpeg,.png"
                                onchange="previewFile(this, 'preview_surat_izin')">
                            <div id="preview_surat_izin" class="file-preview-box mt-2" style="display:none;"></div>
                            <small class="text-muted d-block mt-1">Kosongkan jika tidak ingin mengubah berkas.</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Kartu Keluarga (KK)</label>
                            @if(isset($formulir) && $formulir->upload_kk)
                                <div class="mb-2">
                                    <button type="button" onclick="openPreviewModal('{{ asset('storage/' . $formulir->upload_kk) }}', 'pdf')" class="btn btn-sm btn-outline-secondary rounded-pill">
                                        <i class="fas fa-eye mr-1"></i> Lihat Berkas Saat Ini
                                    </button>
                                </div>
                            @endif
                            <input type="file" id="file_kk" name="upload_kk" class="form-control p-1" accept=".pdf,.jpg,.jpeg,.png"
                                onchange="previewFile(this, 'preview_kk')">
                            <div id="preview_kk" class="file-preview-box mt-2" style="display:none;"></div>
                            <small class="text-muted d-block mt-1">Kosongkan jika tidak ingin mengubah berkas.</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Surat Keterangan Dokter</label>
                            @if(isset($formulir) && $formulir->upload_skd)
                                <div class="mb-2">
                                    <button type="button" onclick="openPreviewModal('{{ asset('storage/' . $formulir->upload_skd) }}', 'pdf')" class="btn btn-sm btn-outline-secondary rounded-pill">
                                        <i class="fas fa-eye mr-1"></i> Lihat Berkas Saat Ini
                                    </button>
                                </div>
                            @endif
                            <input type="file" id="file_skd" name="upload_skd" class="form-control p-1" accept=".pdf,.jpg,.jpeg,.png"
                                onchange="previewFile(this, 'preview_skd')">
                            <div id="preview_skd" class="file-preview-box mt-2" style="display:none;"></div>
                            <small class="text-muted d-block mt-1">Kosongkan jika tidak ingin mengubah berkas.</small>
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
                            <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah', $formulir->nama_ayah ?? '') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Pekerjaan Ayah *</label>
                            <input type="text" name="pekerjaan_ayah" class="form-control" value="{{ old('pekerjaan_ayah', $formulir->pekerjaan_ayah ?? '') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Nama Ibu *</label>
                            <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu', $formulir->nama_ibu ?? '') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Pekerjaan Ibu *</label>
                            <input type="text" name="pekerjaan_ibu" class="form-control" value="{{ old('pekerjaan_ibu', $formulir->pekerjaan_ibu ?? '') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Nama Wali (Opsional)</label>
                            <input type="text" name="nama_wali" class="form-control" value="{{ old('nama_wali', $formulir->nama_wali ?? '') }}" placeholder="Isi jika Anda tinggal bersama wali">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-muted small">Nomor Telfon Ayah / Ibu / Wali *</label>
                            <input type="text" name="no_telp_ortu" class="form-control" value="{{ old('no_telp_ortu', $formulir->no_telp_ortu ?? '') }}" required placeholder="Contoh: 081234567890">
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

<!-- Modal Preview Berkas -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 0.75rem;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title font-weight-bold text-dark" id="previewModalLabel">Pratinjau Berkas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center pt-2 pb-4">
                <iframe id="previewFrame" src="" style="width: 100%; height: 60vh; border: none; border-radius: 0.5rem; box-shadow: inset 0 2px 4px 0 rgba(0,0,0,0.06);" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    function previewFile(input, previewId) {
        const box = document.getElementById(previewId);
        box.innerHTML = '';
        if (!input.files || !input.files[0]) { box.style.display = 'none'; return; }

        const file   = input.files[0];
        const isImg  = file.type.startsWith('image/');
        const isPdf  = file.type === 'application/pdf';
        const sizeMB = (file.size / 1024 / 1024).toFixed(2);
        const url    = URL.createObjectURL(file);

        if (isImg) {
            box.innerHTML = `
                <div style="position:relative; display:inline-block; width:100%;">
                    <img src="${url}" alt="preview"
                        style="width:100%; max-height:160px; object-fit:cover; border-radius:0.5rem; border:2px solid #e5e7eb; cursor:pointer;"
                        onclick="openPreviewModal('${url}', 'img')" title="Klik untuk perbesar">
                    <div style="background:rgba(0,0,0,0.55); color:#fff; font-size:0.72rem; padding:3px 8px; border-radius:0 0 0.5rem 0.5rem; text-align:center;">
                        📷 ${file.name} &nbsp;·&nbsp; ${sizeMB} MB &nbsp;
                        <span style="cursor:pointer; color:#fca5a5;" onclick="clearFile('${input.id}','${previewId}')">✕ Hapus</span>
                    </div>
                </div>`;
        } else if (isPdf) {
            box.innerHTML = `
                <div style="background:#f8f9fa; border:2px dashed #6b7280; border-radius:0.5rem; padding:12px 14px; display:flex; align-items:center; gap:10px;">
                    <i class="fas fa-file-pdf" style="font-size:1.8rem; color:#dc2626;"></i>
                    <div style="flex:1; min-width:0;">
                        <p style="margin:0; font-weight:600; font-size:0.85rem; color:#111; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">${file.name}</p>
                        <small style="color:#6b7280;">${sizeMB} MB &nbsp;·&nbsp;
                            <a href="#" onclick="openPreviewModal('${url}', 'pdf'); return false;" style="color:#3b82f6;">Pratinjau PDF</a>
                        </small>
                    </div>
                    <span onclick="clearFile('${input.id}','${previewId}')" style="cursor:pointer; color:#9ca3af; font-size:1.1rem;" title="Hapus">&times;</span>
                </div>`;
        }
        box.style.display = 'block';
    }

    function openPreviewModal(url, type) {
        const body = document.getElementById('previewModalBody');
        if (type === 'img') {
            body.innerHTML = `<img src="${url}" style="max-width:100%; max-height:75vh; border-radius:0.5rem; box-shadow:0 4px 6px rgba(0,0,0,0.1);">`;
        } else {
            body.innerHTML = `<iframe src="${url}" style="width:100%; height:65vh; border:none; border-radius:0.5rem;"></iframe>`;
        }
        $('#previewModal').modal('show');
    }

    function clearFile(inputId, previewId) {
        const input = document.getElementById(inputId);
        if (input) input.value = '';
        const box = document.getElementById(previewId);
        if (box) { box.innerHTML = ''; box.style.display = 'none'; }
    }
</script>
@endsection
