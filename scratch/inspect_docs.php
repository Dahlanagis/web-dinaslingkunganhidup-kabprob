<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$navs = \App\Models\Navigation::where('title', 'like', '%Dokumen%')->orWhere('url', 'like', '%dokumen%')->get();
foreach ($navs as $n) {
    echo "ID: {$n->id} | Title: {$n->title} | URL: {$n->url} | Parent: {$n->parent_id}\n";
}
