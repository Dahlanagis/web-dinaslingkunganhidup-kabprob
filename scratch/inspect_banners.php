<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$banners = \App\Models\Banner::all();
echo "Total banners: " . $banners->count() . "\n\n";
foreach ($banners as $b) {
    echo "ID: " . $b->id . "\n";
    echo "Title: " . $b->title . "\n";
    echo "Image: " . $b->image . "\n";
    echo "Order: " . $b->order . "\n";
    echo "Is Active: " . ($b->is_active ? 'Yes' : 'No') . "\n";
    echo "Link: " . $b->link . "\n";
    echo "Description: " . $b->description . "\n";
    echo "--------------------------\n";
}
