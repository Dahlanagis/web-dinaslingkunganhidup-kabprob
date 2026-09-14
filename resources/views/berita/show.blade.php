@extends('layouts.public')

@section('content')
@php
    $isArtikel = ($post->category ?? '') === 'artikel';
@endphp

<!-- BREADCRUMB & HEADER -->
<section class="page-header-dlh py-4 text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #031e13 0%, #064e3b 50%, #022c22 100%);">
    <div class="container position-relative py-2" style="z-index: 2;">
        <nav aria-label="breadcrumb" class="mb-2">
            <ol class="breadcrumb mb-0" style="font-size: 0.82rem;">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none hover-white"><i class="bi bi-house-door-fill me-1"></i> Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url($isArtikel ? '/informasi/artikel' : '/informasi/berita') }}" class="text-white-50 text-decoration-none hover-white">{{ $isArtikel ? 'Artikel Lingkungan' : 'Berita' }}</a></li>
                <li class="breadcrumb-item active text-white text-truncate" style="max-width: 300px;" aria-current="page">{{ $post->title }}</li>
            </ol>
        </nav>
    </div>
</section>

<div class="py-5" style="background: var(--slate50);">
    <div class="container">
        <div class="row g-4">
            <!-- MAIN ARTICLE (COL-LG-8) -->
            <div class="col-lg-8">
                <article class="p-4 p-md-5 bg-white rounded-4 shadow-sm border border-slate-200">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge {{ $isArtikel ? 'bg-warning text-dark' : 'bg-success bg-opacity-10 text-success' }} px-3 py-1.5 rounded-pill font-monospace small fw-bold">
                                <i class="bi {{ $isArtikel ? 'bi-journal-bookmark-fill' : 'bi-newspaper' }} me-1"></i> {{ $isArtikel ? 'Artikel Edukasi Lingkungan' : 'Berita Resmi' }}
                            </span>
                            <span class="text-muted small"><i class="bi bi-clock me-1"></i> {{ $post->created_at ? $post->created_at->translatedFormat('l, d F Y') : 'Terbaru' }}</span>
                        </div>
                        @auth
                            @if($isArtikel)
                                <a href="{{ url('/admin/articles/' . $post->id . '/edit') }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 fw-bold" target="_blank">
                                    <i class="bi bi-pencil-square me-1"></i> Edit di Admin
                                </a>
                            @else
                                <a href="{{ url('/admin/posts/' . $post->id . '/edit') }}" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold" target="_blank">
                                    <i class="bi bi-pencil-square me-1"></i> Edit di Admin
                                </a>
                            @endif
                        @endauth
                    </div>

                    <h1 class="fw-extrabold mb-4 text-dark" style="font-size: clamp(1.6rem, 2.5vw, 2.2rem); line-height: 1.35; letter-spacing: -0.4px;">
                        {{ $post->title }}
                    </h1>

                    <!-- Author & View Stats -->
                    <div class="d-flex align-items-center justify-content-between p-3 rounded-3 bg-light border mb-4 text-muted small">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <span class="d-block text-dark fw-bold">DLH Kab. Probolinggo</span>
                                <span style="font-size: 0.72rem;">{{ $isArtikel ? 'Kanal Publikasi & Edukasi' : 'Rilis Berita Resmi' }}</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span><i class="bi bi-eye text-info me-1"></i> {{ $post->views ?? 0 }} kali dibaca</span>
                        </div>
                    </div>

                    <!-- FEATURED IMAGE -->
                    @if($post->image)
                    <div class="rounded-4 overflow-hidden mb-4 shadow-sm">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-100 object-fit-cover" style="max-height: 460px;">
                    </div>
                    @endif

                    <!-- ARTICLE CONTENT -->
                    <div class="article-body-content text-dark mb-5" style="line-height: 1.85; font-size: 1.05rem;">
                        {!! str_contains($post->content ?? '', '<') ? $post->content : nl2br(e($post->content ?? '')) !!}
                    </div>

                    <!-- SHARE BUTTONS -->
                    <div class="p-3 p-md-4 rounded-4 bg-light border d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                        <div class="fw-bold text-dark small">
                            <i class="bi bi-share-fill text-success me-1"></i> Bagikan {{ $isArtikel ? 'Artikel' : 'Berita' }} Ini:
                        </div>
                        <div class="d-flex gap-2">
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' - ' . url()->current()) }}" target="_blank" class="btn btn-sm btn-success rounded-pill px-3 py-1.5">
                                <i class="bi bi-whatsapp me-1"></i> WhatsApp
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-sm btn-primary rounded-pill px-3 py-1.5">
                                <i class="bi bi-facebook me-1"></i> Facebook
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1.5" onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan berhasil disalin!');">
                                <i class="bi bi-link-45deg me-1"></i> Salin Tautan
                            </button>
                        </div>
                    </div>

                    <!-- BACK TO LIST -->
                    <div class="mt-4 pt-3 border-top">
                        <a href="{{ url($isArtikel ? '/informasi/artikel' : '/informasi/berita') }}" class="btn btn-outline-success rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar {{ $isArtikel ? 'Artikel' : 'Berita' }}
                        </a>
                    </div>
                </article>
            </div>

            <!-- SIDEBAR (COL-LG-4) -->
            <div class="col-lg-4">
                <!-- BERITA TERBARU LAINNYA -->
                <div class="p-4 bg-white rounded-4 shadow-sm border border-slate-200 mb-4">
                    <h5 class="fw-bold mb-3 pb-2 border-bottom text-dark">
                        <i class="bi bi-newspaper text-success me-1"></i> Berita Terkini Lainnya
                    </h5>
                    @php
                        $recentPosts = \App\Models\Post::where('status', 'published')->where('id', '!=', $post->id)->latest()->take(4)->get();
                    @endphp
                    <div class="d-flex flex-column gap-3">
                        @forelse($recentPosts as $rPost)
                        <div class="d-flex gap-3 align-items-center pb-3 border-bottom">
                            <img src="{{ $rPost->image ? asset('storage/' . $rPost->image) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=150&h=100&fit=crop' }}" 
                                 alt="{{ $rPost->title }}" 
                                 class="rounded-3 object-fit-cover flex-shrink-0" 
                                 style="width: 75px; height: 60px;">
                            <div>
                                <span class="text-muted" style="font-size: 0.72rem;"><i class="bi bi-calendar3 me-1"></i> {{ $rPost->created_at->translatedFormat('d M Y') }}</span>
                                <h6 class="mb-0 mt-1" style="font-size: 0.88rem; line-height: 1.35;">
                                    <a href="{{ url('/berita/' . $rPost->slug) }}" class="text-dark text-decoration-none hover-green">
                                        {{ Str::limit($rPost->title, 55) }}
                                    </a>
                                </h6>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted small mb-0">Belum ada berita lainnya.</p>
                        @endforelse
                    </div>
                </div>

                <!-- BANTUAN & PENGADUAN CALLOUT -->
                <div class="p-4 rounded-4 shadow-sm text-white position-relative overflow-hidden" style="background: linear-gradient(145deg, #062b1b 0%, #031e13 100%); border: 1px solid rgba(74,222,128,0.3);">
                    <div class="d-flex align-items-center gap-2 mb-2 text-warning fw-bold small">
                        <i class="bi bi-megaphone-fill"></i> SALURAN PENGADUAN
                    </div>
                    <h5 class="fw-bold mb-2">Ada Masalah Lingkungan?</h5>
                    <p class="small text-white-50 mb-3" style="line-height: 1.6;">
                        Laporkan sampah liar atau dahan pohon roboh langsung ke tim reaksi cepat DLH Kabupaten Probolinggo.
                    </p>
                    <a href="{{ url('/kontak') }}" class="btn btn-sm btn-success w-100 rounded-pill py-2 fw-bold">
                        <i class="bi bi-chat-dots-fill me-1"></i> Hubungi Kami / Pengaduan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-green:hover {
        color: #16a34a !important;
    }
    .article-body-content p {
        margin-bottom: 1.25rem;
    }
</style>
@endsection
