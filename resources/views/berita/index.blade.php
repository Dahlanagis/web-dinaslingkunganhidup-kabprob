@extends('layouts.public')

@section('content')
@php
    $isArtikel = ($category ?? '') === 'artikel';
@endphp

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
                <li class="breadcrumb-item active text-white" aria-current="page">
                    {{ $isArtikel ? 'Artikel Lingkungan' : 'Berita' }}
                </li>
            </ol>
        </nav>
        
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill mb-3 subpage-pill-badge">
            <span class="subpage-pulse-beacon"></span>
            <i class="bi {{ $isArtikel ? 'bi-flower1 text-warning' : 'bi-newspaper text-warning' }}"></i>
            <span>{{ $isArtikel ? 'Publikasi & Edukasi Pelestarian Alam' : 'Pusat Publikasi & Rilis Berita Resmi' }}</span>
        </div>

        <h1 class="fw-extrabold display-5 mb-2" style="font-weight: 800; letter-spacing: -0.5px;">
            @if($isArtikel)
                Artikel &amp; Edukasi <span class="header-text-gradient">Lingkungan Hidup</span>
            @else
                Berita Terkini <span class="header-text-gradient">DLH Kab. Probolinggo</span>
            @endif
        </h1>
        <p class="text-white-75 mb-0" style="max-width: 680px; font-size: 1.02rem; line-height: 1.7;">
            @if($isArtikel)
                Wawasan edukatif seputar pemilahan sampah mandiri, gerakan sekolah Adiwiyata, kelestarian keanekaragaman hayati, dan pelestarian bumi Probolinggo.
            @else
                Ikuti liputan kegiatan kedinasan, agenda lapangan, pemantauan lingkungan, dan informasi operasional Dinas Lingkungan Hidup Kabupaten Probolinggo.
            @endif
        </p>
    </div>
</section>

