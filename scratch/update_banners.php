<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Update Banner 1
$b1 = \App\Models\Banner::find(1);
if ($b1) {
    $b1->update([
        'title' => 'Selamat Datang di Portal Resmi DLH Kabupaten Probolinggo',
        'image' => 'banners/banner-hero-dlh.jpg',
        'is_active' => true,
    ]);
} else {
    \App\Models\Banner::create([
        'id' => 1,
        'title' => 'Selamat Datang di Portal Resmi DLH Kabupaten Probolinggo',
        'image' => 'banners/banner-hero-dlh.jpg',
        'is_active' => true,
    ]);
}

// Update Banner 2
$b2 = \App\Models\Banner::find(2);
if ($b2) {
    $b2->update([
        'title' => 'Gerakan Lingkungan Bersih, Hijau & Lestari',
        'image' => 'banners/banner-lingkungan-lestari.jpg',
        'is_active' => true,
    ]);
} else {
    \App\Models\Banner::create([
        'id' => 2,
        'title' => 'Gerakan Lingkungan Bersih, Hijau & Lestari',
        'image' => 'banners/banner-lingkungan-lestari.jpg',
        'is_active' => true,
    ]);
}

echo "Banners successfully updated to match web banner!\n";
$all = \App\Models\Banner::all();
foreach ($all as $b) {
    echo "ID: {$b->id} | Title: {$b->title} | Img: {$b->image}\n";
}
