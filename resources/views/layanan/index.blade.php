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
                <li class="breadcrumb-item text-white-50">Layanan</li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $activeTab['title'] ?? 'Layanan Publik' }}</li>
            </ol>
        </nav>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill mb-3 subpage-pill-badge">
            <span class="subpage-pulse-beacon"></span>
            <i class="bi {{ $activeTab['icon'] ?? 'bi-grid-3x3-gap-fill' }} text-warning"></i>
            <span>Pelayanan Resmi Dinas Lingkungan Hidup Kab. Probolinggo</span>
        </div>
        <h1 class="fw-extrabold display-5 mb-2" style="font-weight: 800; letter-spacing: -0.5px;">
            {!! $activeTab['title'] ?? 'Layanan Publik Lingkungan Hidup' !!}
        </h1>
        <p class="text-white-75 mb-0" style="max-width: 720px; font-size: 1.02rem; line-height: 1.7;">
            {{ $activeTab['desc'] ?? 'Akses informasi resmi mengenai pengelolaan persampahan, pengujian laboratorium lingkungan, dan pusat pengaduan masyarakat.' }}
        </p>
    </div>
</section>

<!-- MAIN CONTENT -->
<div class="py-5" style="background: var(--slate50);">
    <div class="container">
        
        <!-- STATUS / INFO BAR (Glassmorphism Style) -->
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-5 p-3.5 rounded-4 subpage-toolbar-glass">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-success text-white px-3.5 py-2 rounded-pill fw-bold shadow-xs" style="font-size: 0.82rem;">
                    <i class="bi {{ $activeTab['icon'] ?? 'bi-check-circle-fill' }} me-1.5"></i>
                    {{ $activeTab['title'] ?? 'Layanan DLH' }}
                </span>
                <span class="text-muted small">
                    Pemerintah Kabupaten Probolinggo
                </span>
            </div>

            <div class="text-muted small">
                <i class="bi bi-clock-history me-1 text-success"></i> Jam Layanan: <strong>Senin - Jumat (07.30 - 15.30 WIB)</strong>
            </div>
        </div>

        {{-- 1. PERSAMPAHAN --}}
        @if($currentSlug === 'persampahan')
        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="p-4 p-md-5 bg-white rounded-4 shadow-sm border border-slate-200 position-relative overflow-hidden">
                    <div class="card-accent-bar accent-green"></div>
                    
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-1.5 rounded-pill font-monospace small fw-bold">
                            <i class="bi bi-recycle me-1"></i> {{ $currentService->tag ?? 'Bidang Pengelolaan Sampah & B3' }}
                        </span>
                        @auth
                            @if(isset($currentService))
                                <a href="{{ url('/admin/services/' . $currentService->id . '/edit') }}" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold" target="_blank">
                                    <i class="bi bi-pencil-square me-1"></i> Edit Layanan di Admin
                                </a>
                            @endif
                        @endauth
                    </div>
                    <h2 class="fw-extrabold text-dark mb-3">{{ $currentService->name ?? 'Layanan Pengelolaan Persampahan & Kebersihan' }}</h2>
                    @if(isset($currentService) && !empty($currentService->description))
                        <div class="service-dynamic-description mb-4" style="line-height: 1.85; font-size: 1rem;">
                            {!! $currentService->description !!}
                        </div>
                    @else
                        <p class="text-muted mb-4" style="line-height: 1.8; font-size: 0.98rem;">
                            DLH Kabupaten Probolinggo mengelola sistem persampahan terpadu dari pengangkutan sampah permukiman, pasar, instansi hingga pemrosesan akhir di TPA Seboro, serta pembinaan jaringan Bank Sampah aktif di seluruh kecamatan.
                        </p>
                    @endif

                    <!-- Feature Grid -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="p-3.5 rounded-3 bg-light border h-100 hover-lift transition-all">
                                <div class="d-flex align-items-center gap-2 mb-2 text-success fw-bold">
                                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.95rem;">
                                        <i class="bi bi-truck"></i>
                                    </div>
                                    <span>Armada Pengangkutan Rutin</span>
                                </div>
                                <p class="text-muted small mb-0" style="line-height: 1.6;">Armada truk sampah beroperasi melayani jalur protokol, perumahan, pasar tradisional, dan kawasan perkotaan di Kabupaten Probolinggo.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3.5 rounded-3 bg-light border h-100 hover-lift transition-all">
                                <div class="d-flex align-items-center gap-2 mb-2 text-success fw-bold">
                                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.95rem;">
                                        <i class="bi bi-recycle"></i>
                                    </div>
                                    <span>Program Bank Sampah</span>
                                </div>
                                <p class="text-muted small mb-0" style="line-height: 1.6;">Fasilitasi pembentukan Bank Sampah Unit di desa/kelurahan serta sekolah Adiwiyata untuk reduksi sampah bernilai ekonomi.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3.5 rounded-3 bg-light border h-100 hover-lift transition-all">
                                <div class="d-flex align-items-center gap-2 mb-2 text-success fw-bold">
                                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.95rem;">
                                        <i class="bi bi-pin-map-fill"></i>
                                    </div>
                                    <span>TPA Sampah Seboro</span>
                                </div>
                                <p class="text-muted small mb-0" style="line-height: 1.6;">Pemrosesan akhir sampah ramah lingkungan menggunakan metode controlled landfill dan pengolahan lindi berkala.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3.5 rounded-3 bg-light border h-100 hover-lift transition-all">
                                <div class="d-flex align-items-center gap-2 mb-2 text-success fw-bold">
                                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.95rem;">
                                        <i class="bi bi-box-seam-fill"></i>
                                    </div>
                                    <span>Penyediaan Kontainer Sampah</span>
                                </div>
                                <p class="text-muted small mb-0" style="line-height: 1.6;">Penempatan kontainer amrol di titik-titik TPS strategis perdesaan dan pusat keramaian masyarakat.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Alur Layanan -->
                    <h5 class="fw-bold text-dark mb-3 mt-4"><i class="bi bi-diagram-3-fill text-success me-2"></i>Alur Permohonan Layanan Pengangkutan:</h5>
                    <div class="p-3.5 rounded-3 bg-light border mb-4">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-start gap-3">
                                <span class="badge bg-success rounded-circle flex-shrink-0" style="width: 28px; height: 28px; line-height: 20px;">1</span>
                                <div class="text-muted small">Mengajukan surat permohonan layanan retribusi pengangkutan sampah kepada Kepala DLH Kab. Probolinggo.</div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <span class="badge bg-success rounded-circle flex-shrink-0" style="width: 28px; height: 28px; line-height: 20px;">2</span>
                                <div class="text-muted small">Petugas DLH melakukan survei lokasi dan menghitung estimasi volume timbulan sampah harian.</div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <span class="badge bg-success rounded-circle flex-shrink-0" style="width: 28px; height: 28px; line-height: 20px;">3</span>
                                <div class="text-muted small">Penetapan jadwal angkut dan penempatan titik kontainer / tong sampah terpadu.</div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <span class="badge bg-success rounded-circle flex-shrink-0" style="width: 28px; height: 28px; line-height: 20px;">4</span>
                                <div class="text-muted small">Pelaksanaan pengangkutan berkala oleh armada dinas menuju Tempat Pemrosesan Akhir (TPA).</div>
                            </div>
                        </div>
                    </div>

                    <!-- Callout WhatsApp -->
                    <div class="p-4 rounded-4 text-white d-flex align-items-center justify-content-between flex-wrap gap-3" style="background: linear-gradient(135deg, #052e16 0%, #166534 100%);">
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="subpage-pulse-beacon"></span>
                                <div class="fw-bold fs-6 text-white">Konsultasi Layanan Sampah &amp; Kebersihan</div>
                            </div>
                            <div class="text-white-75 small">Hubungi hotline kebersihan untuk pengangkutan sampah wilayah Anda.</div>
                        </div>
                        <a href="https://wa.me/628113431188?text=Halo%20DLH%20Kab%20Probolinggo,%20saya%20ingin%20konsultasi%20layanan%20pengangkutan%20sampah" target="_blank" class="btn btn-warning text-dark rounded-pill px-4 fw-bold shadow-sm">
                            <i class="bi bi-whatsapp me-1.5"></i> WhatsApp Petugas
                        </a>
                    </div>
                </div>
            </div>

            <!-- Side Cards -->
            <div class="col-lg-4">
                <div class="p-4 bg-white rounded-4 shadow-sm border border-slate-200 sticky-top" style="top: 100px;">
                    <div class="card-accent-bar accent-amber"></div>
                    
                    <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom">Statistik Persampahan</h5>
                    <div class="d-flex flex-column gap-3 mb-4">
                        <div class="p-3.5 rounded-3 bg-light border">
                            <div class="text-muted small">Volume Sampah Terkelola</div>
                            <div class="fw-extrabold fs-3 text-success">45.280+ Ton</div>
                            <small class="text-muted">Per tahun di Kab. Probolinggo</small>
                        </div>
                        <div class="p-3.5 rounded-3 bg-light border">
                            <div class="text-muted small">Bank Sampah Aktif</div>
                            <div class="fw-extrabold fs-3 text-success">45 Unit</div>
                            <small class="text-muted">Tersebar di 24 Kecamatan</small>
                        </div>
                    </div>
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-clock-history text-success me-1"></i> Jadwal Armada:</h6>
                    <p class="text-muted small mb-0" style="line-height: 1.7;">
                        Senin - Kamis : 07.30 - 15.30 WIB<br>
                        Jumat : 07.00 - 14.30 WIB<br>
                        Sabtu &amp; Minggu : Operasional Armada Piket
                    </p>
                </div>
            </div>
        </div>

        {{-- 2. LABORATORIUM LINGKUNGAN --}}
        @elseif($currentSlug === 'lab')
        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="p-4 p-md-5 bg-white rounded-4 shadow-sm border border-slate-200 position-relative overflow-hidden">
                    <div class="card-accent-bar accent-green"></div>

                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1.5 rounded-pill font-monospace small fw-bold">
                            <i class="bi bi-shield-check me-1"></i> {{ $currentService->tag ?? 'Laboratorium Terakreditasi' }}
                        </span>
                        @auth
                            @if(isset($currentService))
                                <a href="{{ url('/admin/services/' . $currentService->id . '/edit') }}" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold" target="_blank">
                                    <i class="bi bi-pencil-square me-1"></i> Edit Layanan di Admin
                                </a>
                            @endif
                        @endauth
                    </div>
                    <h2 class="fw-extrabold text-dark mb-3">{{ $currentService->name ?? 'Laboratorium Lingkungan Hidup DLH' }}</h2>
                    @if(isset($currentService) && !empty($currentService->description))
                        <div class="service-dynamic-description mb-4" style="line-height: 1.85; font-size: 1rem;">
                            {!! $currentService->description !!}
                        </div>
                    @else
                        <p class="text-muted mb-4" style="line-height: 1.8; font-size: 0.98rem;">
                            Unit Laboratorium Lingkungan DLH Kabupaten Probolinggo melayani pengambilan contoh uji dan analisis kimia/fisika laboratorium untuk air limbah, air sungai, air bersih, serta pemantauan kualitas udara ambien.
                        </p>
                    @endif

                    <h5 class="fw-bold text-dark mb-3">Layanan Pengujian yang Tersedia:</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="p-3.5 rounded-3 bg-light border h-100 hover-lift transition-all">
                                <div class="fw-bold text-dark mb-1"><i class="bi bi-droplet-half text-primary me-1.5 fs-5"></i> Uji Air Limbah Industri</div>
                                <p class="text-muted small mb-0" style="line-height: 1.6;">Pengujian parameter pH, BOD, COD, TSS, Minyak Lemak, Senyawa Logam Berat sesuai baku mutu limbah cair daerah.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3.5 rounded-3 bg-light border h-100 hover-lift transition-all">
                                <div class="fw-bold text-dark mb-1"><i class="bi bi-water text-info me-1.5 fs-5"></i> Uji Air Sungai &amp; Sumur</div>
                                <p class="text-muted small mb-0" style="line-height: 1.6;">Pengukuran baku mutu air kelas I-IV untuk pemantauan berkala badan air lingkungan hidup.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3.5 rounded-3 bg-light border h-100 hover-lift transition-all">
                                <div class="fw-bold text-dark mb-1"><i class="bi bi-wind text-success me-1.5 fs-5"></i> Kualitas Udara Ambien &amp; Emisi</div>
                                <p class="text-muted small mb-0" style="line-height: 1.6;">Pengukuran partikulat debu (PM2.5, PM10), SO2, NO2, CO, dan intensitas kebisingan area usaha.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3.5 rounded-3 bg-light border h-100 hover-lift transition-all">
                                <div class="fw-bold text-dark mb-1"><i class="bi bi-file-earmark-check text-warning me-1.5 fs-5"></i> Sertifikat Hasil Uji (SHU)</div>
                                <p class="text-muted small mb-0" style="line-height: 1.6;">Penerbitan Sertifikat Hasil Uji resmi yang sah untuk pelaporan dokumen lingkungan UKL-UPL dan SPPL.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Callout WhatsApp -->
                    <div class="p-4 rounded-4 text-white d-flex align-items-center justify-content-between flex-wrap gap-3" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="subpage-pulse-beacon"></span>
                                <div class="fw-bold fs-6 text-white">Konsultasi Uji Laboratorium Lingkungan</div>
                            </div>
                            <div class="text-white-75 small">Tanyakan parameter uji dan tata cara pengambilan sampel kepada analis lab.</div>
                        </div>
                        <a href="https://wa.me/628113431188?text=Halo%20Laboratorium%20DLH%20Kab%20Probolinggo,%20saya%20ingin%20konsultasi%20pengujian%20sampel" target="_blank" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                            <i class="bi bi-whatsapp me-1.5"></i> Hubungi Analis Lab
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="p-4 bg-white rounded-4 shadow-sm border border-slate-200 sticky-top" style="top: 100px;">
                    <div class="card-accent-bar accent-green"></div>
                    <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom">Informasi Sampel Uji</h5>
                    <p class="text-muted small mb-3" style="line-height: 1.7;">Sampel air dapat dibawa langsung atau meminta petugas lab DLH melakukan sampling lapangan (on-site) sesuai tarif retribusi daerah.</p>
                    <div class="alert alert-info py-2.5 small mb-3">
                        <i class="bi bi-info-circle me-1"></i> Wadah sampel harus bersih dan sesuai spesifikasi parameter uji.
                    </div>
                    <a href="{{ url('/dokumen/regulasi') }}" class="btn btn-outline-success w-100 rounded-pill fw-bold">
                        <i class="bi bi-file-earmark-ruled me-1.5"></i> Unduh SOP Laboratorium
                    </a>
                </div>
            </div>
        </div>

        {{-- 3. PENGADUAN MASYARAKAT --}}
        @elseif($currentSlug === 'pengaduan')
        <div class="row g-4 mb-4">
            <div class="col-lg-12">
                <div class="p-4 p-md-5 bg-white rounded-4 shadow-sm border border-slate-200 position-relative overflow-hidden">
                    <div class="card-accent-bar accent-amber"></div>

                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-1.5 rounded-pill font-monospace small fw-bold">
                            <i class="bi bi-megaphone-fill me-1"></i> {{ $currentService->tag ?? 'Saluran Resmi Aspirasi & Pengaduan' }}
                        </span>
                        @auth
                            @if(isset($currentService))
                                <a href="{{ url('/admin/services/' . $currentService->id . '/edit') }}" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold" target="_blank">
                                    <i class="bi bi-pencil-square me-1"></i> Edit Layanan di Admin
                                </a>
                            @endif
                        @endauth
                    </div>
                    <h2 class="fw-extrabold text-dark mb-2">{{ $currentService->name ?? 'Pusat Layanan Pengaduan Masyarakat DLH' }}</h2>
                    @if(isset($currentService) && !empty($currentService->description))
                        <div class="service-dynamic-description mb-4" style="line-height: 1.85; font-size: 1rem;">
                            {!! $currentService->description !!}
                        </div>
                    @else
                        <p class="text-muted mb-4" style="max-width: 750px; font-size: 1.02rem; line-height: 1.7;">
                            Masyarakat dapat melaporkan masalah pencemaran lingkungan hidup, tumpukan sampah liar, pembuangan limbah ilegal, atau pohon tumbang yang membahayakan secara mudah melalui dua kanal resmi:
                        </p>
                    @endif

                    <!-- DUA KANAL PENGADUAN UTAMA (HALLO SAE & SP4N LAPOR) -->
                    <div class="row g-4 mb-4">
                        <!-- 1. HALLO SAE -->
                        <div class="col-md-6">
                            <div class="p-4 rounded-4 text-white h-100 position-relative overflow-hidden shadow-sm" style="background: linear-gradient(135deg, #052e16 0%, #166534 100%); border: 2px solid #22c55e;">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="badge bg-success px-3 py-1.5 rounded-pill fw-bold">
                                        <i class="bi bi-lightning-charge-fill me-1 text-warning"></i> Respon Cepat WhatsApp
                                    </span>
                                    <i class="bi bi-whatsapp fs-1 text-success opacity-75"></i>
                                </div>
                                <h3 class="fw-extrabold text-white mb-2">Hallo Sae DLH</h3>
                                <p class="text-white-75 mb-3" style="line-height: 1.7; font-size: 0.95rem;">
                                    Layanan hotline pengaduan instan DLH Kab. Probolinggo via WhatsApp. Kirimkan foto, lokasi GPS, dan kronologi pencemaran untuk ditindaklanjuti tim piket lapangan.
                                </p>
                                <div class="p-3 rounded-3 mb-3" style="background: rgba(255,255,255,0.1); border: 1px dashed rgba(255,255,255,0.25);">
                                    <div class="small text-white-75">Nomor Kontak Resmi:</div>
                                    <div class="fw-bold fs-5 text-warning font-monospace">0811-3431-188</div>
                                </div>
                                <a href="https://wa.me/628113431188?text=Halo%20Admin%20Hallo%20Sae%20DLH,%20saya%20ingin%20melaporkan%20pengaduan%20lingkungan" target="_blank" class="btn btn-warning text-dark fw-bold rounded-pill px-4 py-2.5 w-100 shadow-sm">
                                    <i class="bi bi-whatsapp me-1.5"></i> Lapor via WhatsApp Hallo Sae
                                </a>
                            </div>
                        </div>

                        <!-- 2. SP4N LAPOR -->
                        <div class="col-md-6">
                            <div class="p-4 rounded-4 text-white h-100 position-relative overflow-hidden shadow-sm" style="background: linear-gradient(135deg, #7f1d1d 0%, #b91c1c 100%); border: 2px solid #ef4444;">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="badge bg-danger px-3 py-1.5 rounded-pill fw-bold">
                                        <i class="bi bi-shield-lock-fill me-1 text-warning"></i> Kanal Nasional Terpadu
                                    </span>
                                    <i class="bi bi-megaphone-fill fs-1 text-danger opacity-75"></i>
                                </div>
                                <h3 class="fw-extrabold text-white mb-2">SP4N LAPOR!</h3>
                                <p class="text-white-75 mb-3" style="line-height: 1.7; font-size: 0.95rem;">
                                    Sistem Pengelolaan Pengaduan Pelayanan Publik Nasional terintegrasi dengan KemenPAN-RB, Kantor Staf Presiden, dan Ombudsman RI untuk pengawasan akuntabel.
                                </p>
                                <div class="p-3 rounded-3 mb-3" style="background: rgba(255,255,255,0.1); border: 1px dashed rgba(255,255,255,0.25);">
                                    <div class="small text-white-75">Portal Resmi Nasional:</div>
                                    <div class="fw-bold fs-5 text-warning font-monospace">www.lapor.go.id</div>
                                </div>
                                <a href="https://www.lapor.go.id" target="_blank" class="btn btn-light text-danger fw-bold rounded-pill px-4 py-2.5 w-100 shadow-sm">
                                    <i class="bi bi-box-arrow-up-right me-1.5"></i> Masuk ke Portal SP4N LAPOR!
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- ALUR PENANGANAN PENGADUAN -->
                    <div class="p-4 rounded-4 bg-light border mt-4">
                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-diagram-3-fill text-success me-2"></i> Alur Penanganan Laporan Pengaduan</h5>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="p-3.5 bg-white rounded-3 border h-100 text-center hover-lift transition-all">
                                    <span class="badge bg-success rounded-circle mb-2" style="width: 32px; height: 32px; line-height: 24px;">1</span>
                                    <h6 class="fw-bold mb-1">Penerimaan Laporan</h6>
                                    <p class="text-muted small mb-0">Laporan diverifikasi kelengkapan bukti foto dan titik koordinat lokasi.</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3.5 bg-white rounded-3 border h-100 text-center hover-lift transition-all">
                                    <span class="badge bg-success rounded-circle mb-2" style="width: 32px; height: 32px; line-height: 24px;">2</span>
                                    <h6 class="fw-bold mb-1">Disposisi Bidang</h6>
                                    <p class="text-muted small mb-0">Diteruskan ke bidang teknis (Kebersihan, Lab, atau Pengendalian).</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3.5 bg-white rounded-3 border h-100 text-center hover-lift transition-all">
                                    <span class="badge bg-success rounded-circle mb-2" style="width: 32px; height: 32px; line-height: 24px;">3</span>
                                    <h6 class="fw-bold mb-1">Inspeksi Lapangan</h6>
                                    <p class="text-muted small mb-0">Tim reaksi cepat menuju lokasi untuk validasi dan penindakan fisik.</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3.5 bg-white rounded-3 border h-100 text-center hover-lift transition-all">
                                    <span class="badge bg-success rounded-circle mb-2" style="width: 32px; height: 32px; line-height: 24px;">4</span>
                                    <h6 class="fw-bold mb-1">Penyelesaian Selesai</h6>
                                    <p class="text-muted small mb-0">Pelapor menerima laporan status penanganan penuntasan pengaduan.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- 4. SEMUA LAYANAN (JIKA DIBUKA DARI /layanan) --}}
        @else
        <div class="row g-4">
            @forelse($services as $service)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 rounded-4 shadow-sm p-4 premium-service-card transition-all position-relative overflow-hidden" style="background: #fff;">
                    <div class="card-accent-bar accent-green"></div>
                    <div class="d-flex align-items-center justify-content-between mb-3 mt-1">
                        <div class="rounded-3 d-flex align-items-center justify-content-center text-success" style="width: 52px; height: 52px; background: rgba(22, 101, 52, 0.08); font-size: 1.6rem;">
                            <i class="bi {{ $service->icon ?: 'bi-star' }}"></i>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 font-monospace fw-semibold" style="font-size: 0.75rem;">
                            {{ $service->tag ?: 'Layanan' }}
                        </span>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">{!! $service->name !!}</h5>
                    <p class="text-muted small mb-4" style="line-height: 1.7; flex: 1;">
                        {{ $service->description ?: 'Layanan resmi Dinas Lingkungan Hidup Kabupaten Probolinggo untuk masyarakat dan pelaku usaha.' }}
                    </p>
                    <div class="pt-3 border-top d-flex align-items-center justify-content-between">
                        <span class="text-muted small"><i class="bi bi-shield-check text-success me-1"></i> Resmi DLH</span>
                        @if(str_contains(strtolower($service->name), 'sampah'))
                            <a href="{{ url('/layanan/persampahan') }}" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold">Detail Layanan <i class="bi bi-arrow-right"></i></a>
                        @elseif(str_contains(strtolower($service->name), 'lapor') || str_contains(strtolower($service->name), 'pengaduan'))
                            <a href="{{ url('/layanan/pengaduan') }}" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold">Lapor Sekarang <i class="bi bi-arrow-right"></i></a>
                        @else
                            <a href="{{ url('/kontak') }}" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold">Konsultasi <i class="bi bi-arrow-right"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Data layanan belum tersedia.</p>
            </div>
            @endforelse
        </div>
        @endif

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
    .card-accent-bar.accent-amber {
        background: linear-gradient(90deg, #d97706, #fbbf24);
    }
    .hover-lift {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .hover-lift:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 24px rgba(0,0,0,0.06);
    }
    .premium-service-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(22, 101, 52, 0.1) !important;
        border-color: rgba(22, 163, 74, 0.3) !important;
    }
    .hover-white:hover {
        color: #fff !important;
    }
    .service-dynamic-description img {
        max-width: 100%;
        height: auto;
        border-radius: 14px;
        margin: 14px 0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    .service-dynamic-description table {
        width: 100%;
        margin: 16px 0;
        border-collapse: collapse;
    }
    .service-dynamic-description table td, .service-dynamic-description table th {
        padding: 10px 14px;
        border: 1px solid #e2e8f0;
    }
</style>
@endsection
