<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$b1 = \App\Models\Banner::find(1);
if ($b1) {
    $b1->update([
        'title' => 'DLH Kab. Probolinggo',
        'image' => 'banners/banner-hero-dlh.jpg',
        'is_active' => true,
    ]);
}

$b2 = \App\Models\Banner::find(2);
if ($b2) {
    $b2->update([
        'title' => 'Pelestarian Lingkungan Hidup',
        'image' => 'banners/banner-lingkungan-lestari.jpg',
        'is_active' => true,
    ]);
}

echo "Banners updated:\n";
foreach (\App\Models\Banner::all() as $b) {
    echo "ID: {$b->id} | {$b->title} | {$b->image}\n";
}
