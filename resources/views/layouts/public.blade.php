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
            display: flex; align-items: center; gap: 12px;
            text-decoration: none;
        }
        .brand-logo-box {
            width: 46px; height: 46px;
            border-radius: 12px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--g700), var(--g950));
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 14px rgba(21,128,61,.3);
            flex-shrink: 0;
            transition: transform .3s, box-shadow .3s;
        }
        .brand-logo-wrap:hover .brand-logo-box {
            transform: scale(1.06) rotate(-2deg);
            box-shadow: 0 6px 20px rgba(21,128,61,.45);
        }
        .brand-logo-box img { width: 100%; height: 100%; object-fit: contain; padding: 4px; }
        .brand-logo-box .bi { font-size: 1.5rem; color: #fff; }
        .brand-text { display: flex; flex-direction: column; justify-content: center; }
        .brand-name {
            font-size: 1rem; font-weight: 800;
            color: var(--g900); line-height: 1.15;
            letter-spacing: -.4px;
        }
        .brand-divider {
            display: block; width: 100%; height: 1.5px;
            background: linear-gradient(90deg, var(--g500), transparent);
            margin: 2px 0;
            border-radius: 2px;
        }
        .brand-sub {
            font-size: .68rem; font-weight: 700;
            color: var(--g600); letter-spacing: .8px;
            text-transform: uppercase;
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

        /* Dropdown Premium Redesign (Minimalist) */
        .dropdown-menu-dlh {
            border: 1px solid rgba(0,0,0,0.06); 
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.01);
            padding: 8px; 
            min-width: 240px;
            animation: popIn .2s cubic-bezier(0.16, 1, 0.3, 1);
            background: #ffffff;
            margin-top: 8px;
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
            background: linear-gradient(180deg, rgba(255,255,255,.04) 0%, rgba(0,0,0,.25) 100%);
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 28px; padding: 36px 28px;
            display: flex; flex-direction: column; align-items: flex-start; gap: 20px;
            box-shadow: inset 0 2px 20px rgba(255,255,255,.02), 0 10px 30px rgba(0,0,0,.3);
            position: relative; overflow: hidden; height: 100%;
            transition: all .5s cubic-bezier(.175,.885,.32,1.275);
        }
        .stat-card-p::before {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(circle at 50% 0%, var(--stat-color), transparent 70%);
            opacity: 0.1; transition: opacity .5s; pointer-events: none;
        }
        .stat-card-p:hover { transform: translateY(-10px); border-color: rgba(255,255,255,.15); box-shadow: 0 30px 60px rgba(0,0,0,.6), inset 0 0 0 1px rgba(255,255,255,.05); }
        .stat-card-p:hover::before { opacity: 0.25; }
        .stat-card-top { position:absolute; top:0; left:0; right:0; height:4px; background:var(--stat-color); opacity:0.3; transition: opacity .5s; z-index:2; }
        .stat-card-p:hover .stat-card-top { opacity:1; box-shadow: 0 0 20px var(--stat-color); }
        .stat-bg-icon { position: absolute; right: -15px; bottom: -20px; font-size: 8rem; color: rgba(255,255,255,.02); z-index: 0; transform: rotate(-15deg); transition: all .6s cubic-bezier(.175,.885,.32,1.275); pointer-events: none; }
        .stat-card-p:hover .stat-bg-icon { color: rgba(255,255,255,.06); transform: rotate(0deg) scale(1.1); }
        
        .stat-icon-box {
            width: 64px; height: 64px; border-radius: 20px;
            display: flex; align-items: center; justify-content: center; font-size: 1.8rem;
            background: rgba(255,255,255,.05); color: #fff;
            border: 1px solid rgba(255,255,255,.1);
            backdrop-filter: blur(10px); position: relative; z-index: 1;
            transition: all .5s cubic-bezier(.175,.885,.32,1.275);
        }
        .stat-card-p:hover .stat-icon-box { transform: scale(1.15) rotate(8deg); background: var(--stat-color); border-color: transparent; color: #000; box-shadow: 0 10px 25px rgba(0,0,0,.5); }
        
        .stat-value { font-size: 2.8rem; font-weight: 900; color: #fff; line-height: 1; letter-spacing: -1.5px; margin-bottom: 6px; position:relative; z-index:1; }
        .stat-name { font-size: .95rem; color: rgba(255,255,255,.65); font-weight: 500; line-height: 1.4; position:relative; z-index:1; transition: color .4s; }
        .stat-card-p:hover .stat-name { color: #fff; }
        
        .stat-tag { font-size: .7rem; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase; padding: 6px 14px; border-radius: 100px; margin-top: auto; position:relative; z-index:1; background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.1); color: rgba(255,255,255,.8); transition: all .4s; }
        .stat-card-p:hover .stat-tag { background: var(--stat-color); color: #000; border-color: transparent; }

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
        .svc-card:hover { transform: translateY(-10px); border-color: rgba(251,191,36,.4); box-shadow: 0 30px 60px rgba(0,0,0,.6), inset 0 0 0 1px rgba(251,191,36,.15); }
        .svc-card-top { height: 4px; background: linear-gradient(90deg, rgba(255,255,255,.1), rgba(255,255,255,.02)); transition: all .4s; }
        .svc-card:hover .svc-card-top { background: linear-gradient(90deg, var(--g500), var(--amber)); }
        .svc-num { font-size: 7rem; font-weight: 900; color: rgba(255,255,255,.015); position: absolute; top: -10px; right: 0px; line-height: 1; user-select: none; pointer-events: none; letter-spacing: -6px; z-index: -1; transition: all .5s; }
        .svc-card:hover .svc-num { color: rgba(251,191,36,.04); transform: scale(1.1) translate(-10px, 10px); }
        .svc-icon-ring {
            width: 62px; height: 62px; border-radius: 18px;
            background: linear-gradient(135deg, rgba(255,255,255,.08), rgba(255,255,255,.01)); border: 1px solid rgba(255,255,255,.05);
            display: flex; align-items: center; justify-content: center; box-shadow: inset 0 2px 10px rgba(255,255,255,.05);
            font-size: 1.6rem; color: #fff; flex-shrink: 0; transition: all .5s cubic-bezier(.175,.885,.32,1.275);
        }
        .svc-card:hover .svc-icon-ring { transform: scale(1.15) rotate(-8deg); background: linear-gradient(135deg, var(--amber), #d97706); color: #000; box-shadow: 0 10px 25px rgba(251,191,36,.4); border-color: transparent; }
        .svc-tag { font-size: .68rem; font-weight: 800; color: rgba(255,255,255,.4); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 14px; transition: color .4s; }
        .svc-card:hover .svc-tag { color: var(--amber); }
        .svc-title { font-size: 1.1rem; font-weight: 800; color: #fff; line-height: 1.4; margin: 0; letter-spacing: -.3px; }
        .svc-desc { font-size: .85rem; color: rgba(255,255,255,.55); line-height: 1.7; flex-grow: 1; transition: color .4s; }
        .svc-card:hover .svc-desc { color: rgba(255,255,255,.75); }
        .svc-chip { font-size: .68rem; padding: 4px 12px; background: rgba(0,0,0,.2); border: 1px solid rgba(255,255,255,.05); border-radius: 100px; color: rgba(255,255,255,.6); white-space: nowrap; font-weight: 600; transition: all .4s; }
        .svc-card:hover .svc-chip { border-color: rgba(251,191,36,.2); color: rgba(255,255,255,.9); background: rgba(251,191,36,.05); }
        .svc-arrow-btn {
            width: 44px; height: 44px; border-radius: 50%;
            background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.08);
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,.6); text-decoration: none; flex-shrink: 0; transition: all .5s cubic-bezier(.175,.885,.32,1.275);
        }
        .svc-card:hover .svc-arrow-btn { background: var(--amber); color: #000; transform: translateX(8px); border-color: transparent; box-shadow: 0 8px 20px rgba(251,191,36,.3); }

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
            background: #fff; border: 1px solid rgba(22,163,74,.1); border-radius: 18px;
            width: 170px; height: 130px;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 10px; text-decoration: none;
            transition: all .3s cubic-bezier(.165,.84,.44,1);
            box-shadow: 0 1px 3px rgba(0,0,0,.05); flex-shrink: 0;
        }
        .mitra-card:hover { transform: translateY(-8px); box-shadow: 0 10px 32px rgba(0,0,0,.1); border-color: var(--g600); }
        .mitra-icon { width: 48px; height: 48px; border-radius: 12px; background: #f0fdf4; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; color: var(--g700); transition: all .3s; }
        .mitra-card:hover .mitra-icon { background: var(--g700); color: #fff; transform: scale(1.1); }
        .mitra-name { font-size: .78rem; font-weight: 700; color: var(--slate800); text-align: center; line-height: 1.3; }

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
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div style="width:50px;height:50px;background:linear-gradient(135deg,var(--g700),var(--g900));border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-tree-fill text-white fs-4"></i>
                            </div>
                            <div>
                                <div style="font-size:1rem;font-weight:800;color:#fff;line-height:1.2;">{{ $siteName }}</div>
                                <div style="font-size:.78rem;color:rgba(255,255,255,.45);">{{ $siteShortName }}</div>
                            </div>
                        </div>
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
                            <img src="http://127.0.0.1:8000/images/qr_skm.png" alt="QR DLH" onerror="this.src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=DLH+Kab+Probolinggo'">
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
    </script>
</body>
</html>