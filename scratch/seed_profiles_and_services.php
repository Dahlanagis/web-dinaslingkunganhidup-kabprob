<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Profile;
use App\Models\Service;

echo "Updating services slugs...\n";
$servicesMap = [
    'persampahan' => [
        'name' => 'Pengelolaan Sampah & Kebersihan',
        'tag' => 'Kebersihan',
        'icon' => 'bi-recycle',
        'description' => '<p>DLH Kabupaten Probolinggo mengelola sistem persampahan terpadu dari pengangkutan sampah permukiman, pasar, instansi hingga pemrosesan akhir di TPA Seboro, serta pembinaan jaringan Bank Sampah aktif di seluruh kecamatan.</p>
<h4>Fasilitas & Program Layanan:</h4>
<ul>
  <li><strong>Armada Pengangkutan Rutin:</strong> Jalur protokol, pemukiman warga, pasar tradisional, dan kawasan publik.</li>
  <li><strong>Program Bank Sampah:</strong> Pembentukan unit bank sampah berbasis 3R (Reduce, Reuse, Recycle).</li>
  <li><strong>TPA Seboro:</strong> Pemrosesan sampah ramah lingkungan berkonsep controlled landfill dan penanganan lindi.</li>
  <li><strong>Kontainer Amrol:</strong> Penyediaan titik pembuangan sementara di lokasi strategis kecamatan.</li>
</ul>'
    ],
    'lab' => [
        'name' => 'Laboratorium Pengujian Lingkungan',
        'tag' => 'Laboratorium',
        'icon' => 'bi-droplet-half',
        'description' => '<p>Laboratorium Lingkungan DLH Kabupaten Probolinggo melayani uji sampling kualitas air, air limbah industri/domestik, kualitas air sumur masyarakat, serta pemantauan baku mutu udara ambien secara berkala.</p>
<h4>Parameter & Lingkup Pengujian:</h4>
<ul>
  <li><strong>Uji Kualitas Air Limbah:</strong> Parameter BOD, COD, TSS, pH, Logam Berat, dan Minyak/Lemak.</li>
  <li><strong>Uji Air Bersih & Sungai:</strong> Pemantauan sungai-sungai utama dan sumber mata air Kabupaten Probolinggo.</li>
  <li><strong>Penerbitan Sertifikat Hasil Uji (SHU):</strong> Dokumen resmi kepatuhan baku mutu lingkungan.</li>
</ul>'
    ],
    'pengaduan' => [
        'name' => 'Pengaduan Pencemaran Lingkungan',
        'tag' => 'Pengaduan',
        'icon' => 'bi-megaphone-fill',
        'description' => '<p>Pusat penerimaan laporan, keluhan, dan aspirasi masyarakat mengenai permasalahan lingkungan hidup seperti pembuangan sampah liar, pembuangan limbah tanpa izin, polusi bau, dan pohon tumbang.</p>
<h4>Kanal Pengaduan Resmi:</h4>
<ul>
  <li><strong>SP4N LAPOR!:</strong> Layanan aspirasi dan pengaduan daring nasional terintegrasi.</li>
  <li><strong>Hallo Sae DLH (WhatsApp):</strong> Layanan respon cepat penanganan kedinasan.</li>
  <li><strong>Posko Pengaduan Langsung:</strong> Kantor Dinas Lingkungan Hidup Kab. Probolinggo.</li>
</ul>'
    ],
    'amdal' => [
        'name' => 'AMDAL & Perizinan Lingkungan',
        'tag' => 'Perizinan',
        'icon' => 'bi-file-earmark-check-fill',
        'description' => '<p>Fasilitasi dan penilaian dokumen lingkungan AMDAL, UKL-UPL, serta Surat Pernyataan Kesanggupan Pengelolaan dan Pemantauan Lingkungan Hidup (SPPL) bagi pelaku usaha dan kegiatan di Kabupaten Probolinggo.</p>'
    ],
    'taman-rth' => [
        'name' => 'Taman Kota & Ruang Terbuka Hijau (RTH)',
        'tag' => 'Ruang Hijau',
        'icon' => 'bi-tree-fill',
        'description' => '<p>Pengelolaan, penataan, dan pemeliharaan taman aktif, hutan kota, median jalan, jalur hijau pedestrian, serta peremajaan pohon peneduh di seluruh wilayah perkotaan Kabupaten Probolinggo.</p>'
    ],
    'maklumat-pelayanan' => [
        'name' => 'Maklumat Pelayanan Publik',
        'tag' => 'Info Publik',
        'icon' => 'bi-award-fill',
        'description' => '<p>Standar dan komitmen pelayanan publik resmi Dinas Lingkungan Hidup Kabupaten Probolinggo untuk memberikan pelayanan yang transparan, profesional, bebas pungli, dan bertanggung jawab.</p>'
    ]
];

