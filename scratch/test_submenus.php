<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

$urls = [
    '/profil/sejarah',
    '/profil/visi-misi',
    '/profil/struktur',
    '/profil/tupoksi',
    '/profil/pejabat',
    '/profil/maklumat',
    '/layanan/persampahan',
    '/layanan/lab',
    '/layanan/pengaduan',
    '/dokumen/kinerja',
    '/dokumen/regulasi',
    '/informasi/berita',
    '/informasi/artikel',
    '/informasi/galeri',
    '/berita/kunjungan-kerja-desa',
];

echo "Testing Submenu Routes:\n";
foreach ($urls as $url) {
    $request = Illuminate\Http\Request::create($url, 'GET');
    $response = $kernel->handle($request);
    $status = $response->getStatusCode();
    $content = $response->getContent();
    $isUnderConstruction = str_contains($content, 'Halaman Sedang Dalam Pengembangan');
    
    echo "URL: {$url} -> Status: {$status} | Under Construction: " . ($isUnderConstruction ? 'YES (FAIL)' : 'NO (SUCCESS)') . "\n";
    if ($status !== 200) {
        echo "Error output snippet: " . substr($content, 0, 200) . "\n";
    }
}
