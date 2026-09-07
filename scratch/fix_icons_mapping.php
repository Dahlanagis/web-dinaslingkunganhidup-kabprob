<?php

$welcome = 'd:\DLH web PKL\resources\views\welcome.blade.php';
$content = file_get_contents($welcome);

// New stats loop that maps heroicons to bootstrap icons to avoid SVG missing errors
$newStatsLoop = <<<'HTML'
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
HTML;

$startMarker = '                @forelse($statistics as $stat)';
$endMarker = '                @empty';

if (strpos($content, $startMarker) !== false && strpos($content, $endMarker) !== false) {
    $parts1 = explode($startMarker, $content, 2);
    $beforeChunk = rtrim($parts1[0]);
    $parts2 = explode($endMarker, $parts1[1], 2);
    $afterChunk = "\n                @empty" . $parts2[1];
    
    $newContent = $beforeChunk . "\n" . $newStatsLoop . $afterChunk;
    file_put_contents($welcome, $newContent);
    echo "Stats block updated successfully with mapping.\n";
} else {
    echo "Markers not found.\n";
}
