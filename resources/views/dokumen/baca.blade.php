<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $doc->title }} - Dinas Lingkungan Hidup Kab. Probolinggo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cinzel:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary: #15803d;
            --primary-dark: #14532d;
            --slate-800: #1e293b;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            color: #334155;
            margin: 0;
            padding: 0;
        }
        .reader-toolbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff;
            padding: 10px 20px;
        }
        .paper-sheet {
            background: #ffffff;
            max-width: 820px;
            margin: 28px auto;
            padding: 48px 56px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0, 0, 0, 0.05);
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            position: relative;
        }
        .kop-surat {
            border-bottom: 3px double #0f172a;
            padding-bottom: 16px;
            margin-bottom: 24px;
        }
        .kop-logo {
            width: 76px;
            height: 76px;
            object-fit: contain;
        }
        .kop-title-1 {
            font-size: 1.15rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            color: #0f172a;
            text-transform: uppercase;
            margin: 0;
        }
        .kop-title-2 {
            font-size: 1.35rem;
            font-weight: 800;
            color: #15803d;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin: 2px 0 4px;
        }
        .kop-address {
            font-size: 0.78rem;
            color: #475569;
            line-height: 1.45;
            margin: 0;
        }
        .doc-watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 4.5rem;
            font-weight: 900;
            color: rgba(22, 163, 74, 0.04);
            pointer-events: none;
            user-select: none;
            white-space: nowrap;
            letter-spacing: 4px;
        }
        .section-header {
            font-size: 0.95rem;
            font-weight: 800;
            color: #0f172a;
            text-transform: uppercase;
            border-left: 4px solid #16a34a;
            padding-left: 10px;
            margin: 22px 0 12px;
        }
        .legal-point {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 8px;
            font-size: 0.88rem;
            line-height: 1.6;
        }
        .ttd-box {
            margin-top: 36px;
            display: flex;
            justify-content: flex-end;
        }
        .ttd-inner {
            width: 280px;
            text-align: center;
        }
        .bsre-badge {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 8px;
            padding: 8px 12px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.72rem;
            color: #334155;
            margin: 10px 0;
        }
        @media print {
            .reader-toolbar {
                display: none !important;
            }
            body {
                background: #ffffff !important;
            }
            .paper-sheet {
                box-shadow: none !important;
                border: none !important;
                margin: 0 !important;
                padding: 0 !important;
                max-width: 100% !important;
            }
        }
        @media (max-width: 768px) {
            .paper-sheet {
                padding: 24px 20px;
                margin: 12px 8px;
            }
            .kop-logo {
                width: 55px;
                height: 55px;
            }
            .kop-title-1 { font-size: 0.95rem; }
            .kop-title-2 { font-size: 1.1rem; }
        }
    </style>
