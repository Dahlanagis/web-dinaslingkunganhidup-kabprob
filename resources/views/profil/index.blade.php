@extends('layouts.public')

@section('content')
<!-- PREMIUM PAGE HEADER -->
<section class="subpage-header py-5 text-white position-relative overflow-hidden">
    <div class="subpage-header-bg"></div>
    <div class="subpage-header-orb"></div>
    <div class="subpage-header-orb-right"></div>
    <div class="container position-relative py-3" style="z-index: 2;">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0 align-items-center" style="font-size: 0.82rem;">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-white-50 text-decoration-none hover-white">
                        <i class="bi bi-house-door-fill me-1 text-warning"></i> Beranda
                    </a>
                </li>
                <li class="breadcrumb-item text-white-50">Profil</li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $activeTab['title'] ?? 'Profil Instansi' }}</li>
            </ol>
        </nav>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill mb-3 subpage-pill-badge">
            <span class="subpage-pulse-beacon"></span>
            <i class="bi {{ $activeTab['icon'] ?? 'bi-building' }} text-warning"></i>
            <span>Profil Resmi Dinas Lingkungan Hidup Kab. Probolinggo</span>
        </div>
        <h1 class="fw-extrabold display-5 mb-2" style="font-weight: 800; letter-spacing: -0.5px;">
            {{ $activeTab['title'] ?? 'Profil Instansi DLH' }}
        </h1>
        <p class="text-white-75 mb-0" style="max-width: 720px; font-size: 1.02rem; line-height: 1.7;">
            Mengenal lebih dekat struktur tata kelola, visi misi pembangunan hijau, tugas pokok dan fungsi, serta komitmen pelayanan Dinas Lingkungan Hidup Kabupaten Probolinggo.
        </p>
    </div>
</section>

