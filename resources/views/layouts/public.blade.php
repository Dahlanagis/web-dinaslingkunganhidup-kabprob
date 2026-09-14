@php
    $siteSetting = \App\Models\Setting::first() ?? new \App\Models\Setting();
    $primaryColor = $siteSetting->primary_color ?: '#16a34a';
    $secondaryColor = $siteSetting->secondary_color ?: '#052e16';
    $accentColor = $siteSetting->accent_color ?: '#fbbf24';
    $siteName = $siteSetting->site_name ?: 'Dinas Lingkungan Hidup';
    $siteShortName = $siteSetting->site_short_name ?: 'Kab. Probolinggo';
    $siteTagline = $siteSetting->site_tagline ?: 'Mewujudkan Kabupaten Probolinggo yang Bersih, Hijau, dan Berkelanjutan';
    $runningText = $siteSetting->running_text ?: 'Selamat Datang di Website Resmi Dinas Lingkungan Hidup (DLH) Kabupaten Probolinggo. Mari wujudkan lingkungan hidup yang bersih, hijau, dan lestari.';
    $heroTitle = $siteSetting->hero_title ?: 'DLH Kab. Probolinggo';
    $heroDesc = $siteSetting->hero_description ?: 'Dinas Lingkungan Hidup Kabupaten Probolinggo hadir untuk menjaga kelestarian alam, mengelola tata ruang hijau, dan menangani kebersihan secara profesional.';
    $logoUrl = $siteSetting->logo_path ? asset('storage/' . $siteSetting->logo_path) : asset('storage/settings/01M1MHT13FMWTSSC5JFSMJ4JY0.png');
    $faviconUrl = $siteSetting->favicon_path ? asset('storage/' . $siteSetting->favicon_path) : $logoUrl;
    $phone = $siteSetting->phone ?: '(0335) 421234';
    $email = $siteSetting->email ?: 'dlh@probolinggokab.go.id';
    $address = $siteSetting->address ?: 'Jl. Panglima Sudirman No.123, Kraksaan, Kabupaten Probolinggo';
    $workingHours = $siteSetting->working_hours ?: 'Senin - Jumat: 07.30 - 16.00 WIB';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteName }} — {{ $siteShortName }}</title>
    <meta name="description" content="{{ $siteTagline }}">
    @if($faviconUrl)
        <link rel="icon" type="image/x-icon" href="{{ $faviconUrl }}">
        <link rel="shortcut icon" href="{{ $faviconUrl }}">
        <link rel="apple-touch-icon" href="{{ $faviconUrl }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --g950:#052e16; --g900:#14532d; --g800:#166534; --g700:#15803d;
            --g600:#16a34a; --g500:#22c55e; --g400:#4ade80;
            --amber:#fbbf24; --amber-light:#fcd34d;
            --slate50:#f8fafc; --slate100:#f1f5f9; --slate200:#e2e8f0;
            --slate700:#334155; --slate800:#1e293b;
            --primary: {{ $primaryColor }};
            --accent: {{ $accentColor }};
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            background: var(--slate50);
            color: var(--slate800);
            overflow-x: hidden;
        }

        /* TOPBAR */
        .topbar {
            background: var(--g950);
            color: rgba(255,255,255,.6);
            font-size: .78rem;
            padding: 7px 0;
        }
        .topbar a { color: rgba(255,255,255,.6); text-decoration: none; transition: color .2s; }
        .topbar a:hover { color: var(--amber); }

        /* NAVBAR */
        .navbar-main {
            background: rgba(255,255,255,.95);
            backdrop-filter: blur(24px) saturate(200%);
            -webkit-backdrop-filter: blur(24px) saturate(200%);
            border-bottom: 1px solid rgba(22,163,74,.12);
            box-shadow: 0 1px 0 rgba(22,163,74,.08), 0 4px 24px rgba(0,0,0,.06);
            transition: all .35s ease;
            padding: 8px 0;
        }
        .navbar-main.scrolled {
            padding: 5px 0;
            background: rgba(255,255,255,.98);
            box-shadow: 0 0 0 1px rgba(22,163,74,.12), 0 8px 32px rgba(0,0,0,.1);
        }

        /* Brand Logo */
        .brand-logo-wrap {
            display: flex; align-items: center; gap: 14px;
            text-decoration: none;
        }
        .brand-logo-box {
            position: relative;
            width: 54px; height: 54px;
            border-radius: 14px;
            overflow: hidden;
            background: #ffffff;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            transition: transform .35s cubic-bezier(.34,1.56,.64,1), box-shadow .3s ease;
            /* Double ring: inner white + outer green glow */
            box-shadow:
                0 0 0 2px #ffffff,
                0 0 0 4px var(--g600),
                0 6px 18px rgba(21,128,61,.3);
        }
        /* Shine overlay on hover */
        .brand-logo-box::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,.55) 0%, transparent 55%);
            opacity: 0;
            transition: opacity .3s ease;
            pointer-events: none;
            border-radius: 14px;
        }
        .brand-logo-wrap:hover .brand-logo-box {
            transform: scale(1.08) rotate(-4deg);
            box-shadow:
                0 0 0 2px #ffffff,
                0 0 0 4px var(--g500),
                0 10px 28px rgba(21,128,61,.45);
        }
        .brand-logo-wrap:hover .brand-logo-box::after { opacity: 1; }
        .brand-logo-box img { width: 92%; height: 92%; object-fit: contain; border-radius: 10px; }
        .brand-logo-box .bi { font-size: 1.5rem; color: var(--g700); }
        .brand-text { display: flex; flex-direction: column; justify-content: center; }
        .brand-name {
            font-size: .98rem; font-weight: 800;
            color: var(--g900); line-height: 1.2;
            letter-spacing: -.3px;
        }
        .brand-divider {
            display: block; width: 100%; height: 2px;
            background: linear-gradient(90deg, var(--g500), var(--g400), transparent);
            margin: 3px 0;
            border-radius: 2px;
        }
        .brand-sub {
            font-size: .66rem; font-weight: 700;
            color: var(--g600); letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Footer variant of brand logo */
        .brand-logo-wrap.brand-footer .brand-name {
            color: #ffffff;
            font-size: 1.05rem;
        }
        .brand-logo-wrap.brand-footer .brand-sub {
            color: #4ade80;
            font-size: .72rem;
            letter-spacing: 1.2px;
        }
        .brand-logo-wrap.brand-footer .brand-divider {
            background: linear-gradient(90deg, #4ade80, #22c55e, transparent);
        }
        .brand-logo-wrap.brand-footer .brand-logo-box {
            box-shadow:
                0 0 0 2px #ffffff,
                0 0 0 4px var(--g500),
                0 8px 24px rgba(0,0,0,.35);
        }
        .brand-logo-wrap.brand-footer:hover .brand-logo-box {
            box-shadow:
                0 0 0 2px #ffffff,
                0 0 0 4px #4ade80,
                0 12px 30px rgba(74,222,128,.4);
        }

        /* Nav Links */
        .nav-pill {
            font-weight: 700; font-size: .82rem;
            color: var(--slate700) !important;
            padding: 7px 13px !important;
            border-radius: 8px; transition: all .22s ease;
            position: relative; letter-spacing: .15px;
            white-space: nowrap;
        }
        .nav-pill:hover { color: var(--g700) !important; background: rgba(22,163,74,.08); }
        .nav-pill.active {
            color: var(--g700) !important;
            background: rgba(22,163,74,.1);
        }
        /* Active underline indicator */
        .nav-pill.active::after {
            content: '';
            position: absolute; bottom: 2px; left: 50%; transform: translateX(-50%);
            width: 16px; height: 2px;
            background: var(--g600); border-radius: 2px;
        }

        /* Navbar CTA Button */
        .nav-cta {
            display: inline-flex; align-items: center; gap: 7px;
            background: linear-gradient(135deg, var(--g600), var(--g700));
            color: #fff !important; font-weight: 700; font-size: .82rem;
            padding: 8px 18px !important; border-radius: 10px;
            text-decoration: none; transition: all .25s;
            box-shadow: 0 3px 12px rgba(22,163,74,.35);
            white-space: nowrap;
        }
        .nav-cta:hover {
            background: linear-gradient(135deg, var(--g500), var(--g600));
            box-shadow: 0 5px 18px rgba(22,163,74,.5);
            transform: translateY(-1px);
            color: #fff !important;
        }

        /* Dropdown Submenu Scrollable & Premium Styling */
        .dropdown-menu-dlh {
            border: 1px solid rgba(0,0,0,0.08); 
            border-radius: 14px;
            box-shadow: 0 12px 32px -4px rgba(0,0,0,0.14), 0 4px 12px -2px rgba(0,0,0,0.06);
            padding: 8px 6px; 
            min-width: 250px;
            max-height: 280px;
            overflow-y: auto;
            overflow-x: hidden;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            overscroll-behavior: contain;
            scrollbar-width: thin;
            scrollbar-color: rgba(148, 163, 184, 0.45) transparent;
            animation: popIn .2s cubic-bezier(0.16, 1, 0.3, 1);
            background: #ffffff;
            margin-top: 8px;
        }
        .dropdown-menu-dlh::-webkit-scrollbar {
            width: 5px;
        }
        .dropdown-menu-dlh::-webkit-scrollbar-track {
            background: transparent;
            margin: 6px 0;
            border-radius: 10px;
        }
        .dropdown-menu-dlh::-webkit-scrollbar-thumb {
            background: rgba(148, 163, 184, 0.4);
            border-radius: 10px;
            transition: background 0.2s ease;
        }
        .dropdown-menu-dlh::-webkit-scrollbar-thumb:hover {
            background: #16a34a;
        }
        .dropdown-item-dlh {
            font-size: 0.95rem; 
            font-weight: 500; 
            padding: 10px 16px;
            border-radius: 8px; 
            color: #334155; /* Slate 700 / Navy tint */
            display: flex; 
            align-items: center; 
            gap: 16px; 
            transition: all 0.15s ease;
            margin-bottom: 2px;
        }
        .dropdown-item-dlh:last-child {
            margin-bottom: 0;
        }
        .dropdown-item-dlh:hover {
            background-color: #f1f5f9; /* Slate 100 soft gray */
            color: #0f172a; /* Darker navy */
        }
        .dropdown-item-dlh i {
            display: flex; 
            align-items: center; 
            justify-content: center;
            color: #334155; 
            font-size: 1.2rem;
            transition: color 0.15s ease;
        }
        .dropdown-item-dlh:hover i {
            color: #0f172a;
        }

        /* TICKER */
        .ticker-bar {
            background: linear-gradient(90deg, var(--g900), var(--g700));
            padding: 9px 0; font-size: .85rem; color: rgba(255,255,255,.9);
        }
        .ticker-label {
            background: var(--amber); color: #000; font-weight: 800;
            font-size: .72rem; padding: 3px 12px; border-radius: 100px;
            text-transform: uppercase; letter-spacing: .8px; white-space: nowrap; flex-shrink: 0;
        }

        /* PORTAL LAYANAN */
        .portal-section { background: linear-gradient(180deg, #f8fafc 0%, #f0fdf4 100%); }

        /* Featured Card */
        .portal-featured {
            background: linear-gradient(135deg, var(--g950) 0%, #0a2a17 60%, var(--g900) 100%);
            border-radius: 1.75rem; padding: 40px 44px;
            display: flex; align-items: center; gap: 32px;
            position: relative; overflow: hidden;
            box-shadow: 0 20px 60px rgba(5,46,22,.25);
        }
        .portal-featured::before {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(circle at 80% 50%, rgba(74,222,128,.08) 0%, transparent 60%),
                        radial-gradient(circle at 20% 20%, rgba(251,191,36,.05) 0%, transparent 50%);
            pointer-events: none;
        }
        .portal-featured-left {
            display: flex; gap: 24px; align-items: flex-start; flex: 1; position: relative; z-index: 1;
        }
        .portal-featured-icon {
            width: 64px; height: 64px; border-radius: 18px; flex-shrink: 0;
            background: linear-gradient(135deg, rgba(74,222,128,.2), rgba(74,222,128,.06));
            border: 1px solid rgba(74,222,128,.25);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem; color: var(--g400);
        }
        .portal-featured-tag {
            font-size: .7rem; font-weight: 800; letter-spacing: 1.8px; text-transform: uppercase;
            color: var(--amber); display: block; margin-bottom: 8px;
        }
        .portal-featured-title {
            font-size: 1.55rem; font-weight: 800; color: #fff;
            line-height: 1.25; letter-spacing: -.5px; margin-bottom: 12px;
        }
        .portal-featured-desc {
            font-size: .875rem; color: rgba(255,255,255,.58); line-height: 1.75; max-width: 460px; margin: 0;
        }
        .portal-featured-btn-primary {
            display: inline-flex; align-items: center; gap: 7px;
            background: linear-gradient(135deg, var(--g600), var(--g700));
            color: #fff; font-weight: 700; font-size: .85rem;
            padding: 10px 22px; border-radius: 10px; text-decoration: none;
            box-shadow: 0 4px 16px rgba(22,163,74,.4); transition: all .3s;
        }
        .portal-featured-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(22,163,74,.5); color: #fff; }
        .portal-featured-btn-outline {
            display: inline-flex; align-items: center; gap: 7px;
            background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.2);
            color: rgba(255,255,255,.85); font-weight: 600; font-size: .85rem;
            padding: 10px 22px; border-radius: 10px; text-decoration: none; transition: all .3s;
        }
        .portal-featured-btn-outline:hover { background: rgba(255,255,255,.14); color: #fff; transform: translateY(-2px); }
        .portal-featured-right {
            flex-shrink: 0; display: flex; flex-direction: column;
            align-items: center; gap: 20px; position: relative; z-index: 1;
        }
        .portal-featured-blob {
            width: 110px; height: 110px; border-radius: 50%;
            background: radial-gradient(circle, rgba(74,222,128,.15) 0%, rgba(74,222,128,.04) 100%);
            border: 1px solid rgba(74,222,128,.18);
            display: flex; align-items: center; justify-content: center;
            font-size: 3rem; color: var(--g400);
        }
        .portal-feat-stats { display: flex; gap: 16px; }
        .portal-feat-stat {
            text-align: center; background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,255,255,.09); border-radius: 14px;
            padding: 14px 18px;
        }
        .pfs-num { display: block; font-size: 1.4rem; font-weight: 800; color: var(--amber); line-height: 1; letter-spacing: -1px; }
        .pfs-label { display: block; font-size: .65rem; color: rgba(255,255,255,.45); font-weight: 600; text-transform: uppercase; letter-spacing: .8px; margin-top: 4px; }

        /* Service Icon Cards */
        .svc-icon-card {
            display: flex; align-items: flex-start; gap: 20px;
            background: #ffffff; border: 1px solid rgba(0,0,0,.06);
            border-radius: 20px; padding: 26px;
            text-decoration: none; transition: all .5s cubic-bezier(.165,.84,.44,1);
            position: relative; overflow: hidden; height: 100%;
            box-shadow: 0 4px 12px rgba(0,0,0,.03); z-index: 1;
        }
        .svc-icon-card::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, #166534 0%, #14532d 100%);
            opacity: 0; z-index: -1; transition: opacity .5s ease;
        }
        .svc-icon-card:hover {
            transform: translateY(-8px);
            border-color: #14532d;
            box-shadow: 0 20px 40px -10px rgba(20,83,45,.4);
        }
        .svc-icon-card:hover::before { opacity: 1; }
        
        .svc-icon-box {
            width: 60px; height: 60px; border-radius: 18px; flex-shrink: 0;
            background: var(--svc-bg); border: 1px solid var(--svc-border);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem; color: var(--svc-color);
            transition: all .5s cubic-bezier(.175,.885,.32,1.275); position: relative; z-index: 2;
        }
        .svc-icon-card:hover .svc-icon-box { background: rgba(255,255,255,.15); color: #fff; transform: scale(1.15) rotate(8deg); box-shadow: 0 10px 20px rgba(0,0,0,.2); border-color: rgba(255,255,255,.3); backdrop-filter: blur(5px); }
        .svc-icon-content { flex: 1; min-width: 0; transition: all .4s; }
        .svc-icon-tag {
            font-size: .67rem; font-weight: 800; letter-spacing: 1.4px; text-transform: uppercase;
            color: var(--svc-color, var(--g600)); display: block; margin-bottom: 6px; transition: color .4s;
        }
        .svc-icon-card:hover .svc-icon-tag { color: #86efac; }
        .svc-icon-title {
            font-size: 1rem; font-weight: 800; color: var(--slate800); margin: 0 0 6px;
            line-height: 1.35; letter-spacing: -.2px; transition: color .4s;
        }
        .svc-icon-card:hover .svc-icon-title { color: #ffffff; }
        .svc-icon-desc { font-size: .8rem; color: #64748b; line-height: 1.6; margin: 0; transition: color .4s; }
        .svc-icon-card:hover .svc-icon-desc { color: rgba(255,255,255,.7); }
        .svc-icon-arrow {
            width: 36px; height: 36px; border-radius: 50%; flex-shrink: 0;
            background: rgba(0,0,0,.02); border: 1px solid rgba(0,0,0,.05);
            display: flex; align-items: center; justify-content: center;
            color: #94a3b8; font-size: .85rem; transition: all .4s;
        }
        .svc-icon-card:hover .svc-icon-arrow {
            background: #fff; border-color: #fff;
            color: #14532d; transform: translateX(5px) scale(1.1); box-shadow: 0 5px 15px rgba(0,0,0,.3);
        }

        /* ELITE QUICK ACCESS CARDS */
        .quick-card-elite {
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 250px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 22px;
            padding: 24px 22px;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
            z-index: 1;
        }
        .quick-card-elite::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #16a34a, #15803d);
            opacity: 0;
            transition: opacity 0.3s ease, height 0.3s ease;
        }
        .quick-card-elite::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 85% 15%, rgba(22, 163, 74, 0.04), transparent 65%);
            opacity: 0.5;
            transition: opacity 0.4s ease;
            z-index: -1;
        }
        .quick-card-elite:hover {
            transform: translateY(-8px);
            border-color: rgba(22, 163, 74, 0.28);
            box-shadow: 0 20px 38px -10px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(22, 163, 74, 0.12);
        }
        .quick-card-elite:hover::before {
            opacity: 1;
            height: 4px;
        }
        .quick-card-elite:hover::after {
            opacity: 1;
        }
        .qc-watermark {
            position: absolute;
            right: -12px;
            bottom: -16px;
            font-size: 6.2rem;
            color: #15803d;
            opacity: 0.035;
            pointer-events: none;
            transition: all 0.5s ease;
            z-index: -1;
        }
        .quick-card-elite:hover .qc-watermark {
            transform: scale(1.15) rotate(8deg);
            opacity: 0.09;
        }
        .qc-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }
        .qc-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.8px;
            color: #15803d;
            background: #f0fdf4;
            border: 1px solid rgba(22, 163, 74, 0.2);
            padding: 5px 11px;
            border-radius: 20px;
            text-transform: uppercase;
        }
        .qc-pulse {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
            background: #16a34a;
            box-shadow: 0 0 6px rgba(22, 163, 74, 0.6);
            animation: qcPulseAnim 2s infinite;
        }
        @keyframes qcPulseAnim {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.85); }
        }
        .qc-icon-box {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #15803d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .quick-card-elite:hover .qc-icon-box {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            color: #ffffff;
            transform: scale(1.1) rotate(6deg);
            box-shadow: 0 8px 18px rgba(22, 163, 74, 0.25);
            border-color: transparent;
        }
        .qc-body {
            flex: 1;
            margin-bottom: 18px;
        }
        .qc-title {
            font-size: 1.06rem;
            font-weight: 800;
            color: var(--slate900, #0f172a);
            margin: 0 0 8px 0;
            line-height: 1.35;
            letter-spacing: -0.2px;
            transition: color 0.3s ease;
        }
        .quick-card-elite:hover .qc-title {
            color: #15803d;
        }
        .qc-desc {
            font-size: 0.82rem;
            color: #64748b;
            line-height: 1.55;
            margin: 0;
        }
        .qc-footer {
            padding-top: 14px;
            border-top: 1px dashed rgba(0, 0, 0, 0.08);
        }
        .qc-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--slate700, #334155);
            transition: all 0.3s ease;
        }
        .qc-action-btn i {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            transition: all 0.3s ease;
        }
        .quick-card-elite:hover .qc-action-btn {
            color: #15803d;
        }
        .quick-card-elite:hover .qc-action-btn i {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            color: #ffffff;
            transform: translateX(4px);
            box-shadow: 0 4px 10px rgba(22, 163, 74, 0.25);
        }

        @media (max-width: 767px) {
            .portal-featured { flex-direction: column; padding: 28px 22px; }
            .portal-featured-right { width: 100%; flex-direction: row; justify-content: center; flex-wrap: wrap; }
            .portal-featured-blob { width: 80px; height: 80px; font-size: 2.2rem; }
        }

        /* HERO */
        .hero-section {
            position: relative; min-height: 88vh;
            display: flex; flex-direction: column; overflow: hidden;
            background: var(--g950);
        }
        .hero-bg {
            position: absolute; inset: 0;
            background-image: url('https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=1474&q=80');
            background-size: cover; background-position: center;
            transform: scale(1.05); transition: transform 8s ease;
        }
        .hero-section:hover .hero-bg { transform: scale(1); }
        .hero-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(5,46,22,.92) 0%, rgba(5,46,22,.72) 50%, rgba(5,46,22,.45) 100%);
        }
        .hero-particles {
            position: absolute; inset: 0; pointer-events: none;
            background-image:
                radial-gradient(circle 2px at 20% 30%, rgba(74,222,128,.3) 0%, transparent 50%),
                radial-gradient(circle 1.5px at 80% 60%, rgba(251,191,36,.22) 0%, transparent 50%),
                radial-gradient(circle 1px at 60% 80%, rgba(74,222,128,.18) 0%, transparent 50%);
        }
        .hero-content { position: relative; z-index: 2; flex: 1; display: flex; align-items: center; }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,.1); backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,.18); color: #fff;
            padding: 6px 18px; border-radius: 100px;
            font-size: .8rem; font-weight: 600; letter-spacing: .5px; margin-bottom: 22px;
        }
        .hero-dot { width: 8px; height: 8px; background: var(--g400); border-radius: 50%; animation: pulse-dot 2s infinite; }
        .hero-title {
            font-size: clamp(2.2rem, 5vw, 3.8rem); font-weight: 800; line-height: 1.15;
            color: #fff; letter-spacing: -1.5px; margin-bottom: 20px;
        }
        .hero-highlight {
            background: linear-gradient(90deg, var(--g400), var(--amber));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .hero-desc { font-size: 1.05rem; color: rgba(255,255,255,.78); max-width: 540px; line-height: 1.75; margin-bottom: 32px; }
        .btn-hero-primary {
            background: linear-gradient(135deg, var(--g600), var(--g700));
            color: #fff; border: none; padding: 13px 30px; border-radius: 12px;
            font-weight: 700; font-size: .92rem; text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
            transition: all .3s; box-shadow: 0 4px 20px rgba(22,163,74,.4);
        }
        .btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(22,163,74,.5); color: #fff; background: linear-gradient(135deg, var(--g500), var(--g600)); }
        .btn-hero-outline {
            background: rgba(255,255,255,.1); backdrop-filter: blur(8px);
            color: #fff; border: 1px solid rgba(255,255,255,.3);
            padding: 13px 28px; border-radius: 12px; font-weight: 600;
            font-size: .92rem; text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px; transition: all .3s;
        }
        .btn-hero-outline:hover { background: rgba(255,255,255,.2); color: #fff; transform: translateY(-2px); }
        .hero-stats-strip {
            position: relative; z-index: 2;
            background: rgba(255,255,255,.07); backdrop-filter: blur(12px);
            border-top: 1px solid rgba(255,255,255,.1); padding: 20px 0;
        }
        .hero-stat-item { text-align: center; padding: 0 24px; }
        .hero-stat-item + .hero-stat-item { border-left: 1px solid rgba(255,255,255,.12); }
        .hero-stat-num { font-size: 1.8rem; font-weight: 800; color: var(--amber); line-height: 1; letter-spacing: -1px; }
        .hero-stat-label { font-size: .75rem; color: rgba(255,255,255,.6); margin-top: 4px; font-weight: 500; }

        /* SECTION LABELS */
        .section-label {
            font-size: .75rem; font-weight: 800; letter-spacing: 1.8px;
            text-transform: uppercase; color: var(--g600);
            display: inline-flex; align-items: center; gap: 8px; margin-bottom: 10px;
        }
        .section-label::before, .section-label::after {
            content: ''; display: block; width: 24px; height: 2px; background: var(--g500); border-radius: 2px;
        }
        .section-title { font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 800; letter-spacing: -1px; color: var(--slate800); line-height: 1.2; }
        .section-title-light { color: #fff; }

        /* PORTAL LAYANAN CARDS */
        .portal-card {
            border-radius: 1.5rem; overflow: hidden; position: relative;
            display: flex; align-items: flex-end;
            text-decoration: none; color: #fff;
            transition: transform .4s cubic-bezier(.165,.84,.44,1), box-shadow .4s;
            width: 100%;
        }
        .portal-card:hover { transform: translateY(-6px) scale(1.01); box-shadow: 0 24px 60px rgba(0,0,0,.22); color: #fff; }
        .portal-card-bg {
            position: absolute; inset: 0; background-size: cover; background-position: center; transition: transform .6s;
        }
        .portal-card:hover .portal-card-bg { transform: scale(1.08); }
        .portal-card-overlay { position: absolute; inset: 0; }
        .portal-card-body { position: relative; z-index: 2; padding: 22px; width: 100%; }
        .portal-badge {
            display: inline-flex; align-items: center; gap: 5px;
            background: rgba(255,255,255,.18); backdrop-filter: blur(6px);
            border: 1px solid rgba(255,255,255,.25); color: #fff;
            padding: 4px 12px; border-radius: 100px; font-size: .7rem;
            font-weight: 700; letter-spacing: .7px; text-transform: uppercase; margin-bottom: 10px;
        }
        .portal-title { font-size: 1.05rem; font-weight: 800; line-height: 1.3; margin-bottom: 6px; color: #fff; }
        .portal-sub { font-size: .8rem; color: rgba(255,255,255,.75); margin-bottom: 14px; }
        .portal-btn {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(255,255,255,.15); backdrop-filter: blur(6px);
            border: 1px solid rgba(255,255,255,.3); color: #fff;
            font-weight: 700; font-size: .78rem; padding: 7px 16px;
            border-radius: 100px; text-decoration: none; transition: all .25s;
        }
        .portal-btn:hover { background: rgba(255,255,255,.3); color: #fff; }

        /* STATS */
        .stats-section {
            background: linear-gradient(135deg, var(--g950) 0%, #0a2a17 50%, var(--g900) 100%);
            position: relative; overflow: hidden;
        }
        .stats-section::before {
            content: ''; position: absolute; top: -200px; right: -200px; width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(74,222,128,.07) 0%, transparent 70%); pointer-events: none;
        }
        .stat-card-p {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px; padding: 24px 20px;
            display: flex; flex-direction: column; align-items: flex-start; gap: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
            position: relative; overflow: hidden; height: 100%;
            transition: all 0.25s ease;
        }
        .stat-card-p:hover {
            transform: translateY(-4px);
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(74, 222, 128, 0.35);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }
        .stat-icon-box {
            width: 48px; height: 48px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center; font-size: 1.4rem;
            background: rgba(22, 163, 74, 0.16); color: #4ade80;
            border: 1px solid rgba(74, 222, 128, 0.25);
            position: relative; z-index: 1;
            transition: all 0.25s ease;
        }
        .stat-card-p:hover .stat-icon-box {
            background: #166534; border-color: #22c55e; color: #fff;
        }
        
        .stat-value { font-size: 2.2rem; font-weight: 800; color: #fff; line-height: 1.1; letter-spacing: -0.5px; margin-bottom: 4px; position:relative; z-index:1; }
        .stat-name { font-size: .9rem; color: #cbd5e1; font-weight: 500; line-height: 1.35; position:relative; z-index:1; }

        /* LAYANAN */
        .layanan-section { background: linear-gradient(180deg, #0b2e13 0%, #051609 100%); position: relative; }
        .layanan-section::after {
            content: ''; position: absolute; inset: 0; background: url('data:image/svg+xml;utf8,<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2" r="1.5" fill="rgba(255,255,255,.02)"/></svg>'); pointer-events: none;
        }
        .svc-card {
            background: linear-gradient(180deg, rgba(255,255,255,.03) 0%, rgba(0,0,0,.25) 100%);
            border: 1px solid rgba(255,255,255,.05);
            border-radius: 28px; overflow: hidden; transition: all .5s cubic-bezier(.165,.84,.44,1);
            height: 100%; display: flex; flex-direction: column;
            box-shadow: inset 0 2px 20px rgba(255,255,255,.02), 0 10px 30px rgba(0,0,0,.3);
            position: relative; z-index: 1;
        }
        .svc-card:hover { transform: translateY(-6px); border-color: rgba(74, 222, 128, 0.4); box-shadow: 0 20px 45px rgba(0,0,0,.5), 0 0 20px rgba(34, 197, 94, 0.15); }
        .svc-card-top { height: 4px; background: linear-gradient(90deg, rgba(255,255,255,.1), rgba(255,255,255,.02)); transition: all .4s; }
        .svc-card:hover .svc-card-top { background: linear-gradient(90deg, #16a34a, #4ade80); }
        .svc-num { font-size: 7rem; font-weight: 900; color: rgba(255,255,255,.015); position: absolute; top: -10px; right: 0px; line-height: 1; user-select: none; pointer-events: none; letter-spacing: -6px; z-index: -1; transition: all .5s; }
        .svc-card:hover .svc-num { color: rgba(255,255,255,.03); transform: scale(1.05) translate(-6px, 6px); }
        .svc-icon-ring {
            width: 62px; height: 62px; border-radius: 18px;
            background: linear-gradient(135deg, rgba(255,255,255,.08), rgba(255,255,255,.01)); border: 1px solid rgba(255,255,255,.05);
            display: flex; align-items: center; justify-content: center; box-shadow: inset 0 2px 10px rgba(255,255,255,.05);
            font-size: 1.6rem; color: #fff; flex-shrink: 0; transition: all .4s cubic-bezier(.165,.84,.44,1);
        }
        .svc-card:hover .svc-icon-ring { transform: scale(1.08); background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: #ffffff; box-shadow: 0 8px 22px rgba(22, 163, 74, 0.35); border-color: rgba(74, 222, 128, 0.4); }
        .svc-tag { font-size: .68rem; font-weight: 800; color: rgba(255,255,255,.4); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 14px; transition: color .4s; }
        .svc-card:hover .svc-tag { color: #86efac; }
        .svc-title { font-size: 1.1rem; font-weight: 800; color: #fff; line-height: 1.4; margin: 0; letter-spacing: -.3px; }
        .svc-desc { font-size: .85rem; color: rgba(255,255,255,.55); line-height: 1.7; flex-grow: 1; transition: color .4s; }
        .svc-card:hover .svc-desc { color: rgba(255,255,255,.8); }
        .svc-chip { font-size: .68rem; padding: 4px 12px; background: rgba(0,0,0,.2); border: 1px solid rgba(255,255,255,.05); border-radius: 100px; color: rgba(255,255,255,.6); white-space: nowrap; font-weight: 600; transition: all .4s; }
        .svc-card:hover .svc-chip { border-color: rgba(74, 222, 128, 0.3); color: rgba(255,255,255,.95); background: rgba(34, 197, 94, 0.1); }
        .svc-arrow-btn {
            width: 44px; height: 44px; border-radius: 50%;
            background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.08);
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,.6); text-decoration: none; flex-shrink: 0; transition: all .4s cubic-bezier(.165,.84,.44,1);
        }
        .svc-card:hover .svc-arrow-btn { background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: #ffffff; transform: translateX(6px); border-color: #4ade80; box-shadow: 0 6px 18px rgba(22, 163, 74, 0.35); }

        /* BERITA */
        .news-card {
            background: #fff; border-radius: 28px; overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,.03); border: 1px solid #e2e8f0;
            transition: all .5s cubic-bezier(.165,.84,.44,1);
            height: 100%; display: flex; flex-direction: column; position: relative;
        }
        .news-card:hover { transform: translateY(-10px); box-shadow: 0 24px 56px rgba(22,163,74,.15); border-color: rgba(22,163,74,.2); }
        .news-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 5px;
            background: linear-gradient(90deg, var(--g600), var(--amber));
            transform: scaleX(0); transform-origin: left; transition: transform .5s cubic-bezier(.165,.84,.44,1); z-index: 2;
        }
        .news-card:hover::before { transform: scaleX(1); }
        .news-img-wrap { overflow: hidden; height: 230px; position: relative; display: flex; align-items: center; justify-content: center; }
        .news-img-wrap::after {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(circle at 10px 10px, rgba(255,255,255,0.15) 2px, transparent 0);
            background-size: 20px 20px; opacity: 0.5; pointer-events: none;
        }
        .news-img-wrap i { transition: all .6s cubic-bezier(.165,.84,.44,1); font-size: 4.5rem; color: rgba(255,255,255,.06); }
        .news-card:hover .news-img-wrap i { transform: scale(1.2) rotate(5deg); color: rgba(255,255,255,.2); }
        .news-badge { position:absolute; top:20px; left:20px; z-index:2; padding:6px 16px; border-radius:100px; font-weight:800; font-size:.72rem; letter-spacing:1px; text-transform:uppercase; box-shadow:0 8px 24px rgba(0,0,0,.15); backdrop-filter:blur(10px); background:rgba(255,255,255,.95); }
        .news-card-body { padding: 32px; flex: 1; display: flex; flex-direction: column; background: #fff; position: relative; z-index: 1; }
        .news-date { font-size: .75rem; color: var(--g600); font-weight: 800; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 16px; background: #f0fdf4; padding: 6px 14px; border-radius: 100px; align-self: flex-start; }
        .news-title-link { font-size: 1.15rem; font-weight: 800; color: var(--slate800); line-height: 1.45; text-decoration: none; display: block; flex: 1; transition: color .3s; }
        .news-title-link:hover { color: var(--g600); }
        .news-excerpt { font-size: .88rem; color: #64748b; line-height: 1.7; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin: 12px 0 24px; }
        .news-more { display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-size: .85rem; font-weight: 800; color: #fff; text-decoration: none; padding: 12px 20px; background: #047857; border: 1px solid #047857; border-radius: 14px; transition: all .4s; }
        .news-card:hover .news-more { background: #064e3b; border-color: #064e3b; gap: 12px; }

        /* GALLERY */
        .gallery-tabs .nav-link { font-weight: 700; font-size: .85rem; color: #64748b; background: var(--slate100); border-radius: 10px; padding: 9px 22px; border: none; transition: all .2s; }
        .gallery-tabs .nav-link.active { background: #047857; color: #fff; box-shadow: 0 4px 14px rgba(4,120,87,.35); }
        .gallery-scroll { display: flex; gap: 18px; overflow-x: auto; padding-bottom: 16px; scrollbar-width: none; -ms-overflow-style: none; }
        .gallery-scroll::-webkit-scrollbar { display: none; }
        .gallery-item { flex: 0 0 calc(33.333% - 12px); border-radius: 1.25rem; overflow: hidden; position: relative; height: 320px; cursor: pointer; }
        @media (max-width: 991px) { .gallery-item { flex: 0 0 calc(50% - 9px); } }
        @media (max-width: 575px) { .gallery-item { flex: 0 0 88%; } }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform .6s; }
        .gallery-item:hover img { transform: scale(1.1); }
        .gallery-item-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(5,46,22,.92) 0%, rgba(5,46,22,.3) 55%, transparent 100%); }
        .gallery-item-content { position: absolute; bottom: 0; left: 0; right: 0; padding: 20px; z-index: 2; }
        .gallery-item-content h6 { color: #fff; font-weight: 700; font-size: .92rem; margin: 0; line-height: 1.4; text-shadow: 0 2px 6px rgba(0,0,0,.4); }
        .gallery-play-btn {
            position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
            width: 64px; height: 64px; background: rgba(251,191,36,.9); border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #000; font-size: 1.6rem; z-index: 3; transition: all .3s;
            box-shadow: 0 6px 24px rgba(0,0,0,.3);
        }
        .gallery-item:hover .gallery-play-btn { transform: translate(-50%,-50%) scale(1.12); }

        /* MITRA */
        .mitra-section { background: linear-gradient(180deg, #f0fdf4 0%, var(--slate50) 100%); border-top: 1px solid rgba(22,163,74,.08); }
        .mitra-card {
            background: linear-gradient(145deg, #f8fafc 0%, #f1f5f9 100%);
            border: 1px solid #e2e8f0; border-radius: 20px;
            width: 300px; min-height: 110px;
            display: flex; align-items: stretch; justify-content: stretch;
            text-decoration: none; padding: 12px;
            transition: all .4s cubic-bezier(.165,.84,.44,1);
            box-shadow: inset 0 2px 4px rgba(255,255,255,0.6), 0 2px 10px rgba(0,0,0,.02); flex-shrink: 0;
            position: relative; overflow: hidden;
        }
        .mitra-card:hover { transform: translateY(-4px); border-color: rgba(22,163,74,.4); box-shadow: inset 0 2px 4px rgba(255,255,255,0.8), 0 12px 30px rgba(22,163,74,.15); background: linear-gradient(145deg, #f0fdf4 0%, #e6f6ec 100%); }
        
        .mitra-inner-card {
            background: #ffffff; box-shadow: 0 4px 15px rgba(0,0,0,.04); border-radius: 12px;
            display: flex; flex-direction: row; align-items: center; justify-content: flex-start;
            gap: 16px; padding: 14px 18px; width: 100%; transition: transform .4s cubic-bezier(.165,.84,.44,1);
            position: relative; z-index: 1; border: 1px solid rgba(0,0,0,.02);
        }
        .mitra-card:hover .mitra-inner-card { transform: scale(1.02); box-shadow: 0 8px 25px rgba(0,0,0,.08); }

        .mitra-img { width: 44px; height: 44px; object-fit: contain; filter: drop-shadow(0 2px 4px rgba(0,0,0,.08)); flex-shrink: 0; }
        .mitra-icon-fallback { width: 44px; height: 44px; border-radius: 10px; background: #f0fdf4; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; color: var(--g700); flex-shrink: 0; }
        
        .mitra-text-wrap { display: flex; flex-direction: column; gap: 3px; align-items: flex-start; text-align: left; }
        .mitra-name { font-size: .88rem; font-weight: 800; color: #1e293b; line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-align: left; }
        .mitra-sub { font-size: .65rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; text-align: left; }

        .mitra-arrow { position: absolute; top: 12px; right: 14px; font-size: 1.1rem; color: var(--g600); opacity: 0; transform: translate(-8px, 8px); transition: all .4s cubic-bezier(.165,.84,.44,1); z-index: 0; }
        .mitra-card:hover .mitra-arrow { opacity: 1; transform: translate(0, 0); }

        /* CTA */
        .cta-section { background: linear-gradient(180deg, var(--g950) 0%, #030f07 100%); position: relative; }
        .cta-section::after {
            content: ''; position: absolute; inset: 0; background: url('data:image/svg+xml;utf8,<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2" r="1.5" fill="rgba(255,255,255,.02)"/></svg>'); pointer-events: none;
        }
        .cta-card {
            background: linear-gradient(180deg, rgba(255,255,255,.05) 0%, rgba(0,0,0,.3) 100%);
            border: 1px solid rgba(255,255,255,.08); border-radius: 32px; padding: 60px 52px;
            position: relative; overflow: hidden; box-shadow: inset 0 2px 20px rgba(255,255,255,.03), 0 20px 50px rgba(0,0,0,.4);
        }
        .cta-card::before {
            content: ''; position: absolute; top: -150px; left: -150px;
            width: 400px; height: 400px; pointer-events: none;
            background: radial-gradient(circle, rgba(251,191,36,.08) 0%, transparent 60%);
        }
        .cta-btn {
            display: flex; align-items: center; gap: 16px; padding: 18px 24px;
            border-radius: 20px; text-decoration: none; font-weight: 700; transition: all .4s cubic-bezier(.175,.885,.32,1.275);
            position: relative; overflow: hidden; z-index: 1; border: 1px solid rgba(255,255,255,.1);
        }
        .cta-btn::before { content: ''; position: absolute; inset: 0; background: linear-gradient(90deg, transparent, rgba(255,255,255,.15), transparent); transform: translateX(-100%); transition: transform .6s; z-index: -1; }
        .cta-btn:hover::before { transform: translateX(100%); }
        .cta-btn-icon { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; background: rgba(255,255,255,.15); box-shadow: inset 0 2px 10px rgba(255,255,255,.1); transition: transform .4s; }
        .cta-btn:hover .cta-btn-icon { transform: scale(1.15) rotate(8deg); }
        .cta-btn-red { background: linear-gradient(135deg, #7f1d1d, #450a0a); color: #fff; box-shadow: inset 0 2px 10px rgba(255,255,255,.05), 0 8px 25px rgba(0,0,0,.3); }
        .cta-btn-red:hover { transform: translateY(-5px); box-shadow: inset 0 2px 10px rgba(255,255,255,.1), 0 15px 35px rgba(127,29,29,.4); border-color: rgba(239,68,68,.3); color: #fff; }
        .cta-btn-green { background: linear-gradient(135deg, #064e3b, #022c22); color: #fff; box-shadow: inset 0 2px 10px rgba(255,255,255,.05), 0 8px 25px rgba(0,0,0,.3); }
        .cta-btn-green:hover { transform: translateY(-5px); box-shadow: inset 0 2px 10px rgba(255,255,255,.1), 0 15px 35px rgba(6,78,59,.4); border-color: rgba(52,211,153,.3); color: #fff; }

        /* FOOTER */
        .site-footer { background: linear-gradient(180deg, var(--g950) 0%, #030f07 100%); color: rgba(255,255,255,.6); padding: 60px 0 0; }
        .footer-brand-box { background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.07); border-radius: 20px; padding: 28px; }
        .footer-heading { font-size: .95rem; font-weight: 700; color: #fff; margin-bottom: 18px; position: relative; padding-bottom: 12px; }
        .footer-heading::after { content: ''; position: absolute; left: 0; bottom: 0; width: 32px; height: 3px; background: linear-gradient(90deg, var(--amber), var(--amber-light)); border-radius: 2px; transition: width .3s; }
        .footer-heading:hover::after { width: 100%; }
        .footer-contact-item { display: flex; gap: 14px; margin-bottom: 18px; color: rgba(255,255,255,.55); font-size: .875rem; line-height: 1.6; }
        .footer-contact-item i { color: var(--amber); margin-top: 2px; flex-shrink: 0; }
        .footer-social a {
            display: inline-flex; width: 38px; height: 38px; align-items: center; justify-content: center;
            border-radius: 10px; background: rgba(255,255,255,.07); color: rgba(255,255,255,.65);
            text-decoration: none; font-size: 1rem; transition: all .25s; border: 1px solid rgba(255,255,255,.1);
        }
        .footer-social a:hover { background: var(--g700); color: #fff; transform: translateY(-3px); }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,.06); padding: 18px 0; margin-top: 50px; font-size: .8rem; color: rgba(255,255,255,.35); text-align: center; }
        .qr-card { background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.09); border-radius: 20px; padding: 26px 20px; text-align: center; position: relative; overflow: hidden; }
        .qr-card::before { content: ''; position: absolute; top: -60%; left: -60%; width: 220%; height: 220%; background: conic-gradient(from 0deg, transparent, rgba(251,191,36,.04), transparent, rgba(22,163,74,.04), transparent); animation: qr-spin 12s linear infinite; pointer-events: none; }
        @keyframes qr-spin { to { transform: rotate(360deg); } }
        .qr-img-wrap { display: inline-block; background: #fff; border-radius: 14px; padding: 10px; box-shadow: 0 4px 20px rgba(0,0,0,.2); position: relative; z-index: 1; margin-bottom: 14px; }
        .qr-img-wrap img { width: 130px; height: 130px; border-radius: 6px; display: block; object-fit: contain; }
        .qr-label { font-size: .72rem; font-weight: 800; color: #fff; letter-spacing: 2.5px; text-transform: uppercase; margin-bottom: 14px; position: relative; z-index: 1; }
        .qr-sub { font-size: .78rem; font-weight: 600; color: var(--amber); position: relative; z-index: 1; }

        /* ADMIN FAB */
        .admin-fab {
            position: fixed; bottom: 28px; left: 28px; z-index: 9999;
            background: rgba(5,46,22,.78); backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,.18); border-radius: 50px;
            padding: 12px 16px; display: flex; align-items: center; gap: 0;
            text-decoration: none; color: #fff; font-weight: 600; font-size: .875rem;
            box-shadow: 0 8px 28px rgba(0,0,0,.25);
            transition: all .4s cubic-bezier(.175,.885,.32,1.275); overflow: hidden;
        }
        .admin-fab i { font-size: 1.1rem; flex-shrink: 0; transition: transform .3s; }
        .admin-fab-label { max-width: 0; overflow: hidden; white-space: nowrap; opacity: 0; transition: all .4s; letter-spacing: .3px; }
        .admin-fab:hover { background: linear-gradient(135deg, var(--g900), var(--g950)); box-shadow: 0 12px 36px rgba(22,163,74,.35); color: #fff; transform: translateY(-4px); gap: 10px; }
        .admin-fab:hover .admin-fab-label { max-width: 120px; opacity: 1; }
        .admin-fab:hover i { transform: rotate(-10deg) scale(1.1); }

        /* ANIMATIONS */
        @keyframes pulse-dot { 0%,100% { opacity:1; transform: scale(1); } 50% { opacity:.5; transform: scale(.75); } }
        @keyframes popIn { from { opacity:0; transform: translateY(6px) scale(.98); } to { opacity:1; transform: none; } }
        @keyframes fadeUp { from { opacity:0; transform: translateY(30px); } to { opacity:1; transform: none; } }
        .anim-fadeup { animation: fadeUp .6s ease both; }
        .d1 { animation-delay: .1s; } .d2 { animation-delay: .2s; } .d3 { animation-delay: .3s; }

        /* RESPONSIVE */
        @media (max-width: 991px) {
            .bento-grid { grid-template-columns: 1fr 1fr; }
            .bento-wide { grid-column: span 2; }
            .cta-card { padding: 36px 28px; }
        }
        @media (max-width: 767px) {
            .bento-grid { grid-template-columns: 1fr; }
            .bento-wide { grid-column: span 1; }
            .hero-section { min-height: 75vh; }
            .hero-stat-item + .hero-stat-item { border-left: none; border-top: 1px solid rgba(255,255,255,.1); padding-top: 14px; }
            .cta-card { padding: 28px 20px; }
        }
            /* Hide scrollbar for horizontal scrolling containers */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }

        /* VOICE ASSISTANT WIDGET & TOAST */
        .dlh-voice-ctrl {
            position: fixed; bottom: 28px; right: 28px; z-index: 9999;
            background: linear-gradient(135deg, #166534 0%, #14532d 100%);
            border: 1.5px solid rgba(255, 255, 255, 0.25); border-radius: 50px;
            padding: 10px 18px; display: flex; align-items: center; gap: 8px;
            color: #ffffff; font-weight: 700; font-size: .84rem;
            box-shadow: 0 8px 24px rgba(20, 83, 45, 0.35);
            cursor: pointer; transition: all .35s cubic-bezier(.175,.885,.32,1.275);
            user-select: none;
        }
        .dlh-voice-ctrl:hover {
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 12px 30px rgba(20, 83, 45, 0.5);
            border-color: rgba(251, 191, 36, 0.7);
            color: #fff;
        }
        .dlh-voice-ctrl.speaking {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            border-color: #34d399;
            box-shadow: 0 0 24px rgba(52, 211, 153, 0.65);
            animation: dlhPulseGlow 1.8s infinite;
        }
        @keyframes dlhPulseGlow {
            0%, 100% { box-shadow: 0 0 14px rgba(52, 211, 153, 0.5); }
            50% { box-shadow: 0 0 28px rgba(52, 211, 153, 0.85); }
        }
        .dlh-voice-toast {
            position: fixed; bottom: 84px; right: 28px; z-index: 9998;
            background: rgba(15, 23, 42, 0.94); backdrop-filter: blur(14px);
            border: 1px solid rgba(52, 211, 153, 0.35); border-radius: 16px;
            padding: 12px 18px; max-width: 330px; color: #ffffff;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.32);
            opacity: 0; visibility: hidden; transform: translateY(12px);
            transition: all .35s ease; pointer-events: none;
        }
        .dlh-voice-toast.show {
            opacity: 1; visibility: visible; transform: translateY(0);
        }
        .dlh-voice-speaker {
            font-size: .7rem; font-weight: 800; color: #34d399;
            letter-spacing: .8px; text-transform: uppercase;
        }
        .dlh-voice-text {
            font-size: .82rem; color: rgba(255, 255, 255, 0.92);
            line-height: 1.45; margin-top: 3px; font-weight: 500;
        }
        .dlh-voice-wave {
            display: inline-flex; align-items: center; gap: 3px; height: 16px;
        }
        .dlh-voice-wave span {
            width: 3px; height: 100%; background: #34d399; border-radius: 2px;
            animation: dlhWaveBar 1.2s ease-in-out infinite;
        }
        .dlh-voice-wave span:nth-child(1) { animation-delay: 0.0s; height: 35%; }
        .dlh-voice-wave span:nth-child(2) { animation-delay: 0.2s; height: 85%; }
        .dlh-voice-wave span:nth-child(3) { animation-delay: 0.4s; height: 60%; }
        .dlh-voice-wave span:nth-child(4) { animation-delay: 0.1s; height: 95%; }
        @keyframes dlhWaveBar {
            0%, 100% { transform: scaleY(0.3); }
            50% { transform: scaleY(1); }
        }
    </style>
</head>
<body>


    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-main sticky-top" id="mainNav">
        <div class="container-fluid px-lg-5">
            <a class="brand-logo-wrap navbar-brand" href="{{ url('/') }}">
                <div class="brand-logo-box">
                    @if($logoUrl)
                        <img src="{{ $logoUrl }}" alt="Logo {{ $siteName }}" onerror="this.parentElement.innerHTML='<i class=\'bi bi-tree-fill\'></i>'">
                    @else
                        <i class="bi bi-tree-fill"></i>
                    @endif
                </div>
                <div class="brand-text">
                    <span class="brand-name">{{ $siteName }}</span>
                    <span class="brand-divider"></span>
                    <span class="brand-sub">{{ $siteShortName }}</span>
                </div>
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1 py-3 py-lg-0">
                    @php
                        $rootNavigations = \App\Models\Navigation::with('children')
                            ->whereNull('parent_id')
                            ->where('is_active', true)
                            ->orderBy('order')
                            ->get();
                    @endphp
                    @forelse($rootNavigations as $nav)
                        @if($nav->children->count() > 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-pill dropdown-toggle" href="{{ $nav->url }}" data-bs-toggle="dropdown" target="{{ $nav->target }}">{{ $nav->title }}</a>
                                <ul class="dropdown-menu dropdown-menu-dlh">
                                    @foreach($nav->children->where('is_active', true) as $child)
                                        <li>
                                            <a class="dropdown-item dropdown-item-dlh" href="{{ $child->url }}" target="{{ $child->target }}">
                                                <i class="bi {{ $child->icon ?: 'bi-chevron-right' }}"></i> {{ $child->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link nav-pill" href="{{ $nav->url }}" target="{{ $nav->target }}">{{ $nav->title }}</a>
                            </li>
                        @endif
                    @empty
                        <li class="nav-item"><a class="nav-link nav-pill active" href="{{ url('/') }}">Beranda</a></li>
                    @endforelse
                    {{-- CTA Hubungi --}}
                    <li class="nav-item ms-2">
                        <a href="{{ url('/kontak') }}" class="nav-cta">
                            <i class="bi bi-send-fill"></i> Hubungi Kami
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-5 col-md-6">
                    <div class="footer-brand-box">
                        <a class="brand-logo-wrap brand-footer mb-4" href="{{ url('/') }}">
                            <div class="brand-logo-box">
                                @if($logoUrl)
                                    <img src="{{ $logoUrl }}" alt="Logo {{ $siteName }}" onerror="this.parentElement.innerHTML='<i class=\'bi bi-tree-fill\'></i>'">
                                @else
                                    <i class="bi bi-tree-fill"></i>
                                @endif
                            </div>
                            <div class="brand-text">
                                <span class="brand-name">{{ $siteName }}</span>
                                <span class="brand-divider"></span>
                                <span class="brand-sub">{{ $siteShortName }}</span>
                            </div>
                        </a>
                        <p style="color:rgba(255,255,255,.5);font-size:.875rem;line-height:1.8;margin-bottom:20px;">{{ $siteName }} {{ $siteShortName }} berkomitmen mewujudkan kelestarian lingkungan, pengelolaan sampah terpadu, dan ruang terbuka hijau yang asri.</p>
                        <div class="footer-social d-flex gap-2">
                            <a href="https://facebook.com/dlhkabprobolinggo" target="_blank"><i class="bi bi-facebook"></i></a>
                            <a href="https://instagram.com/dlhkabprobolinggo" target="_blank"><i class="bi bi-instagram"></i></a>
                            <a href="https://youtube.com/@dlhkabprobolinggo" target="_blank"><i class="bi bi-youtube"></i></a>
                            <a href="https://twitter.com/dlhkabprob" target="_blank"><i class="bi bi-twitter-x"></i></a>
                            <a href="https://wa.me/6281234567890" target="_blank"><i class="bi bi-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="qr-card h-100 d-flex flex-column align-items-center justify-content-center">
                        <div class="qr-label">Scan Kode QR</div>
                        <div class="qr-img-wrap">
                            <img src="{{ asset('images/qr_skm.png') }}" alt="QR DLH" onerror="this.src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=DLH+Kab+Probolinggo'">
                        </div>
                        <div class="qr-sub"><i class="bi bi-hand-index-thumb me-1"></i>Scan QR Portal Pelayanan</div>
                        <div style="font-size:.7rem;color:rgba(255,255,255,.3);margin-top:6px;">DLH Kab. Probolinggo</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand-box h-100">
                        <h5 class="footer-heading">Alamat Kantor</h5>
                        <div class="footer-contact-item"><i class="bi bi-geo-alt-fill"></i><span>{{ $address }}</span></div>
                        <div class="footer-contact-item"><i class="bi bi-telephone-fill"></i><span>{{ $phone }}</span></div>
                        <div class="footer-contact-item"><i class="bi bi-envelope-fill"></i><span>{{ $email }}</span></div>
                        <div class="footer-contact-item" style="margin-bottom:0;"><i class="bi bi-clock-fill"></i><span>{{ $workingHours }}</span></div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">Dinas Lingkungan Hidup Kab. Probolinggo &copy; {{ date('Y') }}. All Rights Reserved.</div>
        </div>
    </footer>

    <!-- ADMIN FAB -->
    <a href="{{ url('/admin') }}" class="admin-fab">
        <i class="bi bi-shield-lock-fill"></i>
        <span class="admin-fab-label">Portal Admin</span>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const nav = document.getElementById('mainNav');
        window.addEventListener('scroll', () => { nav.classList.toggle('scrolled', window.scrollY > 60); });
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.style.opacity='1'; e.target.style.transform='translateY(0)'; } });
        }, { threshold: 0.08 });
        document.querySelectorAll('.stat-card-p, .svc-card, .news-card, .bento-card, .mitra-card').forEach(el => {
            el.style.opacity='0'; el.style.transform='translateY(24px)';
            el.style.transition='opacity .55s ease, transform .55s ease';
            obs.observe(el);
        });

        /* ============================================================
           SISTEM SUARA GOOGLE CEWEK LEMBUT (AUDIO TTS DLH PROBOLINGGO)
           - Suara Google cewek asli yang lembut dan jernih
           - Anti-berantakan, bebas tabrakan/tumpuk suara
           - Sambutan awal masuk lembut dan ramah
           - Pengucapan menu & sub-menu yang rapi dan elegan
           ============================================================ */
        (function() {
            const toast = document.getElementById('dlhVoiceToast');
            const toastText = document.getElementById('dlhVoiceText');
            const voiceBtn = document.getElementById('dlhVoiceBtn');
            let currentAudio = null;
            let toastTimer = null;
            let lastSpeechTime = 0;

            function showToast(text) {
                if (!toast || !toastText) return;
                toastText.textContent = text;
                toast.classList.add('show');
                if (voiceBtn) voiceBtn.classList.add('speaking');
                clearTimeout(toastTimer);
                toastTimer = setTimeout(() => {
                    toast.classList.remove('show');
                    if (voiceBtn) voiceBtn.classList.remove('speaking');
                }, 3800);
            }

            function stopAllVoice() {
                if (currentAudio) {
                    try {
                        currentAudio.pause();
                        currentAudio.currentTime = 0;
                    } catch (e) {}
                    currentAudio = null;
                }
                if ('speechSynthesis' in window) {
                    try { window.speechSynthesis.cancel(); } catch (e) {}
                }
                if (toast) toast.classList.remove('show');
                if (voiceBtn) voiceBtn.classList.remove('speaking');
            }

            // Pemutar Suara Google Cewek yang Lembut & Natural (Studio Audio MP3 via Server Cache /audio-tts)
            function playGoogleVoice(text, onEnd) {
                if (!text) {
                    if (onEnd) onEnd();
                    return;
                }

                const now = Date.now();
                if (now - lastSpeechTime < 250) return; // Debounce anti-dobel klik
                lastSpeechTime = now;

                stopAllVoice();
                showToast(text);

                try {
                    const encoded = encodeURIComponent(text);
                    const audio = new Audio('/audio-tts?text=' + encoded);
                    currentAudio = audio;

                    let doneCalled = false;
                    const done = () => {
                        if (doneCalled) return;
                        doneCalled = true;
                        if (toast) toast.classList.remove('show');
                        if (voiceBtn) voiceBtn.classList.remove('speaking');
                        currentAudio = null;
                        if (onEnd) onEnd();
                    };

                    audio.onplay = () => {
                        if (voiceBtn) voiceBtn.classList.add('speaking');
                    };

                    audio.onended = done;
                    audio.onerror = done;

                    const promise = audio.play();
                    if (promise !== undefined) {
                        promise.catch(() => done());
                    }
                } catch (err) {
                    if (onEnd) onEnd();
                }
            }

            // Suara Sambutan Awal Masuk (Lembut & Hangat)
            const welcomeText = "Selamat datang di website resmi Dinas Lingkungan Hidup Kabupaten Probolinggo.";

            function playWelcomeOnce() {
                if (!sessionStorage.getItem('dlh_welcome_heard')) {
                    sessionStorage.setItem('dlh_welcome_heard', 'true');
                    playGoogleVoice(welcomeText);
                }
            }

            // Kebijakan Autoplay: Coba langsung, atau aktifkan pada interaksi pertama pengguna
            let interacted = false;
            function triggerFirstInteraction() {
                if (!interacted) {
                    interacted = true;
                    playWelcomeOnce();
                }
                window.removeEventListener('click', triggerFirstInteraction);
                window.removeEventListener('keydown', triggerFirstInteraction);
                window.removeEventListener('touchstart', triggerFirstInteraction);
            }

            // Upayakan play otomatis jika browser mengizinkan
            setTimeout(() => {
                playWelcomeOnce();
            }, 500);

            window.addEventListener('click', triggerFirstInteraction, { once: true });
            window.addEventListener('keydown', triggerFirstInteraction, { once: true });
            window.addEventListener('touchstart', triggerFirstInteraction, { once: true });

            // Tombol Floating: Putar ulang sambutan kapan saja
            if (voiceBtn) {
                voiceBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    playGoogleVoice(welcomeText);
                });
            }

            // Helper ekstraksi teks bersih dari elemen (tanpa ikon dan karakter liar)
            function getCleanText(el) {
                const clone = el.cloneNode(true);
                clone.querySelectorAll('i, svg, .dropdown-menu, .badge, .navbar-toggler-icon').forEach(n => n.remove());
                let txt = clone.textContent.replace(/[\n\r\t]+/g, ' ').replace(/\s+/g, ' ').trim();
                txt = txt.replace(/&/g, ' dan ');
                txt = txt.replace(/\bHOME\b/gi, 'Beranda');
                txt = txt.replace(/\(Tupoksi\)/gi, '');
                txt = txt.replace(/[\(\)\[\]\/\\_]/g, ' ');
                txt = txt.replace(/\s+/g, ' ').trim();
                return txt;
            }

            // Helper navigasi dengan suara Google yang jelas & merdu
            function navigateWithVoice(title, href, target) {
                if (href && href !== '#' && !href.startsWith('javascript:')) {
                    if (target === '_blank') {
                        playGoogleVoice(title);
                        return;
                    }
                    let navigated = false;
                    const proceed = () => {
                        if (!navigated) {
                            navigated = true;
                            window.location.href = href;
                        }
                    };
                    playGoogleVoice(title, proceed);
                    setTimeout(proceed, 650); // Jeda pengaman agar suara sempat berkumandang sebelum transisi halaman
                } else {
                    playGoogleVoice(title);
                }
            }

            // ==========================================
            // SUARA MENCET MENU DAN SUB MENU
            // ==========================================
            document.addEventListener('DOMContentLoaded', () => {
                // 1. Menu Utama Langsung (Beranda, Kontak)
                document.querySelectorAll('.navbar-main .nav-link:not(.dropdown-toggle), .navbar-main .nav-cta').forEach(link => {
                    link.addEventListener('click', function(e) {
                        const title = getCleanText(this);
                        if (!title) return;

                        const href = this.getAttribute('href');
                        const target = this.getAttribute('target');
                        if (href && href !== '#' && !href.startsWith('javascript:')) {
                            e.preventDefault();
                            navigateWithVoice(title, href, target);
                        } else {
                            playGoogleVoice(title);
                        }
                    });
                });

                // 2. Menu Utama yang Membuka Dropdown Sub-Menu (Profil, Layanan, Dokumen, Informasi)
                document.querySelectorAll('.navbar-main .dropdown-toggle').forEach(toggle => {
                    toggle.addEventListener('click', function() {
                        const title = getCleanText(this);
                        if (title) {
                            playGoogleVoice(title);
                        }
                    });
                });

                // 3. Sub-Menu (Item di dalam Dropdown)
                document.querySelectorAll('.dropdown-item-dlh, .navbar-main .dropdown-item').forEach(subItem => {
                    subItem.addEventListener('click', function(e) {
                        e.stopPropagation();
                        const title = getCleanText(this);
                        if (!title) return;

                        const href = this.getAttribute('href');
                        const target = this.getAttribute('target');

                        if (href && href !== '#' && !href.startsWith('javascript:')) {
                            if (target === '_blank') {
                                playGoogleVoice(title);
                            } else {
                                e.preventDefault();
                                navigateWithVoice(title, href, target);
                            }
                        } else {
                            playGoogleVoice(title);
                        }
                    });
                });
            });
        })();
    </script>
</body>
</html>