<!-- MAIN CONTENT -->
<div class="py-5" style="background: var(--slate50);">
    <div class="container">
        <!-- TOP TOOLBAR & SEARCH (Glassmorphism Style) -->
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-5 p-3.5 rounded-4 subpage-toolbar-glass">
            <!-- Indicator Badge -->
            <div class="d-flex align-items-center gap-2">
                <span class="badge {{ $isArtikel ? 'bg-warning text-dark' : 'bg-success text-white' }} px-3.5 py-2 rounded-pill fw-bold shadow-xs" style="font-size: 0.82rem;">
                    <i class="bi {{ $isArtikel ? 'bi-journal-bookmark-fill' : 'bi-newspaper' }} me-1.5"></i>
                    {{ $isArtikel ? 'Kategori: Artikel Lingkungan' : 'Kategori: Berita' }}
                </span>
                <span class="text-muted small">
                    Tersedia <strong>{{ $posts->total() ?? $posts->count() }}</strong> {{ $isArtikel ? 'artikel terbit' : 'berita terbit' }}
                </span>
            </div>

            <!-- Search Form with Glass Style -->
            <form action="{{ url()->current() }}" method="GET" class="d-flex gap-2" style="min-width: 290px;">
                <div class="input-group input-group-sm custom-search-group">
                    <span class="input-group-text bg-white border-end-0 text-success"><i class="bi bi-search"></i></span>
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control border-start-0 ps-0" placeholder="{{ $isArtikel ? 'Cari judul artikel...' : 'Cari judul berita...' }}">
                    <button class="btn btn-success fw-bold px-3 search-submit-btn" type="submit">Cari</button>
                </div>
            </form>
        </div>

        <!-- POSTS GRID -->
        <div class="row g-4">
            @forelse($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 rounded-4 overflow-hidden premium-news-card shadow-sm position-relative">
                    <!-- Top Accent Border on Card -->
                    <div class="card-accent-bar {{ $isArtikel ? 'accent-amber' : 'accent-green' }}"></div>
                    
                    <!-- Cover Image -->
                    <div class="position-relative overflow-hidden news-img-box" style="height: 225px;">
                        <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=600&h=400&fit=crop' }}" 
                             alt="{{ $post->title }}" 
                             class="w-100 h-100 object-fit-cover news-card-thumb"
                             loading="lazy">
                        <div class="news-img-gradient-overlay"></div>
                        
                        <!-- Floating Category Badge -->
                        <div class="position-absolute top-0 start-0 m-3" style="z-index: 2;">
                            <span class="badge {{ $isArtikel ? 'bg-warning text-dark' : 'bg-success text-white' }} shadow-sm px-3 py-1.5 rounded-pill font-monospace fw-bold" style="font-size: 0.74rem; letter-spacing: 0.5px;">
                                <i class="bi {{ $isArtikel ? 'bi-file-earmark-text' : 'bi-tag-fill' }} me-1"></i>
                                {{ $isArtikel ? 'ARTIKEL' : 'BERITA' }}
                            </span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-4 d-flex flex-column">
                        <!-- Meta info -->
                        <div class="d-flex align-items-center gap-3 text-muted small mb-2.5" style="font-size: 0.8rem;">
                            <span><i class="bi bi-calendar3 me-1 text-success"></i> {{ $post->created_at ? $post->created_at->translatedFormat('d M Y') : 'Terbaru' }}</span>
                            <span><i class="bi bi-eye me-1 text-info"></i> {{ $post->views ?? 0 }} dilihat</span>
                        </div>

                        <!-- Title -->
                        <h5 class="fw-extrabold mb-2.5 text-dark news-title" style="font-size: 1.12rem; line-height: 1.45;">
                            <a href="{{ url(($isArtikel ? '/artikel/' : '/berita/') . $post->slug) }}" class="text-dark text-decoration-none title-link">
                                {{ $post->title }}
                            </a>
                        </h5>

                        <!-- Excerpt -->
                        <p class="text-muted small mb-4 flex-grow-1" style="line-height: 1.65; font-size: 0.88rem;">
                            {{ Str::limit(strip_tags($post->content), 115) }}
                        </p>

                        <!-- Footer Link -->
                        <div class="pt-3 border-top d-flex align-items-center justify-content-between mt-auto">
                            <a href="{{ url(($isArtikel ? '/artikel/' : '/berita/') . $post->slug) }}" class="read-more-btn {{ $isArtikel ? 'text-warning' : 'text-success' }} fw-bold text-decoration-none small d-inline-flex align-items-center gap-1.5">
                                <span>{{ $isArtikel ? 'Baca Artikel' : 'Baca Selengkapnya' }}</span>
                                <i class="bi bi-arrow-right-short fs-5 transition-transform"></i>
                            </a>
                            <span class="text-muted small" style="font-size: 0.75rem;"><i class="bi bi-shield-check text-success me-1"></i> DLH Kab. Probolinggo</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 py-5 text-center">
                <div class="py-5 bg-white rounded-4 border shadow-sm p-4 mx-auto" style="max-width: 580px;">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3 text-muted" style="width: 76px; height: 76px; font-size: 2.5rem;">
                        <i class="bi {{ $isArtikel ? 'bi-journal-x' : 'bi-newspaper' }}"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">{{ $isArtikel ? 'Belum Ada Artikel Ditemukan' : 'Belum Ada Berita Ditemukan' }}</h4>
                    <p class="text-muted small mb-3">Tidak ada konten yang sesuai dengan kata kunci pencarian Anda.</p>
                    <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-success rounded-pill px-4 fw-bold">
                        <i class="bi bi-arrow-clockwise me-1"></i> Muat Ulang
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- PAGINATION -->
        @if(method_exists($posts, 'links') && $posts->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
        @endif
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

    /* TOOLBAR GLASS */
    .subpage-toolbar-glass {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(22, 163, 74, 0.18);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
    }
    .custom-search-group {
        border-radius: 9999px;
        overflow: hidden;
        border: 1px solid rgba(22, 163, 74, 0.3);
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    }
    .custom-search-group input:focus {
        box-shadow: none;
    }
    .search-submit-btn {
        border-radius: 0 9999px 9999px 0 !important;
        transition: background-color 0.25s ease;
    }

    /* PREMIUM NEWS CARD */
    .premium-news-card {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.06) !important;
        transition: transform 0.35s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.35s ease, border-color 0.3s ease;
    }
    .premium-news-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 22px 45px rgba(22, 101, 52, 0.11) !important;
        border-color: rgba(22, 163, 74, 0.35) !important;
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
    .card-accent-bar.accent-amber {
        background: linear-gradient(90deg, #d97706, #fbbf24);
    }
    .news-card-thumb {
        transition: transform 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);
    }
    .premium-news-card:hover .news-card-thumb {
        transform: scale(1.08);
    }
    .news-img-gradient-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to top, rgba(0,0,0,0.3) 0%, transparent 100%);
        pointer-events: none;
    }
    .title-link {
        transition: color 0.25s ease;
    }
    .premium-news-card:hover .title-link {
        color: #16a34a !important;
    }
    .read-more-btn .transition-transform {
        transition: transform 0.25s ease;
    }
    .premium-news-card:hover .read-more-btn .transition-transform {
        transform: translateX(5px);
    }
    .hover-white:hover {
        color: #ffffff !important;
    }
</style>
@endsection
