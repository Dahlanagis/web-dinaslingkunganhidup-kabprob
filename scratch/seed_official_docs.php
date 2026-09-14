<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Ensure documents directory exists
$docDir = storage_path('app/public/documents');
if (!file_exists($docDir)) {
    mkdir($docDir, 0755, true);
}

// Function to generate a simple valid PDF with custom title text
function createSamplePdf($filename, $title) {
    $path = storage_path('app/public/documents/' . $filename);
    $content = "%PDF-1.4\n" .
        "1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj\n" .
        "2 0 obj<</Type/Pages/Count 1/Kids[3 0 R]>>endobj\n" .
        "3 0 obj<</Type/Page/MediaBox[0 0 595 842]/Parent 2 0 R/Contents 4 0 R/Resources<<>>>>endobj\n" .
        "4 0 obj<</Length 100>>stream\n" .
        "BT /F1 16 Tf 50 750 Td (" . addcslashes($title, '()\\') . ") Tj ET\n" .
        "endstream\nendobj\n" .
        "xref\n0 5\n0000000000 65535 f\n0000000009 00000 n\n0000000052 00000 n\n0000000101 00000 n\n0000000212 00000 n\n" .
        "trailer<</Size 5/Root 1 0 R>>\nstartxref\n362\n%%EOF";
    file_put_contents($path, $content);
    return 'documents/' . $filename;
}

$items = [
    [
        'title' => 'Rencana Strategis (Renstra) DLH Kabupaten Probolinggo Tahun 2024–2029',
        'category' => 'Perencanaan Kinerja',
        'downloads' => 185,
        'filename' => 'renstra-dlh-2024-2029.pdf',
    ],
    [
        'title' => 'Laporan Kinerja Instansi Pemerintah (LKjIP) DLH Kabupaten Probolinggo Tahun 2025',
        'category' => 'Evaluasi Kinerja',
        'downloads' => 94,
        'filename' => 'lkjip-dlh-2025.pdf',
    ],
    [
        'title' => 'Perjanjian Kinerja (PK) Kepala Dinas Lingkungan Hidup Kabupaten Probolinggo Tahun 2026',
        'category' => 'Perjanjian Kinerja',
        'downloads' => 52,
        'filename' => 'perjanjian-kinerja-2026.pdf',
    ],
    [
        'title' => 'Indikator Kinerja Utama (IKU) Dinas Lingkungan Hidup Kabupaten Probolinggo',
        'category' => 'Indikator Kinerja Utama',
        'downloads' => 68,
        'filename' => 'iku-dlh-kab-probolinggo.pdf',
    ],
    [
        'title' => 'Rencana Kerja (Renja) Dinas Lingkungan Hidup Kabupaten Probolinggo Tahun 2026',
        'category' => 'Perencanaan Kinerja',
        'downloads' => 120,
        'filename' => 'renja-dlh-2026.pdf',
    ],
    [
        'title' => 'Peraturan Daerah (Perda) No. 5 Tahun 2024 tentang Pengelolaan Sampah dan RTH Kabupaten Probolinggo',
        'category' => 'Regulasi',
        'downloads' => 210,
        'filename' => 'perda-sampah-rth-2024.pdf',
    ],
    [
        'title' => 'Standar Operasional Prosedur (SOP) Pelayanan Pengujian Kualitas Lingkungan & Laboratorium DLH',
        'category' => 'Standar Operasional',
        'downloads' => 145,
        'filename' => 'sop-pelayanan-lab-lingkungan.pdf',
    ],
];

// Truncate and create exactly 7 official documents
\App\Models\Document::truncate();

foreach ($items as $item) {
    $filePath = createSamplePdf($item['filename'], $item['title']);
    \App\Models\Document::create([
        'title' => $item['title'],
        'category' => $item['category'],
        'downloads' => $item['downloads'],
        'file_path' => $filePath,
    ]);
}

echo "Created 7 official DLH documents successfully:\n";
foreach (\App\Models\Document::all() as $doc) {
    echo "ID: {$doc->id} | {$doc->title} | [{$doc->category}] | File: {$doc->file_path}\n";
}
