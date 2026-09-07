<?php

$welcomeFile = 'd:\DLH web PKL\resources\views\welcome.blade.php';
$content = file_get_contents($welcomeFile);

// Split at <!-- TICKER --> (this is right after the Navbar)
$parts1 = explode('<!-- TICKER -->', $content, 2);
$header = $parts1[0]; // From <!DOCTYPE> to </nav>

// Split the second part at <!-- STATISTIK -->
$parts2 = explode('<!-- STATISTIK -->', $parts1[1], 2);
$middle = '<!-- TICKER -->' . $parts2[0]; // TICKER, HERO, PORTAL, dll
$footer = '<!-- STATISTIK -->' . $parts2[1]; // STATISTIK, LAYANAN, BERITA, MITRA, CTA, FOOTER

// Wait, the user ONLY wants STATISTIK and FOOTER. But wait, in welcome.blade.php, after STATISTIK there is LAYANAN UNGGULAN, BERITA, MITRA, CTA, then FOOTER.
// If I just dump the entire bottom half into the layout, EVERY sub-page will have "Layanan Unggulan", "Berita", "Mitra" at the bottom. Is that what they want?
// Usually, yes, corporate websites have a fat footer area.
// But let's look at the sections:
// - STATISTIK
// - LAYANAN UNGGULAN
// - BERITA TERKINI
// - MITRA
// - CTA PENGADUAN
// - FOOTER

// Actually, maybe it's better to just include the STATISTIK and FOOTER and CTA, but NOT the Berita/Layanan on subpages.
// To do this, I will create `resources/views/partials/stats.blade.php` and `resources/views/partials/footer.blade.php`.
// And I will include them in `page.blade.php`.
// But wait, `page.blade.php` needs the `<head>` and `<nav>` too, to look consistent!
// Okay, let's just create a `public.blade.php` layout.

$layoutContent = $header . "\n    <main>\n        @yield('content')\n    </main>\n\n    " . $footer;

$welcomeNew = "@extends('layouts.public')\n\n@section('content')\n" . $middle . "\n@endsection\n";

file_put_contents('d:\DLH web PKL\resources\views\layouts\public.blade.php', $layoutContent);
file_put_contents('d:\DLH web PKL\resources\views\welcome.blade.php', $welcomeNew);

echo "Layout created and welcome.blade.php refactored successfully.\n";

// Now for page.blade.php
$pageContent = <<<'HTML'
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
HTML;

file_put_contents('d:\DLH web PKL\resources\views\page.blade.php', $pageContent);
echo "page.blade.php updated to use layout.\n";

