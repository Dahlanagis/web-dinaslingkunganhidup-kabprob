@extends('layouts.public')

@section('content')
@php
    $siteSetting = \App\Models\Setting::first() ?? new \App\Models\Setting();
    $runningText = $siteSetting->running_text ?: 'Selamat Datang di Website Resmi Dinas Lingkungan Hidup (DLH) Kabupaten Probolinggo. Mari wujudkan lingkungan hidup yang bersih, hijau, dan lestari.';
    $heroTitle = $siteSetting->hero_title ?: 'DLH Kab. Probolinggo';
    $heroDesc = $siteSetting->hero_description ?: 'Dinas Lingkungan Hidup Kabupaten Probolinggo hadir untuk menjaga kelestarian alam, mengelola tata ruang hijau, dan menangani kebersihan secara profesional.';
@endphp
<!-- TICKER -->
    <div class="ticker-bar">
        <div class="container d-flex align-items-center gap-3">
            <span class="ticker-label"><i class="bi bi-megaphone-fill me-1"></i>Pengumuman</span>
            <div style="overflow:hidden;flex:1;">
                <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" scrollamount="5">{{ $runningText }}</marquee>
            </div>
        </div>
    </div>

    <!-- HERO -->
    <section class="hero-section">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-particles"></div>
        <div class="hero-content w-100">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-7 col-xl-6 py-5">
                        <div class="hero-badge anim-fadeup">
                            <span class="hero-dot"></span>
                            Resmi · Terpercaya · Profesional
                        </div>
                        <h1 class="hero-title anim-fadeup d1">
                            {{ $heroTitle }}<br>
                            <span class="hero-highlight">Kabupaten Probolinggo</span>
                        </h1>
                        <p class="hero-desc anim-fadeup d2">{{ $heroDesc }}</p>
                        <div class="d-flex gap-3 flex-wrap anim-fadeup d3">
                            <a href="#layanan" class="btn-hero-primary"><i class="bi bi-grid-3x3-gap-fill"></i> Lihat Layanan</a>
                            <a href="#berita" class="btn-hero-outline"><i class="bi bi-newspaper"></i> Berita Terbaru</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-stats-strip">
            <div class="container">
                <div class="row g-0">
                    @php
                        $heroStats = \App\Models\Statistic::where('is_active', true)->latest()->take(4)->get();
                    @endphp
                    @forelse($heroStats as $stat)
                    <div class="col-6 col-md-3">
                        <div class="hero-stat-item">
                            <div class="hero-stat-num">{{ $stat->value }}</div>
                            <div class="hero-stat-label">{{ $stat->title }}</div>
                        </div>
                    </div>
                    @empty
                    <div class="col-6 col-md-3"><div class="hero-stat-item"><div class="hero-stat-num">45K+</div><div class="hero-stat-label">Ton Sampah Dikelola</div></div></div>
                    <div class="col-6 col-md-3"><div class="hero-stat-item"><div class="hero-stat-num">124</div><div class="hero-stat-label">Titik RTH Terkelola</div></div></div>
                    <div class="col-6 col-md-3"><div class="hero-stat-item"><div class="hero-stat-num">45</div><div class="hero-stat-label">Bank Sampah Aktif</div></div></div>
                    <div class="col-6 col-md-3"><div class="hero-stat-item"><div class="hero-stat-num">85%</div><div class="hero-stat-label">Indeks Kualitas Udara</div></div></div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- PORTAL LAYANAN -->
    <section id="layanan" class="portal-section py-5">
        <div class="container py-3">
            <div class="text-center mb-5">
                <div class="section-label">Akses Cepat</div>
                <h2 class="section-title">Portal Layanan DLH</h2>
                <p class="text-muted mt-3" style="max-width:520px;margin:0 auto;font-size:.95rem;line-height:1.7;">
                    Temukan informasi dan layanan unggulan DLH Kabupaten Probolinggo secara mudah dan cepat.
                </p>
            </div>

            {{-- FEATURED CARD --}}
            <div class="portal-featured mb-4">
                <div class="portal-featured-left">
                    <div class="portal-featured-icon">
                        <i class="bi bi-buildings-fill"></i>
                    </div>
                    <div>
                        <span class="portal-featured-tag">Profil Instansi</span>
                        <h3 class="portal-featured-title">Dinas Lingkungan Hidup<br>Kab. Probolinggo</h3>
                        <p class="portal-featured-desc">Lembaga pemerintah daerah yang bertugas merumuskan dan melaksanakan kebijakan di bidang lingkungan hidup, kebersihan, dan ruang terbuka hijau untuk mewujudkan kabupaten yang bersih, hijau, dan berkelanjutan.</p>
                        <div class="d-flex gap-3 flex-wrap mt-4">
                            <a href="#" class="portal-featured-btn-primary"><i class="bi bi-eye-fill"></i> Lihat Profil</a>
                            <a href="#" class="portal-featured-btn-outline"><i class="bi bi-file-earmark-text"></i> Visi &amp; Misi</a>
                        </div>
                    </div>
                </div>
                <div class="portal-featured-right">
                    <div class="portal-featured-blob">
                        <i class="bi bi-tree-fill"></i>
                    </div>
                    <div class="portal-feat-stats">
                        <div class="portal-feat-stat"><span class="pfs-num">45K+</span><span class="pfs-label">Ton Sampah</span></div>
                        <div class="portal-feat-stat"><span class="pfs-num">124</span><span class="pfs-label">Titik RTH</span></div>
                        <div class="portal-feat-stat"><span class="pfs-num">45</span><span class="pfs-label">Bank Sampah</span></div>
                    </div>
                </div>
            </div>

            {{-- SERVICE ICON GRID --}}
            <div class="row g-3">
                @php
                $portalItems = \App\Models\Service::all()->map(function ($service) {
                    return [
                        'icon' => $service->icon ?? 'bi-star',
                        'tag' => $service->tag ?? 'Layanan',
                        'color' => '#14532d',
                        'bg' => 'rgba(20,83,45,.08)',
                        'border' => 'rgba(20,83,45,.18)',
                        'title' => $service->name,
                        'desc' => $service->description,
                    ];
                });
                @endphp
                @foreach($portalItems as $item)
                <div class="col-lg-4 col-md-6">
                    <a href="{{ url('/layanan/' . \Illuminate\Support\Str::slug($item['title'])) }}" class="svc-icon-card" style="--svc-color:{{ $item['color'] }};--svc-bg:{{ $item['bg'] }};--svc-border:{{ $item['border'] }};">
                        <div class="svc-icon-box">
                            <i class="bi {{ $item['icon'] }}"></i>
                        </div>
                        <div class="svc-icon-content">
                            <span class="svc-icon-tag">{{ $item['tag'] }}</span>
                            <h5 class="svc-icon-title">{!! $item['title'] !!}</h5>
                            <p class="svc-icon-desc">{{ $item['desc'] }}</p>
                        </div>
                        <div class="svc-icon-arrow">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

