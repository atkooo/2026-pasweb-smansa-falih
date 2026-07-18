@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('extra-css')
<style>
    .card-custom {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .form-control-custom {
        border-radius: 0.5rem;
        border: 1px solid #d1d5db;
        padding: 0.75rem 1rem;
    }
    .form-control-custom:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }
    .note-editor.note-frame {
        border-radius: 0.5rem;
        border-color: #d1d5db;
    }
    
    body.dark-mode .card-custom {
        background-color: #1f2937;
    }
    body.dark-mode .form-control-custom {
        background-color: #374151;
        border-color: #4b5563;
        color: #f9fafb;
    }
    body.dark-mode .form-control-custom:focus {
        border-color: #ef4444;
    }
    body.dark-mode .note-editor.note-frame {
        border-color: #4b5563;
    }
    body.dark-mode .note-editor .note-toolbar {
        background-color: #374151;
        border-bottom-color: #4b5563;
    }
    body.dark-mode .note-editor .note-editing-area .note-editable {
        background-color: #1f2937;
        color: #f9fafb;
    }
</style>
@endsection

@section('content')
<div class="d-flex align-items-center mb-4 mt-2">
    <a href="{{ route('berita.index') }}" class="btn btn-light mr-3" style="border-radius: 50rem; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
        <i class="fas fa-arrow-left"></i>
    </a>
    <div>
        <h3 class="font-weight-bold" style="letter-spacing: -0.5px; margin-bottom: 0;">Edit Berita</h3>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-custom">
            <div class="card-body p-4">
                <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">Judul Berita <span class="text-danger">*</span></label>
                                <input type="text" name="judul" class="form-control form-control-custom" placeholder="Masukkan judul yang menarik..." required value="{{ old('judul', $berita->judul) }}">
                                @error('judul') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">Isi Konten <span class="text-danger">*</span></label>
                                <textarea name="isi" id="summernote" required>{{ old('isi', $berita->isi) }}</textarea>
                                @error('isi') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card bg-light" style="border-radius: 0.75rem; border: none;">
                                <div class="card-body">
                                    <h6 class="font-weight-bold mb-3"><i class="fas fa-cog mr-2"></i> Pengaturan Publikasi</h6>
                                    
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select name="kategori" class="form-control form-control-custom">
                                            <option value="Pengumuman" {{ old('kategori', $berita->kategori) == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                            <option value="Kegiatan" {{ old('kategori', $berita->kategori) == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                            <option value="Prestasi" {{ old('kategori', $berita->kategori) == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control form-control-custom">
                                            <option value="diterbitkan" {{ old('status', $berita->status) == 'diterbitkan' ? 'selected' : '' }}>Diterbitkan</option>
                                            <option value="draf" {{ old('status', $berita->status) == 'draf' ? 'selected' : '' }}>Draf</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group mt-4">
                                        <label>Foto Sampul</label>
                                        @if($berita->gambar_sampul)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $berita->gambar_sampul) }}" alt="Sampul Lama" style="width: 100%; border-radius: 0.5rem;">
                                                <small class="text-muted d-block mt-1">Gambar saat ini</small>
                                            </div>
                                        @endif
                                        <div class="custom-file mb-3">
                                            <input type="file" class="custom-file-input" id="customFile" name="gambar_sampul" accept="image/*">
                                            <label class="custom-file-label" for="customFile" style="border-radius: 0.5rem;">Ganti foto...</label>
                                        </div>
                                        @error('gambar_sampul') <small class="text-danger d-block mt-1">{{ $message }}</small> @enderror
                                        
                                        <img id="preview-img" src="#" alt="Preview" style="display: none; width: 100%; border-radius: 0.5rem; margin-top: 10px;">
                                    </div>
                                    
                                    <hr class="my-4">
                                    
                                    <button type="submit" class="btn btn-block py-2" style="background-color: #ef4444; color: white; border-radius: 0.5rem; font-weight: 600;">
                                        <i class="fas fa-save mr-2"></i> Perbarui Berita
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 400,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        // Show filename in custom file input
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            
            // Image preview
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview-img').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endsection
