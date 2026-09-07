<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Service;

Service::truncate();

$portalItems = [
    ['icon'=>'bi-recycle','tag'=>'Kebersihan','title'=>'Pengelolaan Sampah','desc'=>'Layanan pengangkutan, pengelolaan TPA, dan bank sampah terintegrasi.'],
    ['icon'=>'bi-file-earmark-check-fill','tag'=>'Perizinan','title'=>'AMDAL & Perizinan','desc'=>'Dokumen lingkungan, UKL-UPL, dan SPPL untuk kelayakan usaha.'],
    ['icon'=>'bi-megaphone-fill','tag'=>'Pengaduan','title'=>'SP4N LAPOR! DLH','desc'=>'Laporkan masalah lingkungan dan aspirasi masyarakat secara resmi.'],
    ['icon'=>'bi-tree-fill','tag'=>'Ruang Hijau','title'=>'Taman & RTH','desc'=>'Pengelolaan ruang terbuka hijau, hutan kota, dan taman kota.'],
    ['icon'=>'bi-shield-check','tag'=>'Pengendalian','title'=>'Pencemaran Lingkungan','desc'=>'Pemantauan kualitas udara, air, dan tanah secara berkala.'],
    ['icon'=>'bi-info-circle-fill','tag'=>'Info Publik','title'=>'Maklumat Pelayanan','desc'=>'Standar pelayanan publik bidang lingkungan hidup DLH.'],
];

foreach($portalItems as $item) {
    Service::create([
        'name' => $item['title'],
        'description' => $item['desc'],
        'icon' => $item['icon'],
        'tag' => $item['tag']
    ]);
}
echo "Services seeded.\n";
