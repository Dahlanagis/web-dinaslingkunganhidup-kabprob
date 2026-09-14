<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$navs = App\Models\Navigation::with('children')->whereNull('parent_id')->orderBy('order')->get();
foreach ($navs as $n) {
    echo $n->title . " [URL: " . $n->url . "]\n";
    foreach ($n->children as $c) {
        echo "   -> " . $c->title . " [URL: " . $c->url . "]\n";
    }
}

echo "\n--- MODELS IN SYSTEM ---\n";
echo "Posts: " . App\Models\Post::count() . "\n";
echo "Services: " . App\Models\Service::count() . "\n";
echo "Documents: " . App\Models\Document::count() . "\n";
echo "Galleries: " . App\Models\Gallery::count() . "\n";
if (class_exists('App\Models\Profile')) {
    echo "Profiles: " . App\Models\Profile::count() . "\n";
}