<!-- STATISTIK -->
    <section class="stats-section py-5">
        <div class="container py-3">
            <div class="text-center mb-5">
                <div class="section-label" style="color:var(--amber);"><span style="background:var(--amber);"></span>Capaian Kinerja<span style="background:var(--amber);"></span></div>
                <h2 class="section-title section-title-light">Data & Statistik Terkini</h2>
                <p class="mt-3" style="color:rgba(255,255,255,.5);max-width:520px;margin:12px auto 0;font-size:.95rem;line-height:1.7;">
                    Gambaran pencapaian kinerja dan data strategis lingkungan di wilayah Kabupaten Probolinggo.
                </p>
            </div>
            <div class="row g-4">
                @php
                    $statistics = \App\Models\Statistic::where('is_active', true)->latest()->take(4)->get();
                @endphp
                @forelse($statistics as $stat)
                @php
                    // Map heroicons to bootstrap icons to ensure compatibility with our custom CSS
                    $iconMap = [
                        'heroicon-o-trash' => 'bi-trash3',
                        'heroicon-o-tree' => 'bi-tree',
                        'heroicon-o-chart-bar' => 'bi-bar-chart',
                        'heroicon-o-building-storefront' => 'bi-shop',
                        'heroicon-o-cloud' => 'bi-cloud',
                        'heroicon-o-megaphone' => 'bi-megaphone',
                        'heroicon-o-document-check' => 'bi-file-earmark-check',
                    ];
                    $cleanIcon = str_replace(['heroicon-o-', 'heroicon-m-', 'heroicon-s-'], '', $stat->icon);
                    $iconClass = $iconMap[$stat->icon] ?? (str_starts_with($stat->icon ?? '', 'bi-') ? $stat->icon : 'bi-' . $cleanIcon);
                    // fallback if still not found
                    if(!str_starts_with($iconClass, 'bi-')) $iconClass = 'bi-star';
                @endphp
                <div class="col-md-6 col-xl-3">
                    <div class="stat-card-p" style="--stat-color:var(--amber);">
                        <div class="stat-card-top"></div>
                        <i class="bi {{ $iconClass }} stat-bg-icon"></i>
                        <div class="stat-icon-box"><i class="bi {{ $iconClass }}"></i></div>
                        <div style="position:relative;z-index:1;">
                            <div class="stat-value">{{ $stat->value }}</div>
                            <div class="stat-name">{{ $stat->title }}</div>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Fallback jika database kosong -->
                <div class="col-md-6 col-xl-3"><div class="stat-card-p" style="--stat-color:var(--amber);"><div class="stat-card-top"></div><i class="bi bi-trash3 stat-bg-icon"></i><div class="stat-icon-box"><i class="bi bi-trash3"></i></div><div style="position:relative;z-index:1;"><div class="stat-value">45.280</div><div class="stat-name">Ton Sampah Terkelola</div></div><div class="stat-tag">Tahun 2025</div></div></div>
                <div class="col-md-6 col-xl-3"><div class="stat-card-p" style="--stat-color:var(--amber);"><div class="stat-card-top"></div><i class="bi bi-tree stat-bg-icon"></i><div class="stat-icon-box"><i class="bi bi-tree"></i></div><div style="position:relative;z-index:1;"><div class="stat-value">124</div><div class="stat-name">Titik Ruang Terbuka Hijau</div></div><div class="stat-tag">Taman & Hutan Kota</div></div></div>
                <div class="col-md-6 col-xl-3"><div class="stat-card-p" style="--stat-color:var(--amber);"><div class="stat-card-top"></div><i class="bi bi-wind stat-bg-icon"></i><div class="stat-icon-box"><i class="bi bi-wind"></i></div><div style="position:relative;z-index:1;"><div class="stat-value">85%</div><div class="stat-name">Indeks Kualitas Udara</div></div><div class="stat-tag">Kategori Baik</div></div></div>
                <div class="col-md-6 col-xl-3"><div class="stat-card-p" style="--stat-color:var(--amber);"><div class="stat-card-top"></div><i class="bi bi-recycle stat-bg-icon"></i><div class="stat-icon-box"><i class="bi bi-recycle"></i></div><div style="position:relative;z-index:1;"><div class="stat-value">45</div><div class="stat-name">Bank Sampah Aktif</div></div><div class="stat-tag">24 Kecamatan</div></div></div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- LAYANAN UNGGULAN -->
    <section class="layanan-section py-5">
        <div class="container py-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5 gap-3">
                <div>
                    <div class="section-label" style="color:var(--amber);"><span style="background:var(--amber);"></span>Layanan Kami<span style="background:var(--amber);"></span></div>
                    <h2 class="section-title section-title-light">Layanan Unggulan DLH</h2>
                    <p style="color:rgba(255,255,255,.55);font-size:.92rem;line-height:1.7;max-width:480px;margin-top:8px;">Pelayanan publik di bidang pelestarian alam, pengelolaan sampah, dan tata lingkungan yang profesional.</p>
                </div>
                <a href="{{ url('/layanan') }}" class="btn fw-semibold px-4 py-2 text-white" style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);border-radius:10px;white-space:nowrap;transition:all .3s;">
                    Semua Layanan <i class="bi bi-arrow-right text-warning ms-1"></i>
                </a>
            </div>
            <div style="overflow-x:auto;padding:10px 4px 24px 4px;" class="hide-scrollbar">
                <div style="display:flex;gap:20px;min-width:max-content;padding-right:24px;">
                    @php
                        $svcs = \App\Models\Service::all();
                        // Mapping helper for heroicons if needed
                        $getIcon = function($icon) {
                            $map = [
                                'heroicon-o-trash' => 'bi-trash3',
                                'heroicon-o-tree' => 'bi-tree',
                                'heroicon-o-chart-bar' => 'bi-bar-chart',
                                'heroicon-o-building-storefront' => 'bi-shop',
                                'heroicon-o-cloud' => 'bi-cloud',
                                'heroicon-o-megaphone' => 'bi-megaphone',
                                'heroicon-o-document-check' => 'bi-file-earmark-check',
                            ];
                            $c = str_replace(['heroicon-o-','heroicon-m-','heroicon-s-'], '', $icon);
                            return $map[$icon] ?? (str_starts_with($icon ?? '', 'bi-') ? $icon : 'bi-'.$c);
                        };
                    @endphp
                    @forelse($svcs as $s)
                    <div class="svc-card position-relative" style="width:340px;flex:0 0 auto;">
                        <div class="svc-card-top"></div>
                        <span class="svc-num">{{ $loop->iteration < 10 ? '0'.$loop->iteration : $loop->iteration }}</span>
                        <div class="p-4 d-flex flex-column h-100">
                            <div class="svc-tag">{{ $s->tag ?? 'Layanan Publik' }}</div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="svc-icon-ring"><i class="bi {{ $getIcon($s->icon) }}"></i></div>
                                <h5 class="svc-title">{{ $s->name }}</h5>
                            </div>
                            <p class="svc-desc mb-3">{{ $s->description }}</p>
                            
                            <div style="border-top:1px solid rgba(255,255,255,.08);padding-top:14px;margin-top:auto;display:flex;align-items:center;justify-content:space-between;">
                                <span style="font-size:.74rem;color:rgba(255,255,255,.5);font-weight:500;"><i class="bi bi-clock me-1" style="color:var(--amber);"></i> Tersedia</span>
                                <a href="{{ url('/layanan/' . \Illuminate\Support\Str::slug($s->name)) }}" class="svc-arrow-btn"><i class="bi bi-arrow-right" style="font-size:.8rem;"></i></a>
                            </div>
                        </div>
                    </div>
                    @empty
                        <p class="text-white">Belum ada layanan tersedia.</p>
                    @endforelse
