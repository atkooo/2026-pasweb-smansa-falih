@extends('layouts.admin')

@section('title', 'Kelola Profil & Info Website')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0" style="border-radius: 1rem;">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h4 class="card-title font-weight-bold mb-0" style="color: #111827; letter-spacing: -0.5px;">Profil Website</h4>
                <p class="text-muted mb-0 mt-1" style="font-size: 0.9rem;">Kelola konten Sejarah, Visi, dan Misi yang tampil di halaman publik.</p>
            </div>
            
            <form action="{{ route('profil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(session('success'))
                    <div class="px-4 pt-4 pb-0">
                        <x-alert type="success">
                            {{ session('success') }}
                        </x-alert>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="px-4 pt-4 pb-0">
                        <x-alert type="danger">
                            <ul class="mb-0 pl-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </x-alert>
                    </div>
                @endif
                <div class="card-body px-4 py-4">

                    <h5 class="font-weight-bold text-dark mb-3" style="border-bottom: 2px solid #f3f4f6; padding-bottom: 0.5rem;">Bagian Beranda & Unduhan</h5>
                    
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="font-weight-600 text-muted small text-uppercase">Teks Judul Beranda</label>
                                <input type="text" name="beranda_judul" class="form-control" placeholder="Contoh: PASKIBRA GANESHA" style="border-radius: 0.5rem;" value="{{ old('beranda_judul', $informasi['beranda_judul'] ?? 'PASKIBRA GANESHA') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="font-weight-600 text-muted small text-uppercase">Teks Subjudul Beranda</label>
                                <input type="text" name="beranda_subjudul" class="form-control" placeholder="Contoh: SMA NEGERI 1 PONTIANAK" style="border-radius: 0.5rem;" value="{{ old('beranda_subjudul', $informasi['beranda_subjudul'] ?? 'SMA NEGERI 1 PONTIANAK') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="font-weight-600 text-muted small text-uppercase">Deskripsi Sambutan</label>
                                <textarea name="beranda_deskripsi" class="form-control" rows="3" style="border-radius: 0.5rem;">{{ old('beranda_deskripsi', $informasi['beranda_deskripsi'] ?? 'Website Paskibra Ganesha SMA Negeri 1 Pontianak hadir sebagai media informasi serta sistem informasi seleksi penerimaan anggota...') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="font-weight-600 text-muted small text-uppercase">Gambar Background (Hero Image)</label>
                                @if(isset($informasi['beranda_background']))
                                    <div class="mb-2">
                                        <img src="{{ asset($informasi['beranda_background']) }}" alt="Hero Background" class="img-thumbnail" style="max-height: 150px;">
                                    </div>
                                @endif
                                <input type="file" name="beranda_background" class="form-control-file" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <h6 class="font-weight-bold text-dark mt-4 mb-3"><i class="fas fa-file-download mr-2 text-danger"></i>Dokumen Unduhan (Beranda)</h6>
                    <div class="row mb-5">
                        @for($i = 1; $i <= 4; $i++)
                        <div class="col-md-6 mb-3">
                            <div class="p-3 border rounded bg-light">
                                <div class="form-group mb-2">
                                    <label class="font-weight-600 text-muted small text-uppercase">Judul Dokumen {{ $i }}</label>
                                    <input type="text" name="doc{{ $i }}_judul" class="form-control form-control-sm" value="{{ old('doc'.$i.'_judul', $informasi['doc'.$i.'_judul'] ?? '') }}" placeholder="Contoh: Surat Izin Orang Tua">
                                </div>
                                <div class="form-group mb-0">
                                    <label class="font-weight-600 text-muted small text-uppercase">File Dokumen {{ $i }}</label>
                                    @if(isset($informasi['doc'.$i.'_file']))
                                        <div class="mb-1"><a href="{{ asset($informasi['doc'.$i.'_file']) }}" target="_blank" class="badge badge-primary"><i class="fas fa-paperclip"></i> File Tersimpan</a></div>
                                    @endif
                                    <input type="file" name="doc{{ $i }}_file" class="form-control-file form-control-sm" accept=".pdf,.doc,.docx">
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>

                    <h5 class="font-weight-bold text-dark mb-3" style="border-bottom: 2px solid #f3f4f6; padding-bottom: 0.5rem;">Bagian Sejarah Paskibra SMA N 1</h5>
                    
                    <div class="form-group mb-5">
                        <label class="font-weight-600 text-muted small text-uppercase">Gambar Sejarah</label>
                        @if(isset($informasi['gambar_sejarah']))
                            <div class="mb-2">
                                <img src="{{ asset($informasi['gambar_sejarah']) }}" alt="Gambar Sejarah" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        @endif
                        <input type="file" name="gambar_sejarah" class="form-control-file" accept="image/*">
                        <small class="form-text text-muted">Abaikan jika tidak ingin mengubah gambar sejarah SMAN 1.</small>
                    </div>

                    <h5 class="font-weight-bold text-dark mb-3 mt-4" style="border-bottom: 2px solid #f3f4f6; padding-bottom: 0.5rem;">Bagian Visi & Misi</h5>
                    
                    <div class="form-group mb-4">
                        <label class="font-weight-600 text-muted small text-uppercase">Gambar Bagian Visi</label>
                        @if(isset($informasi['gambar_visi']))
                            <div class="mb-2">
                                <img src="{{ asset($informasi['gambar_visi']) }}" alt="Gambar Visi" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        @endif
                        <input type="file" name="gambar_visi" class="form-control-file" accept="image/*">
                        <small class="form-text text-muted">Abaikan jika tidak ingin mengubah gambar.</small>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-600 text-muted small text-uppercase">Visi Paskibra</label>
                        <textarea name="visi" class="form-control" rows="3" style="border-radius: 0.5rem;">{{ old('visi', $informasi['visi'] ?? '') }}</textarea>
                    

                    <div class="form-group mb-4">
                        <label class="font-weight-600 text-muted small text-uppercase">Misi Paskibra</label>
                        <textarea name="misi" class="form-control" rows="6" style="border-radius: 0.5rem;">{{ old('misi', $informasi['misi'] ?? '') }}</textarea>
                        <small class="form-text text-muted mt-2">
                            <i class="fas fa-info-circle mr-1"></i> Pisahkan setiap poin misi menggunakan <strong>Baris Baru (Enter)</strong>. Setiap baris akan otomatis dibuat menjadi 1 kotak kartu misi di halaman depan.
                        </small>
                    </div>

                    <h5 class="font-weight-bold text-dark mb-3 mt-5" style="border-bottom: 2px solid #f3f4f6; padding-bottom: 0.5rem;">Bagian Struktur Organisasi (Susunan Pengurus)</h5>
                    
                    @php
                    $org_roles = [
                        ['id' => 'org_kepsek', 'label' => 'Kepala Sekolah'],
                        ['id' => 'org_pembina', 'label' => 'Pembina Paskibra'],
                        ['id' => 'org_ketua', 'label' => 'Ketua Paskibra'],
                        ['id' => 'org_wakil', 'label' => 'Wakil Ketua'],
                        ['id' => 'org_komandan', 'label' => 'Komandan Angkatan'],
                        ['id' => 'org_sekretaris', 'label' => 'Sekretaris'],
                        ['id' => 'org_bendahara', 'label' => 'Bendahara'],
                        ['id' => 'org_div_kesekretariatan', 'label' => 'Koord. Divisi Kesekretariatan'],
                        ['id' => 'org_div_acara', 'label' => 'Koord. Divisi Acara'],
                        ['id' => 'org_div_humas', 'label' => 'Koord. Divisi Humas'],
                        ['id' => 'org_div_upacara', 'label' => 'Koord. Divisi Upacara'],
                        ['id' => 'org_div_latihan', 'label' => 'Koord. Divisi Latihan']
                    ];
                    @endphp

                    <div class="row">
                        @foreach($org_roles as $role)
                        <div class="col-md-6 mb-4">
                            <div class="p-3 border rounded" style="background-color: #fcfcfc; border-color: #f0f0f0 !important;">
                                <h6 class="font-weight-bold text-dark mb-3"><i class="fas fa-user-circle mr-2 text-danger"></i>{{ $role['label'] }}</h6>
                                
                                <div class="form-group mb-3">
                                    <label class="font-weight-600 text-muted small text-uppercase">Nama</label>
                                    <input type="text" name="{{ $role['id'] }}_nama" class="form-control" style="border-radius: 0.5rem;" value="{{ old($role['id'].'_nama', $informasi[$role['id'].'_nama'] ?? '') }}">
                                </div>
                                
                                @if(in_array($role['id'], ['org_kepsek', 'org_pembina']))
                                <div class="form-group mb-3">
                                    <label class="font-weight-600 text-muted small text-uppercase">NIP</label>
                                    <input type="text" name="{{ $role['id'] }}_nip" class="form-control" style="border-radius: 0.5rem;" value="{{ old($role['id'].'_nip', $informasi[$role['id'].'_nip'] ?? '') }}">
                                </div>
                                @else
                                <div class="form-group mb-3">
                                    <label class="font-weight-600 text-muted small text-uppercase">Kelas</label>
                                    <input type="text" name="{{ $role['id'] }}_kelas" class="form-control" style="border-radius: 0.5rem;" value="{{ old($role['id'].'_kelas', $informasi[$role['id'].'_kelas'] ?? '') }}">
                                </div>
                                @endif
                                
                                <div class="form-group mb-0">
                                    <label class="font-weight-600 text-muted small text-uppercase">Unggah Foto</label>
                                    @if(isset($informasi[$role['id'].'_foto']))
                                        <div class="mb-2">
                                            <img src="{{ asset($informasi[$role['id'].'_foto']) }}" class="img-thumbnail" style="width: 80px; height: 80px; border-radius: 0.5rem; object-fit: cover; object-position: top center; aspect-ratio: 1/1;">
                                        </div>
                                    @endif
                                    <input type="file" name="{{ $role['id'] }}_foto" class="form-control-file" accept="image/*">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="card-footer bg-light border-0 text-right py-3" style="border-radius: 0 0 1rem 1rem;">
                    <button type="submit" class="btn btn-primary px-4 font-weight-bold shadow-sm" style="border-radius: 0.5rem; letter-spacing: 0.3px;">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
