<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (!User::where('email', 'admin@dlh.com')->exists()) {
            User::create([
                'name' => 'Admin DLH',
                'email' => 'admin@dlh.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Seed Documents
        $documents = [
            ['title' => 'e bekal', 'category' => 'Perencanaan Kinerja', 'downloads' => 12],
            ['title' => 'laporan tahun 2026', 'category' => 'Evaluasi Kinerja', 'downloads' => 45],
            ['title' => 'patip', 'category' => 'Perencanaan Kinerja', 'downloads' => 8],
            ['title' => 'SK Kepala Dinas 2026', 'category' => 'Regulasi', 'downloads' => 20],
            ['title' => 'Renstra 2024-2029', 'category' => 'Perencanaan Kinerja', 'downloads' => 150],
            ['title' => 'LAKIP 2025', 'category' => 'Laporan Akuntabilitas', 'downloads' => 30],
            ['title' => 'SOP Pelayanan', 'category' => 'Standar Operasional', 'downloads' => 75],
            ['title' => 'PK Kepala Dinas 2026', 'category' => 'Perjanjian Kinerja', 'downloads' => 10],
            ['title' => 'IKU Dinas', 'category' => 'Indikator Kinerja Utama', 'downloads' => 25],
        ];
        foreach ($documents as $doc) {
            \App\Models\Document::create($doc);
        }

        // Seed Posts
        $posts = [
            ['title' => 'peternak ayam', 'slug' => 'peternak-ayam', 'content' => 'Berita tentang peternak ayam.', 'views' => 4, 'created_at' => '2026-08-31 10:00:00'],
            ['title' => 'ternak kuda', 'slug' => 'ternak-kuda', 'content' => 'Berita tentang ternak kuda.', 'views' => 12, 'created_at' => '2026-08-30 09:00:00'],
            ['title' => 'BERITA', 'slug' => 'berita', 'content' => 'Berita umum terbaru.', 'views' => 18, 'created_at' => '2026-08-28 08:00:00'],
            ['title' => 'Kunjungan Kerja ke Desa', 'slug' => 'kunjungan-kerja-desa', 'content' => 'Bapak Kepala Dinas melakukan kunjungan kerja.', 'views' => 25, 'created_at' => '2026-09-01 11:00:00'],
            ['title' => 'Rapat Evaluasi Bulanan', 'slug' => 'rapat-evaluasi-bulanan', 'content' => 'Rapat evaluasi kinerja bulan Agustus.', 'views' => 30, 'created_at' => '2026-09-02 09:30:00'],
            ['title' => 'Penghargaan Peternak Berprestasi', 'slug' => 'penghargaan-peternak', 'content' => 'Pemberian penghargaan kepada peternak terbaik tahun ini.', 'views' => 50, 'created_at' => '2026-08-25 14:00:00'],
            ['title' => 'Vaksinasi Masal Ternak', 'slug' => 'vaksinasi-masal', 'content' => 'Program vaksinasi masal untuk mencegah penyakit PMK.', 'views' => 42, 'created_at' => '2026-08-20 10:15:00'],
        ];
        foreach ($posts as $post) {
            \App\Models\Post::create($post);
        }

        // Seed Galleries
        for ($i = 1; $i <= 7; $i++) {
            \App\Models\Gallery::create([
                'title' => "Foto Kegiatan $i",
                'type' => 'foto',
                'category' => 'Kegiatan Lapangan',
                'images' => ["gallery/foto$i.jpg"],
            ]);
        }

        // Seed Reports (Pengaduan)
        \App\Models\Report::create([
            'name' => 'Budi Santoso',
            'location' => 'Desa Makmur',
            'description' => 'Ada pencemaran limbah di sungai dekat peternakan.',
        ]);

        // Seed Profiles, QuickAccess, Statistics, RelatedLinks, Banners
        $this->call(ContentSeeder::class);
    }
}
