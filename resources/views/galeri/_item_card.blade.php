@php
    $thumb = 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=600&h=400&fit=crop';
    if (!empty($gallery->images) && is_array($gallery->images) && count($gallery->images) > 0) {
        $thumb = asset('storage/' . $gallery->images[0]);
    }
    $mediaUrl = $gallery->type === 'video' ? ($gallery->video_url ?? '') : $thumb;
@endphp
<div class="col-lg-4 col-md-6">
    <div class="card h-100 rounded-4 overflow-hidden shadow-sm bg-white gallery-card-box" style="cursor: pointer;" onclick="previewGallery('{{ addslashes($gallery->title) }}', '{{ $gallery->type }}', '{{ $mediaUrl }}')">
        <div class="position-relative overflow-hidden" style="height: 220px;">
            <img src="{{ $thumb }}" alt="{{ $gallery->title }}" class="w-100 h-100 object-fit-cover gallery-img-thumb">
            <div class="position-absolute top-0 start-0 m-3">
                <span class="badge {{ $gallery->type === 'video' ? 'bg-danger' : 'bg-success' }} text-white px-3 py-1.5 rounded-pill font-monospace small">
                    <i class="bi {{ $gallery->type === 'video' ? 'bi-play-circle-fill' : 'bi-camera-fill' }} me-1"></i>
                    {{ strtoupper($gallery->type) }}
                </span>
            </div>
            @if($gallery->type === 'video')
            <div class="position-absolute top-50 start-50 translate-middle">
                <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center shadow" style="width: 54px; height: 54px; font-size: 1.5rem;">
                    <i class="bi bi-play-fill"></i>
                </div>
            </div>
            @else
            <div class="position-absolute bottom-0 end-0 m-3">
                <span class="badge bg-dark bg-opacity-70 text-white rounded-pill px-2.5 py-1 small">
                    <i class="bi bi-arrows-fullscreen me-1"></i> Perbesar
                </span>
            </div>
            @endif
        </div>
        <div class="card-body p-4 d-flex flex-column">
            <span class="text-success fw-bold text-uppercase small mb-1" style="font-size: 0.72rem; letter-spacing: 0.8px;">
                {{ $gallery->category ?? 'Dokumentasi' }}
            </span>
            <h5 class="fw-bold text-dark mb-2" style="font-size: 1.05rem; line-height: 1.4;">
                {{ $gallery->title }}
            </h5>
            @if($gallery->description)
            <p class="text-muted small mb-0 flex-grow-1" style="line-height: 1.6;">
                {{ Str::limit($gallery->description, 90) }}
            </p>
            @endif
            <div class="pt-3 border-top mt-auto d-flex align-items-center justify-content-between text-muted" style="font-size: 0.78rem;">
                <span><i class="bi bi-calendar3 me-1"></i> {{ $gallery->created_at->translatedFormat('d M Y') }}</span>
                <span class="text-success fw-semibold"><i class="bi bi-eye-fill me-1"></i> Lihat Media</span>
            </div>
        </div>
    </div>
</div>
