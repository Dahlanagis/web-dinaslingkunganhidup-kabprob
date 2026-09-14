<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$g = \App\Models\Gallery::first();
echo "Images attribute raw: " . json_encode($g->getAttributes()['images']) . "\n";
echo "Images attribute casted: " . json_encode($g->images) . "\n";

$col = \Filament\Tables\Columns\ImageColumn::make('images');
$col->record($g);
echo "ImageColumn getImageUrl(): " . json_encode($col->getImageUrl()) . "\n";
echo "ImageColumn getImageUrls(): " . json_encode($col->getImageUrls()) . "\n";

echo "Storage url: " . \Illuminate\Support\Facades\Storage::disk('public')->url('galleries/01M1ZF29SG4CM6JWR1ZGR0ZA85.jpg') . "\n";
