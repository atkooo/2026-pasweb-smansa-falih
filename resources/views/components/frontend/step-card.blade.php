@props(['number', 'icon', 'title', 'description'])

<div class="col-md-6 col-lg-4">
    <div class="card h-100 p-4 border-0 step-card">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <h3 class="fw-black mb-0 step-number" style="color: #e9ecef; font-size: 2.5rem; line-height: 1;">
                {{ $number }}
            </h3>
            <div class="p-3 step-icon-bg">
                <i class="{{ $icon }}" style="color: #d10000; font-size: 1.5rem;"></i>
            </div>
        </div>
        <h5 class="fw-bold text-dark mb-3" style="font-size: 1.25rem;">{{ $title }}</h5>
        <p class="text-muted mb-0" style="line-height: 1.6;">{{ $description }}</p>
    </div>
</div>
