<x-filament-widgets::widget class="fi-transparent" style="background: transparent !important; box-shadow: none !important; border: none !important; padding: 0 !important;">
    <style>
        .dlh-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1rem;
            width: 100%;
        }
        @media (max-width: 760px) { .dlh-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 480px) { .dlh-grid { grid-template-columns: 1fr; } }

        /* ── Card ── */
        .sc {
            position: relative;
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.2rem 1.3rem;
            text-decoration: none !important;
            cursor: pointer;
            overflow: hidden;
            box-shadow: 0 1px 6px rgba(15,23,42,0.06), 0 4px 16px rgba(15,23,42,0.04);
            transition: transform 0.28s cubic-bezier(0.34,1.56,0.64,1),
                        box-shadow 0.28s ease,
                        border-color 0.28s ease;
        }
        .sc:hover {
            transform: translateY(-4px);
        }
        .sc.c1:hover { box-shadow: 0 12px 28px rgba(37,99,235,0.14);  border-color: #bfdbfe; }
        .sc.c2:hover { box-shadow: 0 12px 28px rgba(5,150,105,0.14);  border-color: #6ee7b7; }
        .sc.c3:hover { box-shadow: 0 12px 28px rgba(124,58,237,0.14); border-color: #ddd6fe; }
        .sc.c4:hover { box-shadow: 0 12px 28px rgba(217,119,6,0.14);  border-color: #fde68a; }

        /* Top accent bar */
        .sc::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            border-radius: 16px 16px 0 0;
        }
        .sc.c1::before { background: linear-gradient(90deg,#2563eb,#60a5fa); }
        .sc.c2::before { background: linear-gradient(90deg,#059669,#34d399); }
        .sc.c3::before { background: linear-gradient(90deg,#7c3aed,#a78bfa); }
        .sc.c4::before { background: linear-gradient(90deg,#d97706,#fbbf24); }

        /* ── Icon ── */
        .sc-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1);
        }
        .sc:hover .sc-icon { transform: scale(1.1) rotate(-5deg); }

        .sc.c1 .sc-icon { background: #eff6ff; color: #2563eb; }
        .sc.c2 .sc-icon { background: #ecfdf5; color: #059669; }
        .sc.c3 .sc-icon { background: #f5f3ff; color: #7c3aed; }
        .sc.c4 .sc-icon { background: #fffbeb; color: #d97706; }

        /* ── Text ── */
        .sc-text { display: flex; flex-direction: column; gap: 0.1rem; min-width: 0; }

        .sc-label {
            font-size: 0.76rem;
            font-weight: 600;
            color: #94a3b8;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .sc-num {
            font-size: 2rem;
            font-weight: 900;
            line-height: 1;
            letter-spacing: -0.04em;
            font-variant-numeric: tabular-nums;
            color: #0f172a;
            margin: 0.2rem 0 0.1rem;
            transition: color 0.25s ease;
        }
        .sc.c1:hover .sc-num { color: #2563eb; }
        .sc.c2:hover .sc-num { color: #059669; }
        .sc.c3:hover .sc-num { color: #7c3aed; }
        .sc.c4:hover .sc-num { color: #d97706; }

        .sc-sub {
            font-size: 0.72rem;
            color: #cbd5e1;
            margin: 0;
            white-space: nowrap;
        }
    </style>

    <div class="dlh-grid">

        @if($role === 'operator')
            {{-- Operator Card 1 · Layanan Publik --}}
            <a href="/admin/services" class="sc c2">
                <div class="sc-icon">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.9" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3"/>
                    </svg>
                </div>
                <div class="sc-text">
                    <p class="sc-label">Layanan Publik</p>
                    <p class="sc-num">{{ $servicesCount }}</p>
                    <p class="sc-sub">Data & Alur Pelayanan</p>
                </div>
            </a>

            {{-- Operator Card 2 · Akses Cepat --}}
            <a href="/admin/quick-accesses" class="sc c1">
                <div class="sc-icon">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.9" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 6.257L6.166 4.666M6 10.5H3.75"/>
                    </svg>
                </div>
                <div class="sc-text">
                    <p class="sc-label">Pintasan Akses Cepat</p>
                    <p class="sc-num">{{ $quickAccessCount }}</p>
                    <p class="sc-sub">Tombol Menu Pintas</p>
                </div>
            </a>

            {{-- Operator Card 3 · Statistik Lingkungan --}}
            <a href="/admin/statistics" class="sc c3">
                <div class="sc-icon">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.9" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                    </svg>
                </div>
                <div class="sc-text">
                    <p class="sc-label">Data Statistik</p>
                    <p class="sc-num">{{ $statisticsCount }}</p>
                    <p class="sc-sub">Indikator Capaian</p>
                </div>
            </a>

            {{-- Operator Card 4 · Pengaduan Masuk --}}
            <div class="sc c4" style="cursor:default;">
                <div class="sc-icon">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.9" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                    </svg>
                </div>
                <div class="sc-text">
                    <p class="sc-label">Pengaduan Masuk</p>
                    <p class="sc-num">{{ $reportsCount }}</p>
                    <p class="sc-sub">Aspirasi Warga</p>
                </div>
            </div>
        @else
            {{-- 1 · Dokumen Kinerja --}}
            <a href="/admin/documents" class="sc c1">
                <div class="sc-icon">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.9" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                </div>
                <div class="sc-text">
                    <p class="sc-label">Dokumen Kinerja</p>
                    <p class="sc-num">{{ $documentsCount }}</p>
                    <p class="sc-sub">Renstra · LAKIP · SOP</p>
                </div>
            </a>

            {{-- 2 · Total Berita --}}
            <a href="/admin/posts" class="sc c2">
                <div class="sc-icon">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.9" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-5.25 3h9m-9 3h9m-9-9h.008v.008H6.75V7.5zm0 3h.008v.008H6.75V10.5zm0 3h.008v.008H6.75V13.5zM12.75 3v18H20.25c.828 0 1.5-.672 1.5-1.5V4.5c0-.828-.672-1.5-1.5-1.5h-7.5zm-6 0v18H3.75C2.922 21 2.25 20.328 2.25 19.5V4.5C2.25 3.672 2.922 3 3.75 3h3z"/>
                    </svg>
                </div>
                <div class="sc-text">
                    <p class="sc-label">Total Berita</p>
                    <p class="sc-num">{{ $postsCount }}</p>
                    <p class="sc-sub">Artikel · Siaran Pers</p>
                </div>
            </a>

            {{-- 3 · Galeri Foto --}}
            <a href="/admin/galleries" class="sc c3">
                <div class="sc-icon">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.9" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                    </svg>
                </div>
                <div class="sc-text">
                    <p class="sc-label">Galeri Foto</p>
                    <p class="sc-num">{{ $galleriesCount }}</p>
                    <p class="sc-sub">Album · Dokumentasi</p>
                </div>
            </a>

            {{-- 4 · Pengaduan Masuk --}}
            <div class="sc c4" style="cursor:default;">
                <div class="sc-icon">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.9" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                    </svg>
                </div>
                <div class="sc-text">
                    <p class="sc-label">Pengaduan Masuk</p>
                    <p class="sc-num">{{ $reportsCount }}</p>
                    <p class="sc-sub">Aspirasi Warga</p>
                </div>
            </div>
        @endif

    </div>
</x-filament-widgets::widget>
