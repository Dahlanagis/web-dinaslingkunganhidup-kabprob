<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Post;

// Update 6 and 7 to DLH themes
$p6 = Post::find(6);
if ($p6) {
    $p6->update([
        'title' => 'Sosialisasi Program Bank Sampah dan Kompos Mandiri di Tingkat Kecamatan',
        'slug' => 'sosialisasi-bank-sampah-kompos-mandiri-kecamatan',
        'category' => 'berita',
        'content' => "DLH Kabupaten Probolinggo menyelenggarakan bimbingan teknis pengelolaan sampah skala rumah tangga dan teknik pembuatan pupuk kompos mandiri.\n\nKegiatan ini diikuti oleh kader lingkungan perwakilan desa dari berbagai kecamatan di wilayah Kabupaten Probolinggo dengan tujuan mendorong kemandirian pengolahan sampah organik.",
        'image' => 'galleries/01M1ZF29SG4CM6JWR1ZGR0ZA85.jpg',
    ]);
}

$p7 = Post::find(7);
if ($p7) {
    $p7->update([
        'title' => 'Aksi Bersih Pantai dan Penanaman 1.000 Bibit Mangrove di Pesisir Probolinggo',
        'slug' => 'aksi-bersih-pantai-penanaman-mangrove-probolinggo',
        'category' => 'berita',
        'content' => "Sebagai bentuk mitigasi abrasi dan perlindungan ekosistem pesisir, DLH Kabupaten Probolinggo bersama relawan lingkungan dan pelajar menggelar aksi bersih pantai serta penanaman 1.000 bibit mangrove.\n\nGerakan ini diharapkan dapat menjaga keanekaragaman hayati pesisir dan meningkatkan kepedulian generasi muda terhadap kelestarian laut.",
        'image' => 'galleries/01M1ZF43QAWGE9R5MW47D50V5E.jpg',
    ]);
}

$p3 = Post::find(3);
if ($p3) {
    $p3->update(['image' => 'galleries/01M1K2G15AX919GAPJ2KMHR4EP.jpeg']);
}

$p4 = Post::find(4);
if ($p4) {
    $p4->update(['image' => 'galleries/01M1K2GS09BX9DE116AK2PYZB8.jpg']);
}

$p5 = Post::find(5);
if ($p5) {
    $p5->update(['image' => 'galleries/01M1K2HCYZ2H3CHGDAVHE31N84.jpg']);
}

// Articles
$p9 = Post::find(9);
if ($p9) {
    $p9->update(['image' => 'galleries/01M1ZF4SM5ETZ2HXC6N7PWQ1SH.jpeg']);
}

$p10 = Post::find(10);
if ($p10) {
    $p10->update(['image' => 'galleries/01M1ZF29SG4CM6JWR1ZGR0ZA85.jpg']);
}

$p11 = Post::find(11);
if ($p11) {
    $p11->update(['image' => 'galleries/01M1K2G15AX919GAPJ2KMHR4EP.jpeg']);
}

$p12 = Post::find(12);
if ($p12) {
    $p12->update(['image' => 'galleries/01M1ZF43QAWGE9R5MW47D50V5E.jpg']);
}

echo "All posts and articles updated with DLH content & real images!\n";