</div>
            </div>
        </div>
    </section>

    <!-- BERITA -->
    <section id="berita" class="py-5" style="background:var(--slate50);">
        <div class="container py-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5 gap-3">
                <div>
                    <div class="section-label">Informasi</div>
                    <h2 class="section-title">Berita Terkini</h2>
                    <p class="text-muted mt-2" style="font-size:.92rem;max-width:460px;line-height:1.7;">Ikuti perkembangan kegiatan dan program kerja DLH Kabupaten Probolinggo.</p>
                </div>
                <a href="{{ url('/berita') }}" class="btn fw-semibold px-4 py-2" style="background:#f0fdf4;color:var(--g700);border:1px solid rgba(22,163,74,.2);border-radius:10px;white-space:nowrap;">
                    Semua Berita <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

<div class="row g-4">
                @php
                    $posts = \App\Models\Post::latest()->take(3)->get();
                @endphp
                @forelse($posts as $post)
                <div class="col-lg-4 col-md-6">
                    <div class="news-card">
                        <div class="news-img-wrap">
                            <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=600&h=400&fit=crop' }}" alt="{{ $post->title }}">
                            <span class="news-badge" style="color:#047857;">Berita</span>
                        </div>
                        <div class="news-card-body">
                            <div class="news-date"><i class="bi bi-calendar3"></i> {{ $post->created_at->translatedFormat('d F Y') }}</div>
                            <a href="{{ url('/berita/' . $post->slug) }}" class="news-title-link">{{ $post->title }}</a>
                            <p class="news-excerpt">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                            <a href="{{ url('/berita/' . $post->slug) }}" class="news-more">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12"><p class="text-muted text-center py-5">Belum ada berita yang diterbitkan.</p></div>
                @endforelse
            </div>
        </div>
    </section>

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
                            // Get all galleries of type foto
                            $galleries = \App\Models\Gallery::where('type', 'foto')->latest()->take(10)->get();
                            $allPhotos = [];
                            foreach($galleries as $g) {
                                $imgs = $g->images ?? [];
                                foreach($imgs as $img) {
                                    $allPhotos[] = ['title' => $g->title, 'path' => $img, 'cat' => $g->category];
                                }
                            }
                        @endphp
                        @forelse($allPhotos as $foto)
                            @php
                                $imgSrc = asset('storage/' . $foto['path']);
                            @endphp
                            <div class="gallery-item" style="cursor:pointer;" onclick="openLightbox('{{ $imgSrc }}', '{{ addslashes($foto['title']) }}', 'photo')">
                                <img src="{{ $imgSrc }}" alt="{{ $foto['title'] }}">
                                <div class="gallery-item-overlay"></div>
                                <div class="gallery-item-content">
                                    <span class="badge mb-2" style="background:rgba(4,120,87,.9);color:#fff;font-size:.7rem;padding:4px 10px;border-radius:100px;backdrop-filter:blur(4px);"><i class="bi bi-images me-1"></i>{{ $foto['cat'] ?? 'FOTO' }}</span>
                                    <h6>{{ $foto['title'] }}</h6>
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


        <!-- MITRA -->
    <section class="mitra-section py-5">
        <div class="container text-center py-3">
            <div class="section-label">Ekosistem</div>
            <h2 class="section-title mb-2">Instansi & Mitra Terkoneksi</h2>
            <p class="text-muted mb-5" style="max-width:560px;margin:12px auto 0;font-size:.92rem;line-height:1.7;">Sinergi pelayanan publik lingkungan dan koordinasi antar lembaga di Kabupaten Probolinggo.</p>
            <div class="d-flex flex-wrap justify-content-center gap-4">
                @foreach([['icon'=>'bi-tree-fill','name'=>'KEMEN LHK','sub'=>'Pusat Data Nasional'],['icon'=>'bi-buildings-fill','name'=>'Pemkab Probolinggo','sub'=>'Pemerintah Daerah'],['icon'=>'bi-hdd-network-fill','name'=>'Diskominfo','sub'=>'Sistem Informasi'],['icon'=>'bi-bank2','name'=>'BAPPEDA','sub'=>'Perencanaan Daerah'],['icon'=>'bi-shield-shaded','name'=>'KLHK Jatim','sub'=>'Regional Jawa Timur']] as $m)
                <a href="#" class="mitra-card">
                    <div class="mitra-icon"><i class="bi {{ $m['icon'] }}"></i></div>
                    <div><div class="mitra-name">{{ $m['name'] }}</div><div style="font-size:.68rem;color:#94a3b8;margin-top:2px;">{{ $m['sub'] }}</div></div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA PENGADUAN -->
    <section class="cta-section py-5">
        <div class="container py-3">
            <div class="cta-card">
                <div class="row align-items-center g-4" style="position:relative;z-index:1;">
                    <div class="col-lg-7">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-shield-check text-warning"></i>
                            <span class="text-warning fw-bold" style="font-size:.8rem;letter-spacing:1px;text-transform:uppercase;">Layanan Pengaduan</span>
                        </div>
                        <h2 style="font-size:clamp(1.6rem,3.5vw,2.2rem);font-weight:800;color:#fff;line-height:1.3;margin-bottom:14px;">
                            Laporkan Masalah Lingkungan &amp; Aspirasi <span style="color:var(--amber);">Masyarakat</span>
                        </h2>
                        <p style="color:rgba(255,255,255,.65);line-height:1.75;font-size:.95rem;max-width:480px;">
                            Laporkan penumpukan sampah liar, pencemaran lingkungan, atau aspirasi tata kota hijau melalui platform resmi kami. Tim kami siap merespons dengan cepat.
                        </p>
                    </div>
                    <div class="col-lg-5">
                        <div class="d-flex flex-column gap-3">
                            <a href="https://www.lapor.go.id/" target="_blank" class="cta-btn cta-btn-red">
                                <div class="cta-btn-icon" style="background:rgba(255,255,255,.15);"><i class="bi bi-megaphone-fill text-white fs-4"></i></div>
                                <div class="flex-grow-1"><div style="font-size:1rem;font-weight:800;">SP4N LAPOR!</div><div style="font-size:.78rem;opacity:.85;font-weight:400;">Portal Pengaduan Resmi RI</div></div>
                                <i class="bi bi-arrow-right fs-4 opacity-75"></i>
                            </a>
                            <a href="https://wa.me/6282131001001?text=Halo%20sae" target="_blank" class="cta-btn cta-btn-green">
                                <div class="cta-btn-icon" style="background:rgba(255,255,255,.1);"><i class="bi bi-whatsapp text-white fs-4"></i></div>
                                <div class="flex-grow-1"><div style="font-size:1rem;font-weight:800;">CALL CENTER</div><div style="font-size:.78rem;opacity:.85;font-weight:400;">Hubungi Tim Reaksi Cepat</div></div>
                                <i class="bi bi-arrow-right fs-4 opacity-75"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
