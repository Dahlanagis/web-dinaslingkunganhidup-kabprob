<x-filament-widgets::widget class="fi-transparent" style="background: transparent !important; box-shadow: none !important; border: none !important; padding: 0 !important; margin-bottom: 0.5rem !important;">
    <style>
        .dlh-hero {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            padding: 2rem 2.25rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            background: linear-gradient(135deg, #052e16 0%, #14532d 40%, #166534 70%, #15803d 100%);
            box-shadow: 0 16px 40px -8px rgba(5,46,22,0.5), 0 4px 12px rgba(5,46,22,0.25);
            border: 1px solid rgba(74,222,128,0.2);
        }

        /* ── Animated mesh gradient backdrop ── */
        .dlh-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 600px 300px at 110% -20%, rgba(74,222,128,0.22) 0%, transparent 60%),
                radial-gradient(ellipse 400px 400px at -10% 120%, rgba(16,185,129,0.18) 0%, transparent 60%),
                radial-gradient(ellipse 300px 200px at 60% 120%, rgba(52,211,153,0.12) 0%, transparent 60%);
            pointer-events: none;
            animation: dlhMeshShift 8s ease-in-out infinite alternate;
        }
        @keyframes dlhMeshShift {
            0%   { opacity: 0.85; }
            100% { opacity: 1; }
        }

        /* ── Decorative ring ── */
        .dlh-hero-ring {
            position: absolute;
            right: -90px;
            top: -90px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            border: 50px solid rgba(74,222,128,0.08);
            pointer-events: none;
        }
        .dlh-hero-ring2 {
            position: absolute;
            right: -60px;
            top: -60px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 30px solid rgba(74,222,128,0.1);
            pointer-events: none;
        }

        /* ── Status pill ── */
        .dlh-hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.18);
            padding: 4px 14px;
            border-radius: 9999px;
            backdrop-filter: blur(12px);
            margin-bottom: 0.85rem;
        }
        .dlh-hero-pill span.live-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #4ade80;
            box-shadow: 0 0 8px #4ade80;
            animation: dlhHeroPulse 2s ease-in-out infinite;
        }
        @keyframes dlhHeroPulse {
            0%, 100% { box-shadow: 0 0 6px #4ade80; opacity: 0.85; }
            50%       { box-shadow: 0 0 14px #4ade80; opacity: 1; }
        }
        .dlh-hero-pill span.pill-text {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #bbf7d0;
        }

        /* ── Heading ── */
        .dlh-hero h1 {
            font-size: 1.75rem;
            font-weight: 900;
            color: #ffffff;
            margin: 0;
            line-height: 1.2;
            letter-spacing: -0.02em;
            text-shadow: 0 2px 16px rgba(0,0,0,0.2);
        }
        .dlh-hero p.sub {
            font-size: 0.88rem;
            color: rgba(203,213,225,0.9);
            margin: 0.5rem 0 0;
            line-height: 1.6;
            max-width: 580px;
        }

        /* ── Quick Actions ── */
        .dlh-hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.65rem;
            align-items: center;
            position: relative;
            z-index: 2;
        }
        .dlh-hero-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 20px;
            border-radius: 12px;
            font-size: 0.84rem;
            font-weight: 700;
            text-decoration: none !important;
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            white-space: nowrap;
        }
        .dlh-hero-btn.primary {
            background: #22c55e;
            color: #052e16;
            box-shadow: 0 4px 16px rgba(34,197,94,0.4);
        }
        .dlh-hero-btn.primary:hover {
            background: #16a34a;
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(22,163,74,0.5);
        }
        .dlh-hero-btn.ghost {
            background: rgba(255,255,255,0.1);
            color: #ffffff;
            border: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(8px);
        }
        .dlh-hero-btn.ghost:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        .dlh-hero-btn.link {
            background: rgba(134,239,172,0.12);
            color: #86efac;
            border: 1px solid rgba(134,239,172,0.22);
        }
        .dlh-hero-btn.link:hover {
            background: rgba(134,239,172,0.22);
            transform: translateY(-3px);
        }
    </style>

    <div class="dlh-hero">
        <div class="dlh-hero-ring"></div>
        <div class="dlh-hero-ring2"></div>

        <div style="position:relative; z-index:2;">
            <div class="dlh-hero-pill">
                <span class="live-dot"></span>
                <span class="pill-text">Portal DLH Kab. Probolinggo &bull; {{ $currentDate }}</span>
            </div>
            <h1>Selamat Datang, {{ auth()->user()?->name ?? 'Super Admin DLH' }} 👋</h1>
            <p class="sub">Pusat kendali informasi publik, dokumen transparansi kinerja, dan pengelolaan layanan lingkungan hidup terpadu.</p>
        </div>

        <div class="dlh-hero-actions">
            <a href="/admin/posts/create" class="dlh-hero-btn primary">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Tulis Berita
            </a>
            <a href="/admin/documents/create" class="dlh-hero-btn ghost">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                Unggah Dokumen
            </a>
            <a href="/" target="_blank" class="dlh-hero-btn link">
                Web Publik
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/></svg>
            </a>
        </div>
    </div>
</x-filament-widgets::widget>
