<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$p = public_path('storage/galleries');
echo "public/storage/galleries exists: " . (file_exists($p) ? 'YES' : 'NO') . "\n";
if (file_exists($p)) {
    foreach (scandir($p) as $f) {
        if ($f != '.' && $f != '..') echo "- $f\n";
    }
}
