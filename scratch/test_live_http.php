<?php
$urls = [
    'Berita' => 'http://127.0.0.1:8001/informasi/berita',
    'Artikel' => 'http://127.0.0.1:8001/informasi/artikel',
    'Galeri' => 'http://127.0.0.1:8001/informasi/galeri',
    'Visi Misi' => 'http://127.0.0.1:8001/profil/visi-misi',
    'Struktur' => 'http://127.0.0.1:8001/profil/struktur',
    'Persampahan' => 'http://127.0.0.1:8001/layanan/persampahan',
    'Pengaduan' => 'http://127.0.0.1:8001/layanan/pengaduan',
    'Dokumen Kinerja' => 'http://127.0.0.1:8001/dokumen/kinerja',
    'Dokumen Regulasi' => 'http://127.0.0.1:8001/dokumen/regulasi',
];

echo "LIVE HTTP SERVER TEST (PORT 8001):\n";
echo str_repeat('-', 70) . "\n";
foreach ($urls as $label => $url) {
    $ctx = stream_context_create(['http' => ['timeout' => 5]]);
    $html = @file_get_contents($url, false, $ctx);
    if ($html === false) {
        echo "[$label] $url => CONNECTION ERROR\n";
        continue;
    }
    $hasFallback = str_contains($html, 'Halaman Sedang Dalam Pengembangan');
    $titleMatch = [];
    preg_match('/<title>(.*?)<\/title>/is', $html, $titleMatch);
    $h1Match = [];
    preg_match('/<h1[^>]*>(.*?)<\/h1>/is', $html, $h1Match);
    $pageHeading = trim(strip_tags($h1Match[1] ?? 'None'));

    echo sprintf(
        "[%s] => Status: OK (Size: %d bytes) | Under Construction: %s | Heading: %s\n",
        $label,
        strlen($html),
        $hasFallback ? 'YES (FAIL)' : 'NO (PASSED)',
        $pageHeading
    );
}
echo str_repeat('-', 70) . "\n";
