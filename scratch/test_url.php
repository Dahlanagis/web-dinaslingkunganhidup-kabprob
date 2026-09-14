<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$url = \Illuminate\Support\Facades\Storage::disk('public')->url('galleries/01M1ZF29SG4CM6JWR1ZGR0ZA85.jpg');
echo "Disk public URL: " . $url . "\n";
echo "APP_URL config: " . config('app.url') . "\n";
echo "Asset url: " . asset('storage/galleries/01M1ZF29SG4CM6JWR1ZGR0ZA85.jpg') . "\n";