<!-- MAIN CONTENT -->
<div class="py-5" style="background: var(--slate50);">
    <div class="container">
        <!-- TOP INFO BAR (Glassmorphism Style) -->
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4 p-3.5 rounded-4 subpage-toolbar-glass">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-success text-white px-3.5 py-2 rounded-pill fw-bold shadow-xs" style="font-size: 0.82rem;">
                    <i class="bi {{ $activeTab['icon'] ?? 'bi-building' }} me-1.5"></i>
                    {{ $activeTab['title'] ?? 'Profil Instansi' }}
                </span>
                <span class="text-muted small">
                    Pemerintah Kabupaten Probolinggo
                </span>
            </div>
            <div class="text-muted small">
                <i class="bi bi-shield-check text-success me-1"></i> Data Profil Resmi Terverifikasi
            </div>
        </div>

        <div class="row">
            <!-- MAIN CONTENT (COL-LG-10 MX-AUTO) -->
            <div class="col-lg-10 mx-auto">
                <div class="p-4 p-md-5 bg-white rounded-4 shadow-sm border border-slate-200 position-relative overflow-hidden">
                    <div class="card-accent-bar accent-green"></div>
                    
                    @if(isset($profile) && !empty($profile->content))
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-1.5 rounded-pill font-monospace small fw-bold">
                                <i class="bi {{ $activeTab['icon'] ?? 'bi-building' }} me-1"></i> {{ $activeTab['title'] ?? 'Profil Instansi' }}
                            </span>
                            @auth
                                <a href="{{ url('/admin/profiles/' . $profile->id . '/edit') }}" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold" target="_blank">
                                    <i class="bi bi-pencil-square me-1"></i> Edit di Portal Admin
                                </a>
                            @endauth
                        </div>
                        <h2 class="fw-extrabold text-dark mb-4">{{ $profile->title }}</h2>

                        @if(!empty($profile->image))
                            <div class="mb-4 text-center">
                                <img src="{{ asset('storage/' . $profile->image) }}" alt="{{ $profile->title }}" class="img-fluid rounded-4 shadow-sm border" style="max-height: 480px; width: auto; object-fit: contain;">
                            </div>
                        @endif

                        <div class="profile-dynamic-content" style="line-height: 1.85; font-size: 1.05rem;">
                            {!! $profile->content !!}
                        </div>

                    {{-- 1. VISI MISI (FALLBACK) --}}
                    @elseif($currentSlug === 'visi-misi')
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-1.5 rounded-pill font-monospace small fw-bold">
                                <i class="bi bi-compass me-1"></i> Arah Kebijakan Strategis Daerah
                            </span>
                        </div>
                        <h2 class="fw-extrabold text-dark mb-4">Visi &amp; Misi DLH Kab. Probolinggo</h2>

                        <!-- Visi Card -->
                        <div class="p-4 p-md-5 rounded-4 mb-5 text-white position-relative overflow-hidden shadow-sm" style="background: linear-gradient(135deg, #064e3b 0%, #047857 100%);">
                            <div class="d-flex align-items-center gap-2 text-warning fw-bold mb-3">
                                <i class="bi bi-eye-fill fs-5"></i>
                                <span style="letter-spacing: 1.5px; font-size: 0.85rem;">VISI PEMERINTAH KABUPATEN PROBOLINGGO</span>
                            </div>
                            <blockquote class="mb-0 fs-4 fw-bold fst-italic" style="line-height: 1.6;">
                                "Mewujudkan Kabupaten Probolinggo yang Sejahtera, Berkeadilan, Mandiri, Berwawasan Lingkungan, dan Berdaya Saing Melalui Pembangunan Berkelanjutan."
                            </blockquote>
                        </div>

                        <!-- Misi Cards -->
                        <h4 class="fw-bold text-dark mb-3"><i class="bi bi-flag-fill text-success me-2"></i>Misi Lingkungan Hidup</h4>
                        <div class="d-flex flex-column gap-3">
                            <div class="p-3.5 p-md-4 rounded-3 border bg-light d-flex align-items-start gap-3 hover-lift transition-all">
                                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0 shadow-xs" style="width: 40px; height: 40px;">1</div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Peningkatan Kualitas Pengelolaan Sampah &amp; Kebersihan</h6>
                                    <p class="text-muted small mb-0" style="line-height: 1.65;">Mengembangkan sistem pengelolaan persampahan terpadu dari hulu ke hilir berbasis reduksi, guna ulang, daur ulang (3R) dan pemberdayaan bank sampah.</p>
                                </div>
                            </div>
                            <div class="p-3.5 p-md-4 rounded-3 border bg-light d-flex align-items-start gap-3 hover-lift transition-all">
                                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0 shadow-xs" style="width: 40px; height: 40px;">2</div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Pengendalian Pencemaran Air, Udara, dan Lahan</h6>
                                    <p class="text-muted small mb-0" style="line-height: 1.65;">Melakukan pengawasan dan pemantauan berkala baku mutu lingkungan hidup, perizinan lingkungan (AMDAL/UKL-UPL), serta penegakan hukum lingkungan terpadu.</p>
                                </div>
                            </div>
                            <div class="p-3.5 p-md-4 rounded-3 border bg-light d-flex align-items-start gap-3 hover-lift transition-all">
                                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0 shadow-xs" style="width: 40px; height: 40px;">3</div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Pengembangan Ruang Terbuka Hijau &amp; Keanekaragaman Hayati</h6>
                                    <p class="text-muted small mb-0" style="line-height: 1.65;">Memperluas proporsi Ruang Terbuka Hijau (RTH) publik dan menata pertamanan kota guna menciptakan iklim mikro yang sehat dan asri.</p>
                                </div>
                            </div>
                            <div class="p-3.5 p-md-4 rounded-3 border bg-light d-flex align-items-start gap-3 hover-lift transition-all">
                                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0 shadow-xs" style="width: 40px; height: 40px;">4</div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Pemberdayaan Masyarakat &amp; Transformasi Digital Layanan</h6>
                                    <p class="text-muted small mb-0" style="line-height: 1.65;">Meningkatkan kesadaran masyarakat melalui program Adiwiyata, Proklim, serta kemudahan pelaporan online masyarakat.</p>
                                </div>
                            </div>
                        </div>

                    {{-- 2. STRUKTUR ORGANISASI --}}
                    @elseif($currentSlug === 'struktur')
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-1.5 rounded-pill font-monospace small fw-bold">
                                <i class="bi bi-diagram-3 me-1"></i> Bagan Struktur Organisasi
                            </span>
                        </div>
                        <h2 class="fw-extrabold text-dark mb-3">Bagan Struktur Organisasi DLH</h2>
                        <p class="text-muted mb-4">Struktur organisasi Dinas Lingkungan Hidup Kabupaten Probolinggo berdasarkan Peraturan Bupati yang berlaku.</p>

                        <!-- Tree Hierarchy Representation -->
                        <div class="text-center mb-4">
                            <!-- Kepala Dinas -->
                            <div class="p-3.5 rounded-4 text-white d-inline-block shadow-sm mb-3 hover-lift transition-all" style="background: linear-gradient(135deg, #14532d, #166534); min-width: 300px;">
                                <div class="small text-warning fw-bold text-uppercase" style="letter-spacing: 1px;">Pimpinan Instansi</div>
                                <h5 class="fw-extrabold mb-0">Kepala Dinas Lingkungan Hidup</h5>
                            </div>
                            <div class="border-start border-3 border-success mx-auto" style="width: 0; height: 26px;"></div>
                            
                            <!-- Sekretariat -->
                            <div class="p-3 rounded-3 bg-light border d-inline-block shadow-xs mb-3 hover-lift transition-all" style="min-width: 260px;">
                                <div class="small text-success fw-bold">Sekretariat Dinas</div>
                                <div class="text-muted small">Subbag Umum, Kepegawaian, Perencanaan &amp; Keuangan</div>
                            </div>
                            <div class="border-start border-3 border-success mx-auto" style="width: 0; height: 26px;"></div>

                            <!-- Bidang-Bidang -->
                            <div class="row g-3 justify-content-center text-start mt-2">
                                <div class="col-md-4">
                                    <div class="p-3.5 rounded-3 border bg-light h-100 shadow-xs text-center hover-lift transition-all">
                                        <div class="rounded-circle bg-success bg-opacity-15 text-success d-flex align-items-center justify-content-center mx-auto mb-2.5" style="width: 46px; height: 46px;">
                                            <i class="bi bi-trash3-fill fs-5"></i>
                                        </div>
                                        <h6 class="fw-bold mb-1">Bidang Pengelolaan Sampah &amp; B3</h6>
                                        <p class="text-muted small mb-0" style="line-height: 1.5;">Penanganan persampahan, TPA Seboro, dan limbah bahan berbahaya beracun.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3.5 rounded-3 border bg-light h-100 shadow-xs text-center hover-lift transition-all">
                                        <div class="rounded-circle bg-success bg-opacity-15 text-success d-flex align-items-center justify-content-center mx-auto mb-2.5" style="width: 46px; height: 46px;">
                                            <i class="bi bi-moisture fs-5"></i>
                                        </div>
                                        <h6 class="fw-bold mb-1">Bidang Pengendalian Pencemaran</h6>
                                        <p class="text-muted small mb-0" style="line-height: 1.5;">Pemantauan baku mutu air, udara, AMDAL, dan pengawasan industri.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3.5 rounded-3 border bg-light h-100 shadow-xs text-center hover-lift transition-all">
                                        <div class="rounded-circle bg-success bg-opacity-15 text-success d-flex align-items-center justify-content-center mx-auto mb-2.5" style="width: 46px; height: 46px;">
                                            <i class="bi bi-tree-fill fs-5"></i>
                                        </div>
                                        <h6 class="fw-bold mb-1">Bidang Tata Lingkungan &amp; RTH</h6>
                                        <p class="text-muted small mb-0" style="line-height: 1.5;">Pengelolaan taman kota, keanekaragaman hayati, dan edukasi Adiwiyata.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    {{-- 3. TUPOKSI --}}
                    @elseif($currentSlug === 'tupoksi')
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-1.5 rounded-pill font-monospace small fw-bold">
                                <i class="bi bi-card-checklist me-1"></i> Landasan Regulasi
                            </span>
                        </div>
                        <h2 class="fw-extrabold text-dark mb-4">Tugas Pokok &amp; Fungsi (Tupoksi)</h2>

                        <div class="p-4 rounded-4 bg-light border mb-4">
                            <h5 class="fw-bold text-success mb-2"><i class="bi bi-flag-fill me-1.5"></i> Tugas Pokok:</h5>
                            <p class="text-muted mb-0" style="line-height: 1.8; font-size: 0.98rem;">
                                Dinas Lingkungan Hidup Kabupaten Probolinggo mempunyai tugas membantu Bupati dalam melaksanakan urusan pemerintahan yang menjadi kewenangan daerah dan tugas pembantuan di bidang lingkungan hidup, kebersihan, persampahan, dan ruang terbuka hijau.
                            </p>
                        </div>

                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-gear-fill text-success me-1.5"></i> Fungsi Utama DLH Kabupaten Probolinggo:</h5>
                        <ul class="list-group list-group-flush gap-2.5">
                            <li class="list-group-item px-0 border-0 d-flex align-items-start gap-3">
                                <i class="bi bi-check-circle-fill text-success mt-1 fs-5"></i>
                                <span style="line-height: 1.7;">Perumusan kebijakan teknis di bidang tata lingkungan, perlindungan, konservasi, dan pengelolaan lingkungan hidup daerah.</span>
                            </li>
                            <li class="list-group-item px-0 border-0 d-flex align-items-start gap-3">
                                <i class="bi bi-check-circle-fill text-success mt-1 fs-5"></i>
                                <span style="line-height: 1.7;">Pelaksanaan kebijakan pengelolaan persampahan, kebersihan lingkungan, dan pemanfaatan daur ulang bernilai ekonomis.</span>
                            </li>
                            <li class="list-group-item px-0 border-0 d-flex align-items-start gap-3">
                                <i class="bi bi-check-circle-fill text-success mt-1 fs-5"></i>
                                <span style="line-height: 1.7;">Pengendalian pencemaran, kerusakan lingkungan hidup, dan pengujian laboratorium baku mutu air serta udara ambien.</span>
                            </li>
                            <li class="list-group-item px-0 border-0 d-flex align-items-start gap-3">
                                <i class="bi bi-check-circle-fill text-success mt-1 fs-5"></i>
                                <span style="line-height: 1.7;">Pemeliharaan dan pengembangan Ruang Terbuka Hijau (RTH) publik serta pertamanan kota yang ramah lingkungan.</span>
                            </li>
                            <li class="list-group-item px-0 border-0 d-flex align-items-start gap-3">
                                <i class="bi bi-check-circle-fill text-success mt-1 fs-5"></i>
                                <span style="line-height: 1.7;">Penegakan hukum dan penyelesaian pengaduan masyarakat di bidang lingkungan hidup dan tata kebersihan.</span>
                            </li>
                        </ul>

                    {{-- 4. PEJABAT PENGELOLA --}}
                    @elseif($currentSlug === 'pejabat')
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-1.5 rounded-pill font-monospace small fw-bold">
                                <i class="bi bi-people-fill me-1"></i> Pejabat Struktural
                            </span>
                        </div>
                        <h2 class="fw-extrabold text-dark mb-4">Daftar Pejabat Pengelola DLH</h2>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 border bg-light text-center h-100 hover-lift transition-all">
                                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mx-auto mb-3 shadow-sm" style="width: 84px; height: 84px; font-size: 2.6rem;">
                                        <i class="bi bi-person-circle"></i>
                                    </div>
                                    <h5 class="fw-bold mb-1 text-dark">Kepala Dinas</h5>
                                    <div class="text-success fw-bold small mb-2">Dinas Lingkungan Hidup</div>
                                    <p class="text-muted small mb-0" style="line-height: 1.65;">Memimpin perumusan kebijakan dan penyelenggaraan urusan pemerintahan daerah di bidang lingkungan hidup dan kebersihan.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 border bg-light text-center h-100 hover-lift transition-all">
                                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mx-auto mb-3 shadow-sm" style="width: 84px; height: 84px; font-size: 2.6rem;">
                                        <i class="bi bi-person-circle"></i>
                                    </div>
                                    <h5 class="fw-bold mb-1 text-dark">Sekretaris Dinas</h5>
                                    <div class="text-success fw-bold small mb-2">Sekretariat DLH</div>
                                    <p class="text-muted small mb-0" style="line-height: 1.65;">Mengkoordinasikan perencanaan, kepegawaian, keuangan, perlengkapan, dan tata kelola administrasi dinas.</p>
                                </div>
                            </div>
                        </div>

                    {{-- 5. MAKLUMAT PELAYANAN --}}
                    @elseif($currentSlug === 'maklumat')
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-1.5 rounded-pill font-monospace small fw-bold">
                                <i class="bi bi-award-fill me-1"></i> Komitmen Pelayanan Publik
                            </span>
                        </div>
                        <h2 class="fw-extrabold text-dark mb-4">Maklumat Pelayanan DLH</h2>

                        <div class="p-4 p-md-5 rounded-4 text-center text-white position-relative overflow-hidden shadow-lg" style="background: linear-gradient(145deg, #052e16 0%, #14532d 50%, #064e3b 100%); border: 2px solid #fbbf24;">
                            <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px; font-size: 2.2rem;">
                                <i class="bi bi-award-fill"></i>
                            </div>
                            <h3 class="fw-extrabold text-warning mb-3" style="letter-spacing: 1.5px;">MAKLUMAT PELAYANAN</h3>
                            <p class="lead fst-italic mb-4" style="line-height: 1.85; max-width: 640px; margin: 0 auto; font-size: 1.15rem;">
                                "Dengan ini, kami pimpinan dan segenap pegawai Dinas Lingkungan Hidup Kabupaten Probolinggo menyatakan sanggup menyelenggarakan pelayanan publik sesuai standar pelayanan yang telah ditetapkan, dan apabila tidak menepati janji ini, kami siap menerima sanksi sesuai ketentuan peraturan perundang-undangan yang berlaku."
                            </p>
                            <div class="pt-3 border-top border-white border-opacity-25 d-inline-block">
                                <span class="fw-bold text-white fs-6">Dinas Lingkungan Hidup Kabupaten Probolinggo</span>
                            </div>
                        </div>

                    {{-- 6. SEJARAH / PROFIL UMUM (DEFAULT) --}}
                    @else
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-1.5 rounded-pill font-monospace small fw-bold">
                                <i class="bi bi-clock-history me-1"></i> Profil Instansi
                            </span>
                        </div>
                        <h2 class="fw-extrabold text-dark mb-4">Profil &amp; Sejarah Singkat DLH</h2>

                        <div class="lead text-dark mb-4" style="line-height: 1.85; font-size: 1.12rem;">
                            Dinas Lingkungan Hidup (DLH) Kabupaten Probolinggo merupakan unsur pelaksana urusan pemerintahan di bidang lingkungan hidup yang berkedudukan di bawah dan bertanggung jawab kepada Bupati melalui Sekretaris Daerah.
                        </div>

                        <p class="text-muted" style="line-height: 1.85;">
                            Kabupaten Probolinggo memiliki bentang alam yang kaya dan strategis, membentang dari wilayah pesisir utara pantai Jawa, kawasan agraris, perkotaan Kraksaan dan Dringu, hingga pegunungan Bromo Tengger Semeru. Dinas Lingkungan Hidup mengemban amanah besar menjaga kelestarian alam, mengelola sistem tata sampah terpadu, mengurangi pencemaran lingkungan, serta memperluas tutupan ruang terbuka hijau yang asri dan sehat.
                        </p>

                        <div class="row g-3 my-4">
                            <div class="col-md-4">
                                <div class="p-3.5 rounded-3 bg-light border text-center hover-lift transition-all">
                                    <div class="fw-extrabold text-success fs-3">24</div>
                                    <small class="text-muted">Kecamatan Terlayani</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3.5 rounded-3 bg-light border text-center hover-lift transition-all">
                                    <div class="fw-extrabold text-success fs-3">325+</div>
                                    <small class="text-muted">Desa &amp; Kelurahan</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3.5 rounded-3 bg-light border text-center hover-lift transition-all">
                                    <div class="fw-extrabold text-success fs-3">100%</div>
                                    <small class="text-muted">Komitmen Hijau</small>
                                </div>
                            </div>
                        </div>

                        <p class="text-muted mb-0" style="line-height: 1.85;">
                            Melalui perpaduan penegakan regulasi lingkungan, inovasi digital pelaporan (*SP4N LAPOR!* &amp; *Hallo Sae*), dan kolaborasi aktif dengan kader lingkungan masyarakat, DLH terus berikhtiar mewujudkan Kabupaten Probolinggo yang bersih, hijau, dan berkelanjutan.
                        </p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* SUBPAGE HERO STYLES */
    .subpage-header {
        background: linear-gradient(135deg, #021a10 0%, #064e3b 50%, #03271d 100%);
    }
    .subpage-header-bg {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1.5px, transparent 1.5px);
        background-size: 24px 24px;
        opacity: 0.4;
        pointer-events: none;
    }
    .subpage-header-orb {
        position: absolute;
        width: 380px;
        height: 380px;
        top: -120px;
        right: 10%;
        background: radial-gradient(circle, rgba(74, 222, 128, 0.28) 0%, transparent 70%);
        filter: blur(60px);
        pointer-events: none;
    }
    .subpage-header-orb-right {
        position: absolute;
        width: 320px;
        height: 320px;
        bottom: -100px;
        left: 5%;
        background: radial-gradient(circle, rgba(251, 191, 36, 0.18) 0%, transparent 70%);
        filter: blur(60px);
        pointer-events: none;
    }
    .subpage-pill-badge {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(12px);
        font-size: 0.8rem;
        font-weight: 700;
        color: #86efac;
    }
    .subpage-pulse-beacon {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #4ade80;
        box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.7);
        animation: pulseBeacon 2s infinite;
    }
    @keyframes pulseBeacon {
        0% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.7); }
        70% { box-shadow: 0 0 0 9px rgba(74, 222, 128, 0); }
        100% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0); }
    }
    .subpage-toolbar-glass {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(22, 163, 74, 0.18);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
    }
    .card-accent-bar {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3.5px;
        z-index: 3;
    }
    .card-accent-bar.accent-green {
        background: linear-gradient(90deg, #16a34a, #86efac);
    }
    .hover-lift {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .hover-lift:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 24px rgba(0,0,0,0.06);
    }
    .hover-white:hover {
        color: #fff !important;
    }
    .profile-dynamic-content img {
        max-width: 100%;
        height: auto;
        border-radius: 14px;
        margin: 14px 0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    .profile-dynamic-content table {
        width: 100%;
        margin: 16px 0;
        border-collapse: collapse;
    }
    .profile-dynamic-content table td, .profile-dynamic-content table th {
        padding: 10px 14px;
        border: 1px solid #e2e8f0;
    }
</style>
@endsection
