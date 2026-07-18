@extends('layouts.admin')

@section('title', 'Galeri Foto')

@section('extra-css')
<style>
    .gallery-item {
        position: relative;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
        margin-bottom: 1.5rem;
        background-color: white;
    }
    .gallery-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    .gallery-img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }
    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 50%, rgba(0,0,0,0) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 1.25rem;
    }
    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }
    .gallery-title {
        color: white;
        font-weight: 600;
        margin-bottom: 0.25rem;
        font-size: 1.1rem;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
    }
    .gallery-date {
        color: rgba(255,255,255,0.8);
        font-size: 0.85rem;
    }
    .btn-delete {
        position: absolute;
        top: 1rem;
        right: 1rem;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: rgba(239, 68, 68, 0.9);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.2s ease;
        z-index: 10;
        cursor: pointer;
    }
    .gallery-item:hover .btn-delete {
        opacity: 1;
        transform: scale(1);
    }
    .btn-delete:hover {
        background: #dc2626;
        transform: scale(1.1) !important;
    }
    
    body.dark-mode .gallery-item {
        background-color: #1f2937;
    }
    body.dark-mode .modal-content {
        background-color: #1f2937;
        color: #f9fafb;
        border-color: #374151;
    }
    body.dark-mode .modal-header, body.dark-mode .modal-footer {
        border-color: #374151;
    }
    body.dark-mode .form-control {
        background-color: #374151;
        border-color: #4b5563;
        color: #f9fafb;
    }
    body.dark-mode .form-control:focus {
        border-color: #3b82f6;
    }
    body.dark-mode .close {
        color: #f9fafb;
    }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <div>
        <h3 class="font-weight-bold" style="letter-spacing: -0.5px; margin-bottom: 0.2rem;">Galeri Foto</h3>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">Manajemen dokumentasi dan foto kegiatan Paskibra.</p>
    </div>
    <div>
        <button class="btn px-4 py-2" style="background-color: #10b981; color: white; border-radius: 50rem; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3); font-weight: 600;" data-toggle="modal" data-target="#modal-add">
            <i class="fas fa-upload mr-2"></i> Unggah Foto
        </button>
    </div>
</div>

<div class="row">
    @forelse($galeris as $galeri)
    <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="gallery-item">
            <img src="{{ asset('storage/' . $galeri->file_foto) }}" alt="{{ $galeri->judul_foto }}" class="gallery-img">
            
            <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete" title="Hapus Foto">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
            
            <div class="gallery-overlay">
                <div class="gallery-title">{{ Str::limit($galeri->judul_foto, 40) }}</div>
                <div class="gallery-date">
                    <i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($galeri->tanggal_upload)->format('d M Y') }}
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="text-center py-5">
            <div class="text-muted mb-3"><i class="fas fa-images fa-4x" style="opacity: 0.2;"></i></div>
            <h5 class="text-muted">Galeri masih kosong. Silakan unggah foto pertama Anda!</h5>
        </div>
    </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $galeris->links() }}
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 1rem; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold">Unggah Foto Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label class="font-weight-bold">Judul/Deskripsi Singkat <span class="text-danger">*</span></label>
                        <input type="text" name="judul_foto" class="form-control" style="border-radius: 0.5rem;" placeholder="Cth: Latihan Pengibaran..." required>
                    </div>
                    
                    <div class="form-group mb-0">
                        <label class="font-weight-bold">Pilih File Foto <span class="text-danger">*</span></label>
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="customFile" name="file_foto" accept="image/*" required>
                            <label class="custom-file-label" for="customFile" style="border-radius: 0.5rem;">Cari foto...</label>
                        </div>
                        <small class="text-muted">Format yang diizinkan: JPG, JPEG, PNG, GIF. Maksimal ukuran file: 5MB.</small>
                        <img id="preview-img" src="#" alt="Preview" style="display: none; width: 100%; border-radius: 0.5rem; margin-top: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" style="border-radius: 0.5rem;" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn px-4" style="background-color: #10b981; color: white; border-radius: 0.5rem; font-weight: 600;">Unggah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    $(document).ready(function() {
        // Custom file input logic
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
        
        // Display validation errors if any
        @if($errors->any())
            let errorMsg = "";
            @foreach ($errors->all() as $error)
                errorMsg += "{{ $error }}\n";
            @endforeach
            alert(errorMsg);
        @endif
    });
</script>
@endsection
