<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$paths = [
    'public/storage' => public_path('storage'),
    'storage/app/public' => storage_path('app/public'),
    'storage/app/public/galleries' => storage_path('app/public/galleries'),
    'storage/app/public/gallery' => storage_path('app/public/gallery'),
];

foreach ($paths as $label => $p) {
    echo "$label: exists=" . (file_exists($p) ? 'YES' : 'NO') . " is_link=" . (is_link($p) ? 'YES' : 'NO') . " target=" . (is_link($p) ? readlink($p) : '') . "\n";
}

if (file_exists(storage_path('app/public/galleries'))) {
    echo "Files in storage/app/public/galleries:\n";
    foreach (scandir(storage_path('app/public/galleries')) as $f) {
        if ($f != '.' && $f != '..') echo "- $f\n";
    }
}

if (file_exists(public_path('storage'))) {
    echo "Files in public/storage:\n";
    foreach (scandir(public_path('storage')) as $f) {
        if ($f != '.' && $f != '..') echo "- $f\n";
    }
}
