<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$dokumen = \App\Models\Navigation::where('title', 'DOKUMEN')->whereNull('parent_id')->first();
if ($dokumen) {
    // Delete existing children to re-order cleanly
    \App\Models\Navigation::where('parent_id', $dokumen->id)->delete();

    \App\Models\Navigation::create([
        'title' => 'Semua Dokumen',
        'url' => '/dokumen',
        'parent_id' => $dokumen->id,
        'order' => 1,
        'is_active' => true,
        'icon' => 'bi-folder2-open',
    ]);

    \App\Models\Navigation::create([
        'title' => 'Dokumen Kinerja',
        'url' => '/dokumen/kinerja',
        'parent_id' => $dokumen->id,
        'order' => 2,
        'is_active' => true,
        'icon' => 'bi-journal-check',
    ]);

    \App\Models\Navigation::create([
        'title' => 'Regulasi & SOP',
        'url' => '/dokumen/regulasi',
        'parent_id' => $dokumen->id,
        'order' => 3,
        'is_active' => true,
        'icon' => 'bi-file-earmark-ruled',
    ]);
}

echo "Navigation for DOKUMEN updated successfully:\n";
foreach (\App\Models\Navigation::where('parent_id', $dokumen->id)->get() as $c) {
    echo "  - {$c->title} [URL: {$c->url}] [Order: {$c->order}]\n";
}
