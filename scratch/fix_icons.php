<?php

$welcome = 'd:\DLH web PKL\resources\views\welcome.blade.php';
$content = file_get_contents($welcome);

$newStatsLoop = <<<'HTML'
                @forelse($statistics as $stat)
                <div class="col-md-6 col-xl-3">
                    <div class="stat-card-p" style="--stat-color:var(--amber);">
                        <div class="stat-card-top"></div>
                        @if($stat->icon && str_starts_with($stat->icon, 'heroicon-'))
                            @svg($stat->icon, 'stat-bg-icon', ['style' => 'width:8rem; height:8rem; color:var(--stat-color);'])
                            <div class="stat-icon-box">
                                @svg($stat->icon, '', ['style' => 'width:1.8rem; height:1.8rem; color:var(--stat-color);'])
                            </div>
                        @else
                            <i class="bi {{ $stat->icon ?? 'bi-bar-chart' }} stat-bg-icon"></i>
                            <div class="stat-icon-box"><i class="bi {{ $stat->icon ?? 'bi-bar-chart' }}"></i></div>
                        @endif
                        <div style="position:relative;z-index:1;">
                            <div class="stat-value">{{ $stat->value }}</div>
                            <div class="stat-name">{{ $stat->title }}</div>
                        </div>
                    </div>
                </div>
HTML;

// We need to replace the old @forelse block for stats.
$startMarker = '                @forelse($statistics as $stat)';
$endMarker = '                @empty';

if (strpos($content, $startMarker) !== false && strpos($content, $endMarker) !== false) {
    $parts1 = explode($startMarker, $content, 2);
    $beforeChunk = rtrim($parts1[0]);
    $parts2 = explode($endMarker, $parts1[1], 2);
    $afterChunk = "\n                @empty" . $parts2[1];
    
    $newContent = $beforeChunk . "\n" . $newStatsLoop . $afterChunk;
    file_put_contents($welcome, $newContent);
    echo "Stats block updated successfully.\n";
} else {
    echo "Markers not found.\n";
}
