@extends('layouts.public')

@section('content')
@php
    $siteSetting = $siteSetting ?? (\App\Models\Setting::first() ?? new \App\Models\Setting());
    $phone = $siteSetting->phone ?: '(0335) 421234';
    $email = $siteSetting->email ?: 'dlh@probolinggokab.go.id';
    $address = $siteSetting->address ?: 'Jl. Raya Dringu No. 81, Probolinggo, Jawa Timur 67271';
    $workingHours = $siteSetting->working_hours ?: 'Senin - Jumat: 07.30 - 16.00 WIB';
@endphp

<!-- PAGE HEADER -->
<section class="contact-page-header py-4 text-white position-relative overflow-hidden">
    <div class="contact-header-bg"></div>
    <div class="contact-header-orb"></div>
    <div class="container position-relative py-2" style="z-index: 2;">
        <nav aria-label="breadcrumb" class="mb-2">
            <ol class="breadcrumb mb-0" style="font-size: 0.82rem;">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none hover-white"><i class="bi bi-house-door-fill me-1"></i> Beranda</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Hubungi Kami</li>
            </ol>
        </nav>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2 contact-pill-badge">
            <span class="pulse-beacon"></span>
            <i class="bi bi-headset"></i>
            <span>Pusat Layanan Informasi & Pengaduan Resmi DLH</span>
        </div>
        <h1 class="fw-extrabold display-6 mb-1" style="font-weight: 800; letter-spacing: -0.5px;">
            Hubungi Kami & Layanan <span class="header-highlight">Pengaduan</span>
        </h1>
        <p class="text-white-50 mb-0" style="max-width: 680px; font-size: 0.98rem; line-height: 1.6;">
            Dinas Lingkungan Hidup Kabupaten Probolinggo siap melayani informasi publik, konsultasi lingkungan, serta menindaklanjuti pengaduan masyarakat secara responsif.
        </p>
    </div>
</section>

<!-- SECTION: PENGADUAN SHOWCASE BANNER (SP4N LAPOR & HALLO SAE) -->
<section class="py-5" style="background: #04130b; position: relative;">
    <div class="hub-ambient-glow-left"></div>
    <div class="hub-ambient-glow-right"></div>
    
    <div class="container position-relative" style="z-index: 2;">
        <div class="command-hub-card position-relative overflow-hidden">
            <!-- Shimmer Top Accent -->
            <div class="hub-top-shimmer"></div>
            <div class="hub-mesh-pattern"></div>

            <div class="row align-items-center g-4 g-lg-5 position-relative" style="z-index: 2;">
                <!-- Left Side: Headline & Description -->
                <div class="col-lg-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-shield-check text-warning fs-5"></i>
                        <span class="text-warning fw-bold" style="font-size:.82rem;letter-spacing:1.2px;text-transform:uppercase;">LAYANAN PENGADUAN RESMI</span>
                    </div>

                    <h2 class="hub-heading text-white fw-extrabold mb-3">
                        Laporkan Masalah Lingkungan &amp; Aspirasi <span class="text-gradient-amber">Masyarakat</span>
                    </h2>

                    <p class="hub-desc text-white-75 mb-4">
                        Laporkan penumpukan sampah liar, dahan pohon rawan tumbang, pencemaran lingkungan, atau aspirasi tata kota hijau melalui kanal resmi kami. Tim kami siap merespons dengan cepat.
                    </p>

                    <!-- Feature Badges -->
                    <div class="d-flex flex-wrap gap-2 pt-1">
                        <span class="badge bg-white bg-opacity-10 text-white border border-white border-opacity-15 px-3 py-2 rounded-pill fw-medium" style="font-size: 0.8rem;">
                            <i class="bi bi-lightning-charge-fill text-warning me-1.5"></i> Respon Cepat Lapangan
                        </span>
                        <span class="badge bg-white bg-opacity-10 text-white border border-white border-opacity-15 px-3 py-2 rounded-pill fw-medium" style="font-size: 0.8rem;">
                            <i class="bi bi-shield-lock-fill text-success me-1.5"></i> Kerahasiaan Terjamin
                        </span>
                        <span class="badge bg-white bg-opacity-10 text-white border border-white border-opacity-15 px-3 py-2 rounded-pill fw-medium" style="font-size: 0.8rem;">
                            <i class="bi bi-geo-alt-fill text-info me-1.5"></i> Kirim GPS &amp; Foto Bukti
                        </span>
                    </div>
                </div>

                <!-- Right Side: 2 Clean, Bold, Spacious Action Cards -->
                <div class="col-lg-6">
                    <div class="d-flex flex-column gap-3">
                        
                        <!-- BUTTON 1: SP4N LAPOR! -->
                        <a href="https://www.lapor.go.id/" target="_blank" class="contact-action-btn btn-sp4n">
                            <div class="action-btn-shimmer"></div>
                            <div class="action-btn-icon icon-sp4n">
                                <i class="bi bi-megaphone-fill"></i>
                            </div>
                            <div class="action-btn-content">
                                <div class="action-btn-title">SP4N LAPOR!</div>
                                <div class="action-btn-sub">Portal Pengaduan Resmi RI &bull; Terintegrasi Nasional</div>
                            </div>
                            <div class="action-btn-arrow">
                                <i class="bi bi-arrow-right fs-4"></i>
                            </div>
                        </a>

                        <!-- BUTTON 2: HALLO SAE -->
                        <a href="https://wa.me/6282131001001?text=Halo%20Sae%2C%20saya%20ingin%20menyampaikan%20laporan%20pengaduan%20kepada%20Dinas%20Lingkungan%20Hidup%20Kabupaten%20Probolinggo." target="_blank" class="contact-action-btn btn-sae">
                            <div class="action-btn-shimmer"></div>
                            <div class="action-btn-icon icon-sae">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <div class="action-btn-content">
                                <div class="action-btn-title">HALLO SAE (WHATSAPP)</div>
                                <div class="action-btn-sub">Hotline Reaksi Cepat DLH &bull; Chat 0821-3100-1001</div>
                            </div>
                            <div class="action-btn-arrow">
                                <i class="bi bi-arrow-right fs-4"></i>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MAIN CONTENT WRAPPER -->
