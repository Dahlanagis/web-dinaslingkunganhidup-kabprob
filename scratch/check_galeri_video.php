<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

$contentGaleri = $kernel->handle(Illuminate\Http\Request::create('/informasi/galeri', 'GET'))->getContent();
echo "Has 'Video Kegiatan': " . (str_contains($contentGaleri, 'Video Kegiatan') ? 'YES' : 'NO') . "\n";
echo "Has 'youtube.com': " . (str_contains($contentGaleri, 'youtube.com') ? 'YES' : 'NO') . "\n";

if (str_contains($contentGaleri, 'youtube.com')) {
    preg_match_all('/.{0,50}youtube\.com.{0,50}/is', $contentGaleri, $matches);
    print_r($matches[0]);
}
