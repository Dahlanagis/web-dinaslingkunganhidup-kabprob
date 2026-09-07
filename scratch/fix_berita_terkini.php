<?php

$welcome = 'd:\DLH web PKL\resources\views\welcome.blade.php';
$content = file_get_contents($welcome);

$newNewsLoop = <<<'HTML'
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
HTML;

$startMarker = '            <div class="row g-4">';
$endMarker = '    <!-- GALERI -->'; // We replace until before GALERI section

if (strpos($content, $startMarker) !== false && strpos($content, $endMarker) !== false) {
    // Actually, there's multiple <div class="row g-4">. We must find the one inside <!-- BERITA -->
    $beritaMarker = '<!-- BERITA -->';
    if (strpos($content, $beritaMarker) !== false) {
        $parts = explode($beritaMarker, $content, 2);
        $beforeBerita = $parts[0];
        $inBerita = $parts[1];
        
        $parts2 = explode($startMarker, $inBerita, 2);
        $beritaHeader = $parts2[0];
        $afterStart = $parts2[1];
        
        // Find the end of the row (it's right before </section> of BERITA)
        $sectionEnd = '        </div>
    </section>';
        $parts3 = explode($sectionEnd, $afterStart, 2);
        $beritaFooter = $parts3[1]; // Everything after BERITA section
        
        $newContent = $beforeBerita . $beritaMarker . $beritaHeader . "\n" . ltrim($newNewsLoop) . "\n" . $sectionEnd . $beritaFooter;
        
        file_put_contents($welcome, $newContent);
        echo "Made Berita Terkini dynamic.\n";
    }
} else {
    echo "Markers not found.\n";
}
