<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Post;

// 1. Update existing posts to be specifically BERITA
$berita1 = Post::find(3);
if ($berita1) {
    $berita1->update([
        'title' => 'DLH Tingkatkan Operasi Bersih & Penertiban Timbulan Sampah Liar',
        'category' => 'berita',
        'slug' => 'dlh-tingkatkan-operasi-bersih-sampah-liar',
        'content' => "Dinas Lingkungan Hidup (DLH) Kabupaten Probolinggo terus menggencarkan kegiatan operasi bersih dan penanganan titik-titik tumpukan sampah liar di sepanjang jalur protokol dan kawasan fasilitas umum.\n\nKepala Dinas Lingkungan Hidup menyampaikan bahwa penanganan sampah memerlukan kolaborasi berkelanjutan antara petugas kebersihan dan partisipasi aktif warga untuk tidak membuang sampah sembarangan. Fasilitas kontainer sampah juga terus dimaksimalkan demi terciptanya lingkungan kabupaten yang bersih, indah, dan nyaman.",
    ]);
}

$berita2 = Post::find(4);
if ($berita2) {
    $berita2->update([
        'title' => 'Kunjungan Kerja Monitoring Pengelolaan Bank Sampah Desa Terpadu',
        'category' => 'berita',
        'slug' => 'kunjungan-kerja-monitoring-bank-sampah-desa',
        'content' => "Tim Bidang Pengelolaan Sampah DLH Kabupaten Probolinggo melaksanakan kunjungan kerja lapangan untuk memantau aktivitas Bank Sampah Unit di beberapa desa percontohan.\n\nKunjungan ini bertujuan untuk mengukur efektivitas reduksi sampah skala rumah tangga serta memberikan pembinaan manajemen pencatatan tabungan sampah warga. Program ini terbukti mampu menekan volume sampah yang masuk ke Tempat Pemrosesan Akhir (TPA).",
    ]);
}

$berita3 = Post::find(5);
if ($berita3) {
    $berita3->update([
        'title' => 'Rapat Evaluasi Kinerja Pengendalian Pencemaran dan Baku Mutu Lingkungan',
        'category' => 'berita',
        'slug' => 'rapat-evaluasi-kinerja-pengendalian-pencemaran',
        'content' => "DLH Kabupaten Probolinggo menyelenggarakan rapat evaluasi berkala mengenai pengawasan baku mutu air limbah dan kualitas udara di aula kantor dinas.\n\nDalam rapat ini dipaparkan capaian Indeks Kualitas Lingkungan Hidup (IKLH) tahun berjalan dan langkah-langkah strategis pembinaan terhadap pelaku usaha dan industri agar senantiasa mematuhi dokumen lingkungan hidup.",
    ]);
}

// 2. Ensure distinct ARTIKEL items exist
$artikelData = [
    [
        'title' => 'Pentingnya Memilah Sampah Organik dan Anorganik dari Rumah Tangga',
        'slug' => 'pentingnya-memilah-sampah-organik-anorganik',
        'category' => 'artikel',
        'content' => "Memilah sampah sejak dari sumbernya di rumah merupakan langkah fundamental dalam menjaga kelestarian lingkungan.\n\nSampah organik seperti sisa makanan dan daun dapat diolah menjadi kompos alami bernutrisi tinggi, sedangkan sampah anorganik seperti plastik, kardus, dan kaleng dapat disalurkan ke Bank Sampah untuk didaur ulang. Dengan memilah sampah, kita berkontribusi nyata mengurangi beban TPA dan mencegah timbulan gas metana berlebih.",
        'status' => 'published',
        'views' => 45,
    ],
    [
        'title' => 'Mengenal Program Adiwiyata: Membangun Generasi Peduli Lingkungan Hidup',
        'slug' => 'mengenal-program-adiwiyata-generasi-peduli-lingkungan',
        'category' => 'artikel',
        'content' => "Program Adiwiyata merupakan penghargaan bergengsi bagi sekolah-sekolah yang berhasil menerapkan gerakan peduli dan berbudaya lingkungan hidup di lingkungan sekolah.\n\nMelalui program ini, para siswa diajarkan kebiasaan menanam pohon, hemat energi, pengurangan sampah plastik sekali pakai, serta kebersihan sanitasi sejak usia dini demi melahirkan generasi masa depan yang mencintai kelestarian alam.",
        'status' => 'published',
        'views' => 62,
    ],
    [
        'title' => 'Fungsi Strategis Ruang Terbuka Hijau (RTH) Bagi Kualitas Udara Perkotaan',
        'slug' => 'fungsi-strategis-rth-kualitas-udara-perkotaan',
        'category' => 'artikel',
        'content' => "Ruang Terbuka Hijau (RTH) bukan sekadar pemanis tata kota, melainkan paru-paru alami yang menyerap karbondioksida dan menghasilkan oksigen segar bagi masyarakat.\n\nKeberadaan taman kota dan hutan kota di Kabupaten Probolinggo sangat krusial dalam menurunkan suhu iklim mikro, menjadi resapan air hujan penangkal banjir, dan wahana rekreasi ramah keluarga.",
        'status' => 'published',
        'views' => 38,
    ],
    [
        'title' => 'Panduan Bijak Menangani Limbah Elektronik dan B3 di Rumah Tangga',
        'slug' => 'panduan-bijak-menangani-limbah-elektronik-b3',
        'category' => 'artikel',
        'content' => "Baterai bekas, lampu neon, botol pestisida, dan perangkat elektronik rusak termasuk dalam kategori Bahan Berbahaya dan Beracun (B3).\n\nJangan membuang limbah B3 bersamaan dengan sampah dapur karena dapat mencemari air tanah dan berbahaya bagi kesehatan petugas kebersihan. Kumpulkan secara terpisah dan serahkan pada drop point resmi DLH Kabupaten Probolinggo.",
        'status' => 'published',
        'views' => 29,
    ],
];

foreach ($artikelData as $item) {
    Post::updateOrCreate(
        ['slug' => $item['slug']],
        $item
    );
}

// 3. Ensure other posts (id 6, 7) are set properly
$p6 = Post::find(6);
if ($p6) {
    $p6->update(['category' => 'berita']);
}
$p7 = Post::find(7);
if ($p7) {
    $p7->update(['category' => 'berita']);
}

echo "Posts and Articles successfully separated and seeded!\n";
echo "Total Berita: " . Post::where('category', 'berita')->count() . "\n";
echo "Total Artikel: " . Post::where('category', 'artikel')->count() . "\n";
