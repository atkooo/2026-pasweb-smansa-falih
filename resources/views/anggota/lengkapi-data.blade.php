@extends('layouts.admin')

@section('title', 'Lengkapi Data Anggota - Paskibra Ganesha')

@section('content')
<div class="mb-4 mt-2">
    <div class="alert alert-warning shadow-sm border-0 d-flex align-items-center p-4 mb-4" style="border-radius: 0.75rem; background: rgba(245, 158, 11, 0.12); color: #b45309;">
        <i class="fas fa-id-card fa-2x mr-3 text-warning"></i>
        <div>
            <h5 class="font-weight-bold mb-1" style="color: #92400e;">Lengkapi Biodata & Berkas Anggota</h5>
            <p class="mb-0 small" style="color: #b45309;">Akun Anda terdaftar sebagai <strong>Anggota Paskibra</strong>. Mohon melengkapi biodata diri, data orang tua, serta mengunggah berkas dokumen (KK, SKD, Surat Izin) terlebih dahulu untuk mengaktifkan akses ke Dashboard.</p>
        </div>
</div>

@if (session('warning'))
    <div class="alert alert-warning border-0 shadow-sm mb-4" style="border-radius: 0.75rem;">
        <i class="fas fa-exclamation-circle mr-2"></i> {{ session('warning') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger shadow-sm border-0 mb-4" style="border-radius: 0.75rem;">
        <h6 class="font-weight-bold mb-2"><i class="fas fa-exclamation-triangle mr-2"></i>Terdapat kesalahan pada isian form:</h6>
        <ul class="mb-0 small">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('lengkapi-data.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- SECTION A: BIODATA DIRI -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 0.75rem;">
        <div class="card-header bg-white border-bottom pt-4 pb-3">
            <h5 class="font-weight-bold text-primary mb-0"><i class="fas fa-user mr-2"></i> A. Biodata Pribadi</h5>
        </div>
        <div class="card-body p-4 p-md-5">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Nama Panggilan <span class="text-danger">*</span></label>
                    <input type="text" name="nama_panggilan" class="form-control" value="{{ old('nama_panggilan', $formulir->nama_panggilan ?? explode(' ', trim($user->nama_lengkap))[0]) }}" required placeholder="Contoh: Budi">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jenis_kelamin" class="form-control form-select" required>
                        <option value="" disabled {{ old('jenis_kelamin', $formulir->jenis_kelamin ?? '') == '' ? 'selected' : '' }}>Pilih Jenis Kelamin...</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $formulir->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki (Putra)</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $formulir->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan (Putri)</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $formulir->tempat_lahir === '-' ? '' : ($formulir->tempat_lahir ?? '')) }}" required placeholder="Contoh: Pontianak">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $formulir->tanggal_lahir ?? '') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Agama <span class="text-danger">*</span></label>
                    <select name="agama" class="form-control form-select" required>
                        <option value="" disabled {{ old('agama', $formulir->agama ?? '') == '' ? 'selected' : '' }}>Pilih Agama...</option>
                        <option value="Islam" {{ old('agama', $formulir->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ old('agama', $formulir->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Katolik" {{ old('agama', $formulir->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ old('agama', $formulir->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ old('agama', $formulir->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Khonghucu" {{ old('agama', $formulir->agama ?? '') == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">No. HP (WhatsApp Aktif) <span class="text-danger">*</span></label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $formulir->no_hp === '-' ? '' : ($formulir->no_hp ?? '')) }}" required placeholder="Contoh: 081234567890">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Asal Sekolah <span class="text-danger">*</span></label>
                    <input type="text" name="asal_sekolah" class="form-control" value="{{ old('asal_sekolah', $formulir->asal_sekolah ?? 'SMA Negeri 1 Pontianak') }}" required placeholder="Contoh: SMA Negeri 1 Pontianak">
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Alamat Rumah Lengkap <span class="text-danger">*</span></label>
                    <textarea name="alamat" class="form-control" rows="3" required placeholder="Nama jalan, RT/RW, desa/kelurahan, kecamatan">{{ old('alamat', $formulir->alamat === '-' ? '' : ($formulir->alamat ?? '')) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION B: DATA FISIK & PROFIL -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 0.75rem;">
        <div class="card-header bg-white border-bottom pt-4 pb-3">
            <h5 class="font-weight-bold text-primary mb-0"><i class="fas fa-child mr-2"></i> B. Data Fisik & Profil</h5>
        </div>
        <div class="card-body p-4 p-md-5">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                    <input type="number" name="tinggi_badan" class="form-control" value="{{ old('tinggi_badan', $formulir->tinggi_badan ?? 170) }}" required min="100" max="250" placeholder="Contoh: 170">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Berat Badan (kg) <span class="text-danger">*</span></label>
                    <input type="number" name="berat_badan" class="form-control" value="{{ old('berat_badan', $formulir->berat_badan ?? 60) }}" required min="30" max="200" placeholder="Contoh: 60">
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Riwayat Penyakit (jika ada)</label>
                    <textarea name="riwayat_penyakit" class="form-control" rows="2" placeholder="Kosongkan atau ketik 'Tidak ada' jika sehat">{{ old('riwayat_penyakit', $formulir->riwayat_penyakit === '-' ? 'Tidak ada' : ($formulir->riwayat_penyakit ?? 'Tidak ada')) }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Cita-cita <span class="text-danger">*</span></label>
                    <input type="text" name="cita_cita" class="form-control" value="{{ old('cita_cita', $formulir->cita_cita === '-' ? '' : ($formulir->cita_cita ?? '')) }}" required placeholder="Contoh: TNI / POLRI / Dokter / PNS">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Keterampilan Khusus</label>
                    <input type="text" name="keterampilan" class="form-control" value="{{ old('keterampilan', $formulir->keterampilan ?? '') }}" placeholder="Contoh: Olahraga, Bahasa Asing, Seni">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Ekskul Lain yang Diikuti</label>
                    <input type="text" name="ekskul_lain" class="form-control" value="{{ old('ekskul_lain', $formulir->ekskul_lain ?? '') }}" placeholder="Contoh: Pramuka, PMR (Kosongkan jika tidak ada)">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Pengalaman PBB (SMP/MTs) <span class="text-danger">*</span></label>
                    <select name="opsi_pilihan" class="form-control form-select" required>
                        <option value="YA" {{ old('opsi_pilihan', $formulir->opsi_pilihan ?? 'YA') == 'YA' ? 'selected' : '' }}>Pernah (YA)</option>
                        <option value="TIDAK" {{ old('opsi_pilihan', $formulir->opsi_pilihan ?? '') == 'TIDAK' ? 'selected' : '' }}>Belum (TIDAK)</option>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Motivasi Menjadi Anggota Paskibra <span class="text-danger">*</span></label>
                    <textarea name="motivasi" class="form-control" rows="2" required placeholder="Tuliskan alasan Anda bergabung...">{{ old('motivasi', $formulir->motivasi ?? 'Menjadi anggota resmi Paskibra SMAN 1 Pontianak') }}</textarea>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Motto Hidup <span class="text-danger">*</span></label>
                    <input type="text" name="motto_hidup" class="form-control" value="{{ old('motto_hidup', $formulir->motto_hidup === '-' ? '' : ($formulir->motto_hidup ?? 'Disiplin, Setia, Berani')) }}" required placeholder="Contoh: Disiplin, Setia, Berani">
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION C: DATA ORANG TUA / WALI -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 0.75rem;">
        <div class="card-header bg-white border-bottom pt-4 pb-3">
            <h5 class="font-weight-bold text-primary mb-0"><i class="fas fa-users mr-2"></i> C. Data Orang Tua / Wali</h5>
        </div>
        <div class="card-body p-4 p-md-5">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Nama Ayah <span class="text-danger">*</span></label>
                    <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah', $formulir->nama_ayah ?? '') }}" required placeholder="Masukkan nama ayah">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Pekerjaan Ayah <span class="text-danger">*</span></label>
                    <input type="text" name="pekerjaan_ayah" class="form-control" value="{{ old('pekerjaan_ayah', $formulir->pekerjaan_ayah ?? '') }}" required placeholder="Pekerjaan ayah">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Nama Ibu <span class="text-danger">*</span></label>
                    <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu', $formulir->nama_ibu ?? '') }}" required placeholder="Masukkan nama ibu">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Pekerjaan Ibu <span class="text-danger">*</span></label>
                    <input type="text" name="pekerjaan_ibu" class="form-control" value="{{ old('pekerjaan_ibu', $formulir->pekerjaan_ibu ?? '') }}" required placeholder="Pekerjaan ibu">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">Nama Wali (Opsional)</label>
                    <input type="text" name="nama_wali" class="form-control" value="{{ old('nama_wali', $formulir->nama_wali ?? '') }}" placeholder="Isi jika tinggal bersama wali">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-muted small">No. Telp / HP Orang Tua <span class="text-danger">*</span></label>
                    <input type="text" name="no_telp_ortu" class="form-control" value="{{ old('no_telp_ortu', $formulir->no_telp_ortu ?? '') }}" required placeholder="Contoh: 081234567890">
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION D: UNGGAH BERKAS DOKUMEN -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 0.75rem;">
        <div class="card-header bg-white border-bottom pt-4 pb-3">
            <h5 class="font-weight-bold text-primary mb-0"><i class="fas fa-file-upload mr-2"></i> D. Unggah Berkas Dokumen (PDF/Gambar, Maks 2MB)</h5>
        </div>
        <div class="card-body p-4 p-md-5">
            <div class="row">
                <!-- 1. Surat Izin Ortu -->
                <div class="col-md-4 mb-4">
                    <label class="form-label font-weight-bold text-muted small">Surat Izin Orang Tua @if(!$formulir || empty($formulir->upload_surat_izin)) <span class="text-danger">*</span> @endif</label>
                    <input type="file" id="input_surat_izin" name="upload_surat_izin" class="form-control-file border p-2 rounded w-100" accept=".pdf,.jpg,.jpeg,.png" @if(!$formulir || empty($formulir->upload_surat_izin)) required @endif>
                    @if($formulir && !empty($formulir->upload_surat_izin))
                        <small class="text-success d-block mt-1"><i class="fas fa-check-circle mr-1"></i> Berkas sudah terunggah</small>
                    @endif

                    <div id="preview_container_surat_izin" class="mt-3 text-center p-3 border rounded bg-light" style="{{ ($formulir && !empty($formulir->upload_surat_izin)) ? '' : 'display: none;' }}">
                        <div class="small font-weight-bold text-muted mb-2"><i class="fas fa-eye mr-1"></i> Preview Berkas:</div>
                        @if($formulir && !empty($formulir->upload_surat_izin))
                            @php $extSI = strtolower(pathinfo($formulir->upload_surat_izin, PATHINFO_EXTENSION)); @endphp
                            @if(in_array($extSI, ['jpg', 'jpeg', 'png', 'webp', 'gif']))
                                <img id="preview_img_surat_izin" src="{{ asset('storage/' . $formulir->upload_surat_izin) }}" class="img-fluid rounded border shadow-sm" style="max-height: 180px; object-fit: contain;">
                                <div id="preview_doc_surat_izin" class="p-2 d-none">
                                    <i class="fas fa-file-pdf text-danger fa-3x mb-2"></i>
                                    <div id="preview_name_surat_izin" class="small font-weight-bold text-dark text-truncate">{{ basename($formulir->upload_surat_izin) }}</div>
                                </div>
                            @else
                                <img id="preview_img_surat_izin" src="" class="img-fluid rounded border shadow-sm d-none" style="max-height: 180px; object-fit: contain;">
                                <div id="preview_doc_surat_izin" class="p-2">
                                    <i class="fas fa-file-pdf text-danger fa-3x mb-2"></i>
                                    <div id="preview_name_surat_izin" class="small font-weight-bold text-dark text-truncate">{{ basename($formulir->upload_surat_izin) }}</div>
                                </div>
                            @endif
                        @else
                            <img id="preview_img_surat_izin" src="" class="img-fluid rounded border shadow-sm d-none" style="max-height: 180px; object-fit: contain;">
                            <div id="preview_doc_surat_izin" class="p-2 d-none">
                                <i class="fas fa-file-pdf text-danger fa-3x mb-2"></i>
                                <div id="preview_name_surat_izin" class="small font-weight-bold text-dark text-truncate"></div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- 2. Surat Keterangan Dokter (SKD) -->
                <div class="col-md-4 mb-4">
                    <label class="form-label font-weight-bold text-muted small">Surat Keterangan Dokter (SKD) @if(!$formulir || empty($formulir->upload_skd)) <span class="text-danger">*</span> @endif</label>
                    <input type="file" id="input_skd" name="upload_skd" class="form-control-file border p-2 rounded w-100" accept=".pdf,.jpg,.jpeg,.png" @if(!$formulir || empty($formulir->upload_skd)) required @endif>
                    @if($formulir && !empty($formulir->upload_skd))
                        <small class="text-success d-block mt-1"><i class="fas fa-check-circle mr-1"></i> Berkas sudah terunggah</small>
                    @endif

                    <div id="preview_container_skd" class="mt-3 text-center p-3 border rounded bg-light" style="{{ ($formulir && !empty($formulir->upload_skd)) ? '' : 'display: none;' }}">
                        <div class="small font-weight-bold text-muted mb-2"><i class="fas fa-eye mr-1"></i> Preview Berkas:</div>
                        @if($formulir && !empty($formulir->upload_skd))
                            @php $extSKD = strtolower(pathinfo($formulir->upload_skd, PATHINFO_EXTENSION)); @endphp
                            @if(in_array($extSKD, ['jpg', 'jpeg', 'png', 'webp', 'gif']))
                                <img id="preview_img_skd" src="{{ asset('storage/' . $formulir->upload_skd) }}" class="img-fluid rounded border shadow-sm" style="max-height: 180px; object-fit: contain;">
                                <div id="preview_doc_skd" class="p-2 d-none">
                                    <i class="fas fa-file-pdf text-danger fa-3x mb-2"></i>
                                    <div id="preview_name_skd" class="small font-weight-bold text-dark text-truncate">{{ basename($formulir->upload_skd) }}</div>
                                </div>
                            @else
                                <img id="preview_img_skd" src="" class="img-fluid rounded border shadow-sm d-none" style="max-height: 180px; object-fit: contain;">
                                <div id="preview_doc_skd" class="p-2">
                                    <i class="fas fa-file-pdf text-danger fa-3x mb-2"></i>
                                    <div id="preview_name_skd" class="small font-weight-bold text-dark text-truncate">{{ basename($formulir->upload_skd) }}</div>
                                </div>
                            @endif
                        @else
                            <img id="preview_img_skd" src="" class="img-fluid rounded border shadow-sm d-none" style="max-height: 180px; object-fit: contain;">
                            <div id="preview_doc_skd" class="p-2 d-none">
                                <i class="fas fa-file-pdf text-danger fa-3x mb-2"></i>
                                <div id="preview_name_skd" class="small font-weight-bold text-dark text-truncate"></div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- 3. Kartu Keluarga (KK) -->
                <div class="col-md-4 mb-4">
                    <label class="form-label font-weight-bold text-muted small">Kartu Keluarga (KK) @if(!$formulir || empty($formulir->upload_kk)) <span class="text-danger">*</span> @endif</label>
                    <input type="file" id="input_kk" name="upload_kk" class="form-control-file border p-2 rounded w-100" accept=".pdf,.jpg,.jpeg,.png" @if(!$formulir || empty($formulir->upload_kk)) required @endif>
                    @if($formulir && !empty($formulir->upload_kk))
                        <small class="text-success d-block mt-1"><i class="fas fa-check-circle mr-1"></i> Berkas sudah terunggah</small>
                    @endif

                    <div id="preview_container_kk" class="mt-3 text-center p-3 border rounded bg-light" style="{{ ($formulir && !empty($formulir->upload_kk)) ? '' : 'display: none;' }}">
                        <div class="small font-weight-bold text-muted mb-2"><i class="fas fa-eye mr-1"></i> Preview Berkas:</div>
                        @if($formulir && !empty($formulir->upload_kk))
                            @php $extKK = strtolower(pathinfo($formulir->upload_kk, PATHINFO_EXTENSION)); @endphp
                            @if(in_array($extKK, ['jpg', 'jpeg', 'png', 'webp', 'gif']))
                                <img id="preview_img_kk" src="{{ asset('storage/' . $formulir->upload_kk) }}" class="img-fluid rounded border shadow-sm" style="max-height: 180px; object-fit: contain;">
                                <div id="preview_doc_kk" class="p-2 d-none">
                                    <i class="fas fa-file-pdf text-danger fa-3x mb-2"></i>
                                    <div id="preview_name_kk" class="small font-weight-bold text-dark text-truncate">{{ basename($formulir->upload_kk) }}</div>
                                </div>
                            @else
                                <img id="preview_img_kk" src="" class="img-fluid rounded border shadow-sm d-none" style="max-height: 180px; object-fit: contain;">
                                <div id="preview_doc_kk" class="p-2">
                                    <i class="fas fa-file-pdf text-danger fa-3x mb-2"></i>
                                    <div id="preview_name_kk" class="small font-weight-bold text-dark text-truncate">{{ basename($formulir->upload_kk) }}</div>
                                </div>
                            @endif
                        @else
                            <img id="preview_img_kk" src="" class="img-fluid rounded border shadow-sm d-none" style="max-height: 180px; object-fit: contain;">
                            <div id="preview_doc_kk" class="p-2 d-none">
                                <i class="fas fa-file-pdf text-danger fa-3x mb-2"></i>
                                <div id="preview_name_kk" class="small font-weight-bold text-dark text-truncate"></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-right mb-5">
        <button type="submit" class="btn btn-primary btn-lg shadow rounded-pill px-5 font-weight-bold">
            <i class="fas fa-save mr-2"></i> Simpan & Lanjutkan ke Dashboard
        </button>
    </div>
</form>
@endsection

@section('extra-js')
<script>
function setupFilePreview(inputId, imgId, docId, nameId, containerId) {
    const input = document.getElementById(inputId);
    if (!input) return;

    input.addEventListener('change', function() {
        const file = this.files[0];
        const container = document.getElementById(containerId);
        const img = document.getElementById(imgId);
        const doc = document.getElementById(docId);
        const name = document.getElementById(nameId);

        if (file) {
            container.style.display = 'block';
            const fileType = file.type;

            if (fileType.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    img.classList.remove('d-none');
                    if (doc) doc.classList.add('d-none');
                };
                reader.readAsDataURL(file);
            } else {
                img.classList.add('d-none');
                if (doc) {
                    doc.classList.remove('d-none');
                    if (name) name.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
                }
            }
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    setupFilePreview('input_surat_izin', 'preview_img_surat_izin', 'preview_doc_surat_izin', 'preview_name_surat_izin', 'preview_container_surat_izin');
    setupFilePreview('input_skd', 'preview_img_skd', 'preview_doc_skd', 'preview_name_skd', 'preview_container_skd');
    setupFilePreview('input_kk', 'preview_img_kk', 'preview_doc_kk', 'preview_name_kk', 'preview_container_kk');
});
</script>
@endsection
