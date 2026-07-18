@extends('layouts.admin')

@section('title', 'Buat Pengumuman Baru - Paskibra')

@section('content')
<div class="mb-4 mt-2">
    <a href="{{ route('pengumuman.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill mb-3">
        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
    </a>
    <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Buat Pengumuman Baru</h3>
    <p class="text-muted" style="font-size: 0.95rem;">Tambahkan pengumuman baru untuk dibagikan kepada calon anggota.</p>
</div>

<div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
    <div class="card-body p-4">
        <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-dark">Judul Pengumuman <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required placeholder="Contoh: Hasil Seleksi Tahap 1">
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-dark">Kategori / Jenis <span class="text-danger">*</span></label>
                        <select name="jenis" class="form-control @error('jenis') is-invalid @enderror" required>
                            <option value="Info" {{ old('jenis') == 'Info' ? 'selected' : '' }}>Info Umum</option>
                            <option value="Penting" {{ old('jenis') == 'Penting' ? 'selected' : '' }}>Penting</option>
                            <option value="Jadwal" {{ old('jenis') == 'Jadwal' ? 'selected' : '' }}>Jadwal</option>
                            <option value="Hasil Seleksi" {{ old('jenis') == 'Hasil Seleksi' ? 'selected' : '' }}>Hasil Seleksi</option>
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label class="font-weight-bold text-dark">Isi Pengumuman <span class="text-danger">*</span></label>
                <textarea name="isi" id="summernote" class="form-control @error('isi') is-invalid @enderror" required>{{ old('isi') }}</textarea>
                @error('isi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label class="font-weight-bold text-dark">Lampiran File (Opsional)</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error('lampiran') is-invalid @enderror" id="lampiran" name="lampiran">
                    <label class="custom-file-label" for="lampiran">Pilih file...</label>
                </div>
                <small class="form-text text-muted">Format yang didukung: PDF, DOC, DOCX, JPG, PNG, JPEG. Maks: 5MB.</small>
                @error('lampiran')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <hr class="mt-5 mb-4">
            <div class="text-right">
                <button type="submit" class="btn btn-primary font-weight-bold rounded-pill px-4">
                    <i class="fas fa-paper-plane mr-2"></i> Publikasikan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,
            placeholder: 'Tuliskan isi pengumuman di sini...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        // Custom file input label
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endsection
