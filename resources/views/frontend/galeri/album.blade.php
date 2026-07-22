<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>{{ $judul }} - Galeri Paskibra Ganesha</title>
    <!-- Favicon -->
    <link rel="icon" type="image/webp" href="{{ asset('images/logo.webp') }}">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            overflow: hidden; /* Prevent scrolling */
        }
        
        .viewer-container {
            display: flex;
            height: 100vh;
            width: 100vw;
        }

        .main-view {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            position: relative;
            padding: 2rem;
            justify-content: center;
            align-items: center;
        }

        .sidebar {
            width: 250px;
            background-color: #1e1e1e;
            overflow-y: auto;
            padding: 1rem;
            flex-shrink: 0;
            border-left: 1px solid #333;
        }

        /* Hide scrollbar for sidebar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: #1e1e1e;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: #555;
            border-radius: 3px;
        }

        .top-actions {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
        }

        .btn-action {
            background: none;
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-action:hover {
            background-color: white;
            color: #121212;
        }

        .main-image-container {
            height: calc(100vh - 120px);
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .main-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: opacity 0.3s;
        }

        .nav-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0,0,0,0.5);
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            cursor: pointer;
            transition: background 0.3s;
            z-index: 5;
        }

        .nav-arrow:hover {
            background: rgba(255,255,255,0.2);
        }

        .nav-arrow.prev { left: 20px; }
        .nav-arrow.next { right: 20px; }

        .image-info {
            position: absolute;
            bottom: 20px;
            text-align: center;
            width: 100%;
        }

        .thumbnail-wrap {
            margin-bottom: 10px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            opacity: 0.6;
            transition: all 0.2s;
            height: 140px;
        }

        .thumbnail-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbnail-wrap:hover {
            opacity: 0.9;
        }

        .thumbnail-wrap.active {
            border-color: #fff;
            opacity: 1;
        }
        
        @media (max-width: 768px) {
            .viewer-container {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                height: 120px;
                display: flex;
                flex-direction: row;
                overflow-x: auto;
                overflow-y: hidden;
                padding: 10px;
                border-left: none;
                border-top: 1px solid #333;
            }
            .thumbnail-wrap {
                margin-bottom: 0;
                margin-right: 10px;
                height: 100%;
                width: 150px;
                flex-shrink: 0;
            }
            .main-view {
                padding: 1rem;
                height: calc(100vh - 120px);
            }
            .main-image-container {
                height: calc(100% - 60px);
            }
        }
    </style>
</head>
<body>

<div class="viewer-container">
    <!-- Main Viewer Area -->
    <div class="main-view">
        <div class="top-actions">
            <!-- Back to Gallery -->
            <a href="{{ route('galeri') }}" class="btn-action" title="Tutup">
                <i class="fas fa-times"></i>
            </a>
        </div>

        <div class="main-image-container">
            <button class="nav-arrow prev" onclick="changeImage(-1)"><i class="fas fa-chevron-left"></i></button>
            
            <img src="{{ asset('storage/' . $photos[0]->file_foto) }}" id="main-image" class="main-image" alt="Gallery Image">
            
            <button class="nav-arrow next" onclick="changeImage(1)"><i class="fas fa-chevron-right"></i></button>
        </div>

        <div class="image-info">
            <h5 class="mb-1 fw-bold">{{ $judul }}</h5>
            <p class="text-white-50 mb-0" id="image-counter">1 / {{ count($photos) }}</p>
        </div>
    </div>

    <!-- Sidebar Thumbnails -->
    <div class="sidebar" id="thumbnail-sidebar">
        @foreach($photos as $index => $photo)
            <div class="thumbnail-wrap {{ $index == 0 ? 'active' : '' }}" data-index="{{ $index }}" onclick="selectImage({{ $index }}, '{{ asset('storage/' . $photo->file_foto) }}')">
                <img src="{{ asset('storage/' . $photo->file_foto) }}" alt="Thumbnail {{ $index + 1 }}">
            </div>
        @endforeach
    </div>
</div>

<script>
    const photos = @json($photos->map(function($p) { return asset('storage/' . $p->file_foto); }));
    let currentIndex = 0;

    function selectImage(index) {
        currentIndex = index;
        updateView();
    }

    function changeImage(direction) {
        currentIndex += direction;
        
        // Loop around
        if (currentIndex < 0) {
            currentIndex = photos.length - 1;
        } else if (currentIndex >= photos.length) {
            currentIndex = 0;
        }
        
        updateView();
    }

    function updateView() {
        // Update Main Image
        const mainImg = document.getElementById('main-image');
        mainImg.style.opacity = 0.5;
        setTimeout(() => {
            mainImg.src = photos[currentIndex];
            mainImg.style.opacity = 1;
        }, 150);
        
        // Update Counter
        document.getElementById('image-counter').innerText = `${currentIndex + 1} / ${photos.length}`;

        // Update Thumbnails Active State
        document.querySelectorAll('.thumbnail-wrap').forEach((thumb, idx) => {
            if (idx === currentIndex) {
                thumb.classList.add('active');
                // Scroll thumbnail into view
                thumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            } else {
                thumb.classList.remove('active');
            }
        });
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            changeImage(-1);
        } else if (e.key === 'ArrowRight') {
            changeImage(1);
        } else if (e.key === 'Escape') {
            window.location.href = '{{ route("galeri") }}';
        }
    });
</script>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
