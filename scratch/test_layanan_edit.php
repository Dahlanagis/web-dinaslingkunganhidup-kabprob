<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;

$service = App\Models\Service::where('slug', 'persampahan')->first();
$oldDesc = $service->description;
$testMarker = "UJI DINAMIS LAYANAN PERSAMPAHAN 2026";
$service->update([
    'description' => "<p><strong>{$testMarker}</strong></p>" . $oldDesc
]);

$httpKernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Request::create('/layanan/persampahan', 'GET');
$response = $httpKernel->handle($request);
$hasMarker = str_contains($response->getContent(), $testMarker);
echo "Dynamic Edit Test (/layanan/persampahan):\n";
echo "Marker found in public page response: " . ($hasMarker ? "SUCCESS! Service is 100% dynamic from Admin!" : "FAILED!") . "\n";

// Restore
$service->update(['description' => $oldDesc]);
echo "Original description restored successfully.\n";
