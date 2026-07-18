@extends('layouts.admin')

@section('title', 'Kelola Galeri Foto - Paskibra')

@section('content')
<div class="mb-4 mt-2 d-flex justify-content-between align-items-center">
    <div>
        <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Galeri Foto</h3>
        <p class="text-muted" style="font-size: 0.95rem;">Kelola dokumentasi kegiatan dan foto Paskibra.</p>
    </div>
    <button type="button" class="btn btn-primary shadow-sm px-4" data-toggle="modal" data-target="#addFotoModal" style="border-radius: 10px; font-weight: 600;">
        <i class="fas fa-plus mr-2"></i> Tambah Foto
    </button>
</div>

@if($errors->any())
    <x-alert type="danger">
        <i class="fas fa-exclamation-triangle mr-2"></i> <strong>Gagal Mengunggah Foto!</strong>
        <ul class="mb-0 mt-1 pl-4">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif

<!-- Grid Foto -->
<div class="row">
    @forelse($albums as $album)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card border-0 h-100 gallery-card-admin">
                <div class="card-img-wrapper-admin">
                    <img src="{{ asset('storage/' . $album->cover_photo) }}" alt="{{ $album->judul_foto }}" class="gallery-img-admin">
                    <div class="img-overlay-admin d-flex flex-column gap-2" style="z-index: 10;">
                        <a href="{{ route('galeri.album.show', urlencode($album->judul_foto)) }}" class="btn btn-sm btn-info rounded-circle shadow-sm btn-action-admin mb-2" title="Lihat Isi Album" style="color: white;">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-warning rounded-circle shadow-sm btn-action-admin mb-2" data-toggle="modal" data-target="#editAlbumModal{{ Str::slug($album->judul_foto) }}" title="Edit Detail Album" style="color: white;">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form action="{{ route('galeri.album.destroy', urlencode($album->judul_foto)) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus keseluruhan album ini beserta semua fotonya?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger rounded-circle shadow-sm btn-action-admin" title="Hapus Album">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body p-3 bg-white d-flex flex-column" style="border-radius: 0 0 16px 16px;">
                    <h6 class="font-weight-bold text-dark mb-2 text-truncate" title="{{ $album->judul_foto }}">{{ $album->judul_foto }}</h6>
                    <div class="mt-auto pt-2 border-top d-flex justify-content-between align-items-center text-muted small">
                        <span>
                            <i class="far fa-calendar-alt mr-1 text-primary"></i>
                            {{ $album->tanggal_pelaksanaan ? \Carbon\Carbon::parse($album->tanggal_pelaksanaan)->translatedFormat('d M Y') : '-' }}
                        </span>
                        <span><i class="far fa-images mr-1"></i> {{ $album->photo_count }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Album -->
        <x-modal 
            id="editAlbumModal{{ Str::slug($album->judul_foto) }}" 
            title="Edit Detail Album" 
            formAction="{{ route('galeri.album.update', urlencode($album->judul_foto)) }}" 
            formMethod="PUT"
        >
            <div class="text-center mb-3">
                <img src="{{ asset('storage/' . $album->cover_photo) }}" alt="Preview" class="img-fluid rounded shadow-sm" style="max-height: 150px; object-fit: cover;">
            </div>
            <div class="form-group mb-4">
                <label class="font-weight-600 text-muted small text-uppercase">Judul / Keterangan Album <span class="text-danger">*</span></label>
                <input type="text" name="judul_foto" class="form-control" value="{{ $album->judul_foto }}" required style="border-radius: 0.5rem;">
            </div>
            
            <div class="form-group mb-0">
                <label class="font-weight-600 text-muted small text-uppercase">Tanggal Pelaksanaan Kegiatan <span class="text-danger">*</span></label>
                <input type="date" name="tanggal_pelaksanaan" class="form-control" value="{{ $album->tanggal_pelaksanaan }}" required style="border-radius: 0.5rem;">
            </div>
        </x-modal>
    @empty
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 1rem;">
                <div class="card-body text-center py-5">
                    <i class="fas fa-images text-muted mb-3" style="font-size: 3rem; opacity: 0.5;"></i>
                    <h5 class="font-weight-bold text-dark">Belum Ada Foto</h5>
                    <p class="text-muted">Mulai unggah dokumentasi kegiatan Paskibra sekarang.</p>
                    <button type="button" class="btn btn-primary px-4 mt-2" data-toggle="modal" data-target="#addFotoModal" style="border-radius: 8px;">
                        <i class="fas fa-cloud-upload-alt mr-2"></i> Unggah Foto Pertama
                    </button>
                </div>
            </div>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-3">
    {{ $albums->links() }}
</div>

<!-- Modal Tambah Foto -->
<x-modal 
    id="addFotoModal" 
    title="Unggah Foto Baru" 
    formAction="{{ route('galeri.store') }}" 
    enctype="multipart/form-data" 
    submitLabel="Unggah Sekarang" 
    submitIcon="fas fa-upload"
    formId="formTambahFoto"
>
    <div class="form-group mb-4">
        <label class="font-weight-600 text-muted small text-uppercase">Judul / Keterangan Foto <span class="text-danger">*</span></label>
        <input type="text" name="judul_foto" class="form-control" required style="border-radius: 0.5rem;" placeholder="Misal: Kegiatan LDKS 2026">
    </div>
    
    <div class="form-group mb-4">
        <label class="font-weight-600 text-muted small text-uppercase">Tanggal Pelaksanaan Kegiatan <span class="text-danger">*</span></label>
        <input type="date" name="tanggal_pelaksanaan" class="form-control" required style="border-radius: 0.5rem;">
    </div>
    
    <div class="form-group mb-0">
        <label class="font-weight-600 text-muted small text-uppercase">Pilih File Foto <span class="text-danger">*</span></label>
        
        <!-- Drag and Drop Zone -->
        <label class="upload-zone text-center p-3 mb-2 d-block" id="drop-zone" for="file_foto" style="border: 2px dashed #a5b4fc; border-radius: 1rem; background-color: #e0e7ff; transition: all 0.3s ease; position: relative; cursor: pointer;">
            <input type="file" name="file_foto[]" id="file_foto" style="opacity: 0; position: absolute; z-index: -1; width: 1px; height: 1px;" accept="image/jpeg,image/png,image/jpg,image/gif" multiple>
            
            <div class="upload-icon mb-2">
                <i class="fas fa-folder-open" style="font-size: 3rem; color: #4f46e5;"></i>
            </div>
            <h6 class="text-dark font-weight-bold mb-1" style="font-size: 0.95rem;">Click here or drag files to upload</h6>
            
            <div class="d-flex align-items-center justify-content-center my-2">
                <hr class="flex-grow-1" style="border-color: #cbd5e1; max-width: 80px;">
                <span class="mx-3 text-muted font-weight-bold small">OR</span>
                <hr class="flex-grow-1" style="border-color: #cbd5e1; max-width: 80px;">
            </div>
            
            <span class="btn btn-primary px-4 py-1 font-weight-bold mt-1" style="border-radius: 0.5rem; background-color: #4f46e5; border-color: #4f46e5; font-size: 0.9rem;">
                Choose File
            </span>
        </label>

        <!-- Previews Container -->
        <div class="row d-none" id="preview-container">
            <!-- Previews will be injected here via JS -->
        </div>

        <small class="form-text text-muted mt-2 text-center">
            <i class="fas fa-info-circle mr-1"></i> Format: JPG, JPEG, PNG, GIF. Maksimal ukuran file <strong>10 MB</strong> per foto. Anda bisa memilih lebih dari 1 foto.
        </small>
    </div>
</x-modal>


@endsection

@section('extra-js')
<script>
$(document).ready(function() {
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file_foto');
    const previewContainer = document.getElementById('preview-container');
    let selectedFiles = [];

    // Handle drag over
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('dragover');
    });

    // Handle drag leave
    dropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
    });

    // Handle drop
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        if (e.dataTransfer && e.dataTransfer.files) {
            handleFiles(e.dataTransfer.files);
        }
    });

    // Handle file input change
    fileInput.addEventListener('change', function(e) {
        if (e.target.files && e.target.files.length > 0) {
            handleFiles(e.target.files);
        }
    });

    function handleFiles(files) {
        if (files.length > 0) {
            for(let i = 0; i < files.length; i++) {
                selectedFiles.push(files[i]);
            }
            updateFileInput();
            renderPreviews();
        }
    }

    // Must be global for inline onclick to work
    window.removeFile = function(index) {
        selectedFiles.splice(index, 1);
        updateFileInput();
        renderPreviews();
    };

    function updateFileInput() {
        try {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files;
        } catch (e) {
            console.warn("DataTransfer object not fully supported. Multi-upload cumulative addition may be limited.", e);
        }
    }

    function renderPreviews() {
        previewContainer.innerHTML = '';
        
        if (selectedFiles.length > 0) {
            previewContainer.classList.remove('d-none');
            dropZone.classList.add('mb-4', 'minimized');
            // Update button text to imply adding more
            const btn = dropZone.querySelector('.btn-primary');
            if (btn) btn.innerHTML = '<i class="fas fa-plus mr-1"></i> Tambah Foto Lain';
        } else {
            previewContainer.classList.add('d-none');
            dropZone.classList.remove('mb-4', 'minimized');
            // Restore original button text
            const btn = dropZone.querySelector('.btn-primary');
            if (btn) btn.innerText = 'Choose File';
        }

        selectedFiles.forEach((file, index) => {
            let reader = new FileReader();
            reader.onload = function(event) {
                const col = document.createElement('div');
                col.className = 'col-lg-3 col-md-4 col-sm-6 preview-item mb-3';
                col.innerHTML = `
                    <div style="position: relative; border-radius: 0.5rem; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                        <img src="${event.target.result}" alt="Preview" style="width: 100%; height: 120px; object-fit: cover; display: block;">
                        <div onclick="removeFile(${index})" style="position: absolute; top: 5px; right: 5px; background: rgba(239, 68, 68, 0.9); color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.2); border: 2px solid white; z-index: 10;" title="Hapus foto ini">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="text-truncate small mt-1 text-center text-muted" title="${file.name}">${file.name}</div>
                `;
                previewContainer.appendChild(col);
            }
            reader.readAsDataURL(file);
        });
    }

    // Mencegah submit form dua kali (double submit)
    $('#formTambahFoto').on('submit', function() {
        if(selectedFiles.length === 0) {
            alert('Silakan pilih minimal 1 foto.');
            return false;
        }
        $('#btnSubmit').html('<i class="fas fa-spinner fa-spin mr-2"></i> Mengunggah...').attr('disabled', true);
    });
    
    // Prevent double submit on other forms without file validation
    $('form:not(#formTambahFoto)').on('submit', function() {
        const btn = $(this).find('button[type="submit"]');
        if (btn.length > 0) {
            const originalText = btn.html();
            btn.html('<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...').attr('disabled', true);
        }
    });
});
</script>
@endsection
