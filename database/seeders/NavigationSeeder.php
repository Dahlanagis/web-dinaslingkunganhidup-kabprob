<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Navigation;

class NavigationSeeder extends Seeder
{
    public function run()
    {
        // Bersihkan data lama
        Navigation::truncate();

        // 1. HOME
        Navigation::create([
            'title' => 'HOME',
            'url' => '/',
            'order' => 1,
            'is_active' => true,
        ]);

        // 2. PROFIL
        $profil = Navigation::create([
            'title' => 'PROFIL',
            'url' => '#',
            'order' => 2,
            'is_active' => true,
        ]);
        Navigation::create([
            'title' => 'Profil Instansi',
            'url' => '/profil/sejarah',
            'parent_id' => $profil->id,
            'order' => 1,
            'is_active' => true,
            'icon' => 'bi-clock-history',
        ]);
        Navigation::create([
            'title' => 'Visi Misi',
            'url' => '/profil/visi-misi',
            'parent_id' => $profil->id,
            'order' => 2,
            'is_active' => true,
            'icon' => 'bi-compass',
        ]);
        Navigation::create([
            'title' => 'Struktur Organisasi',
            'url' => '/profil/struktur',
            'parent_id' => $profil->id,
            'order' => 3,
            'is_active' => true,
            'icon' => 'bi-diagram-3',
        ]);
        Navigation::create([
            'title' => 'Tugas dan Fungsi',
            'url' => '/profil/tupoksi',
            'parent_id' => $profil->id,
            'order' => 4,
            'is_active' => true,
            'icon' => 'bi-card-checklist',
        ]);
        Navigation::create([
            'title' => 'Pejabat Pengelola',
            'url' => '/profil/pejabat',
            'parent_id' => $profil->id,
            'order' => 5,
            'is_active' => true,
            'icon' => 'bi-person-badge',
        ]);
        Navigation::create([
            'title' => 'Maklumat Pelayanan',
            'url' => '/profil/maklumat',
            'parent_id' => $profil->id,
            'order' => 6,
            'is_active' => true,
            'icon' => 'bi-file-earmark-text',
        ]);

        // 3. LAYANAN
        $layanan = Navigation::create([
            'title' => 'LAYANAN',
            'url' => '#',
            'order' => 3,
            'is_active' => true,
        ]);
        Navigation::create([
            'title' => 'Persampahan',
            'url' => '/layanan/persampahan',
            'parent_id' => $layanan->id,
            'order' => 1,
            'is_active' => true,
            'icon' => 'bi-trash',
        ]);
        Navigation::create([
            'title' => 'Laboratorium Lingkungan',
            'url' => '/layanan/lab',
            'parent_id' => $layanan->id,
            'order' => 2,
            'is_active' => true,
            'icon' => 'bi-droplet',
        ]);
        Navigation::create([
            'title' => 'Pengaduan Masyarakat',
            'url' => '/layanan/pengaduan',
            'parent_id' => $layanan->id,
            'order' => 3,
            'is_active' => true,
            'icon' => 'bi-megaphone',
        ]);

        // 4. DOKUMEN
        $dokumen = Navigation::create([
            'title' => 'DOKUMEN',
            'url' => '#',
            'order' => 4,
            'is_active' => true,
        ]);
        Navigation::create([
            'title' => 'Semua Dokumen',
            'url' => '/dokumen',
            'parent_id' => $dokumen->id,
            'order' => 1,
            'is_active' => true,
            'icon' => 'bi-folder2-open',
        ]);
        Navigation::create([
            'title' => 'Dokumen Kinerja',
            'url' => '/dokumen/kinerja',
            'parent_id' => $dokumen->id,
            'order' => 2,
            'is_active' => true,
            'icon' => 'bi-journal-check',
        ]);
        Navigation::create([
            'title' => 'Regulasi & SOP',
            'url' => '/dokumen/regulasi',
            'parent_id' => $dokumen->id,
            'order' => 3,
            'is_active' => true,
            'icon' => 'bi-file-earmark-ruled',
        ]);

        // 5. INFORMASI
        $informasi = Navigation::create([
            'title' => 'INFORMASI',
            'url' => '#',
            'order' => 5,
            'is_active' => true,
        ]);
        Navigation::create([
            'title' => 'Berita',
            'url' => '/informasi/berita',
            'parent_id' => $informasi->id,
            'order' => 1,
            'is_active' => true,
            'icon' => 'bi-newspaper',
        ]);
        Navigation::create([
            'title' => 'Artikel Lingkungan',
            'url' => '/informasi/artikel',
            'parent_id' => $informasi->id,
            'order' => 2,
            'is_active' => true,
            'icon' => 'bi-flower1',
        ]);
        Navigation::create([
            'title' => 'Galeri Kegiatan',
            'url' => '/informasi/galeri',
            'parent_id' => $informasi->id,
            'order' => 3,
            'is_active' => true,
            'icon' => 'bi-images',
        ]);

        // HUBUNGI dihapus karena sudah ada tombol CTA "Hubungi Kami" di navbar
    }
}
