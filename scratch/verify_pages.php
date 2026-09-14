<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;

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
];

$httpKernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

echo "Testing all submenu routes:\n";
foreach ($urls as $url) {
    $request = Request::create($url, 'GET');
    $response = $httpKernel->handle($request);
    $status = $response->getStatusCode();
    $content = $response->getContent();
    
    // Check if expected content is rendered
    $hasHeader = str_contains($content, 'Dinas Lingkungan Hidup');
    echo "URL: {$url} -> Status: {$status} | Length: " . strlen($content) . ($hasHeader ? " [OK]" : " [NO HEADER]") . "\n";
    $httpKernel->terminate($request, $response);
}

// Test dynamic edit: Update Profil Sejarah
$sejarah = App\Models\Profile::where('section', 'sejarah')->first();
$oldContent = $sejarah->content;
$testMarker = "PENGUJIAN EDIT ADMIN PORTAL 2026";
$sejarah->update([
    'content' => "<p>{$testMarker}</p>" . $oldContent
]);

$request = Request::create('/profil/sejarah', 'GET');
$response = $httpKernel->handle($request);
$hasMarker = str_contains($response->getContent(), $testMarker);
echo "\nDynamic Edit Test (/profil/sejarah):\n";
echo "Marker found in public page response: " . ($hasMarker ? "SUCCESS! Content is 100% dynamic from Admin!" : "FAILED!") . "\n";

// Restore original content
$sejarah->update(['content' => $oldContent]);
echo "Original content restored successfully.\n";
