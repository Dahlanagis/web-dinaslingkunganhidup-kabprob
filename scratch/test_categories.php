<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = App\Models\User::first();
auth()->login($user);

$request = Illuminate\Http\Request::create('/admin/categories', 'GET');
$response = $kernel->handle($request);
echo "GET /admin/categories -> Status: " . $response->getStatusCode() . "\n";
echo "Total Master Categories in DB: " . App\Models\Category::count() . "\n";
foreach (['konten', 'dokumen', 'galeri', 'layanan'] as $type) {
    echo "  - Modul [{$type}]: " . App\Models\Category::where('type', $type)->count() . " kategori\n";
}
