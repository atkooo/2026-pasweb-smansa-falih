@extends('layouts.admin')

@section('title', 'Kelola Profil & Info Website')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0" style="border-radius: 1rem;">
            
            <form action="{{ route('profil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header d-flex p-0 bg-white border-bottom" style="border-radius: 1rem 1rem 0 0;">
                    <div class="p-3 pt-4">
                        <h4 class="card-title font-weight-bold mb-0" style="color: #111827; letter-spacing: -0.5px;">Profil Website</h4>
                        <p class="text-muted mb-0 mt-1 d-none d-sm-block" style="font-size: 0.9rem;">Kelola konten yang tampil di halaman publik.</p>
                    </div>
                    <ul class="nav nav-pills ml-auto p-3 pt-4" id="profil-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active font-weight-bold" id="tab-beranda-tab" data-toggle="pill" href="#tab-beranda" role="tab" aria-controls="tab-beranda" aria-selected="true" style="border-radius: 0.5rem;">Beranda & Unduhan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold mx-1" id="tab-sejarah-tab" data-toggle="pill" href="#tab-sejarah" role="tab" aria-controls="tab-sejarah" aria-selected="false" style="border-radius: 0.5rem;">Sejarah, Visi & Misi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" id="tab-struktur-tab" data-toggle="pill" href="#tab-struktur" role="tab" aria-controls="tab-struktur" aria-selected="false" style="border-radius: 0.5rem;">Struktur Organisasi</a>
                        </li>
                    </ul>
                </div>

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
                    <div class="tab-content" id="profil-tabsContent">
                        
                        <!-- TAB BERANDA -->
                        <div class="tab-pane fade show active" id="tab-beranda" role="tabpanel" aria-labelledby="tab-beranda-tab">
                            <h5 class="font-weight-bold text-dark mb-3" style="border-bottom: 2px solid #f3f4f6; padding-bottom: 0.5rem;">Pengaturan Halaman Beranda</h5>
                            
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
                                        <textarea name="beranda_deskripsi" class="form-control" rows="3" style="border-radius: 0.5rem;">{{ old('beranda_deskripsi', $informasi['beranda_deskripsi'] ?? '') }}</textarea>
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

                            <h5 class="font-weight-bold text-dark mt-4 mb-3" style="border-bottom: 2px solid #f3f4f6; padding-bottom: 0.5rem;"><i class="fas fa-file-download mr-2 text-danger"></i>Dokumen Unduhan (Beranda)</h5>
                            <div class="row">
                                @for($i = 1; $i <= 4; $i++)
                                <div class="col-md-6 mb-3">
                                    <div class="p-3 border rounded bg-light h-100">
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
                        </div>

                        <!-- TAB SEJARAH -->
                        <div class="tab-pane fade" id="tab-sejarah" role="tabpanel" aria-labelledby="tab-sejarah-tab">
                            <h5 class="font-weight-bold text-dark mb-3" style="border-bottom: 2px solid #f3f4f6; padding-bottom: 0.5rem;">Bagian Sejarah Paskibra SMA N 1</h5>
                            
                            <div class="form-group mb-4">
                                <label class="font-weight-600 text-muted small text-uppercase">Gambar Sejarah</label>
                                @if(isset($informasi['gambar_sejarah']))
                                    <div class="mb-2">
                                        <img src="{{ asset($informasi['gambar_sejarah']) }}" alt="Gambar Sejarah" class="img-thumbnail" style="max-height: 150px;">
                                    </div>
                                @endif
                                <input type="file" name="gambar_sejarah" class="form-control-file" accept="image/*">
                                <small class="form-text text-muted">Abaikan jika tidak ingin mengubah gambar sejarah SMAN 1.</small>
                            </div>

                            <div class="form-group mb-4">
                                <label class="font-weight-600 text-muted small text-uppercase">Sejarah Singkat (Tampil di Beranda)</label>
                                <textarea name="sejarah_singkat" class="form-control" rows="4" style="border-radius: 0.5rem;">{{ old('sejarah_singkat', $informasi['sejarah_singkat'] ?? '') }}</textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label class="font-weight-600 text-muted small text-uppercase">Paragraf 1 (Sejarah SMAN 1)</label>
                                <textarea name="sejarah_p1" class="form-control" rows="4" style="border-radius: 0.5rem;">{{ old('sejarah_p1', $informasi['sejarah_p1'] ?? '') }}</textarea>
                            </div>
                            
                            <div class="form-group mb-5">
                                <label class="font-weight-600 text-muted small text-uppercase">Paragraf 2 (Sejarah SMAN 1)</label>
                                <textarea name="sejarah_p2" class="form-control" rows="4" style="border-radius: 0.5rem;">{{ old('sejarah_p2', $informasi['sejarah_p2'] ?? '') }}</textarea>
                            </div>

                            <h5 class="font-weight-bold text-dark mb-3 mt-4" style="border-bottom: 2px solid #f3f4f6; padding-bottom: 0.5rem;">Bagian Sejarah Paskibra (Umum)</h5>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="font-weight-600 text-muted small text-uppercase">Paragraf 1 (Sejarah Umum)</label>
                                        <textarea name="sejarah_umum_p1" class="form-control" rows="4" style="border-radius: 0.5rem;">{{ old('sejarah_umum_p1', $informasi['sejarah_umum_p1'] ?? '') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="font-weight-600 text-muted small text-uppercase">Paragraf 2 (Sejarah Umum)</label>
                                        <textarea name="sejarah_umum_p2" class="form-control" rows="4" style="border-radius: 0.5rem;">{{ old('sejarah_umum_p2', $informasi['sejarah_umum_p2'] ?? '') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="font-weight-600 text-muted small text-uppercase">Paragraf 3 (Sejarah Umum)</label>
                                        <textarea name="sejarah_umum_p3" class="form-control" rows="4" style="border-radius: 0.5rem;">{{ old('sejarah_umum_p3', $informasi['sejarah_umum_p3'] ?? '') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="font-weight-600 text-muted small text-uppercase">Paragraf 4 (Sejarah Umum)</label>
                                        <textarea name="sejarah_umum_p4" class="form-control" rows="4" style="border-radius: 0.5rem;">{{ old('sejarah_umum_p4', $informasi['sejarah_umum_p4'] ?? '') }}</textarea>
                                    </div>
                                </div>
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
                            </div>

                            <div class="form-group mb-4">
                                <label class="font-weight-600 text-muted small text-uppercase">Misi Paskibra</label>
                                <textarea name="misi" class="form-control" rows="6" style="border-radius: 0.5rem;">{{ old('misi', $informasi['misi'] ?? '') }}</textarea>
                                <small class="form-text text-muted mt-2">
                                    <i class="fas fa-info-circle mr-1"></i> Pisahkan setiap poin misi menggunakan <strong>Baris Baru (Enter)</strong>. Setiap baris akan otomatis dibuat menjadi 1 kotak kartu misi di halaman depan.
                                </small>
                            </div>
                        </div>

                        <!-- TAB STRUKTUR -->
                        <div class="tab-pane fade" id="tab-struktur" role="tabpanel" aria-labelledby="tab-struktur-tab">
                            <h5 class="font-weight-bold text-dark mb-3" style="border-bottom: 2px solid #f3f4f6; padding-bottom: 0.5rem;">Susunan Kepengurusan & Organisasi</h5>
                            
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
                                    <div class="p-3 border rounded h-100" style="background-color: #fcfcfc; border-color: #f0f0f0 !important;">
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

                    </div> <!-- End Tab Content -->
                </div> <!-- End Card Body -->
                
                <div class="card-footer bg-light border-top text-right py-3" style="border-radius: 0 0 1rem 1rem;">
                    <button type="submit" class="btn btn-primary px-4 font-weight-bold shadow-sm" style="border-radius: 0.5rem; letter-spacing: 0.3px;">
                        <i class="fas fa-save mr-2"></i> Simpan Semua Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
