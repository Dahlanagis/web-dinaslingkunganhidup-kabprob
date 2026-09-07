<?php

$welcome = 'd:\DLH web PKL\resources\views\welcome.blade.php';
$content = file_get_contents($welcome);

// We want to replace the hardcoded stats with dynamic ones from the DB
$dynamicStats = <<<'HTML'
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
                <div class="col-md-6 col-xl-3">
                    <div class="stat-card-p" style="--stat-color:var(--amber);">
                        <div class="stat-card-top"></div>
                        <i class="bi {{ $stat->icon ?? 'bi-bar-chart' }} stat-bg-icon"></i>
                        <div class="stat-icon-box"><i class="bi {{ $stat->icon ?? 'bi-bar-chart' }}"></i></div>
                        <div style="position:relative;z-index:1;">
                            <div class="stat-value">{{ $stat->value }}</div>
                            <div class="stat-name">{{ $stat->title }}</div>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Tampilkan stat bawaan jika database kosong -->
                <div class="col-md-6 col-xl-3"><div class="stat-card-p" style="--stat-color:var(--amber);"><div class="stat-card-top"></div><i class="bi bi-trash3 stat-bg-icon"></i><div class="stat-icon-box"><i class="bi bi-trash3"></i></div><div style="position:relative;z-index:1;"><div class="stat-value">45.280</div><div class="stat-name">Ton Sampah Terkelola</div></div><div class="stat-tag">Tahun 2025</div></div></div>
                <div class="col-md-6 col-xl-3"><div class="stat-card-p" style="--stat-color:var(--amber);"><div class="stat-card-top"></div><i class="bi bi-tree stat-bg-icon"></i><div class="stat-icon-box"><i class="bi bi-tree"></i></div><div style="position:relative;z-index:1;"><div class="stat-value">124</div><div class="stat-name">Titik Ruang Terbuka Hijau</div></div><div class="stat-tag">Taman & Hutan Kota</div></div></div>
                <div class="col-md-6 col-xl-3"><div class="stat-card-p" style="--stat-color:var(--amber);"><div class="stat-card-top"></div><i class="bi bi-wind stat-bg-icon"></i><div class="stat-icon-box"><i class="bi bi-wind"></i></div><div style="position:relative;z-index:1;"><div class="stat-value">85%</div><div class="stat-name">Indeks Kualitas Udara</div></div><div class="stat-tag">Kategori Baik</div></div></div>
                <div class="col-md-6 col-xl-3"><div class="stat-card-p" style="--stat-color:var(--amber);"><div class="stat-card-top"></div><i class="bi bi-recycle stat-bg-icon"></i><div class="stat-icon-box"><i class="bi bi-recycle"></i></div><div style="position:relative;z-index:1;"><div class="stat-value">45</div><div class="stat-name">Bank Sampah Aktif</div></div><div class="stat-tag">24 Kecamatan</div></div></div>
                @endforelse
            </div>
        </div>
    </section>
HTML;

$startMarker = '    <!-- STATISTIK -->';
$endMarker = '    <!-- LAYANAN UNGGULAN -->';

if (strpos($content, $startMarker) !== false && strpos($content, $endMarker) !== false) {
    $parts1 = explode($startMarker, $content, 2);
    $beforeChunk = rtrim($parts1[0]);
    $parts2 = explode($endMarker, $parts1[1], 2);
    $afterChunk = "\n\n    " . $endMarker . $parts2[1];
    
    $newContent = $beforeChunk . "\n\n" . $dynamicStats . $afterChunk;
    file_put_contents($welcome, $newContent);
    echo "Successfully replaced STATISTIK with dynamic blade code.\n";
} else {
    echo "Markers not found.\n";
}

// Also update hero stats
$heroStart = '<div class="hero-stats-strip">';
$heroEnd = '</section>';
if (strpos($newContent ?? $content, $heroStart) !== false && strpos($newContent ?? $content, $heroEnd) !== false) {
    $newHeroStats = <<<'HTML'
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
HTML;
    
    $c = file_get_contents($welcome);
    $parts1 = explode($heroStart, $c, 2);
    $beforeChunk = rtrim($parts1[0]);
    $parts2 = explode($heroEnd, $parts1[1], 2);
    $afterChunk = "\n    " . $heroEnd . $parts2[1];
    
    $newContent2 = $beforeChunk . "\n        " . $newHeroStats . $afterChunk;
    file_put_contents($welcome, $newContent2);
    echo "Successfully replaced HERO STATS with dynamic blade code.\n";
}
