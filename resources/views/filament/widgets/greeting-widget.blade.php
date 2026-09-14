<x-filament-widgets::widget class="fi-transparent" style="background: transparent !important; box-shadow: none !important; border: none !important; padding: 0 !important; margin-bottom: 0.5rem !important;">
    <style>
        .dlh-hero {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            padding: 1.75rem 2rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            background: linear-gradient(135deg, #092612 0%, #0e351b 50%, #124022 100%);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.25), 0 4px 10px -2px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* ── Subtle background lighting ── */
        .dlh-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 500px 250px at 100% 0%, rgba(255, 255, 255, 0.03) 0%, transparent 70%),
                radial-gradient(ellipse 400px 300px at 0% 100%, rgba(22, 101, 52, 0.2) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ── Subtle decorative rings ── */
        .dlh-hero-ring {
            position: absolute;
            right: -90px;
            top: -90px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.04);
            pointer-events: none;
        }
        .dlh-hero-ring2 {
            position: absolute;
            right: -60px;
            top: -60px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.04);
            pointer-events: none;
        }

        /* ── Status pill ── */
        .dlh-hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 4px 14px;
            border-radius: 9999px;
            margin-bottom: 0.75rem;
        }
        .dlh-hero-pill span.live-dot {
            display: inline-block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #22c55e;
        }
        .dlh-hero-pill span.pill-text {
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #cbd5e1;
        }

        /* ── Heading ── */
        .dlh-hero h1 {
            font-size: 1.65rem;
            font-weight: 800;
            color: #ffffff;
            margin: 0;
            line-height: 1.25;
            letter-spacing: -0.01em;
        }
        .dlh-hero p.sub {
            font-size: 0.88rem;
            color: rgba(226, 232, 240, 0.82);
            margin: 0.45rem 0 0;
            line-height: 1.55;
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
            padding: 9px 18px;
            border-radius: 10px;
            font-size: 0.84rem;
            font-weight: 600;
            text-decoration: none !important;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .dlh-hero-btn.primary {
            background: #166534;
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }
        .dlh-hero-btn.primary:hover {
            background: #15803d;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        }
        .dlh-hero-btn.ghost {
            background: rgba(255, 255, 255, 0.08);
            color: #e2e8f0;
            border: 1px solid rgba(255, 255, 255, 0.12);
        }
        .dlh-hero-btn.ghost:hover {
            background: rgba(255, 255, 255, 0.16);
            color: #ffffff;
            transform: translateY(-2px);
        }
        .dlh-hero-btn.link {
            background: rgba(255, 255, 255, 0.05);
            color: #cbd5e1;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .dlh-hero-btn.link:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
            transform: translateY(-2px);
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
