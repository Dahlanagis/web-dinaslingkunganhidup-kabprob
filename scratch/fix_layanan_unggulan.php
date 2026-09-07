<?php

// 1. Add hide-scrollbar CSS to public.blade.php
$publicLayout = 'd:\DLH web PKL\resources\views\layouts\public.blade.php';
$publicContent = file_get_contents($publicLayout);

if (strpos($publicContent, '.hide-scrollbar') === false) {
    $css = <<<CSS
        /* Hide scrollbar for horizontal scrolling containers */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
CSS;
    $publicContent = str_replace('</style>', $css . "\n    </style>", $publicContent);
    file_put_contents($publicLayout, $publicContent);
    echo "Added hide-scrollbar CSS.\n";
}

// 2. Make Layanan Unggulan dynamic in welcome.blade.php
$welcome = 'd:\DLH web PKL\resources\views\welcome.blade.php';
$welcomeContent = file_get_contents($welcome);

$startMarker = '                    @php $svcs = [';
$endMarker = '                    @foreach($svcs as $s)';

if (strpos($welcomeContent, $startMarker) !== false) {
    $parts1 = explode($startMarker, $welcomeContent, 2);
    $beforeChunk = rtrim($parts1[0]);
    $parts2 = explode($endMarker, $parts1[1], 2);
    $afterChunk = ltrim($parts2[1]);
    
    $newLoopCode = <<<'HTML'
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
HTML;

    // We need to also replace the end of the loop `@endforeach` with nothing, because we included `@endforelse` in the new block.
    // Wait, the old code had `@endforeach` at the end of the `svc-card` div. Let's find it.
    
    $endForeachMarker = '                    @endforeach';
    $afterChunkParts = explode($endForeachMarker, $afterChunk, 2);
    $afterChunkFinal = "\n" . ltrim($afterChunkParts[1] ?? $afterChunk);

    $newContent = $beforeChunk . "\n" . $newLoopCode . $afterChunkFinal;
    
    file_put_contents($welcome, $newContent);
    echo "Made Layanan Unggulan dynamic and fixed old loop.\n";
} else {
    echo "Start marker for Layanan Unggulan not found in welcome.blade.php.\n";
}