<div class="contact-main-wrapper py-5" style="background: var(--slate50);">
    <div class="container">

        <!-- SECTION: OFFICE CONTACT DETAILS -->
        <section class="mb-5">
            <div class="text-center mb-4">
                <span class="section-badge-pill mb-2">
                    <i class="bi bi-building me-1"></i> INFORMASI KANTOR
                </span>
                <h3 class="fw-bold text-dark mb-1">Kontak & Alamat Kedinasan</h3>
                <p class="text-muted small mb-0">Kunjungi atau hubungi kantor Dinas Lingkungan Hidup Kab. Probolinggo</p>
            </div>

            <div class="row g-4">
                <!-- Alamat Kantor -->
                <div class="col-md-6 col-lg-3">
                    <div class="contact-info-card h-100 p-4 rounded-4 shadow-sm bg-white">
                        <div class="contact-card-icon-wrap icon-green mb-3">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-2 text-dark fs-6">Alamat Kantor</h5>
                        <p class="text-muted small mb-3" style="line-height: 1.6;">
                            {{ $address }}
                        </p>
                        <a href="https://maps.google.com/?q={{ urlencode('Dinas Lingkungan Hidup Kabupaten Probolinggo ' . $address) }}" target="_blank" class="card-action-link">
                            Petunjuk Arah <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Telepon -->
                <div class="col-md-6 col-lg-3">
                    <div class="contact-info-card h-100 p-4 rounded-4 shadow-sm bg-white">
                        <div class="contact-card-icon-wrap icon-blue mb-3">
                            <i class="bi bi-telephone-inbound-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-2 text-dark fs-6">Telepon Kantor</h5>
                        <p class="text-muted small mb-3" style="line-height: 1.6;">
                            Saluran telepon kantor jam kerja:
                            <span class="d-block fw-bold text-dark fs-6 mt-1">{{ $phone }}</span>
                        </p>
                        <a href="tel:{{ preg_replace('/[^0-9]/', '', $phone) }}" class="card-action-link">
                            Telepon Sekarang <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Email Resmi -->
                <div class="col-md-6 col-lg-3">
                    <div class="contact-info-card h-100 p-4 rounded-4 shadow-sm bg-white">
                        <div class="contact-card-icon-wrap icon-purple mb-3">
                            <i class="bi bi-envelope-at-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-2 text-dark fs-6">Surat & Email</h5>
                        <p class="text-muted small mb-3" style="line-height: 1.6;">
                            Persuratan kedinasan & narasumber:
                            <span class="d-block fw-bold text-dark fs-6 mt-1 text-break">{{ $email }}</span>
                        </p>
                        <a href="mailto:{{ $email }}" class="card-action-link">
                            Kirim Email <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Jam Kerja -->
                <div class="col-md-6 col-lg-3">
                    <div class="contact-info-card h-100 p-4 rounded-4 shadow-sm bg-white">
                        <div class="contact-card-icon-wrap icon-amber mb-3">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <h5 class="fw-bold mb-2 text-dark fs-6">Jam Layanan</h5>
                        <p class="text-muted small mb-3" style="line-height: 1.6;">
                            <strong class="text-dark d-block mb-1">Jam Operasional:</strong>
                            {{ $workingHours }}
                            <span class="d-block text-danger mt-1" style="font-size: 0.75rem;">
                                *Sabtu, Minggu & Libur Nasional Tutup
                            </span>
                        </p>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 small fw-semibold">
                            <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i> Layanan Tersedia
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION: PETA LOKASI KANTOR -->
        <section class="mb-3">
            <div class="map-container-card p-4 rounded-4 shadow-sm bg-white">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="bi bi-geo-alt-fill text-success"></i>
                            <span class="text-success fw-bold text-uppercase small" style="letter-spacing: 1px;">Lokasi Kantor DLH</span>
                        </div>
                        <h4 class="fw-bold mb-0 text-dark">Peta Kantor Dinas Lingkungan Hidup Kab. Probolinggo</h4>
                        <p class="text-muted small mb-0 mt-0.5">{{ $address }}</p>
                    </div>
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode('Dinas Lingkungan Hidup Kabupaten Probolinggo ' . $address) }}" 
                       target="_blank" 
                       class="btn btn-outline-success rounded-pill px-4 py-2 fw-bold d-inline-flex align-items-center gap-2 flex-shrink-0">
                        <i class="bi bi-map-fill"></i>
                        <span>Buka Peta Google Maps</span>
                    </a>
                </div>

                <div class="map-embed-wrapper rounded-4 overflow-hidden position-relative">
                    <iframe 
                        src="https://maps.google.com/maps?q={{ urlencode('Dinas Lingkungan Hidup Kabupaten Probolinggo') }}&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                        width="100%" 
                        height="340" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </section>

    </div>
