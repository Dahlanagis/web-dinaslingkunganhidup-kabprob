@extends('layouts.public')

@section('content')
<!-- PREMIUM PAGE HEADER -->
<section class="subpage-header py-5 text-white position-relative overflow-hidden">
    <div class="subpage-header-bg"></div>
    <div class="subpage-header-orb"></div>
    <div class="subpage-header-orb-right"></div>
    <div class="container position-relative py-3" style="z-index: 2;">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0 align-items-center" style="font-size: 0.82rem;">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-white-50 text-decoration-none hover-white">
                        <i class="bi bi-house-door-fill me-1 text-warning"></i> Beranda
                    </a>
                </li>
                <li class="breadcrumb-item text-white-50">Informasi</li>
                <li class="breadcrumb-item active text-white" aria-current="page">Galeri Gambar Kegiatan</li>
            </ol>
        </nav>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill mb-3 subpage-pill-badge">
            <span class="subpage-pulse-beacon"></span>
            <i class="bi bi-images text-warning"></i>
            <span>Dokumentasi Visual &amp; Galeri Foto Resmi</span>
        </div>
        <h1 class="fw-extrabold display-5 mb-2" style="font-weight: 800; letter-spacing: -0.5px;">
            Galeri Gambar &amp; <span class="header-text-gradient">Foto Kegiatan</span>
        </h1>
        <p class="text-white-75 mb-0" style="max-width: 720px; font-size: 1.02rem; line-height: 1.7;">
            Dokumentasi foto resmi aktivitas lapangan, pemeliharaan taman dan RTH, aksi bersih lingkungan, serta program kerja Dinas Lingkungan Hidup Kabupaten Probolinggo.
        </p>
    </div>
</section>

