<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

foreach (App\Models\Gallery::all() as $g) {
    $img = $g->images[0] ?? null;
    if (!$img) continue;
    $ch = curl_init('http://127.0.0.1:8000/storage/' . $img);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    echo "ID {$g->id} ({$g->title}): {$img} => HTTP {$code}\n";
}
