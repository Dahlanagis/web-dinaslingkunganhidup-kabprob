<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use App\Models\QuickAccess;
use App\Models\Profile;
use App\Models\RelatedLink;
use App\Models\Statistic;

class ContentSeeder extends Seeder
{
    public function run()
    {
        Profile::truncate();
        QuickAccess::truncate();
        Statistic::truncate();
        RelatedLink::truncate();
        Banner::truncate();

        // 1. Profiles
        Profile::create([
            'section' => 'Visi Misi',
            'title' => 'Visi Misi DLH Kab. Probolinggo',
            'content' => '<h3>VISI</h3><p>Mewujudkan Kabupaten Probolinggo yang Sejahtera, Berkeadilan, Mandiri, Murah Hati, dan Berdaya Saing melalui Pembangunan Berkelanjutan yang Berwawasan Lingkungan.</p><h3>MISI</h3><p>Meningkatkan Kualitas Lingkungan Hidup dan Pengelolaan Persampahan yang Terpadu.</p>'
        ]);

        Profile::create([
            'section' => 'Tugas Pokok & Fungsi',
            'title' => 'Tugas Pokok dan Fungsi (Tupoksi)',
            'content' => '<p>Dinas Lingkungan Hidup mempunyai tugas membantu Bupati melaksanakan urusan pemerintahan bidang lingkungan hidup yang menjadi kewenangan Daerah dan tugas pembantuan yang diberikan kepada Daerah.</p>'
        ]);

        // 2. Quick Accesses
        QuickAccess::create([
            'title' => 'Pengaduan Masyarakat',
            'url' => '#',
            'icon' => 'heroicon-o-megaphone',
        ]);
        QuickAccess::create([
            'title' => 'Indeks Kualitas Udara',
            'url' => '#',
            'icon' => 'heroicon-o-cloud',
        ]);
        QuickAccess::create([
            'title' => 'Layanan Persampahan',
            'url' => '#',
            'icon' => 'heroicon-o-trash',
        ]);
        QuickAccess::create([
            'title' => 'Perizinan Lingkungan',
            'url' => '#',
            'icon' => 'heroicon-o-document-check',
        ]);

        // 3. Statistics
        Statistic::create([
            'title' => 'Volume Sampah (Ton/Hari)',
            'value' => '125',
            'icon' => 'heroicon-o-trash',
            'is_active' => true,
        ]);
        Statistic::create([
            'title' => 'Ruang Terbuka Hijau (%)',
            'value' => '32%',
            'icon' => 'heroicon-o-tree',
            'is_active' => true,
        ]);
        Statistic::create([
            'title' => 'Indeks Kualitas Lingkungan',
            'value' => '78.5',
            'icon' => 'heroicon-o-chart-bar',
            'is_active' => true,
        ]);
        Statistic::create([
            'title' => 'Bank Sampah Aktif',
            'value' => '45 Unit',
            'icon' => 'heroicon-o-building-storefront',
            'is_active' => true,
        ]);

        // 4. Related Links
        RelatedLink::create([
            'title' => 'Pemerintah Kab. Probolinggo',
            'url' => 'https://probolinggokab.go.id/',
            'logo' => 'bi-globe',
            'is_active' => true,
        ]);
        RelatedLink::create([
            'title' => 'Kementerian LHK',
            'url' => 'https://www.menlhk.go.id/',
            'logo' => 'bi-link-45deg',
            'is_active' => true,
        ]);
        RelatedLink::create([
            'title' => 'DLH Provinsi Jawa Timur',
            'url' => 'https://dlh.jatimprov.go.id/',
            'logo' => 'bi-building',
            'is_active' => true,
        ]);
        RelatedLink::create([
            'title' => 'Sistem Informasi Pengelolaan Sampah Nasional (SIPSN)',
            'url' => 'https://sipsn.menlhk.go.id/',
            'logo' => 'bi-recycle',
            'is_active' => true,
        ]);

        // 5. Banners
        Banner::create([
            'title' => 'Gerakan Bersih dan Hijau Kabupaten Probolinggo',
            'image' => 'galleries/01M1K2G15AX919GAPJ2KMHR4EP.jpeg',
            'is_active' => true,
        ]);
        Banner::create([
            'title' => 'Sosialisasi Pemilahan Sampah Mandiri Rumah Tangga',
            'image' => 'galleries/01M1K2GS09BX9DE116AK2PYZB8.jpg',
            'is_active' => true,
        ]);
    }
}
