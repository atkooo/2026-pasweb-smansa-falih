@props(['icon' => 'far fa-file-pdf', 'title', 'link' => '#', 'linkText' => 'Download PDF'])

<div class="col-6 col-md-3">
    <div class="doc-card d-flex flex-column align-items-center h-100">
        <div class="doc-icon-wrapper">
            <i class="{{ $icon }}" style="font-size: 2.2rem; color: #dc3545;"></i>
        </div>
        <h6 class="fw-bold text-dark mt-2 text-center" style="font-size: 1rem; min-height: 45px; display: flex; align-items: center; justify-content: center;">
            {!! $title !!}
        </h6>
        <div class="doc-line"></div>
        <a href="{{ $link }}" class="text-decoration-none fw-bold text-primary mt-auto" style="font-size: 0.9rem; letter-spacing: 0.5px;">
            {{ $linkText }} <i class="fas fa-download ms-1 small"></i>
        </a>
    </div>
</div>