<!-- MAIN CONTENT -->
<div class="py-5" style="background: var(--slate50);">
    <div class="container">
        <!-- TOP STATS BAR (Glassmorphism Style) -->
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-5 p-3.5 rounded-4 subpage-toolbar-glass">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-success text-white px-3.5 py-2 rounded-pill fw-bold shadow-xs" style="font-size: 0.82rem;">
                    <i class="bi bi-camera-fill me-1.5"></i> Dokumentasi Gambar
                </span>
                <span class="text-muted small">
                    Menampilkan <strong>{{ $galleries->count() }}</strong> foto kegiatan lapangan resmi
                </span>
            </div>
            <div class="text-muted small">
                <i class="bi bi-info-circle me-1 text-success"></i> Klik foto untuk memperbesar tampilan resolusi tinggi
            </div>
        </div>

        <!-- PHOTO GRID -->
        <div class="row g-4">
            @forelse($galleries as $g)
                @php
                    $images = $g->images ?? [];
                    if (!is_array($images)) {
                        $images = !empty($images) ? [$images] : [];
                    }
                    $images = array_values(array_filter($images, fn($img) => !empty($img)));
                    $count = count($images);
                    $allUrls = [];
                    foreach ($images as $img) {
                        $allUrls[] = str_starts_with($img, 'http') ? $img : asset('storage/' . ltrim($img, '/'));
                    }
                    $thumb = $count > 0 ? $allUrls[0] : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=600&h=400&fit=crop';
                @endphp
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 rounded-4 overflow-hidden shadow-sm bg-white gallery-card-box border-0 position-relative" 
                         style="cursor: pointer; transition: all 0.35s cubic-bezier(0.2, 0.8, 0.2, 1);" 
                         onclick="openAlbumModal('{{ addslashes($g->title) }}', {{ json_encode($allUrls) }}, '{{ addslashes($g->description ?? '') }}')">
                        <div class="card-accent-bar accent-green"></div>
                        
                        <div class="position-relative overflow-hidden" style="height: 235px;">
                            <img src="{{ $thumb }}" alt="{{ $g->title }}" class="w-100 h-100 object-fit-cover gallery-img-thumb" style="transition: transform 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);">
                            <div class="news-img-gradient-overlay"></div>
                            
                            <div class="position-absolute top-0 start-0 m-3" style="z-index: 2;">
                                @if($count > 1)
                                    <span class="badge bg-success text-white px-3 py-1.5 rounded-pill font-monospace small shadow-sm d-inline-flex align-items-center gap-1.5" style="background: linear-gradient(135deg, #059669, #10b981) !important;">
                                        <i class="bi bi-images"></i> ALBUM ({{ $count }} FOTO)
                                    </span>
                                @else
                                    <span class="badge bg-success text-white px-3 py-1.5 rounded-pill font-monospace small shadow-xs">
                                        <i class="bi bi-image-fill me-1"></i> FOTO
                                    </span>
                                @endif
                            </div>

                            <div class="position-absolute bottom-0 end-0 m-3" style="z-index: 2;">
                                @if($count > 1)
                                    <span class="badge bg-dark bg-opacity-75 text-white rounded-pill px-3 py-1.5 small shadow-sm backdrop-blur d-inline-flex align-items-center gap-1">
                                        <i class="bi bi-collection-play-fill text-warning"></i> Buka Album ({{ $count }})
                                    </span>
                                @else
                                    <span class="badge bg-dark bg-opacity-75 text-white rounded-pill px-3 py-1.5 small shadow-sm backdrop-blur">
                                        <i class="bi bi-arrows-fullscreen me-1"></i> Perbesar
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <span class="text-success fw-bold text-uppercase small mb-1.5" style="font-size: 0.74rem; letter-spacing: 0.8px;">
                                {{ $g->category ?? 'Dokumentasi DLH' }}
                            </span>
                            <h5 class="fw-extrabold text-dark mb-2 news-title" style="font-size: 1.08rem; line-height: 1.45;">
                                {{ $g->title }}
                            </h5>
                            @if($g->description)
                            <p class="text-muted small mb-0 flex-grow-1" style="line-height: 1.65; font-size: 0.87rem;">
                                {{ Str::limit($g->description, 95) }}
                            </p>
                            @endif
                            <div class="pt-3 border-top mt-auto d-flex align-items-center justify-content-between text-muted" style="font-size: 0.78rem;">
                                <span><i class="bi bi-calendar3 me-1 text-success"></i> {{ $g->created_at ? $g->created_at->translatedFormat('d M Y') : 'Kegiatan DLH' }}</span>
                                @if($count > 1)
                                    <span class="text-success fw-bold d-inline-flex align-items-center gap-1"><i class="bi bi-images"></i> {{ $count }} Foto Album</span>
                                @else
                                    <span class="text-success fw-bold d-inline-flex align-items-center gap-1"><i class="bi bi-zoom-in"></i> Lihat Foto</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="py-5 bg-white rounded-4 border shadow-sm p-4 mx-auto" style="max-width: 580px;">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3 text-muted" style="width: 76px; height: 76px; font-size: 2.5rem;">
                            <i class="bi bi-images"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">Belum Ada Dokumentasi Gambar</h4>
                        <p class="text-muted small mb-0">Foto kegiatan belum tersedia saat ini.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- LIGHTBOX MODAL UNTUK GAMBAR & ALBUM -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark text-white rounded-4 overflow-hidden border-0 shadow-lg" style="box-shadow: 0 25px 60px rgba(0,0,0,0.5) !important;">
            <div class="modal-header border-0 pb-0 d-flex justify-content-between align-items-center p-4">
                <div class="d-flex align-items-center gap-2 overflow-hidden me-2">
                    <h5 class="modal-title fw-bold text-white mb-0 text-truncate" id="galleryModalTitle"></h5>
                    <span id="albumCounterBadge" class="badge bg-success rounded-pill px-2.5 py-1 font-monospace small flex-shrink-0" style="display: none;"></span>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="position-relative rounded-4 overflow-hidden bg-black d-flex align-items-center justify-content-center border border-secondary border-opacity-25" style="min-height: 400px; max-height: 72vh;">
                    <img id="galleryModalImg" src="" alt="Preview Gambar" class="img-fluid rounded" style="max-height: 70vh; object-fit: contain; transition: opacity 0.2s ease;">

                    <!-- Tombol Navigasi Prev/Next Album -->
                    <button id="btnPrevAlbum" type="button" onclick="navigateAlbum(-1)" class="btn btn-dark bg-opacity-75 text-white position-absolute start-0 top-50 translate-middle-y ms-3 rounded-circle shadow-lg d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; z-index: 5; border: 1px solid rgba(255,255,255,0.2); display: none;">
                        <i class="bi bi-chevron-left fs-5"></i>
                    </button>
                    <button id="btnNextAlbum" type="button" onclick="navigateAlbum(1)" class="btn btn-dark bg-opacity-75 text-white position-absolute end-0 top-50 translate-middle-y me-3 rounded-circle shadow-lg d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; z-index: 5; border: 1px solid rgba(255,255,255,0.2); display: none;">
                        <i class="bi bi-chevron-right fs-5"></i>
                    </button>
                </div>

                <!-- Thumbnail Strip jika Album > 1 Foto -->
                <div id="albumThumbnailsBar" class="d-flex gap-2 justify-content-center overflow-x-auto py-2 px-1 mt-3" style="display: none !important;"></div>

                <p id="galleryModalDesc" class="text-white-75 small mt-3 mb-1 text-start px-2" style="line-height: 1.7; font-size: 0.92rem;"></p>
            </div>
            <div class="modal-footer border-0 pt-0 pb-4 px-4 d-flex justify-content-between">
                <span class="text-white-50 small"><i class="bi bi-shield-check text-success me-1"></i> Dokumentasi Resmi DLH Kab. Probolinggo</span>
                <a id="galleryModalDownload" href="" target="_blank" class="btn btn-sm btn-success rounded-pill px-3.5 py-1.5 fw-bold">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Buka Ukuran Asli
                </a>
            </div>
        </div>
    </div>