</div>

<!-- BESPOKE STYLES FOR HUBUNGI KAMI PAGE -->
<style>
    /* PAGE HEADER */
    .contact-page-header {
        background: linear-gradient(135deg, #021a0f 0%, #064027 50%, #02140a 100%);
        position: relative;
    }
    .contact-header-bg {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
        background-size: 24px 24px;
        opacity: 0.45;
        pointer-events: none;
    }
    .contact-header-orb {
        position: absolute;
        top: -30%;
        right: -10%;
        width: 480px;
        height: 480px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(34, 197, 94, 0.2) 0%, transparent 70%);
        filter: blur(50px);
        pointer-events: none;
    }
    .contact-pill-badge {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: #86efac;
    }
    .pulse-beacon {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #22c55e;
        box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
        animation: pulseAnimation 2s infinite;
        display: inline-block;
    }
    @keyframes pulseAnimation {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(34, 197, 94, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
    }
    .header-highlight {
        background: linear-gradient(90deg, #4ade80, #fcd34d);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* COMMAND HUB CARD */
    .command-hub-card {
        background: linear-gradient(150deg, #091f15 0%, #0d2c1f 40%, #05160e 100%);
        border: 1px solid rgba(74, 222, 128, 0.25);
        border-radius: 28px;
        padding: 50px 48px;
        box-shadow: 
            0 25px 50px -12px rgba(0, 0, 0, 0.6),
            0 0 0 1px rgba(74, 222, 128, 0.12),
            inset 0 1px 0 rgba(255, 255, 255, 0.14);
        position: relative;
    }
    .hub-top-shimmer {
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent 0%, #34d399 30%, #fbbf24 70%, transparent 100%);
    }
    .hub-mesh-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.035) 1px, transparent 1px);
        background-size: 20px 20px;
        pointer-events: none;
    }
    .hub-ambient-glow-left {
        position: absolute;
        top: 10%; left: -5%;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%);
        filter: blur(60px);
        pointer-events: none;
    }
    .hub-ambient-glow-right {
        position: absolute;
        bottom: 10%; right: -5%;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(244, 63, 94, 0.12) 0%, transparent 70%);
        filter: blur(60px);
        pointer-events: none;
    }

    .hub-heading {
        font-size: clamp(1.7rem, 3.1vw, 2.25rem);
        line-height: 1.32;
        letter-spacing: -0.4px;
    }
    .text-gradient-amber {
        color: #fbbf24;
    }
    .hub-desc {
        font-size: 0.96rem;
        line-height: 1.75;
        max-width: 520px;
    }
    .text-white-75 {
        color: rgba(255, 255, 255, 0.75);
    }

    /* BOLD LUXURY ACTION BUTTONS */
    .contact-action-btn {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 22px 26px;
        border-radius: 22px;
        text-decoration: none;
        position: relative;
        overflow: hidden;
        z-index: 1;
        transition: all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .action-btn-shimmer {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
        transform: translateX(-100%);
        transition: transform 0.6s ease;
        z-index: -1;
    }
    .contact-action-btn:hover .action-btn-shimmer {
        transform: translateX(100%);
    }

    /* BUTTON 1: SP4N LAPOR */
    .btn-sp4n {
        background: linear-gradient(135deg, #881318 0%, #4a090e 100%);
        border: 1px solid rgba(248, 113, 113, 0.4);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 10px 28px rgba(136, 19, 24, 0.4);
        color: #fff;
    }
    .btn-sp4n:hover {
        transform: translateY(-4px) scale(1.01);
        border-color: rgba(248, 113, 113, 0.65);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3), 0 18px 40px rgba(185, 28, 28, 0.5);
        color: #fff;
    }
    .icon-sp4n {
        background: rgba(255, 255, 255, 0.18);
        color: #ffffff;
        box-shadow: inset 0 2px 10px rgba(255, 255, 255, 0.15);
    }

    /* BUTTON 2: HALLO SAE */
    .btn-sae {
        background: linear-gradient(135deg, #06533c 0%, #032b1f 100%);
        border: 1px solid rgba(52, 211, 153, 0.4);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 10px 28px rgba(6, 83, 60, 0.4);
        color: #fff;
    }
    .btn-sae:hover {
        transform: translateY(-4px) scale(1.01);
        border-color: rgba(52, 211, 153, 0.65);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3), 0 18px 40px rgba(16, 185, 129, 0.5);
        color: #fff;
    }
    .icon-sae {
        background: rgba(255, 255, 255, 0.18);
        color: #ffffff;
        box-shadow: inset 0 2px 10px rgba(255, 255, 255, 0.15);
    }

    /* ACTION BUTTON SHARED COMPONENTS */
    .action-btn-icon {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        flex-shrink: 0;
        transition: transform 0.35s ease;
    }
    .contact-action-btn:hover .action-btn-icon {
        transform: scale(1.12) rotate(6deg);
    }
    .action-btn-content {
        flex: 1;
        min-width: 0;
    }
    .action-btn-title {
        font-size: 1.18rem;
        font-weight: 800;
        letter-spacing: 0.4px;
        line-height: 1.25;
        color: #ffffff;
    }
    .action-btn-sub {
        font-size: 0.84rem;
        color: rgba(255, 255, 255, 0.85);
        margin-top: 3px;
        line-height: 1.4;
    }
    .action-btn-arrow {
        color: rgba(255, 255, 255, 0.85);
        flex-shrink: 0;
        transition: transform 0.3s ease, color 0.3s ease;
    }
    .contact-action-btn:hover .action-btn-arrow {
        transform: translateX(6px);
        color: #ffffff;
    }

    /* SECTION BADGE PILL */
    .section-badge-pill {
        display: inline-flex;
        align-items: center;
        background: rgba(22, 163, 74, 0.1);
        border: 1px solid rgba(22, 163, 74, 0.22);
        color: var(--g800);
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 1px;
        padding: 4px 14px;
        border-radius: 9999px;
    }

    /* INFO CARDS */
    .contact-info-card {
        border: 1px solid rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
    }
    .contact-info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.07) !important;
        border-color: rgba(22, 163, 74, 0.3);
    }
    .contact-card-icon-wrap {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
    }
    .icon-green { background: #dcfce7; color: #16a34a; }
    .icon-blue { background: #e0f2fe; color: #0284c7; }
    .icon-purple { background: #f3e8ff; color: #9333ea; }
    .icon-amber { background: #fef3c7; color: #d97706; }

    .card-action-link {
        color: var(--g700);
        font-weight: 700;
        font-size: 0.82rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: gap 0.2s;
    }
    .card-action-link:hover {
        color: var(--g600);
        gap: 8px;
    }

    /* MAP CARD */
    .map-container-card {
        border: 1px solid rgba(0, 0, 0, 0.06);
    }
    .map-embed-wrapper {
        border: 1px solid rgba(0, 0, 0, 0.08);
        border-radius: 14px;
    }
    .map-embed-wrapper iframe {
        display: block;
    }
</style>
@endsection
