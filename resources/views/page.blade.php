@extends('layouts.public')

@section('content')
<div class="container py-5" style="min-height: 50vh; display: flex; align-items: center; justify-content: center;">
    <div class="text-center">
        <i class="bi bi-cone-striped text-warning mb-4" style="font-size: 5rem;"></i>
        <h1 class="fw-bold" style="color: var(--g900);">Halaman Sedang Dalam Pengembangan</h1>
        <p class="text-muted" style="max-width: 500px; margin: 0 auto; font-size: 1.1rem;">
            Mohon maaf, halaman <strong>{{ $title }}</strong> saat ini sedang dalam tahap pembangunan oleh tim kami. Silakan kembali lagi nanti.
        </p>
        <a href="{{ url('/') }}" class="nav-cta mt-4" style="display: inline-block;">
            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
        </a>
    </div>
</div>
@endsection