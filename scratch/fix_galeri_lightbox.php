<?php

$welcome = 'd:\DLH web PKL\resources\views\welcome.blade.php';
$content = file_get_contents($welcome);

// New Galeri block with dynamic photos, static videos, and a lightbox modal.
$newGaleriBlock = <<<'HTML'
    <!-- GALERI -->
    <section class="py-5" style="background:#fff;">
        <div class="container py-3">
            <div class="text-center mb-5">
                <div class="section-label">Visual</div>
                <h2 class="section-title">Galeri Dokumentasi</h2>
                <p class="text-muted mt-3" style="max-width:500px;margin:12px auto 0;font-size:.93rem;line-height:1.7;">Potret aktivitas pelayanan lapangan, pengangkutan sampah, dan program kerja DLH.</p>
            </div>
            <ul class="nav gallery-tabs gap-2 justify-content-center mb-5" id="galTab" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#galFoto"><i class="bi bi-camera-fill me-2"></i>Galeri Foto</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#galVideo"><i class="bi bi-play-btn-fill me-2"></i>Galeri Video</button></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="galFoto">
                    <div class="gallery-scroll">
                        @php
                            $galleries = \App\Models\Gallery::latest()->take(6)->get();
                        @endphp
                        @forelse($galleries as $foto)
                            @php
                                $imgSrc = $foto->image_path ? asset('storage/' . $foto->image_path) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=600&h=400&fit=crop';
                            @endphp
                            <div class="gallery-item" style="cursor:pointer;" onclick="openLightbox('{{ $imgSrc }}', '{{ addslashes($foto->title) }}', 'photo')">
                                <img src="{{ $imgSrc }}" alt="{{ $foto->title }}">
                                <div class="gallery-item-overlay"></div>
                                <div class="gallery-item-content">
                                    <span class="badge mb-2" style="background:rgba(4,120,87,.9);color:#fff;font-size:.7rem;padding:4px 10px;border-radius:100px;backdrop-filter:blur(4px);"><i class="bi bi-images me-1"></i>FOTO</span>
                                    <h6>{{ $foto->title }}</h6>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted w-100 text-center py-4">Belum ada foto galeri.</p>
                        @endforelse
                    </div>
                </div>
                <div class="tab-pane fade" id="galVideo">
                    <div class="gallery-scroll">
                        @php
                        $videos = [
                            ['img'=>'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=600&h=400&fit=crop', 'title'=>'Profil Bank Sampah Probolinggo', 'vid'=>'https://www.youtube.com/embed/dQw4w9WgXcQ'],
                            ['img'=>'https://images.unsplash.com/photo-1611284446314-60a58ac0deb9?w=600&h=400&fit=crop', 'title'=>'Edukasi Pemilahan Sampah Rumah Tangga', 'vid'=>'https://www.youtube.com/embed/dQw4w9WgXcQ'],
                            ['img'=>'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=600&h=400&fit=crop', 'title'=>'Program Hutan Kota Hijau 2025', 'vid'=>'https://www.youtube.com/embed/dQw4w9WgXcQ']
                        ];
                        @endphp
                        @foreach($videos as $v)
                        <div class="gallery-item" style="cursor:pointer;" onclick="openLightbox('{{ $v['vid'] }}', '{{ addslashes($v['title']) }}', 'video')">
                            <img src="{{ $v['img'] }}" alt="{{ $v['title'] }}">
                            <div class="gallery-item-overlay"></div>
                            <div class="gallery-play-btn"><i class="bi bi-play-fill"></i></div>
                            <div class="gallery-item-content">
                                <span class="badge mb-2" style="background:rgba(220,38,38,.9);color:#fff;font-size:.7rem;padding:4px 10px;border-radius:100px;backdrop-filter:blur(4px);"><i class="bi bi-play-btn-fill me-1"></i>VIDEO</span>
                                <h6>{{ $v['title'] }}</h6>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- LIGHTBOX MODAL -->
    <div class="modal fade" id="lightboxModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
          <div class="modal-header border-0 pb-1 justify-content-end">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1) grayscale(100%) brightness(200%);"></button>
          </div>
          <div class="modal-body text-center p-0" id="lightboxBody">
            <!-- Content injected via JS -->
          </div>
          <div class="text-center mt-3 text-white h5" id="lightboxTitle"></div>
        </div>
      </div>
    </div>

    <script>
    function openLightbox(src, title, type) {
        const body = document.getElementById('lightboxBody');
        const titleEl = document.getElementById('lightboxTitle');
        titleEl.innerText = title;
        
        if(type === 'video') {
            body.innerHTML = `<div class="ratio ratio-16x9"><iframe src="${src}?autoplay=1" allow="autoplay; encrypted-media" allowfullscreen class="rounded"></iframe></div>`;
        } else {
            body.innerHTML = `<img src="${src}" class="img-fluid rounded shadow-lg" alt="${title}" style="max-height:80vh;">`;
        }
        
        new bootstrap.Modal(document.getElementById('lightboxModal')).show();
    }
    </script>
HTML;

$startMarker = '    <!-- GALERI -->';
$endMarker = '    <!-- MITRA -->';

if (strpos($content, $startMarker) !== false && strpos($content, $endMarker) !== false) {
    $parts = explode($startMarker, $content, 2);
    $beforeChunk = rtrim($parts[0]);
    $parts2 = explode($endMarker, $parts[1], 2);
    $afterChunk = "\n    " . $endMarker . $parts2[1];
    
    $newContent = $beforeChunk . "\n\n" . ltrim($newGaleriBlock) . "\n\n" . $afterChunk;
    file_put_contents($welcome, $newContent);
    echo "Galeri updated with Lightbox Modal.\n";
} else {
    echo "Markers not found.\n";
}
