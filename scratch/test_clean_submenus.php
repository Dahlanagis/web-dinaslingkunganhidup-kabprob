<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

$tests = [
    'Persampahan' => '/layanan/persampahan',
    'Lab' => '/layanan/lab',
    'Pengaduan' => '/layanan/pengaduan',
    'Dokumen Kinerja' => '/dokumen/kinerja',
    'Dokumen Regulasi' => '/dokumen/regulasi',
    'Visi Misi' => '/profil/visi-misi',
    'Struktur Organisasi' => '/profil/struktur',
];

echo "VERIFYING CLEAN & DIRECT SUBMENU CONTENT:\n";
echo str_repeat('-', 70) . "\n";

foreach ($tests as $label => $url) {
    $req = Illuminate\Http\Request::create($url, 'GET');
    $res = $kernel->handle($req);
    $html = $res->getContent();
    
    // Check if there are redundant tabs
    $hasLayananTabs = str_contains($html, 'Semua Layanan') && str_contains($html, 'btn-sm rounded-pill px-3.5 py-2');
    $hasDokumenTabs = str_contains($html, 'Semua Dokumen') && str_contains($html, 'btn-sm rounded-pill px-3.5 py-2');
    $hasProfilSidebar = str_contains($html, 'Menu Profil Instansi') && str_contains($html, 'list-group-item-action');
    
    $isRedundant = $hasLayananTabs || $hasDokumenTabs || $hasProfilSidebar;
    
    echo sprintf(
        "[%s] %s => Status: %d | Redundant Tab/Menu Clutter: %s\n",
        $label,
        $url,
        $res->getStatusCode(),
        $isRedundant ? 'YES (FAIL)' : 'NO (PASSED - CLEAN & DIRECT)'
    );
}
echo str_repeat('-', 70) . "\n";
