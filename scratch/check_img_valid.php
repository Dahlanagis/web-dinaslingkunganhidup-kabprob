<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$files = [
    '01M1ZF29SG4CM6JWR1ZGR0ZA85.jpg',
    '01M1ZF43QAWGE9R5MW47D50V5E.jpg',
    '01M1ZF4SM5ETZ2HXC6N7PWQ1SH.jpeg',
];

foreach ($files as $f) {
    $p = public_path('storage/galleries/' . $f);
    echo "$f: size=" . filesize($p) . " bytes\n";
    $info = @getimagesize($p);
    echo "  image info: " . json_encode($info) . "\n";
}
