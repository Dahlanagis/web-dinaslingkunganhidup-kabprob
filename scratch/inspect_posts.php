<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

foreach (App\Models\Post::all() as $p) {
    echo "ID: {$p->id} | Category: [{$p->category}] | Title: {$p->title}\n";
}