foreach ($servicesMap as $slug => $data) {
    $service = Service::where('slug', $slug)->first();
    if (!$service) {
        // Try to match by name or tag
        if ($slug === 'persampahan') {
            $service = Service::where('name', 'like', '%Sampah%')->first();
        } elseif ($slug === 'lab') {
            $service = Service::where('name', 'like', '%Pencemaran%')->orWhere('name', 'like', '%Lab%')->first();
        } elseif ($slug === 'pengaduan') {
            $service = Service::where('name', 'like', '%LAPOR%')->orWhere('name', 'like', '%Pengaduan%')->first();
        } elseif ($slug === 'amdal') {
            $service = Service::where('name', 'like', '%AMDAL%')->first();
        } elseif ($slug === 'taman-rth') {
            $service = Service::where('name', 'like', '%Taman%')->orWhere('name', 'like', '%RTH%')->first();
        } elseif ($slug === 'maklumat-pelayanan') {
            $service = Service::where('name', 'like', '%Maklumat%')->first();
        }
    }

    if ($service) {
        $service->update([
            'slug' => $slug,
            'name' => $data['name'],
            'tag' => $data['tag'],
            'icon' => $data['icon'],
            'description' => $service->description ?: $data['description'],
        ]);
        echo "Updated service [{$slug}]: {$service->name}\n";
    } else {
        Service::create([
            'name' => $data['name'],
            'slug' => $slug,
            'tag' => $data['tag'],
            'icon' => $data['icon'],
            'description' => $data['description'],
        ]);
        echo "Created service [{$slug}]: {$data['name']}\n";
    }
}