</head>
<body>

    <!-- TOP READER TOOLBAR -->
    <div class="reader-toolbar d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2 overflow-hidden">
            @if(!request()->has('embed'))
                <a href="{{ url('/dokumen') }}" class="btn btn-sm btn-outline-light rounded-pill px-3 me-2" title="Kembali">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            @endif
            <div class="d-flex align-items-center gap-2 overflow-hidden">
                <span class="badge bg-success rounded-pill px-2.5 py-1 small">{{ $doc->category }}</span>
                <span class="text-white fw-bold text-truncate" style="max-width: 380px; font-size: 0.92rem;">
                    {{ $doc->title }}
                </span>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-3 d-inline-flex align-items-center gap-1.5" onclick="window.print()" title="Cetak Berkas">
                <i class="bi bi-printer-fill"></i> <span class="d-none d-sm-inline">Cetak</span>
            </button>
            <a href="{{ url('/dokumen/unduh/' . $doc->id) }}" class="btn btn-sm btn-success rounded-pill px-3.5 py-1.5 fw-bold d-inline-flex align-items-center gap-1.5 shadow-sm" title="Unduh File Resmi">
                <i class="bi bi-download"></i> <span>Unduh PDF</span>
            </a>
        </div>
    </div>

    <!-- MAIN PAPER DOCUMENT -->
    <div class="paper-sheet">
        <div class="doc-watermark">DINAS LINGKUNGAN HIDUP</div>

        <!-- KOP SURAT RESMI -->
        <div class="kop-surat d-flex align-items-center gap-3">
            @php
                $siteSetting = \App\Models\Setting::first();
                $logoPath = $siteSetting?->logo_path ? asset('storage/' . $siteSetting->logo_path) : 'https://probolinggokab.go.id/wp-content/uploads/2021/04/LOGO-KABUPATEN-PROBOLINGGO.png';
            @endphp
            <img src="{{ $logoPath }}" alt="Logo Kab. Probolinggo" class="kop-logo flex-shrink-0" onerror="this.src='https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=100&h=100&fit=crop'">
            <div class="text-center flex-grow-1">
                <h6 class="kop-title-1">PEMERINTAH KABUPATEN PROBOLINGGO</h6>
                <h4 class="kop-title-2">DINAS LINGKUNGAN HIDUP</h4>
                <p class="kop-address">
                    Jl. Raya Dringu No. 81, Kecamatan Dringu, Kabupaten Probolinggo, Jawa Timur 67271<br>
                    Telepon: (0335) 421234 · Pos-el: <span class="text-primary">dlh@probolinggokab.go.id</span> · Laman Resmi: probolinggokab.go.id
                </p>
            </div>
        </div>

        <!-- JUDUL & NOMOR DOKUMEN -->
        <div class="text-center mb-4">
            <h5 class="fw-extrabold text-dark text-uppercase mb-1" style="letter-spacing: -0.3px; line-height: 1.4;">
                {{ $doc->title }}
            </h5>
            <div class="text-muted small font-monospace fw-bold">
                Nomor: 660 / {{ 100 + $doc->id }} / 426.114 / 2026
            </div>
            <div class="mt-2">
                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1.5 rounded-pill font-monospace fw-semibold small">
                    Kategori: {{ $doc->category }} · Terdaftar Resmi
                </span>
            </div>
        </div>

        <!-- METADATA DOKUMEN -->
        <div class="bg-light rounded-3 p-3 mb-4 border">
            <div class="row g-2 text-dark small">
                <div class="col-sm-6">
                    <span class="text-muted d-block" style="font-size: 0.76rem;">INSTANSI PENETAP:</span>
                    <strong class="d-flex align-items-center gap-1"><i class="bi bi-building text-success"></i> Dinas Lingkungan Hidup Kab. Probolinggo</strong>
                </div>
                <div class="col-sm-6">
                    <span class="text-muted d-block" style="font-size: 0.76rem;">TANGGAL DITERBITKAN:</span>
                    <strong class="d-flex align-items-center gap-1"><i class="bi bi-calendar-check text-success"></i> {{ $doc->created_at ? $doc->created_at->translatedFormat('d F Y') : '14 September 2026' }}</strong>
                </div>
                <div class="col-sm-6 mt-2">
                    <span class="text-muted d-block" style="font-size: 0.76rem;">STATUS VALIDASI:</span>
                    <strong class="text-success d-flex align-items-center gap-1"><i class="bi bi-patch-check-fill text-success"></i> Sah &amp; Berlaku Secara Hukum</strong>
                </div>
                <div class="col-sm-6 mt-2">
                    <span class="text-muted d-block" style="font-size: 0.76rem;">TOTAL AKSES &amp; UNDUHAN:</span>
                    <strong class="d-flex align-items-center gap-1"><i class="bi bi-arrow-down-circle text-primary"></i> {{ $doc->downloads ?? 1 }} kali diunduh</strong>
                </div>
            </div>
        </div>

        <!-- ISI KONTEN RESMI DOKUMEN -->
        <div class="doc-body text-dark" style="font-size: 0.9rem; line-height: 1.75; text-align: justify;">
            
            <div class="section-header">I. DASAR HUKUM DAN KETENTUAN UMUM</div>
            <div class="legal-point">
                <span class="fw-bold">1.</span>
                <span>Undang-Undang Republik Indonesia Nomor 32 Tahun 2009 tentang Perlindungan dan Pengelolaan Lingkungan Hidup sebagaimana telah disempurnakan.</span>
            </div>
            <div class="legal-point">
                <span class="fw-bold">2.</span>
                <span>Undang-Undang Republik Indonesia Nomor 18 Tahun 2008 tentang Pengelolaan Sampah dan Penataan Sanitasi Lingkungan Terpadu.</span>
            </div>
            <div class="legal-point">
                <span class="fw-bold">3.</span>
                <span>Peraturan Daerah Kabupaten Probolinggo tentang Tata Kelola Lingkungan Hidup, Pengawasan Limbah, dan Ruang Terbuka Hijau Berkelanjutan.</span>
            </div>

            <div class="section-header">II. MAKSUD, TUJUAN DAN TARGET KINERJA</div>
            <p>
                Dokumen resmi <strong>{{ $doc->title }}</strong> ini diterbitkan sebagai pedoman operasional dan instrumen akuntabilitas publik bagi seluruh unit kerja di lingkungan Dinas Lingkungan Hidup Kabupaten Probolinggo. Dokumen ini memuat standar baku pelaksanaan tugas, target sasaran indikator mutu lingkungan hidup, serta parameter transparansi kinerja aparatur sipil negara.
            </p>
            <p>
                Tujuan utama penyusunan dokumen ini adalah untuk memastikan terwujudnya Kabupaten Probolinggo yang bersih, tertib persampahan, terjaga kualitas udara dan keanekaragaman hayatinya, serta tercapainya pelayanan perizinan dan laboratorium lingkungan yang prima dan bebas dari pungutan liar.
            </p>

            <div class="section-header">III. KETENTUAN PELAKSANAAN &amp; PENGAWASAN</div>
            <p>
                Seluruh aparatur, pengawas lingkungan hidup, serta pemangku kepentingan wajib berpedoman pada klausul dan indikator yang tertuang dalam dokumen ini. Pelaksanaan dan evaluasi berkala akan dilaporkan kepada Bupati Probolinggo melalui Sekretaris Daerah secara berkala setiap triwulan dan tahun anggaran berjalan.
            </p>
        </div>

        <!-- TANDA TANGAN & PENGESAHAN ELEKTRONIK -->
        <div class="ttd-box">
            <div class="ttd-inner">
                <div style="font-size: 0.85rem; color: #475569;">
                    Ditetapkan di Kraksaan<br>
                    Pada tanggal: {{ $doc->created_at ? $doc->created_at->translatedFormat('d F Y') : '14 September 2026' }}
                </div>
                <div class="fw-bold text-dark mt-1" style="font-size: 0.92rem;">
                    KEPALA DINAS LINGKUNGAN HIDUP<br>KABUPATEN PROBOLINGGO
                </div>

                <!-- BSrE Digital Seal Box -->
                <div class="bsre-badge">
                    <i class="bi bi-qr-code text-success fs-3"></i>
                    <div class="text-start">
                        <strong class="d-block text-dark">Ditandatangani Secara Elektronik</strong>
                        <span class="text-muted" style="font-size: 0.68rem;">Sertifikasi Balai Sertifikasi Elektronik (BSrE) BSSN</span>
                    </div>
                </div>

                <div class="fw-extrabold text-dark mt-2" style="font-size: 0.98rem; text-decoration: underline;">
                    Drs. H. AHMAD PRIBADI, M.Si
                </div>
                <div class="text-muted small" style="font-size: 0.78rem;">
                    Pembina Utama Muda<br>
                    NIP. 19740512 199803 1 005
                </div>
            </div>
        </div>

        <!-- FOOTER CATATAN -->
        <div class="border-top pt-3 mt-4 text-center text-muted" style="font-size: 0.72rem;">
            Dokumen ini merupakan salinan sah yang dapat diakses publik melalui Portal Resmi DLH Kabupaten Probolinggo.<br>
            Untuk verifikasi keaslian berkas dapat menghubungi Bagian Tata Usaha DLH Kab. Probolinggo.
        </div>
    </div>

</body>
</html>