</div>


<style>
    /* SUBPAGE HERO STYLES */
    .subpage-header {
        background: linear-gradient(135deg, #021a10 0%, #064e3b 50%, #03271d 100%);
    }
    .subpage-header-bg {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1.5px, transparent 1.5px);
        background-size: 24px 24px;
        opacity: 0.4;
        pointer-events: none;
    }
    .subpage-header-orb {
        position: absolute;
        width: 380px;
        height: 380px;
        top: -120px;
        right: 10%;
        background: radial-gradient(circle, rgba(74, 222, 128, 0.28) 0%, transparent 70%);
        filter: blur(60px);
        pointer-events: none;
    }
    .subpage-header-orb-right {
        position: absolute;
        width: 320px;
        height: 320px;
        bottom: -100px;
        left: 5%;
        background: radial-gradient(circle, rgba(251, 191, 36, 0.18) 0%, transparent 70%);
        filter: blur(60px);
        pointer-events: none;
    }
    .subpage-pill-badge {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(12px);
        font-size: 0.8rem;
        font-weight: 700;
        color: #86efac;
    }
    .subpage-pulse-beacon {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #4ade80;
        box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.7);
        animation: pulseBeacon 2s infinite;
    }
    @keyframes pulseBeacon {
        0% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.7); }
        70% { box-shadow: 0 0 0 9px rgba(74, 222, 128, 0); }
        100% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0); }
    }
    .header-text-gradient {
        background: linear-gradient(90deg, #86efac 0%, #fde047 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .subpage-toolbar-glass {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(22, 163, 74, 0.18);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
    }
    .card-accent-bar {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3.5px;
        z-index: 3;
    }
    .card-accent-bar.accent-green {
        background: linear-gradient(90deg, #16a34a, #86efac);
    }
    .gallery-card-box {
        border: 1px solid rgba(0, 0, 0, 0.06) !important;
    }
    .gallery-card-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 22px 45px rgba(22, 101, 52, 0.12) !important;
        border-color: rgba(22, 163, 74, 0.35) !important;
    }
    .gallery-card-box:hover .gallery-img-thumb {
        transform: scale(1.08);
    }
    .news-img-gradient-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to top, rgba(0,0,0,0.35) 0%, transparent 100%);
        pointer-events: none;
    }
    .backdrop-blur {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
</style>

<script>
    let currentAlbumPhotos = [];
    let currentAlbumIndex = 0;
    let galleryModalInstance = null;

    function openAlbumModal(title, photos, desc) {
        if (!Array.isArray(photos)) {
            photos = photos ? [photos] : [];
        }
        currentAlbumPhotos = photos;
        currentAlbumIndex = 0;

        document.getElementById('galleryModalTitle').innerText = title;
        document.getElementById('galleryModalDesc').innerText = desc || '';

        const badge = document.getElementById('albumCounterBadge');
        const prevBtn = document.getElementById('btnPrevAlbum');
        const nextBtn = document.getElementById('btnNextAlbum');
        const thumbBar = document.getElementById('albumThumbnailsBar');

        if (currentAlbumPhotos.length > 1) {
            badge.style.display = 'inline-block';
            prevBtn.style.display = 'flex';
            nextBtn.style.display = 'flex';
            thumbBar.style.setProperty('display', 'flex', 'important');

            // Render thumbnail strip
            thumbBar.innerHTML = '';
            currentAlbumPhotos.forEach((src, idx) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = `btn p-0 rounded-3 overflow-hidden border-2 flex-shrink-0 transition-all ${idx === 0 ? 'border-success opacity-100 shadow-sm' : 'border-secondary opacity-50'}`;
                btn.style.width = '52px';
                btn.style.height = '52px';
                btn.onclick = () => setAlbumPhoto(idx);

                const img = document.createElement('img');
                img.src = src;
                img.className = 'w-100 h-100 object-fit-cover';
                btn.appendChild(img);
                thumbBar.appendChild(btn);
            });
        } else {
            badge.style.display = 'none';
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'none';
            thumbBar.style.setProperty('display', 'none', 'important');
            thumbBar.innerHTML = '';
        }

        updateModalPhotoDisplay();

        if (!galleryModalInstance) {
            const modalEl = document.getElementById('galleryModal');
            galleryModalInstance = new bootstrap.Modal(modalEl);
            
            modalEl.addEventListener('keydown', function(e) {
                if (currentAlbumPhotos.length > 1) {
                    if (e.key === 'ArrowLeft') {
                        navigateAlbum(-1);
                    } else if (e.key === 'ArrowRight') {
                        navigateAlbum(1);
                    }
                }
            });
        }
        galleryModalInstance.show();
    }

    function setAlbumPhoto(index) {
        if (index < 0 || index >= currentAlbumPhotos.length) return;
        currentAlbumIndex = index;
        updateModalPhotoDisplay();
    }

    function navigateAlbum(direction) {
        if (currentAlbumPhotos.length <= 1) return;
        currentAlbumIndex = (currentAlbumIndex + direction + currentAlbumPhotos.length) % currentAlbumPhotos.length;
        updateModalPhotoDisplay();
    }

    function updateModalPhotoDisplay() {
        const photoUrl = currentAlbumPhotos[currentAlbumIndex] || '';
        const modalImg = document.getElementById('galleryModalImg');
        
        modalImg.style.opacity = '0.3';
        setTimeout(() => {
            modalImg.src = photoUrl;
            modalImg.style.opacity = '1';
        }, 120);

        document.getElementById('galleryModalDownload').href = photoUrl;

        if (currentAlbumPhotos.length > 1) {
            document.getElementById('albumCounterBadge').innerText = `Foto ${currentAlbumIndex + 1} dari ${currentAlbumPhotos.length}`;
            
            // Update thumbnails active state
            const thumbs = document.getElementById('albumThumbnailsBar').children;
            for (let i = 0; i < thumbs.length; i++) {
                if (i === currentAlbumIndex) {
                    thumbs[i].className = 'btn p-0 rounded-3 overflow-hidden border-2 border-success opacity-100 shadow-sm flex-shrink-0';
                    thumbs[i].scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                } else {
                    thumbs[i].className = 'btn p-0 rounded-3 overflow-hidden border-2 border-secondary border-opacity-50 opacity-50 flex-shrink-0';
                }
            }
        }
    }

    // Fallback backward compatibility
    function previewImage(title, imgUrl, desc) {
        openAlbumModal(title, [imgUrl], desc);
    }
</script>
@endsection
