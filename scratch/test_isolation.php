<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

echo "=== 1. TEST BERITA (/informasi/berita) ===\n";
$reqBerita = Illuminate\Http\Request::create('/informasi/berita', 'GET');
$resBerita = $kernel->handle($reqBerita);
$contentBerita = $resBerita->getContent();
preg_match_all('/<h5[^>]*>(.*?)<\/h5>/is', $contentBerita, $mBerita);
$titlesBerita = array_map(fn($t) => trim(strip_tags($t)), $mBerita[1] ?? []);
print_r($titlesBerita);

echo "\n=== 2. TEST ARTIKEL (/informasi/artikel) ===\n";
$reqArtikel = Illuminate\Http\Request::create('/informasi/artikel', 'GET');
$resArtikel = $kernel->handle($reqArtikel);
$contentArtikel = $resArtikel->getContent();
preg_match_all('/<h5[^>]*>(.*?)<\/h5>/is', $contentArtikel, $mArtikel);
$titlesArtikel = array_map(fn($t) => trim(strip_tags($t)), $mArtikel[1] ?? []);
print_r($titlesArtikel);

echo "\n=== 3. TEST GALERI GAMBAR (/informasi/galeri) ===\n";
$reqGaleri = Illuminate\Http\Request::create('/informasi/galeri', 'GET');
$resGaleri = $kernel->handle($reqGaleri);
$contentGaleri = $resGaleri->getContent();
preg_match_all('/<h5[^>]*>(.*?)<\/h5>/is', $contentGaleri, $mGaleri);
$titlesGaleri = array_map(fn($t) => trim(strip_tags($t)), $mGaleri[1] ?? []);
print_r($titlesGaleri);

$hasVideoInGaleri = str_contains($contentGaleri, 'Video Kegiatan') || str_contains($contentGaleri, 'youtube.com');
echo "Galeri contains any video: " . ($hasVideoInGaleri ? 'YES (FAIL)' : 'NO (PASSED)') . "\n";
