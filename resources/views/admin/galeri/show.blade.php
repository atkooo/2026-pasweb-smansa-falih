@extends('layouts.admin')

@section('title', 'Detail Album: ' . $judul . ' - Paskibra')

@section('extra-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endsection

@section('content')
    <div class="mb-4 mt-2 d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('galeri.index') }}" class="text-muted text-decoration-none small mb-1 d-block"><i
                    class="fas fa-arrow-left mr-1"></i> Kembali ke Galeri</a>
            <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Album: {{ $judul }}</h3>
            <p class="text-muted" style="font-size: 0.95rem;">Total {{ $photos->count() }} foto dalam album ini. Klik foto untuk memperbesar.</p>
        </div>
        <button type="button" class="btn btn-primary shadow-sm px-4" data-toggle="modal" data-target="#addFotoToAlbumModal"
            style="border-radius: 10px; font-weight: 600;">
            <i class="fas fa-plus mr-2"></i> Tambah Foto ke Album Ini
        </button>
    </div>

    @if($errors->any())
        <x-alert type="danger">
            <i class="fas fa-exclamation-triangle mr-2"></i> <strong>Peringatan!</strong>
            <ul class="mb-0 mt-1 pl-4">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-alert>
    @endif

    <!-- Grid Foto -->
    <div class="row">
        @foreach($photos as $photo)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card border-0 h-100 gallery-card-admin">
                    <div class="card-img-wrapper-admin">
                        <a href="{{ asset('storage/' . $photo->file_foto) }}" data-fancybox="gallery" data-caption="{{ $judul }} - Dokumentasi #{{ $loop->iteration }}" class="d-block w-100 h-100">
                            <img src="{{ asset('storage/' . $photo->file_foto) }}" class="gallery-img-admin" alt="{{ $judul }}">
                        </a>
                        <div class="img-overlay-admin d-flex justify-content-between align-items-center w-100" style="z-index: 10; pointer-events: none;">
                            <a href="{{ asset('storage/' . $photo->file_foto) }}" data-fancybox="gallery" data-caption="{{ $judul }} - Dokumentasi #{{ $loop->iteration }}"
                                class="btn btn-sm btn-info rounded-circle shadow-sm btn-action-admin text-white"
                                title="Perbesar Foto" style="pointer-events: auto;">
                                <i class="fas fa-search-plus"></i>
                            </a>
                            <form action="{{ route('galeri.destroy', $photo->id) }}" method="POST" class="d-inline delete-form" style="pointer-events: auto;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-circle shadow-sm btn-action-admin"
                                    title="Hapus Foto">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-3 bg-white border-top d-flex flex-column justify-content-between" style="border-radius: 0 0 16px 16px;">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="font-weight-bold text-dark small">Dokumentasi #{{ $loop->iteration }}</span>
                            <small class="badge badge-light border text-muted px-2 py-1" title="Waktu Unggah">
                                <i class="far fa-clock mr-1 text-primary"></i>{{ \Carbon\Carbon::parse($photo->tanggal_upload ?? $photo->created_at)->format('d/m/Y H:i') }}
                            </small>
                        </div>
                        <div class="text-muted small">
                            <i class="far fa-calendar-alt mr-1 text-danger"></i> {{ $photo->tanggal_pelaksanaan ? \Carbon\Carbon::parse($photo->tanggal_pelaksanaan)->translatedFormat('d F Y') : '-' }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal Tambah Foto ke Album Ini -->
    <x-modal id="addFotoToAlbumModal" title="Tambah Foto ke Album: {{ $judul }}" formAction="{{ route('galeri.store') }}"
        enctype="multipart/form-data" submitLabel="Unggah ke Album Ini" submitIcon="fas fa-upload" formId="formTambahFotoAlbum">
        
        <!-- Judul foto dikunci sesuai nama album kegiatan ini -->
        <input type="hidden" name="judul_foto" value="{{ $judul }}">

        <div class="form-group mb-3">
            <label class="font-weight-600 text-muted small text-uppercase">Nama Album Kegiatan</label>
            <input type="text" class="form-control font-weight-bold bg-light" value="{{ $judul }}" readonly
                style="border-radius: 0.5rem;">
        </div>

        <div class="form-group mb-4">
            <label class="font-weight-600 text-muted small text-uppercase">Tanggal Pelaksanaan Kegiatan <span
                    class="text-danger">*</span></label>
            <input type="date" name="tanggal_pelaksanaan" class="form-control" required style="border-radius: 0.5rem;"
                value="{{ $photos->first()?->tanggal_pelaksanaan ? \Carbon\Carbon::parse($photos->first()->tanggal_pelaksanaan)->format('Y-m-d') : date('Y-m-d') }}">
        </div>

        <div class="form-group mb-0">
            <label class="font-weight-600 text-muted small text-uppercase">Pilih File Foto Baru <span
                    class="text-danger">*</span></label>

            <!-- Drag and Drop Zone -->
            <label class="upload-zone text-center p-3 mb-2 d-block" id="drop-zone-album" for="file_foto_album"
                style="border: 2px dashed #a5b4fc; border-radius: 1rem; background-color: #e0e7ff; transition: all 0.3s ease; position: relative; cursor: pointer;">
                <input type="file" name="file_foto[]" id="file_foto_album"
                    style="opacity: 0; position: absolute; z-index: -1; width: 1px; height: 1px;"
                    accept="image/jpeg,image/png,image/jpg,image/gif" multiple>

                <div class="upload-icon mb-2">
                    <i class="fas fa-folder-open" style="font-size: 3rem; color: #4f46e5;"></i>
                </div>
                <h6 class="text-dark font-weight-bold mb-1" style="font-size: 0.95rem;">Klik di sini atau tarik file ke sini untuk mengunggah</h6>

                <div class="d-flex align-items-center justify-content-center my-2">
                    <hr class="grow" style="border-color: #cbd5e1; max-width: 80px;">
                    <span class="mx-3 text-muted font-weight-bold small">ATAU</span>
                    <hr class="grow" style="border-color: #cbd5e1; max-width: 80px;">
                </div>

                <span class="btn btn-primary px-4 py-1 font-weight-bold mt-1"
                    style="border-radius: 0.5rem; background-color: #4f46e5; border-color: #4f46e5; font-size: 0.9rem;">
                    Pilih File Foto
                </span>
            </label>

            <!-- Previews Container -->
            <div class="row d-none" id="preview-container-album">
                <!-- Previews will be injected here via JS -->
            </div>

            <small class="form-text text-muted mt-2 text-center">
                <i class="fas fa-info-circle mr-1"></i> Format: JPG, JPEG, PNG, GIF. Maksimal <strong>10 MB</strong> per foto. Anda dapat memilih beberapa foto sekaligus.
            </small>
        </div>
    </x-modal>

@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        $(document).ready(function () {
            if (typeof Fancybox !== 'undefined') {
                Fancybox.bind('[data-fancybox="gallery"]', {
                    Hash: false,
                    Thumbs: {
                        autoStart: true
                    }
                });
            }

            const dropZone = document.getElementById('drop-zone-album');
            const fileInput = document.getElementById('file_foto_album');
            const previewContainer = document.getElementById('preview-container-album');
            let selectedFiles = [];

            if (dropZone && fileInput) {
                dropZone.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    dropZone.classList.add('dragover');
                });

                dropZone.addEventListener('dragleave', (e) => {
                    e.preventDefault();
                    dropZone.classList.remove('dragover');
                });

                dropZone.addEventListener('drop', (e) => {
                    e.preventDefault();
                    dropZone.classList.remove('dragover');
                    if (e.dataTransfer && e.dataTransfer.files) {
                        handleFiles(e.dataTransfer.files);
                    }
                });

                fileInput.addEventListener('change', function (e) {
                    if (e.target.files && e.target.files.length > 0) {
                        handleFiles(e.target.files);
                    }
                });
            }

            function handleFiles(files) {
                if (files.length > 0) {
                    for (let i = 0; i < files.length; i++) {
                        selectedFiles.push(files[i]);
                    }
                    updateFileInput();
                    renderPreviews();
                }
            }

            window.removeFileAlbum = function (index) {
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
                    console.warn("DataTransfer object not supported.", e);
                }
            }

            function renderPreviews() {
                previewContainer.innerHTML = '';

                if (selectedFiles.length > 0) {
                    previewContainer.classList.remove('d-none');
                    dropZone.classList.add('mb-4', 'minimized');
                    const btn = dropZone.querySelector('.btn-primary');
                    if (btn) btn.innerHTML = '<i class="fas fa-plus mr-1"></i> Tambah Foto Lain';
                } else {
                    previewContainer.classList.add('d-none');
                    dropZone.classList.remove('mb-4', 'minimized');
                    const btn = dropZone.querySelector('.btn-primary');
                    if (btn) btn.innerText = 'Pilih File Foto';
                }

                selectedFiles.forEach((file, index) => {
                    let reader = new FileReader();
                    reader.onload = function (event) {
                        const col = document.createElement('div');
                        col.className = 'col-lg-3 col-md-4 col-sm-6 preview-item mb-3';
                        col.innerHTML = `
                        <div style="position: relative; border-radius: 0.5rem; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                            <img src="${event.target.result}" alt="Preview" style="width: 100%; height: 120px; object-fit: cover; display: block;">
                            <div onclick="removeFileAlbum(${index})" style="position: absolute; top: 5px; right: 5px; background: rgba(239, 68, 68, 0.9); color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.2); border: 2px solid white; z-index: 10;" title="Hapus foto ini">
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

            $('#formTambahFotoAlbum').on('submit', function (event) {
                if (selectedFiles.length === 0) {
                    event.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Belum ada foto',
                        text: 'Silakan pilih minimal 1 foto sebelum mengunggah.',
                        confirmButtonText: 'Tutup'
                    });
                    return false;
                }
                $(this).find('button[type="submit"]').html('<i class="fas fa-spinner fa-spin mr-2"></i> Mengunggah...').attr('disabled', true);
            });
        });
    </script>
@endsection