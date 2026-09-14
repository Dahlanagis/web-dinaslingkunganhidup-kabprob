<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Storage;
use App\Models\Gallery;

$g = Gallery::find(1);
$file = $g->images[0];
echo "File: $file\n";
echo "Storage::disk('public')->exists: " . (Storage::disk('public')->exists($file) ? 'YES' : 'NO') . "\n";
echo "File path: " . Storage::disk('public')->path($file) . "\n";
echo "file_exists: " . (file_exists(Storage::disk('public')->path($file)) ? 'YES' : 'NO') . "\n";