echo "\nPopulating/Standardizing Profiles for all submenus...\n";
$profilesData = [
    'sejarah' => [
        'title' => 'Profil & Sejarah Singkat DLH',
        'content' => '<p class="lead" style="line-height: 1.85; font-size: 1.12rem;">
Dinas Lingkungan Hidup (DLH) Kabupaten Probolinggo merupakan unsur pelaksana urusan pemerintahan di bidang lingkungan hidup yang berkedudukan di bawah dan bertanggung jawab kepada Bupati melalui Sekretaris Daerah.
</p>
<p style="line-height: 1.85;">
Kabupaten Probolinggo memiliki bentang alam yang kaya dan strategis, membentang dari wilayah pesisir utara pantai Jawa, kawasan agraris, perkotaan Kraksaan dan Dringu, hingga kawasan pegunungan Bromo Tengger Semeru. Dinas Lingkungan Hidup mengemban amanah besar menjaga kelestarian alam, mengelola sistem tata sampah terpadu, mengurangi pencemaran lingkungan, serta memperluas tutupan ruang terbuka hijau yang asri dan sehat.
</p>
<div class="row g-3 my-4">
    <div class="col-md-4">
        <div class="p-3 bg-light rounded-3 border text-center">
            <div class="h2 text-success fw-bold mb-0">24</div>
            <small class="text-muted">Kecamatan Terlayani</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="p-3 bg-light rounded-3 border text-center">
            <div class="h2 text-success fw-bold mb-0">325+</div>
            <small class="text-muted">Desa &amp; Kelurahan</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="p-3 bg-light rounded-3 border text-center">
            <div class="h2 text-success fw-bold mb-0">100%</div>
            <small class="text-muted">Komitmen Hijau</small>
        </div>
    </div>
</div>
<p style="line-height: 1.85;">
Melalui perpaduan penegakan regulasi lingkungan, inovasi digital pelaporan (<em>SP4N LAPOR!</em> &amp; <em>Hallo Sae</em>), dan kolaborasi aktif dengan kader lingkungan masyarakat, DLH terus berikhtiar mewujudkan Kabupaten Probolinggo yang bersih, hijau, dan berkelanjutan.
</p>'
    ],
    'visi-misi' => [
        'title' => 'Visi & Misi DLH Kab. Probolinggo',
        'content' => '<div class="p-4 rounded-4 mb-4 text-white" style="background: linear-gradient(135deg, #064e3b 0%, #047857 100%);">
    <div class="text-warning fw-bold mb-2" style="letter-spacing: 1.5px; font-size: 0.85rem;">
        VISI PEMERINTAH KABUPATEN PROBOLINGGO
    </div>
    <blockquote class="mb-0 fs-5 fw-bold fst-italic" style="line-height: 1.6;">
        "Mewujudkan Kabupaten Probolinggo yang Sejahtera, Berkeadilan, Mandiri, Berwawasan Lingkungan, dan Berdaya Saing Melalui Pembangunan Berkelanjutan."
    </blockquote>
</div>
<h4 class="fw-bold mb-3 text-success">Misi Lingkungan Hidup</h4>
<ol style="line-height: 1.8; font-size: 1rem;">
    <li><strong>Peningkatan Kualitas Pengelolaan Sampah &amp; Kebersihan:</strong> Mengembangkan sistem pengelolaan persampahan terpadu dari hulu ke hilir berbasis reduksi, guna ulang, daur ulang (3R) dan pemberdayaan bank sampah.</li>
    <li><strong>Pengendalian Pencemaran Air, Udara, dan Lahan:</strong> Melakukan pengawasan dan pemantauan berkala baku mutu lingkungan hidup, perizinan lingkungan (AMDAL/UKL-UPL), serta penegakan hukum lingkungan terpadu.</li>
    <li><strong>Pengembangan Ruang Terbuka Hijau &amp; Keanekaragaman Hayati:</strong> Memperluas proporsi Ruang Terbuka Hijau (RTH) publik dan menata pertamanan kota guna menciptakan iklim mikro yang sehat dan asri.</li>
    <li><strong>Pemberdayaan Masyarakat &amp; Transformasi Digital Layanan:</strong> Meningkatkan kesadaran masyarakat melalui program Adiwiyata, Proklim, serta kemudahan pelaporan online masyarakat.</li>
</ol>'
    ],
    'struktur' => [
        'title' => 'Bagan Struktur Organisasi DLH',
        'content' => '<p class="text-muted mb-4">Struktur organisasi Dinas Lingkungan Hidup Kabupaten Probolinggo berdasarkan Peraturan Daerah dan Peraturan Bupati yang berlaku.</p>
<div class="text-center my-4">
    <div class="p-3 rounded-4 text-white d-inline-block shadow-sm mb-3" style="background: linear-gradient(135deg, #14532d, #166534); min-width: 280px;">
        <div class="small text-warning fw-bold">PIMPINAN INSTANSI</div>
        <h5 class="fw-bold mb-0">Kepala Dinas Lingkungan Hidup</h5>
    </div>
    <div class="my-2 text-success fw-bold fs-4">↓</div>
    <div class="p-2.5 rounded-3 bg-light border d-inline-block shadow-sm mb-3" style="min-width: 250px;">
        <div class="small text-success fw-bold">Sekretariat Dinas</div>
        <div class="text-muted small">Subbag Perencanaan, Keuangan &amp; Umum Kepegawaian</div>
    </div>
    <div class="row g-3 justify-content-center text-start mt-3">
        <div class="col-md-4">
            <div class="p-3 rounded-3 border bg-light h-100 text-center">
                <div class="h5 text-success mb-1 fw-bold">Bidang Persampahan &amp; B3</div>
                <p class="text-muted small mb-0">Pengelolaan sampah perkotaan, TPA Seboro, armada truk sampah, dan limbah B3.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded-3 border bg-light h-100 text-center">
                <div class="h5 text-success mb-1 fw-bold">Bidang Pengendalian Pencemaran</div>
                <p class="text-muted small mb-0">Laboratorium lingkungan, pemantauan kualitas air &amp; udara, AMDAL, serta pengawasan industri.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded-3 border bg-light h-100 text-center">
                <div class="h5 text-success mb-1 fw-bold">Bidang Tata Lingkungan &amp; RTH</div>
                <p class="text-muted small mb-0">Pengelolaan taman kota, keanekaragaman hayati, pohon peneduh, dan sekolah Adiwiyata.</p>
            </div>
        </div>
    </div>
</div>'
    ],
    'tupoksi' => [
        'title' => 'Tugas Pokok & Fungsi (Tupoksi)',
        'content' => '<div class="p-4 rounded-4 bg-light border mb-4">
    <h5 class="fw-bold text-success mb-2"><i class="bi bi-flag-fill me-1.5"></i> Tugas Pokok:</h5>
    <p class="text-muted mb-0" style="line-height: 1.8; font-size: 0.98rem;">
        Dinas Lingkungan Hidup Kabupaten Probolinggo mempunyai tugas membantu Bupati dalam melaksanakan urusan pemerintahan yang menjadi kewenangan daerah dan tugas pembantuan di bidang lingkungan hidup, kebersihan, persampahan, dan ruang terbuka hijau.
    </p>
</div>
<h5 class="fw-bold text-dark mb-3"><i class="bi bi-gear-fill text-success me-1.5"></i> Fungsi Utama DLH Kabupaten Probolinggo:</h5>
<ul style="line-height: 1.8;">
    <li>Perumusan kebijakan teknis di bidang tata lingkungan, perlindungan, konservasi, dan pengelolaan lingkungan hidup daerah.</li>
    <li>Pelaksanaan kebijakan pengelolaan persampahan, kebersihan lingkungan, dan pemanfaatan daur ulang bernilai ekonomis.</li>
    <li>Pengendalian pencemaran, kerusakan lingkungan hidup, dan pengujian laboratorium baku mutu air serta udara ambien.</li>
    <li>Pemeliharaan dan pengembangan Ruang Terbuka Hijau (RTH) publik serta pertamanan kota yang ramah lingkungan.</li>
    <li>Penegakan hukum dan penyelesaian pengaduan masyarakat di bidang lingkungan hidup dan tata kebersihan.</li>
</ul>'
    ],
    'pejabat' => [
        'title' => 'Daftar Pejabat Pengelola DLH',
        'content' => '<p class="text-muted mb-4">Susunan pimpinan dan pejabat struktural di lingkungan Dinas Lingkungan Hidup Kabupaten Probolinggo:</p>
<div class="row g-4">
    <div class="col-md-6">
        <div class="p-4 rounded-4 border bg-light text-center h-100">
            <div class="h1 text-success mb-2"><i class="bi bi-person-circle"></i></div>
            <h5 class="fw-bold mb-1 text-dark">Kepala Dinas Lingkungan Hidup</h5>
            <div class="text-success fw-bold small mb-2">Pimpinan Instansi</div>
            <p class="text-muted small mb-0">Memimpin perumusan kebijakan dan penyelenggaraan urusan pemerintahan daerah di bidang lingkungan hidup dan kebersihan.</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="p-4 rounded-4 border bg-light text-center h-100">
            <div class="h1 text-success mb-2"><i class="bi bi-person-circle"></i></div>
            <h5 class="fw-bold mb-1 text-dark">Sekretaris Dinas Lingkungan Hidup</h5>
            <div class="text-success fw-bold small mb-2">Sekretariat DLH</div>
            <p class="text-muted small mb-0">Mengkoordinasikan perencanaan, kepegawaian, keuangan, perlengkapan, dan tata kelola administrasi kedinasan.</p>
        </div>
    </div>
</div>'
    ],
    'maklumat' => [
        'title' => 'Maklumat Pelayanan DLH',
        'content' => '<div class="p-4 p-md-5 rounded-4 text-center text-white my-3 shadow-sm" style="background: linear-gradient(145deg, #052e16 0%, #14532d 50%, #064e3b 100%); border: 2px solid #fbbf24;">
    <div class="h1 text-warning mb-3"><i class="bi bi-award-fill"></i></div>
    <h3 class="fw-bold text-warning mb-3" style="letter-spacing: 1.5px;">MAKLUMAT PELAYANAN</h3>
    <blockquote class="lead fst-italic mb-4" style="line-height: 1.85; max-width: 640px; margin: 0 auto;">
        "Dengan ini, kami pimpinan dan segenap pegawai Dinas Lingkungan Hidup Kabupaten Probolinggo menyatakan sanggup menyelenggarakan pelayanan publik sesuai standar pelayanan yang telah ditetapkan, dan apabila tidak menepati janji ini, kami siap menerima sanksi sesuai ketentuan peraturan perundang-undangan yang berlaku."
    </blockquote>
    <div class="pt-3 border-top border-white border-opacity-25 d-inline-block">
        <span class="fw-bold text-white fs-6">Dinas Lingkungan Hidup Kabupaten Probolinggo</span>
    </div>
</div>'
    ]
];

