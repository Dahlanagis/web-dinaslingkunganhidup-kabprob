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
        <style>
            .hero-bg-slide {
                position: absolute;
                inset: 0;
                background-size: cover;
                background-position: center;
                opacity: 0;
                visibility: hidden;
                transition: opacity 1s cubic-bezier(0.4, 0, 0.2, 1), visibility 1s ease, transform 8s ease;
                transform: scale(1.05);
                z-index: 0;
            }
            .hero-bg-slide.active {
                opacity: 1;
                visibility: visible;
                transform: scale(1);
                z-index: 1;
            }
            .hero-text-container {
                position: relative;
                min-height: 380px;
            }
            .hero-text-slide {
                opacity: 0;
                visibility: hidden;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.6s ease;
                transform: translateY(12px);
                pointer-events: none;
            }
            .hero-text-slide.active {
                opacity: 1;
                visibility: visible;
                position: relative;
                transform: translateY(0);
                pointer-events: auto;
            }
            .hero-nav-controls {
                z-index: 10;
                position: relative;
            }
            .hero-indicator-pill {
                height: 6px;
                width: 18px;
                border-radius: 4px;
                background: rgba(255, 255, 255, 0.3);
                border: none;
                cursor: pointer;
                padding: 0;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .hero-indicator-pill.active {
                width: 38px;
                background: #4ade80;
                box-shadow: 0 0 10px rgba(74, 222, 128, 0.7);
            }
            .hero-arrow-ctrl {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
                color: #ffffff;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: 0.82rem;
                cursor: pointer;
                transition: all 0.2s ease;
            }
            .hero-arrow-ctrl:hover {
                background: #4ade80;
                color: #052e16;
                border-color: #4ade80;
                transform: scale(1.08);
            }
            .hero-slide-counter {
                font-size: 0.75rem;
                font-weight: 700;
                letter-spacing: 0.5px;
                color: rgba(255, 255, 255, 0.7);
                background: rgba(0, 0, 0, 0.25);
                padding: 3px 10px;
                border-radius: 100px;
                border: 1px solid rgba(255, 255, 255, 0.15);
            }
        </style>

        @php
            $activeBanners = \App\Models\Banner::where('is_active', true)->get();
            if ($activeBanners->isEmpty()) {
                $activeBanners = collect([
                    (object)[
                        'title' => $siteSetting->hero_title ?: 'DLH Kab. Probolinggo',
                        'description' => $heroDesc,
                        'image' => $siteSetting->hero_banner_path,
                    ]
                ]);
            }
            $defaultHeroBg = 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=1474&q=80';
        @endphp

        <!-- Background Layers for All Active Banners -->
        @foreach($activeBanners as $idx => $b)
            @php
                $bBg = !empty($b->image) ? asset('storage/' . $b->image) : $defaultHeroBg;
            @endphp
            <div class="hero-bg hero-bg-slide {{ $idx === 0 ? 'active' : '' }}" 
                 id="heroBgSlide{{ $idx }}"
                 style="background-image: url('{{ $bBg }}');"></div>
        @endforeach

        <div class="hero-overlay"></div>
        <div class="hero-particles"></div>
        <div class="hero-content w-100">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-7 col-xl-6 py-5 position-relative hero-text-container">
                        @foreach($activeBanners as $idx => $b)
                            @php
                                $bTitle = $b->title ?: ($siteSetting->hero_title ?: 'DLH Kab. Probolinggo');
                                $bDesc = $b->description ?: $heroDesc;
                            @endphp
                            <div class="hero-text-slide {{ $idx === 0 ? 'active' : '' }}" id="heroTextSlide{{ $idx }}">
                                <div class="hero-badge anim-fadeup">
                                    <span class="hero-dot"></span>
                                    Resmi · Terpercaya · Profesional
                                </div>
                                <h1 class="hero-title anim-fadeup d1">
                                    {{ $bTitle }}<br>
                                    <span class="hero-highlight">Kabupaten Probolinggo</span>
                                </h1>
                                <p class="hero-desc anim-fadeup d2">{{ $bDesc }}</p>
                                <div class="d-flex gap-3 flex-wrap anim-fadeup d3">
                                    <a href="#layanan" class="btn-hero-primary"><i class="bi bi-grid-3x3-gap-fill"></i> Lihat Layanan</a>
                                    <a href="#berita" class="btn-hero-outline"><i class="bi bi-newspaper"></i> Berita</a>
                                </div>
                            </div>
                        @endforeach

                        @if($activeBanners->count() > 1)
                            <!-- Slider Nav Controls -->
                            <div class="hero-nav-controls anim-fadeup d3 d-flex align-items-center gap-2 mt-4 pt-2">
                                <div class="d-flex align-items-center gap-2">
                                    @foreach($activeBanners as $idx => $b)
                                        <button type="button" 
                                                class="hero-indicator-pill {{ $idx === 0 ? 'active' : '' }}" 
                                                id="heroDot{{ $idx }}" 
                                                onclick="switchHeroSlide({{ $idx }})" 
                                                aria-label="Banner {{ $idx + 1 }}"
                                                title="Lihat Banner {{ $idx + 1 }}"></button>
                                    @endforeach
                                </div>
                                <div class="d-flex align-items-center gap-1 ms-2">
                                    <button type="button" class="hero-arrow-ctrl" onclick="stepHeroSlide(-1)" aria-label="Banner Sebelumnya" title="Sebelumnya">
                                        <i class="bi bi-chevron-left"></i>
                                    </button>
                                    <button type="button" class="hero-arrow-ctrl" onclick="stepHeroSlide(1)" aria-label="Banner Berikutnya" title="Berikutnya">
                                        <i class="bi bi-chevron-right"></i>
                                    </button>
                                </div>
                                <span class="hero-slide-counter ms-1" id="heroSlideCounter">1 / {{ $activeBanners->count() }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if($activeBanners->count() > 1)
            <script>
                (function() {
                    let currentIdx = 0;
                    const totalBanners = {{ $activeBanners->count() }};
                    let heroAutoTimer = null;

                    window.switchHeroSlide = function(idx) {
                        if (idx < 0) idx = totalBanners - 1;
                        if (idx >= totalBanners) idx = 0;
                        currentIdx = idx;

                        for (let i = 0; i < totalBanners; i++) {
                            const bg = document.getElementById('heroBgSlide' + i);
                            const text = document.getElementById('heroTextSlide' + i);
                            const dot = document.getElementById('heroDot' + i);

                            if (i === currentIdx) {
                                if (bg) bg.classList.add('active');
                                if (text) text.classList.add('active');
                                if (dot) dot.classList.add('active');
                            } else {
                                if (bg) bg.classList.remove('active');
                                if (text) text.classList.remove('active');
                                if (dot) dot.classList.remove('active');
                            }
                        }

                        const counter = document.getElementById('heroSlideCounter');
                        if (counter) {
                            counter.textContent = (currentIdx + 1) + ' / ' + totalBanners;
                        }

                        restartHeroTimer();
                    };

                    window.stepHeroSlide = function(direction) {
                        switchHeroSlide(currentIdx + direction);
                    };

                    function restartHeroTimer() {
                        if (heroAutoTimer) clearInterval(heroAutoTimer);
                        heroAutoTimer = setInterval(function() {
                            switchHeroSlide(currentIdx + 1);
                        }, 6000);
                    }

                    restartHeroTimer();
                })();
            </script>
        @endif
        <div class="hero-stats-strip">
            <div class="container position-relative">
                <style>
                    .hero-stats-carousel-wrap {
                        display: flex;
                        align-items: center;
                        position: relative;
                        width: 100%;
                    }
                    .hero-stats-track {
                        display: flex;
                        align-items: center;
                        overflow-x: auto;
                        scroll-behavior: smooth;
                        scroll-snap-type: x mandatory;
                        -webkit-overflow-scrolling: touch;
                        scrollbar-width: none;
                        -ms-overflow-style: none;
                        width: 100%;
                        cursor: grab;
                        user-select: none;
                        padding: 4px 0;
                    }
                    .hero-stats-track:active {
                        cursor: grabbing;
                    }
                    .hero-stats-track::-webkit-scrollbar {
                        display: none;
                    }
                    .hero-stat-item {
                        text-align: center;
                        padding: 0 32px;
                        flex: 0 0 25%;
                        min-width: 220px;
                        scroll-snap-align: start;
                        box-sizing: border-box;
                    }
                    @media (max-width: 1199px) {
                        .hero-stat-item {
                            flex: 0 0 33.333%;
                            min-width: 200px;
                            padding: 0 24px;
                        }
                    }
                    @media (max-width: 768px) {
                        .hero-stat-item {
                            flex: 0 0 50%;
                            min-width: 170px;
                            padding: 0 16px;
                        }
                    }
                    @media (max-width: 480px) {
                        .hero-stat-item {
                            flex: 0 0 75%;
                            min-width: 160px;
                            padding: 0 12px;
                        }
                    }
                    .hero-stat-item + .hero-stat-item {
                        border-left: 1px solid rgba(255, 255, 255, 0.15);
                    }
                    .hero-stat-num {
                        font-size: 1.85rem;
                        font-weight: 800;
                        color: var(--amber);
                        line-height: 1.1;
                        letter-spacing: -0.5px;
                    }
                    .hero-stat-label {
                        font-size: 0.8rem;
                        color: rgba(255, 255, 255, 0.7);
                        margin-top: 4px;
                        font-weight: 500;
                        white-space: nowrap;
                    }
                    .hero-stats-arrow {
                        width: 36px;
                        height: 36px;
                        border-radius: 50%;
                        background: rgba(255, 255, 255, 0.12);
                        border: 1px solid rgba(255, 255, 255, 0.22);
                        color: #ffffff;
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        cursor: pointer;
                        font-size: 0.95rem;
                        flex-shrink: 0;
                        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
                        backdrop-filter: blur(8px);
                        z-index: 5;
                    }
                    .hero-stats-arrow:hover {
                        background: var(--amber);
                        color: #0f172a;
                        border-color: var(--amber);
                        transform: scale(1.1);
                        box-shadow: 0 0 14px rgba(251, 191, 36, 0.5);
                    }
                    .hero-stats-prev {
                        margin-right: 14px;
                    }
                    .hero-stats-next {
                        margin-left: 14px;
                    }
                </style>
                @php
                    $heroStats = \App\Models\Statistic::where('is_active', true)->latest()->get();
                @endphp
                <div class="hero-stats-carousel-wrap">
                    @if(count($heroStats) > 4)
                    <button type="button" class="hero-stats-arrow hero-stats-prev" onclick="slideHeroStats(-1)" aria-label="Geser ke kiri" title="Geser ke kiri">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    @endif

                    <div class="hero-stats-track" id="heroStatsTrack">
                        @forelse($heroStats as $stat)
                        <div class="hero-stat-item">
                            <div class="hero-stat-num">{{ $stat->value }}</div>
                            <div class="hero-stat-label">{{ $stat->title }}</div>
                        </div>
                        @empty
                        <div class="hero-stat-item"><div class="hero-stat-num">45K+</div><div class="hero-stat-label">Ton Sampah Dikelola</div></div>
                        <div class="hero-stat-item"><div class="hero-stat-num">124</div><div class="hero-stat-label">Titik RTH Terkelola</div></div>
                        <div class="hero-stat-item"><div class="hero-stat-num">45</div><div class="hero-stat-label">Bank Sampah Aktif</div></div>
                        <div class="hero-stat-item"><div class="hero-stat-num">85%</div><div class="hero-stat-label">Indeks Kualitas Udara</div></div>
                        @endforelse
                    </div>

                    @if(count($heroStats) > 4)
                    <button type="button" class="hero-stats-arrow hero-stats-next" onclick="slideHeroStats(1)" aria-label="Geser ke kanan" title="Geser ke kanan">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                    @endif
                </div>

                <script>
                    function slideHeroStats(dir) {
                        const track = document.getElementById('heroStatsTrack');
                        if (!track) return;
                        const item = track.querySelector('.hero-stat-item');
                        const scrollAmount = item ? (item.offsetWidth * 2) * dir : 300 * dir;
                        track.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        const track = document.getElementById('heroStatsTrack');
                        if (!track) return;
                        let isDown = false;
                        let startX, scrollLeft;

                        track.addEventListener('mousedown', (e) => {
                            isDown = true;
                            startX = e.pageX - track.offsetLeft;
                            scrollLeft = track.scrollLeft;
                        });
                        track.addEventListener('mouseleave', () => { isDown = false; });
                        track.addEventListener('mouseup', () => { isDown = false; });
                        track.addEventListener('mousemove', (e) => {
                            if (!isDown) return;
                            e.preventDefault();
                            const x = e.pageX - track.offsetLeft;
                            const walk = (x - startX) * 1.5;
                            track.scrollLeft = scrollLeft - walk;
                        });
                    });
                </script>
            </div>
        </div>
    </section>

    <!-- AKSES CEPAT -->
    <section id="akses-cepat" class="portal-section py-5">
        <div class="container py-3">
            <div class="text-center mb-5">
                <div class="section-label">Akses Cepat</div>
                <h2 class="section-title">Pintasan Akses Cepat</h2>
                <p class="text-muted mt-3" style="max-width:540px;margin:0 auto;font-size:.95rem;line-height:1.7;">
                    Pintasan praktis untuk mengakses kanal pengaduan masyarakat, pemantauan mutu lingkungan, dan layanan digital DLH.
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
                            <a href="{{ url('/profil/profil-instansi') }}" class="portal-featured-btn-primary"><i class="bi bi-building"></i> Lihat Profil</a>
                            <a href="{{ url('/profil/visi-misi') }}" class="portal-featured-btn-outline"><i class="bi bi-compass"></i> Visi &amp; Misi</a>
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

            {{-- QUICK ACCESS GRID --}}
            <div class="row g-4">
                @php
                $quickAccessItems = \App\Models\QuickAccess::where('is_active', true)->get();

                $metaByTitle = [
                    'Pengaduan Masyarakat' => [
                        'badge' => 'SP4N LAPOR!',
                        'desc' => 'Kanal aspirasi & aduan pencemaran lingkungan online cepat dan transparan.',
                        'icon' => 'bi-megaphone-fill',
                        'btn_text' => 'Buat Aduan',
                    ],
                    'Indeks Kualitas Udara' => [
                        'badge' => 'REAL-TIME ISPU',
                        'desc' => 'Pantau status baku mutu & indeks standar pencemar udara terkini di Probolinggo.',
                        'icon' => 'bi-cloud-sun-fill',
                        'btn_text' => 'Pantau ISPU',
                    ],
                    'Layanan Persampahan' => [
                        'badge' => 'TPS3R & BANK SAMPAH',
                        'desc' => 'Informasi retribusi, jadwal pengangkutan armada, serta daur ulang sampah terpadu.',
                        'icon' => 'bi-trash3-fill',
                        'btn_text' => 'Info Persampahan',
                    ],
                    'Perizinan Lingkungan' => [
                        'badge' => 'AMDAL & PERIZINAN',
                        'desc' => 'Panduan pengurusan dokumen AMDAL, UKL-UPL, dan persetujuan lingkungan resmi.',
                        'icon' => 'bi-file-earmark-check-fill',
                        'btn_text' => 'Cek Perizinan',
                    ],
                ];

                $iconFallback = [
                    'heroicon-o-megaphone' => 'bi-megaphone-fill',
                    'heroicon-o-cloud' => 'bi-cloud-sun-fill',
                    'heroicon-o-trash' => 'bi-trash3-fill',
                    'heroicon-o-document-check' => 'bi-file-earmark-check-fill',
                    'heroicon-o-bolt' => 'bi-lightning-charge-fill',
                ];
                @endphp

                @forelse($quickAccessItems as $item)
                @php
                    $cleanIcon = str_replace(['heroicon-o-', 'heroicon-m-', 'heroicon-s-'], '', $item->icon ?? '');
                    $resolvedIcon = $iconFallback[$item->icon] ?? (str_starts_with($item->icon ?? '', 'bi-') ? $item->icon : 'bi-' . ($cleanIcon ?: 'lightning-charge-fill'));
                    
                    $meta = $metaByTitle[$item->title] ?? [
                        'badge' => 'AKSES CEPAT',
                        'desc' => 'Tautan langsung ke sistem dan portal layanan digital Dinas Lingkungan Hidup.',
                        'icon' => $resolvedIcon,
                        'btn_text' => 'Buka Tautan',
                    ];

                    $isExternal = str_starts_with($item->url ?? '', 'http');
                @endphp
                <div class="col-lg-3 col-md-6">
                    <a href="{{ $item->url ?: '#' }}" target="{{ $isExternal ? '_blank' : '_self' }}" class="quick-card-elite">
                        {{-- Ambient Watermark Icon --}}
                        <i class="bi {{ $meta['icon'] }} qc-watermark"></i>

                        {{-- Card Header --}}
                        <div class="qc-header">
                            <span class="qc-badge">
                                <span class="qc-pulse"></span>
                                {{ $meta['badge'] }}
                            </span>
                            <div class="qc-icon-box">
                                <i class="bi {{ $meta['icon'] }}"></i>
                            </div>
                        </div>

                        {{-- Card Body --}}
                        <div class="qc-body">
                            <h4 class="qc-title">{{ $item->title }}</h4>
                            <p class="qc-desc">{{ $meta['desc'] }}</p>
                        </div>

                        {{-- Card Footer --}}
                        <div class="qc-footer">
                            <span class="qc-action-btn">
                                <span>{{ $meta['btn_text'] }}</span>
                                <i class="bi {{ $isExternal ? 'bi-box-arrow-up-right' : 'bi-arrow-right' }}"></i>
                            </span>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center text-muted py-4">Belum ada pintasan akses cepat.</div>
                @endforelse
            </div>
        </div>
    </section>

<!-- STATISTIK -->
    <section class="stats-section py-5">
        <div class="container py-3">
            <style>
                .stats-slider-track {
                    display: flex;
                    gap: 20px;
                    overflow-x: auto;
                    scroll-behavior: smooth;
                    scroll-snap-type: x mandatory;
                    padding: 8px 2px 20px 2px;
                    -webkit-overflow-scrolling: touch;
                    scrollbar-width: none;
                    -ms-overflow-style: none;
                    cursor: grab;
                }
                .stats-slider-track:active {
                    cursor: grabbing;
                }
                .stats-slider-track::-webkit-scrollbar {
                    display: none;
                }
                .stat-slider-item {
                    flex: 0 0 calc(25% - 15px);
                    min-width: 260px;
                    scroll-snap-align: start;
                    display: flex;
                }
                @media (max-width: 1200px) {
                    .stat-slider-item {
                        flex: 0 0 calc(33.333% - 14px);
                        min-width: 240px;
                    }
                }
                @media (max-width: 768px) {
                    .stat-slider-item {
                        flex: 0 0 calc(50% - 10px);
                        min-width: 210px;
                    }
                }
                @media (max-width: 520px) {
                    .stat-slider-item {
                        flex: 0 0 85%;
                        min-width: 200px;
                    }
                }

                /* KARTU STATISTIK KEREN, MODERN & ELEGAN */
                .stat-card-p {
                    background: linear-gradient(165deg, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0.02) 60%, rgba(16, 185, 129, 0.06) 100%);
                    border: 1px solid rgba(255, 255, 255, 0.12);
                    border-radius: 20px;
                    padding: 22px 20px 18px 20px;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    gap: 16px;
                    position: relative;
                    height: 100%;
                    width: 100%;
                    overflow: hidden;
                    backdrop-filter: blur(16px);
                    -webkit-backdrop-filter: blur(16px);
                    box-shadow: 0 8px 24px -6px rgba(0, 0, 0, 0.35), inset 0 1px 0 rgba(255, 255, 255, 0.15);
                    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
                }
                .stat-card-p:hover {
                    transform: translateY(-6px);
                    border-color: rgba(74, 222, 128, 0.5);
                    background: linear-gradient(165deg, rgba(255, 255, 255, 0.12) 0%, rgba(255, 255, 255, 0.03) 60%, rgba(16, 185, 129, 0.1) 100%);
                    box-shadow: 0 18px 36px -8px rgba(0, 0, 0, 0.45), 0 0 24px rgba(34, 197, 94, 0.18);
                }

                /* TOP ACCENT LINE */
                .stat-card-glow-bar {
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    height: 3px;
                    background: linear-gradient(90deg, #22c55e 0%, #4ade80 60%, transparent 100%);
                    opacity: 0.7;
                    transition: opacity 0.3s;
                }
                .stat-card-p:hover .stat-card-glow-bar {
                    opacity: 1;
                    box-shadow: 0 0 12px #22c55e;
                }

                /* KOTAK IKON DENGAN KEDALAMAN & SHINE */
                .stat-icon-box {
                    width: 48px;
                    height: 48px;
                    border-radius: 14px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1.45rem;
                    background: linear-gradient(135deg, rgba(34, 197, 94, 0.22) 0%, rgba(21, 128, 61, 0.38) 100%);
                    border: 1px solid rgba(74, 222, 128, 0.38);
                    color: #86efac;
                    box-shadow: 0 4px 14px rgba(22, 163, 74, 0.22), inset 0 1px 1px rgba(255, 255, 255, 0.25);
                    transition: all 0.3s ease;
                    flex-shrink: 0;
                }
                .stat-card-p:hover .stat-icon-box {
                    transform: scale(1.06);
                    color: #ffffff;
                    background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
                    box-shadow: 0 6px 18px rgba(22, 163, 74, 0.45);
                }

                /* CHIP INDIKATOR AKTIF */
                .stat-live-chip {
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    padding: 3px 9px;
                    border-radius: 9999px;
                    background: rgba(34, 197, 94, 0.12);
                    border: 1px solid rgba(74, 222, 128, 0.25);
                    font-size: 0.68rem;
                    font-weight: 700;
                    color: #86efac;
                    letter-spacing: 0.03em;
                    text-transform: uppercase;
                }
                .stat-pulse {
                    width: 6px;
                    height: 6px;
                    border-radius: 50%;
                    background: #22c55e;
                    box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
                    animation: statPulse 2s infinite;
                }
                @keyframes statPulse {
                    0% {
                        box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
                    }
                    70% {
                        box-shadow: 0 0 0 6px rgba(34, 197, 94, 0);
                    }
                    100% {
                        box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
                    }
                }

                /* ANGKA & JUDUL STATISTIK */
                .stat-body {
                    margin-top: 2px;
                }
                .stat-value {
                    font-size: 2.35rem;
                    font-weight: 900;
                    color: #ffffff;
                    line-height: 1.1;
                    letter-spacing: -0.7px;
                    margin-bottom: 5px;
                    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
                }
                .stat-name {
                    font-size: 0.92rem;
                    color: rgba(255, 255, 255, 0.82);
                    font-weight: 600;
                    line-height: 1.38;
                }

                /* FOOTER KARTU */
                .stat-card-footer {
                    padding-top: 10px;
                    border-top: 1px solid rgba(255, 255, 255, 0.08);
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                }
                .stat-footer-badge {
                    font-size: 0.72rem;
                    color: rgba(255, 255, 255, 0.6);
                    font-weight: 500;
                    display: inline-flex;
                    align-items: center;
                    gap: 5px;
                }

                /* TOMBOL NAVIGASI BERSIH & MODERN */
                .stats-nav-btn {
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.08);
                    border: 1.5px solid rgba(255, 255, 255, 0.18);
                    color: #ffffff;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    font-size: 1rem;
                    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
                    backdrop-filter: blur(8px);
                }
                .stats-nav-btn:hover {
                    background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
                    border-color: #4ade80;
                    color: #ffffff;
                    transform: scale(1.08);
                    box-shadow: 0 4px 16px rgba(22, 163, 74, 0.4);
                }
            </style>

            @php
                $statistics = \App\Models\Statistic::where('is_active', true)->latest()->get();
            @endphp

            <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
                <div>
                    <div class="section-label" style="color:var(--amber);"><span style="background:var(--amber);"></span>Capaian Kinerja<span style="background:var(--amber);"></span></div>
                    <h2 class="section-title section-title-light">Data & Statistik Terkini</h2>
                    <p class="mt-2" style="color:rgba(255,255,255,.65);max-width:520px;margin:0;font-size:.92rem;line-height:1.6;">
                        Gambaran pencapaian kinerja dan data strategis lingkungan di wilayah Kabupaten Probolinggo.
                    </p>
                </div>
                @if(count($statistics) > 4)
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="stats-nav-btn" onclick="slideStats(-1)" aria-label="Sebelumnya" title="Sebelumnya">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button type="button" class="stats-nav-btn" onclick="slideStats(1)" aria-label="Berikutnya" title="Berikutnya">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
                @endif
            </div>

            <!-- SLIDER TRACK KESAMPING BISA DIGESER -->
            <div class="stats-slider-track" id="statsTrack">
                @forelse($statistics as $stat)
                @php
                    $iconMap = [
                        'heroicon-o-trash' => 'bi-trash3',
                        'heroicon-o-tree' => 'bi-tree',
                        'heroicon-o-chart-bar' => 'bi-bar-chart',
                        'heroicon-o-building-storefront' => 'bi-shop',
                        'heroicon-o-cloud' => 'bi-cloud',
                        'heroicon-o-megaphone' => 'bi-megaphone',
                        'heroicon-o-document-check' => 'bi-file-earmark-check',
                    ];
                    $cleanIcon = str_replace(['heroicon-o-', 'heroicon-m-', 'heroicon-s-'], '', $stat->icon ?? '');
                    $iconClass = $iconMap[$stat->icon ?? ''] ?? (str_starts_with($stat->icon ?? '', 'bi-') ? $stat->icon : 'bi-' . $cleanIcon);
                    if(!str_starts_with($iconClass, 'bi-') || $iconClass === 'bi-') $iconClass = 'bi-bar-chart';
                @endphp
                <div class="stat-slider-item">
                    <div class="stat-card-p">
                        <div class="stat-card-glow-bar"></div>

                        <!-- Header Kartu: Ikon & Chip Status -->
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div class="stat-icon-box">
                                <i class="bi {{ $iconClass }}"></i>
                            </div>
                            <span class="stat-live-chip">
                                <span class="stat-pulse"></span> Terdata
                            </span>
                        </div>

                        <!-- Body: Nilai & Label -->
                        <div class="stat-body">
                            <div class="stat-value">{{ $stat->value }}</div>
                            <div class="stat-name">{{ $stat->title }}</div>
                        </div>

                        <!-- Footer: Keterangan Resmi -->
                        <div class="stat-card-footer">
                            <span class="stat-footer-badge">
                                <i class="bi bi-patch-check-fill text-success"></i> DLH Kab. Probolinggo
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Fallback jika database kosong -->
                <div class="stat-slider-item">
                    <div class="stat-card-p">
                        <div class="stat-card-glow-bar"></div>
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div class="stat-icon-box"><i class="bi bi-trash3"></i></div>
                            <span class="stat-live-chip"><span class="stat-pulse"></span> Terdata</span>
                        </div>
                        <div class="stat-body">
                            <div class="stat-value">45.280</div>
                            <div class="stat-name">Ton Sampah Terkelola</div>
                        </div>
                        <div class="stat-card-footer">
                            <span class="stat-footer-badge"><i class="bi bi-patch-check-fill text-success"></i> DLH Kab. Probolinggo</span>
                        </div>
                    </div>
                </div>
                <div class="stat-slider-item">
                    <div class="stat-card-p">
                        <div class="stat-card-glow-bar"></div>
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div class="stat-icon-box"><i class="bi bi-tree"></i></div>
                            <span class="stat-live-chip"><span class="stat-pulse"></span> Terdata</span>
                        </div>
                        <div class="stat-body">
                            <div class="stat-value">124</div>
                            <div class="stat-name">Titik Ruang Terbuka Hijau</div>
                        </div>
                        <div class="stat-card-footer">
                            <span class="stat-footer-badge"><i class="bi bi-patch-check-fill text-success"></i> DLH Kab. Probolinggo</span>
                        </div>
                    </div>
                </div>
                <div class="stat-slider-item">
                    <div class="stat-card-p">
                        <div class="stat-card-glow-bar"></div>
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div class="stat-icon-box"><i class="bi bi-wind"></i></div>
                            <span class="stat-live-chip"><span class="stat-pulse"></span> Terdata</span>
                        </div>
                        <div class="stat-body">
                            <div class="stat-value">85%</div>
                            <div class="stat-name">Indeks Kualitas Udara</div>
                        </div>
                        <div class="stat-card-footer">
                            <span class="stat-footer-badge"><i class="bi bi-patch-check-fill text-success"></i> DLH Kab. Probolinggo</span>
                        </div>
                    </div>
                </div>
                <div class="stat-slider-item">
                    <div class="stat-card-p">
                        <div class="stat-card-glow-bar"></div>
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div class="stat-icon-box"><i class="bi bi-recycle"></i></div>
                            <span class="stat-live-chip"><span class="stat-pulse"></span> Terdata</span>
                        </div>
                        <div class="stat-body">
                            <div class="stat-value">45</div>
                            <div class="stat-name">Bank Sampah Aktif</div>
                        </div>
                        <div class="stat-card-footer">
                            <span class="stat-footer-badge"><i class="bi bi-patch-check-fill text-success"></i> DLH Kab. Probolinggo</span>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        <script>
            function slideStats(dir) {
                const track = document.getElementById('statsTrack');
                if (!track) return;
                const card = track.querySelector('.stat-slider-item');
                const scrollAmount = card ? (card.offsetWidth + 20) * dir : 280 * dir;
                track.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }

            // Drag to scroll
            document.addEventListener('DOMContentLoaded', function() {
                const track = document.getElementById('statsTrack');
                if (!track) return;
                let isDown = false;
                let startX, scrollLeft;

                track.addEventListener('mousedown', (e) => {
                    isDown = true;
                    startX = e.pageX - track.offsetLeft;
                    scrollLeft = track.scrollLeft;
                });
                track.addEventListener('mouseleave', () => { isDown = false; });
                track.addEventListener('mouseup', () => { isDown = false; });
                track.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - track.offsetLeft;
                    const walk = (x - startX) * 1.5;
                    track.scrollLeft = scrollLeft - walk;
                });
            });
        </script>
    </section>

    <!-- LAYANAN UNGGULAN -->
    <section id="layanan" class="layanan-section py-5">
        <div class="container py-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5 gap-3">
                <div>
                    <div class="section-label" style="color:var(--amber);"><span style="background:var(--amber);"></span>Layanan Kami<span style="background:var(--amber);"></span></div>
                    <h2 class="section-title section-title-light">Layanan Unggulan DLH</h2>
                    <p style="color:rgba(255,255,255,.55);font-size:.92rem;line-height:1.7;max-width:480px;margin-top:8px;">Pelayanan publik di bidang pelestarian alam, pengelolaan sampah, dan tata lingkungan yang profesional.</p>
                </div>
                <a href="{{ url('/layanan') }}" class="btn fw-semibold px-4 py-2 text-white" style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);border-radius:10px;white-space:nowrap;transition:all .3s;">
                    Semua Layanan <i class="bi bi-arrow-right text-success ms-1"></i>
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
                                <span style="font-size:.74rem;color:rgba(255,255,255,.6);font-weight:500;"><i class="bi bi-clock me-1 text-success"></i> Tersedia</span>
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
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
                <div>
                    <div class="section-label">Visual</div>
                    <h2 class="section-title">Galeri Dokumentasi</h2>
                    <p class="text-muted mt-2" style="max-width:500px;margin-bottom:0;font-size:.93rem;line-height:1.7;">Potret aktivitas pelayanan lapangan, pengangkutan sampah, dan program kerja DLH.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="gallery-nav-btn" onclick="slideGallery(-1)" aria-label="Sebelumnya" title="Geser ke Kiri">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button type="button" class="gallery-nav-btn" onclick="slideGallery(1)" aria-label="Berikutnya" title="Geser ke Kanan">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                    <a href="{{ url('/informasi/galeri') }}" class="btn fw-semibold px-4 py-2 ms-2" style="background:#f0fdf4;color:var(--g700);border:1px solid rgba(22,163,74,.2);border-radius:10px;white-space:nowrap;transition:all .3s;">
                        Semua Foto <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            
            <ul class="nav gallery-tabs gap-2 justify-content-center justify-content-md-start mb-4" id="galTab" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#galFoto"><i class="bi bi-camera-fill me-2"></i>Galeri Foto</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#galVideo"><i class="bi bi-play-btn-fill me-2"></i>Galeri Video</button></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="galFoto">
                    <div class="gallery-scroll">
                        @php
                            // Get all galleries of type foto
                            $galleries = \App\Models\Gallery::where('type', 'foto')->latest()->take(10)->get();
                        @endphp
                        @forelse($galleries as $g)
                            @php
                                $imgs = $g->images ?? [];
                                if (!is_array($imgs)) {
                                    $imgs = !empty($imgs) ? [$imgs] : [];
                                }
                                $imgs = array_values(array_filter($imgs, fn($i) => !empty($i)));
                                $count = count($imgs);
                                $allUrls = [];
                                foreach($imgs as $img) {
                                    $allUrls[] = str_starts_with($img, 'http') ? $img : asset('storage/' . ltrim($img, '/'));
                                }
                                $thumbSrc = $count > 0 ? $allUrls[0] : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=600&h=400&fit=crop';
                            @endphp
                            <div class="gallery-item" style="cursor:pointer;" onclick="openAlbumLightbox({{ json_encode($allUrls) }}, '{{ addslashes($g->title) }}', '{{ addslashes($g->category ?? 'Kegiatan Lapangan') }}')">
                                <img src="{{ $thumbSrc }}" alt="{{ $g->title }}">
                                <div class="gallery-item-overlay"></div>

                                @if($count > 1)
                                    <!-- Badge Album di Pojok Kiri Atas -->
                                    <div class="position-absolute top-0 start-0 m-3" style="z-index: 3;">
                                        <span class="badge" style="background: linear-gradient(135deg, #059669, #10b981); color:#fff; font-size:.72rem; padding: 5px 12px; border-radius: 100px; box-shadow: 0 4px 12px rgba(0,0,0,0.3); font-weight: 700; display: inline-flex; align-items: center; gap: 4px;">
                                            <i class="bi bi-images"></i> ALBUM ({{ $count }} FOTO)
                                        </span>
                                    </div>
                                    <!-- Indikator Album di Pojok Kanan Atas -->
                                    <div class="position-absolute top-0 end-0 m-3" style="z-index: 3;">
                                        <span class="badge" style="background: rgba(15,23,42,0.75); backdrop-filter: blur(4px); color: #fff; font-size: .68rem; padding: 4px 9px; border-radius: 8px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; border: 1px solid rgba(255,255,255,0.2);">
                                            <i class="bi bi-collection-fill text-warning"></i> {{ $count }}
                                        </span>
                                    </div>
                                @endif

                                <div class="gallery-item-content">
                                    <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                                        <span class="badge" style="background:rgba(4,120,87,.9);color:#fff;font-size:.7rem;padding:4px 10px;border-radius:100px;backdrop-filter:blur(4px);">
                                            <i class="bi bi-tag-fill me-1"></i>{{ $g->category ?? 'FOTO' }}
                                        </span>
                                        @if($count > 1)
                                            <span class="text-white-50 small" style="font-size: 0.72rem;">
                                                <i class="bi bi-camera me-1"></i>{{ $count }} Foto Dokumentasi
                                            </span>
                                        @endif
                                    </div>
                                    <h6>{{ $g->title }}</h6>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted w-100 text-center py-4">Belum ada foto galeri.</p>
                        @endforelse

                        <!-- KARTU LIHAT SEMUA FOTO KETIKA DIGESER KE SAMPING -->
                        <a href="{{ url('/informasi/galeri') }}" class="gallery-item d-flex flex-column align-items-center justify-content-center text-decoration-none p-4 text-center" style="background: linear-gradient(145deg, #022c22 0%, #064e3b 50%, #047857 100%); border: 2px dashed rgba(74, 222, 128, 0.4); border-radius: 1.25rem; min-width: 260px; flex: 0 0 280px; transition: all .35s ease;">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mb-3 text-white shadow-lg" style="width: 64px; height: 64px; background: rgba(255,255,255,0.15); font-size: 1.8rem; border: 1px solid rgba(255,255,255,0.25);">
                                <i class="bi bi-images"></i>
                            </div>
                            <h5 class="text-white fw-bold mb-1.5" style="font-size: 1.1rem;">Lihat Semua Foto</h5>
                            <p class="text-white-50 small mb-3" style="line-height: 1.5; font-size: 0.82rem;">Jelajahi seluruh album dokumentasi resmi kegiatan DLH</p>
                            <span class="btn btn-sm btn-light rounded-pill px-3 py-1.5 fw-bold text-success shadow-xs d-inline-flex align-items-center gap-1.5" style="font-size: 0.82rem;">
                                Buka Semua Foto <i class="bi bi-arrow-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="tab-pane fade" id="galVideo">
                    <div class="gallery-scroll">
                        @php
                            $videoGalleries = \App\Models\Gallery::where('type', 'video')->latest()->take(10)->get();
                            $allVideos = [];
                            foreach($videoGalleries as $g) {
                                $thumbnail = !empty($g->images) && is_array($g->images) && count($g->images) > 0 ? asset('storage/' . $g->images[0]) : null;
                                
                                $embedUrl = $g->video_url ?? '';
                                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $embedUrl, $match);
                                
                                if (isset($match[1])) {
                                    $embedUrl = 'https://www.youtube.com/embed/' . $match[1];
                                    if (!$thumbnail) {
                                        $thumbnail = 'https://img.youtube.com/vi/' . $match[1] . '/hqdefault.jpg';
                                    }
                                }
                                
                                $allVideos[] = [
                                    'title' => $g->title,
                                    'img' => $thumbnail ?: 'https://images.unsplash.com/photo-1611162617474-5b21e879e113?w=600&h=400&fit=crop',
                                    'vid' => $embedUrl,
                                    'cat' => $g->category
                                ];
                            }
                        @endphp
                        @forelse($allVideos as $v)
                        <div class="gallery-item" style="cursor:pointer;" onclick="openLightbox('{{ $v['vid'] }}', '{{ addslashes($v['title']) }}', 'video')">
                            <img src="{{ $v['img'] }}" alt="{{ $v['title'] }}">
                            <div class="gallery-item-overlay"></div>
                            <div class="gallery-play-btn"><i class="bi bi-play-fill"></i></div>
                            <div class="gallery-item-content">
                                <span class="badge mb-2" style="background:rgba(220,38,38,.9);color:#fff;font-size:.7rem;padding:4px 10px;border-radius:100px;backdrop-filter:blur(4px);"><i class="bi bi-play-btn-fill me-1"></i>{{ $v['cat'] ?? 'VIDEO' }}</span>
                                <h6>{{ $v['title'] }}</h6>
                            </div>
                        </div>
                        @empty
                            <p class="text-muted w-100 text-center py-4">Belum ada video galeri.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- LIGHTBOX MODAL UNTUK GAMBAR / ALBUM / VIDEO -->
    <div class="modal fade" id="lightboxModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark text-white rounded-4 overflow-hidden border-0 shadow-lg" style="box-shadow: 0 25px 60px rgba(0,0,0,0.6) !important;">
          <div class="modal-header border-0 pb-0 justify-content-between align-items-center p-3 p-md-4">
            <div class="d-flex align-items-center gap-2 overflow-hidden me-2">
                <span id="lbCounterBadge" class="badge bg-success rounded-pill px-2.5 py-1 font-monospace small flex-shrink-0" style="display:none;"></span>
                <h5 class="modal-title fw-bold text-white mb-0 text-truncate" id="lightboxTitle"></h5>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center p-3 p-md-4 position-relative" id="lightboxBody">
            <!-- Content injected via JS -->
          </div>
          <!-- Thumbnail Bar untuk Album -->
          <div id="lbThumbBar" class="d-flex gap-2 justify-content-center overflow-x-auto py-2 px-3 bg-black bg-opacity-50 border-top border-secondary border-opacity-25" style="display:none !important;"></div>
        </div>
      </div>
    </div>

    <script>
    let lbPhotos = [];
    let lbIndex = 0;
    let lbModalInstance = null;

    function openAlbumLightbox(photos, title, category) {
        if (!Array.isArray(photos)) {
            photos = photos ? [photos] : [];
        }
        lbPhotos = photos;
        lbIndex = 0;

        document.getElementById('lightboxTitle').innerText = title;
        const badge = document.getElementById('lbCounterBadge');
        const thumbBar = document.getElementById('lbThumbBar');

        if (lbPhotos.length > 1) {
            badge.style.display = 'inline-block';
            thumbBar.style.setProperty('display', 'flex', 'important');
            
            // Render thumbnail strip
            thumbBar.innerHTML = '';
            lbPhotos.forEach((src, idx) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = `btn p-0 rounded-3 overflow-hidden border-2 flex-shrink-0 transition-all ${idx === 0 ? 'border-success opacity-100 shadow-sm' : 'border-secondary opacity-50'}`;
                btn.style.width = '48px';
                btn.style.height = '48px';
                btn.onclick = () => setLbPhoto(idx);

                const img = document.createElement('img');
                img.src = src;
                img.className = 'w-100 h-100 object-fit-cover';
                btn.appendChild(img);
                thumbBar.appendChild(btn);
            });
        } else {
            badge.style.display = 'none';
            thumbBar.style.setProperty('display', 'none', 'important');
            thumbBar.innerHTML = '';
        }

        renderLbBody();
        showLbModal();
    }

    function renderLbBody() {
        const body = document.getElementById('lightboxBody');
        const photoUrl = lbPhotos[lbIndex] || '';

        let navHtml = '';
        if (lbPhotos.length > 1) {
            navHtml = `
                <button type="button" onclick="navigateLb(-1)" class="btn btn-dark bg-opacity-75 text-white position-absolute start-0 top-50 translate-middle-y ms-3 rounded-circle shadow-lg d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; z-index: 5; border: 1px solid rgba(255,255,255,0.2);">
                    <i class="bi bi-chevron-left fs-5"></i>
                </button>
                <button type="button" onclick="navigateLb(1)" class="btn btn-dark bg-opacity-75 text-white position-absolute end-0 top-50 translate-middle-y me-3 rounded-circle shadow-lg d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; z-index: 5; border: 1px solid rgba(255,255,255,0.2);">
                    <i class="bi bi-chevron-right fs-5"></i>
                </button>
            `;
            document.getElementById('lbCounterBadge').innerText = `Foto ${lbIndex + 1} dari ${lbPhotos.length}`;
        }

        body.innerHTML = `
            <div class="position-relative rounded-4 overflow-hidden bg-black d-flex align-items-center justify-content-center border border-secondary border-opacity-25" style="min-height: 380px; max-height: 72vh;">
                <img id="lbMainImg" src="${photoUrl}" class="img-fluid rounded" alt="Foto Galeri" style="max-height: 70vh; object-fit: contain; transition: opacity 0.15s ease;">
                ${navHtml}
            </div>
        `;

        // Update active thumb
        const thumbBar = document.getElementById('lbThumbBar');
        if (thumbBar && thumbBar.children.length > 0) {
            const thumbs = thumbBar.children;
            for (let i = 0; i < thumbs.length; i++) {
                if (i === lbIndex) {
                    thumbs[i].className = 'btn p-0 rounded-3 overflow-hidden border-2 border-success opacity-100 shadow-sm flex-shrink-0';
                    thumbs[i].scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                } else {
                    thumbs[i].className = 'btn p-0 rounded-3 overflow-hidden border-2 border-secondary border-opacity-50 opacity-50 flex-shrink-0';
                }
            }
        }
    }

    function setLbPhoto(idx) {
        if (idx < 0 || idx >= lbPhotos.length) return;
        lbIndex = idx;
        const img = document.getElementById('lbMainImg');
        if (img) {
            img.style.opacity = '0.3';
            setTimeout(() => {
                img.src = lbPhotos[lbIndex];
                img.style.opacity = '1';
                document.getElementById('lbCounterBadge').innerText = `Foto ${lbIndex + 1} dari ${lbPhotos.length}`;
            }, 100);
        } else {
            renderLbBody();
        }

        const thumbBar = document.getElementById('lbThumbBar');
        if (thumbBar && thumbBar.children.length > 0) {
            const thumbs = thumbBar.children;
            for (let i = 0; i < thumbs.length; i++) {
                thumbs[i].className = (i === lbIndex) 
                    ? 'btn p-0 rounded-3 overflow-hidden border-2 border-success opacity-100 shadow-sm flex-shrink-0'
                    : 'btn p-0 rounded-3 overflow-hidden border-2 border-secondary border-opacity-50 opacity-50 flex-shrink-0';
            }
        }
    }

    function navigateLb(direction) {
        if (lbPhotos.length <= 1) return;
        lbIndex = (lbIndex + direction + lbPhotos.length) % lbPhotos.length;
        setLbPhoto(lbIndex);
    }

    function showLbModal() {
        const modalEl = document.getElementById('lightboxModal');
        if (!lbModalInstance) {
            lbModalInstance = new bootstrap.Modal(modalEl);
            modalEl.addEventListener('keydown', function(e) {
                if (lbPhotos.length > 1) {
                    if (e.key === 'ArrowLeft') navigateLb(-1);
                    else if (e.key === 'ArrowRight') navigateLb(1);
                }
            });
        }
        lbModalInstance.show();
    }

    function openLightbox(src, title, type) {
        const body = document.getElementById('lightboxBody');
        const titleEl = document.getElementById('lightboxTitle');
        const badge = document.getElementById('lbCounterBadge');
        const thumbBar = document.getElementById('lbThumbBar');

        titleEl.innerText = title;
        badge.style.display = 'none';
        thumbBar.style.setProperty('display', 'none', 'important');
        thumbBar.innerHTML = '';
        lbPhotos = [];
        
        if(type === 'video') {
            body.innerHTML = `<div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-lg"><iframe src="${src}?autoplay=1" allow="autoplay; encrypted-media" allowfullscreen class="rounded"></iframe></div>`;
        } else {
            body.innerHTML = `
                <div class="rounded-4 overflow-hidden bg-black d-flex align-items-center justify-content-center border border-secondary border-opacity-25" style="min-height: 380px; max-height: 72vh;">
                    <img src="${src}" class="img-fluid rounded" alt="${title}" style="max-height:70vh; object-fit: contain;">
                </div>
            `;
        }
        
        showLbModal();
    }

    // Navigasi tombol panah geser galeri
    function slideGallery(dir) {
        const activeTab = document.querySelector('#galTab .nav-link.active');
        const targetId = activeTab ? activeTab.getAttribute('data-bs-target') : '#galFoto';
        const pane = document.querySelector(targetId);
        if (!pane) return;
        const track = pane.querySelector('.gallery-scroll');
        if (!track) return;
        const item = track.querySelector('.gallery-item');
        const scrollAmount = item ? (item.offsetWidth + 18) * dir : 350 * dir;
        track.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }

    // Drag to scroll for .gallery-scroll containers with drag threshold
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.gallery-scroll').forEach(track => {
            let isDown = false;
            let startX, scrollLeft;
            let hasDragged = false;

            track.addEventListener('mousedown', (e) => {
                isDown = true;
                hasDragged = false;
                startX = e.pageX - track.offsetLeft;
                scrollLeft = track.scrollLeft;
            });
            track.addEventListener('mouseleave', () => { isDown = false; });
            track.addEventListener('mouseup', () => { 
                isDown = false; 
                setTimeout(() => { hasDragged = false; }, 80);
            });
            track.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                const x = e.pageX - track.offsetLeft;
                const walk = (x - startX) * 1.5;
                if (Math.abs(walk) > 6) {
                    hasDragged = true;
                    e.preventDefault();
                    track.scrollLeft = scrollLeft - walk;
                }
            });

            // Prevent accidental click when dragging
            track.addEventListener('click', (e) => {
                if (hasDragged) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            }, true);
        });
    });
    </script>
    <style>
        .gallery-nav-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1.5px solid #e2e8f0;
            background: #ffffff;
            color: #0f172a;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .gallery-nav-btn:hover {
            background: #16a34a;
            color: #ffffff;
            border-color: #16a34a;
            transform: scale(1.06);
        }
    </style>


        <!-- MITRA -->
    <section class="mitra-section py-5">
        <div class="container text-center py-3">
            <div class="section-label">Ekosistem</div>
            <h2 class="section-title mb-2">Instansi & Mitra Terkoneksi</h2>
            <p class="text-muted mb-5" style="max-width:560px;margin:12px auto 0;font-size:.92rem;line-height:1.7;">Sinergi pelayanan publik lingkungan dan koordinasi antar lembaga di Kabupaten Probolinggo.</p>
            <div class="d-flex flex-wrap justify-content-center gap-4">
                @php
                    $mitras = \App\Models\RelatedLink::where('is_active', true)->latest()->get();
                @endphp
                @forelse($mitras as $m)
                <a href="{{ $m->url }}" target="_blank" class="mitra-card">
                    <div class="mitra-inner-card">
                        @if($m->logo && !str_starts_with($m->logo, 'bi-'))
                            <img src="{{ filter_var($m->logo, FILTER_VALIDATE_URL) ? $m->logo : asset('storage/' . $m->logo) }}" alt="{{ $m->title }}" class="mitra-img">
                        @else
                            <div class="mitra-icon-fallback">
                                <i class="bi {{ $m->logo ?: 'bi-link-45deg' }}"></i>
                            </div>
                        @endif
                        <div class="mitra-text-wrap" style="justify-content: center;">
                            <div class="mitra-name">{{ $m->title }}</div>
                        </div>
                    </div>
                    <i class="bi bi-arrow-up-right mitra-arrow"></i>
                </a>
                @empty
                    <p class="text-muted">Belum ada tautan terkait.</p>
                @endforelse
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
                            <a href="https://wa.me/6282131001001?text=Hallo%20sae" target="_blank" class="cta-btn cta-btn-green">
                                <div class="cta-btn-icon" style="background:rgba(255,255,255,.1);"><i class="bi bi-whatsapp text-white fs-4"></i></div>
                                <div class="flex-grow-1"><div style="font-size:1rem;font-weight:800;">HALLO SAE</div><div style="font-size:.78rem;opacity:.85;font-weight:400;">Hubungi Tim Reaksi Cepat</div></div>
                                <i class="bi bi-arrow-right fs-4 opacity-75"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
