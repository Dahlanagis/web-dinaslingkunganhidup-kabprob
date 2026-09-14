<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Category;

$data = [
    // 1. KONTEN (Berita & Artikel)
    [
        'name' => 'Berita Kegiatan / Terkini',
        'slug' => 'berita',
        'type' => 'konten',
        'description' => 'Publikasi liputan kegiatan resmi, rapat kedinasan, dan agenda lapangan DLH.',
    ],
    [
        'name' => 'Artikel Edukasi Lingkungan',
        'slug' => 'artikel',
        'type' => 'konten',
        'description' => 'Materi wawasan, tips pemilahan sampah, panduan Adiwiyata, dan edukasi pelestarian alam.',
    ],
    [
        'name' => 'Siaran Pers & Pengumuman',
        'slug' => 'pengumuman',
        'type' => 'konten',
        'description' => 'Pemberitahuan resmi dan siaran pers penting bagi masyarakat luas.',
    ],
    [
        'name' => 'Opini & Wawasan Hijau',
        'slug' => 'opini',
        'type' => 'konten',
        'description' => 'Ulasan analisis ilmiah dan opini kebijakan lingkungan hidup.',
    ],

    // 2. DOKUMEN
    [
        'name' => 'Perencanaan Kinerja',
        'slug' => 'perencanaan-kinerja',
        'type' => 'dokumen',
        'description' => 'Renstra, Perjanjian Kinerja (PK), dan Indikator Kinerja Utama (IKU).',
    ],
    [
        'name' => 'Evaluasi Kinerja',
        'slug' => 'evaluasi-kinerja',
        'type' => 'dokumen',
        'description' => 'Laporan Akuntabilitas Kinerja Instansi Pemerintah (LKjIP) dan monev.',
    ],
    [
        'name' => 'Regulasi & Hukum',
        'slug' => 'regulasi',
        'type' => 'dokumen',
        'description' => 'Perda, Perbup, Surat Keputusan Bupati, dan dasar regulasi hukum lingkungan.',
    ],
    [
        'name' => 'Laporan Tahunan',
        'slug' => 'laporan-tahunan',
        'type' => 'dokumen',
        'description' => 'Laporan tahunan pelaksanaan program kerja DLH Kabupaten Probolinggo.',
    ],
    [
        'name' => 'SOP Pelayanan',
        'slug' => 'sop-pelayanan',
        'type' => 'dokumen',
        'description' => 'Standar Operasional Prosedur pelayanan publik DLH.',
    ],

    // 3. GALERI
    [
        'name' => 'Kegiatan Lapangan',
        'slug' => 'kegiatan-lapangan',
        'type' => 'galeri',
        'description' => 'Dokumentasi aksi lapangan dan operasional petugas di seluruh wilayah.',
    ],
    [
        'name' => 'Sosialisasi & Edukasi',
        'slug' => 'sosialisasi-edukasi',
        'type' => 'galeri',
        'description' => 'Dokumentasi penyuluhan masyarakat, sekolah Adiwiyata, dan workshop.',
    ],
    [
        'name' => 'Penghargaan Lingkungan',
        'slug' => 'penghargaan',
        'type' => 'galeri',
        'description' => 'Dokumentasi penerimaan piala, piagam, dan apresiasi prestasi dinas.',
    ],
    [
        'name' => 'Kerja Bakti & Kebersihan',
        'slug' => 'kerja-bakti',
        'type' => 'galeri',
        'description' => 'Aksi gotong royong bersih-bersih lingkungan bersama warga.',
    ],
    [
        'name' => 'Penghijauan & RTH',
        'slug' => 'penghijauan-rth',
        'type' => 'galeri',
        'description' => 'Penanaman bibit pohon peneduh, mangrove, dan penataan taman kota.',
    ],

    // 4. LAYANAN
    [
        'name' => 'Kebersihan',
        'slug' => 'kebersihan',
        'type' => 'layanan',
        'description' => 'Layanan pengelolaan sampah, armada truk, dan pembinaan bank sampah.',
    ],
    [
        'name' => 'Laboratorium',
        'slug' => 'laboratorium',
        'type' => 'layanan',
        'description' => 'Layanan uji laboratorium air, air limbah, dan kualitas udara.',
    ],
    [
        'name' => 'Pengaduan',
        'slug' => 'pengaduan',
        'type' => 'layanan',
        'description' => 'Kanal pengaduan masyarakat pencemaran lingkungan (Hallo Sae & SP4N LAPOR).',
    ],
    [
        'name' => 'Perizinan',
        'slug' => 'perizinan',
        'type' => 'layanan',
        'description' => 'Penilaian dan persetujuan dokumen lingkungan AMDAL, UKL-UPL, SPPL.',
    ],
    [
        'name' => 'Ruang Hijau',
        'slug' => 'ruang-hijau',
        'type' => 'layanan',
        'description' => 'Penataan dan pemeliharaan taman aktif, hutan kota, dan jalur hijau.',
    ],
];

foreach ($data as $item) {
    Category::updateOrCreate(
        ['slug' => $item['slug'], 'type' => $item['type']],
        [
            'name' => $item['name'],
            'description' => $item['description'],
            'is_active' => true,
        ]
    );
}

echo "Master Categories seeded successfully! Total: " . Category::count() . "\n";
foreach (Category::all() as $c) {
    echo "ID: {$c->id} | Type: [{$c->type}] | Name: {$c->name} ({$c->slug})\n";
}