foreach ($profilesData as $section => $data) {
    // Check if section exists directly or under old names
    $profile = Profile::where('section', $section)->first();
    if (!$profile) {
        if ($section === 'visi-misi') {
            $profile = Profile::where('section', 'Visi Misi')->orWhere('section', 'visi_misi')->first();
        } elseif ($section === 'tupoksi') {
            $profile = Profile::where('section', 'like', '%Tugas%')->orWhere('section', 'tupoksi')->first();
        }
    }

    if ($profile) {
        $profile->update([
            'section' => $section,
            'title' => $profile->title ?: $data['title'],
            'content' => $profile->content ?: $data['content'],
        ]);
        echo "Updated profile section: [{$section}] -> {$profile->title}\n";
    } else {
        Profile::create([
            'section' => $section,
            'title' => $data['title'],
            'content' => $data['content'],
        ]);
        echo "Created profile section: [{$section}] -> {$data['title']}\n";
    }
}

echo "\n--- ALL PROFILES AFTER SEEDING ---\n";
foreach (Profile::all() as $p) {
    echo "ID: {$p->id} | Section: {$p->section} | Title: {$p->title}\n";
}

echo "\n--- ALL SERVICES AFTER SEEDING ---\n";
foreach (Service::all() as $s) {
    echo "ID: {$s->id} | Slug: {$s->slug} | Name: {$s->name}\n";
}
