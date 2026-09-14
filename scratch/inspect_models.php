<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== POSTS ===\n";
print_r(App\Models\Post::first()?->toArray());

echo "=== SERVICES ===\n";
print_r(App\Models\Service::first()?->toArray());

echo "=== DOCUMENTS ===\n";
print_r(App\Models\Document::first()?->toArray());

echo "=== GALLERIES ===\n";
print_r(App\Models\Gallery::first()?->toArray());

echo "=== PROFILES ===\n";
print_r(App\Models\Profile::first()?->toArray());
