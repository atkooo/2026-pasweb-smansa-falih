@extends('layouts.admin')

@section('title', 'Edit Berita - Paskibra')

@section('content')
<div class="mb-4 mt-2 d-flex justify-content-between align-items-center">
    <div>
        <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Edit Berita</h3>
        <p class="text-muted" style="font-size: 0.95rem;">Perbarui informasi atau pengumuman yang sudah ada.</p>
    </div>
    <a href="{{ route('berita.index') }}" class="btn btn-light shadow-sm px-4 text-dark" style="border-radius: 10px; font-weight: 600;">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
</div>

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 0.5rem;">
        <i class="fas fa-exclamation-triangle mr-2"></i> <strong>Gagal menyimpan!</strong> Periksa kembali isian Anda.
        <ul class="mb-0 mt-1 pl-4">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <!-- Main Content Column -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem;">
                <div class="card-body p-4">
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-dark">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control form-control-lg text-dark" value="{{ old('judul', $berita->judul) }}" required placeholder="Masukkan judul berita yang menarik" style="border-radius: 0.5rem; font-size: 1.1rem;">
                    </div>
                    
                    <div class="form-group mb-0">
                        <label class="font-weight-bold text-dark">Isi Berita <span class="text-danger">*</span></label>
                        <textarea name="isi" class="form-control text-dark" rows="15" required placeholder="Tuliskan isi berita atau pengumuman di sini..." style="border-radius: 0.5rem;">{{ old('isi', $berita->isi) }}</textarea>
                        <small class="form-text text-muted mt-2"><i class="fas fa-info-circle mr-1"></i> Mendukung penggunaan baris baru (Enter).</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar Column -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h6 class="font-weight-bold text-dark mb-0">Pengaturan Publikasi</h6>
                </div>
                <div class="card-body p-4">
                    <div class="form-group mb-4">
                        <label class="font-weight-600 text-muted small text-uppercase">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" class="form-control" required style="border-radius: 0.5rem;">
                            <option value="Pengumuman" {{ old('kategori', $berita->kategori) == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                            <option value="Kegiatan" {{ old('kategori', $berita->kategori) == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                            <option value="Prestasi" {{ old('kategori', $berita->kategori) == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                            <option value="Lainnya" {{ old('kategori', $berita->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-600 text-muted small text-uppercase">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" required style="border-radius: 0.5rem;">
                            <option value="diterbitkan" {{ old('status', $berita->status) == 'diterbitkan' ? 'selected' : '' }}>Diterbitkan (Publik)</option>
                            <option value="draf" {{ old('status', $berita->status) == 'draf' ? 'selected' : '' }}>Draf (Sembunyikan)</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h6 class="font-weight-bold text-dark mb-0">Gambar Sampul</h6>
                </div>
                <div class="card-body p-4">
                    @if($berita->gambar_sampul)
                        <div class="mb-3 text-center">
                            <img src="{{ asset('storage/' . $berita->gambar_sampul) }}" alt="Preview" class="img-fluid rounded shadow-sm" style="max-height: 150px;">
                        </div>
                    @endif
                    <div class="form-group mb-0">
                        <div class="custom-file">
                            <input type="file" name="gambar_sampul" class="custom-file-input" id="gambar_sampul" accept="image/jpeg,image/png,image/jpg,image/gif">
                            <label class="custom-file-label" for="gambar_sampul" style="border-radius: 0.5rem;">Ganti gambar...</label>
                        </div>
                        <small class="form-text text-muted mt-2">
                            Abaikan jika tidak ingin mengubah gambar. Format: JPG, PNG. Maks: 2 MB.
                        </small>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block shadow-sm py-3" style="border-radius: 0.5rem; font-weight: 600; font-size: 1.05rem;">
                <i class="fas fa-save mr-2"></i> Perbarui Berita
            </button>
        </div>
    </div>
</form>

@push('scripts')
<script>
    // Menampilkan nama file di custom-file-input
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
@endpush
@endsection
