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
                <li class="breadcrumb-item text-white-50">Dokumen</li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $activeTab['title'] ?? 'Dokumen Publik' }}</li>
            </ol>
        </nav>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill mb-3 subpage-pill-badge">
            <span class="subpage-pulse-beacon"></span>
            <i class="bi {{ $activeTab['icon'] ?? 'bi-folder-check' }} text-warning"></i>
            <span>Transparansi &amp; Keterbukaan Informasi Publik DLH</span>
        </div>
        <h1 class="fw-extrabold display-5 mb-2" style="font-weight: 800; letter-spacing: -0.5px;">
            {{ $activeTab['title'] ?? 'Pusat Dokumen &amp; Regulasi Resmi' }}
        </h1>
        <p class="text-white-75 mb-0" style="max-width: 720px; font-size: 1.02rem; line-height: 1.7;">
            {{ $activeTab['desc'] ?? 'Akses dan unduh berkas laporan kinerja instansi, rencana strategis, peraturan daerah, SK, dan standar operasional prosedur (SOP) Dinas Lingkungan Hidup Kabupaten Probolinggo.' }}
        </p>
    </div>
</section>

<!-- MAIN CONTENT -->
<div class="py-5" style="background: var(--slate50);">
    <div class="container">
        
        <!-- CATEGORY FILTER PILLS -->
        <div class="d-flex align-items-center gap-2 mb-4 overflow-x-auto pb-2 hide-scrollbar">
            @php
                $countAll = \App\Models\Document::count();
                $countKinerja = \App\Models\Document::where(function($q) {
                    $q->where('category', 'like', '%Kinerja%')
                      ->orWhere('category', 'like', '%Perencanaan%')
                      ->orWhere('category', 'like', '%Laporan%')
                      ->orWhere('category', 'like', '%Indikator%')
                      ->orWhere('category', 'like', '%Evaluasi%');
                })->count();
                $countRegulasi = \App\Models\Document::where(function($q) {
                    $q->where('category', 'like', '%Regulasi%')
                      ->orWhere('category', 'like', '%Operasional%')
                      ->orWhere('category', 'like', '%SOP%')
                      ->orWhere('category', 'like', '%Hukum%')
                      ->orWhere('category', 'like', '%Perda%');
                })->count();
            @endphp
            <a href="{{ url('/dokumen') }}" class="btn rounded-pill px-3.5 py-2 fw-bold d-inline-flex align-items-center gap-2 {{ $currentSlug === 'semua' ? 'btn-success text-white shadow-sm' : 'btn-white bg-white text-dark border' }}" style="font-size: 0.86rem;">
                <i class="bi bi-folder2-open"></i> Semua Dokumen
                <span class="badge {{ $currentSlug === 'semua' ? 'bg-white text-success' : 'bg-success bg-opacity-10 text-success' }} rounded-pill ms-1">{{ $countAll }}</span>
            </a>
            <a href="{{ url('/dokumen/kinerja') }}" class="btn rounded-pill px-3.5 py-2 fw-bold d-inline-flex align-items-center gap-2 {{ $currentSlug === 'kinerja' ? 'btn-success text-white shadow-sm' : 'btn-white bg-white text-dark border' }}" style="font-size: 0.86rem;">
                <i class="bi bi-journal-check"></i> Dokumen Kinerja
                <span class="badge {{ $currentSlug === 'kinerja' ? 'bg-white text-success' : 'bg-success bg-opacity-10 text-success' }} rounded-pill ms-1">{{ $countKinerja }}</span>
            </a>
            <a href="{{ url('/dokumen/regulasi') }}" class="btn rounded-pill px-3.5 py-2 fw-bold d-inline-flex align-items-center gap-2 {{ $currentSlug === 'regulasi' ? 'btn-success text-white shadow-sm' : 'btn-white bg-white text-dark border' }}" style="font-size: 0.86rem;">
                <i class="bi bi-file-earmark-ruled"></i> Regulasi &amp; SOP
                <span class="badge {{ $currentSlug === 'regulasi' ? 'bg-white text-success' : 'bg-success bg-opacity-10 text-success' }} rounded-pill ms-1">{{ $countRegulasi }}</span>
            </a>
        </div>

        <!-- STATUS / INFO & SEARCH BAR (Glassmorphism Style) -->
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4 p-3.5 rounded-4 subpage-toolbar-glass">
            <!-- Indicator -->
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-success text-white px-3.5 py-2 rounded-pill fw-bold shadow-xs" style="font-size: 0.82rem;">
                    <i class="bi {{ $activeTab['icon'] ?? 'bi-file-earmark-text' }} me-1.5"></i>
                    {{ $activeTab['title'] ?? 'Dokumen Publik' }}
                </span>
                <span class="text-muted small">
                    Tersedia <strong>{{ $documents->total() ?? $documents->count() }}</strong> berkas resmi
                </span>
            </div>

            <!-- Search Form with Glass Style -->
            <form action="{{ url()->current() }}" method="GET" class="d-flex gap-2" style="min-width: 290px;">
                <div class="input-group input-group-sm custom-search-group">
                    <span class="input-group-text bg-white border-end-0 text-success"><i class="bi bi-search"></i></span>
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control border-start-0 ps-0" placeholder="Cari judul berkas...">
                    <button class="btn btn-success fw-bold px-3 search-submit-btn" type="submit">Cari</button>
                </div>
            </form>
        </div>

        <!-- STATS STRIP -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="p-3.5 rounded-4 bg-white border d-flex align-items-center gap-3 shadow-xs hover-lift transition-all">
                    <div class="rounded-3 bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 1.4rem;">
                        <i class="bi bi-file-earmark-arrow-down-fill"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Berkas Publik</div>
                        <div class="fw-extrabold fs-5 text-dark">{{ $documents->total() ?? $documents->count() }} Dokumen</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3.5 rounded-4 bg-white border d-flex align-items-center gap-3 shadow-xs hover-lift transition-all">
                    <div class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 1.4rem;">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Status Verifikasi</div>
                        <div class="fw-extrabold fs-5 text-dark">Resmi &amp; Terverifikasi</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3.5 rounded-4 bg-white border d-flex align-items-center gap-3 shadow-xs hover-lift transition-all">
                    <div class="rounded-3 bg-warning bg-opacity-15 text-warning d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 1.4rem;">
                        <i class="bi bi-download"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Akses Berkas</div>
                        <div class="fw-extrabold fs-5 text-dark">Terbuka untuk Umum</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DOCUMENTS LIST TABLE -->
        <div class="bg-white rounded-4 shadow-sm border border-slate-200 overflow-hidden position-relative">
            <div class="card-accent-bar accent-green"></div>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light border-bottom">
                        <tr>
                            <th class="ps-4 py-3 text-muted small fw-bold" style="width: 50px;">#</th>
                            <th class="py-3 text-muted small fw-bold">NAMA DOKUMEN</th>
                            <th class="py-3 text-muted small fw-bold" style="width: 220px;">KATEGORI</th>
                            <th class="py-3 text-muted small fw-bold text-center" style="width: 140px;">DIUNDUH</th>
                            <th class="pe-4 py-3 text-muted small fw-bold text-end" style="width: 220px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($documents as $index => $doc)
                        <tr>
                            <td class="ps-4 text-muted small fw-semibold">
                                {{ ($documents instanceof \Illuminate\Pagination\LengthAwarePaginator) ? $documents->firstItem() + $index : $index + 1 }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3 py-2.5">
                                    <div class="rounded-3 bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center flex-shrink-0 shadow-xs" style="width: 44px; height: 44px; font-size: 1.35rem;">
                                        <i class="bi bi-file-earmark-pdf-fill"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.96rem;">{{ $doc->title }}</h6>
                                        <span class="text-muted small" style="font-size: 0.78rem;">
                                            <i class="bi bi-calendar3 me-1 text-success"></i> Diterbitkan: {{ $doc->created_at ? $doc->created_at->format('d M Y') : 'Tahun 2026' }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1.5 font-monospace fw-semibold" style="font-size: 0.76rem;">
                                    {{ $doc->category }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border px-2.5 py-1 rounded-pill small">
                                    <i class="bi bi-eye text-muted me-1"></i> {{ $doc->downloads ?? 0 }}x
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-inline-flex align-items-center justify-content-end gap-2">
                                    <button type="button" 
                                            class="btn btn-sm rounded-pill px-3 py-1.5 fw-bold shadow-xs d-inline-flex align-items-center gap-1.5 hover-scale text-white"
                                            style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); border: none;"
                                            onclick="openDocReaderModal({{ $doc->id }}, '{{ addslashes($doc->title) }}', '{{ addslashes($doc->category) }}', '{{ url('/dokumen/baca/' . $doc->id) }}', '{{ url('/dokumen/unduh/' . $doc->id) }}')"
                                            title="Baca {{ $doc->title }} langsung di website">
                                        <i class="bi bi-book-half"></i>
                                        <span>Baca</span>
                                    </button>
                                    <a href="{{ url('/dokumen/unduh/' . $doc->id) }}" 
                                       target="_blank"
                                       class="btn btn-sm btn-success rounded-pill px-3.5 py-1.5 fw-bold shadow-xs d-inline-flex align-items-center gap-1.5 hover-scale doc-download-btn"
                                       title="Unduh Berkas {{ $doc->title }}">
                                        <i class="bi bi-download download-icon-bounce"></i>
                                        <span>Unduh</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3 text-muted" style="width: 70px; height: 70px; font-size: 2.2rem;">
                                    <i class="bi bi-folder-x"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-1">Tidak ada berkas dokumen ditemukan</h5>
                                <p class="text-muted small mb-0">Coba gunakan kata kunci pencarian yang lain.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            @if($documents instanceof \Illuminate\Pagination\LengthAwarePaginator && $documents->hasPages())
            <div class="p-3.5 border-top d-flex justify-content-center">
                {{ $documents->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>

    </div>
</div>

<!-- MODAL BACA DOKUMEN LANGSUNG DI WEB -->
<div class="modal fade" id="modalBacaDokumen" tabindex="-1" aria-labelledby="modalBacaDokumenLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" style="max-width: 1020px; height: 92vh;">
        <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden" style="height: 100%;">
            <!-- Modal Header -->
            <div class="modal-header py-2.5 px-3 px-md-4 text-white d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #022c22 0%, #064e3b 100%); border: none;">
                <div class="d-flex align-items-center gap-2.5 overflow-hidden me-2">
                    <span class="rounded-pill bg-success bg-opacity-25 px-2.5 py-1 text-light small fw-bold font-monospace border border-success border-opacity-50 flex-shrink-0" id="modalDocCategory">
                        Dokumen
                    </span>
                    <h6 class="modal-title fw-bold text-white text-truncate mb-0" id="modalBacaDokumenLabel" style="font-size: 0.95rem;">
                        Membaca Dokumen
                    </h6>
                </div>
                <div class="d-flex align-items-center gap-2 flex-shrink-0">
                    <a id="btnModalOpenFull" href="#" target="_blank" class="btn btn-sm btn-outline-light rounded-pill px-3 py-1" style="font-size: 0.8rem;" title="Buka Dokumen di Tab Penuh">
                        <i class="bi bi-box-arrow-up-right me-1"></i> <span class="d-none d-sm-inline">Layar Penuh / Tab Baru</span>
                    </a>
                    <a id="btnModalDownload" href="#" target="_blank" class="btn btn-sm btn-success rounded-pill px-3.5 py-1 fw-bold shadow-xs" style="font-size: 0.8rem;" title="Unduh Berkas PDF">
                        <i class="bi bi-download me-1"></i> <span class="d-none d-sm-inline">Unduh PDF</span>
                    </a>
                    <button type="button" class="btn-close btn-close-white ms-1" data-bs-dismiss="modal" aria-label="Tutup" onclick="closeDocReaderModal()"></button>
                </div>
            </div>

            <!-- Modal Body (Iframe Reader) -->
            <div class="modal-body p-0 position-relative" style="background: #f1f5f9; height: calc(100% - 56px);">
                <!-- Direct Iframe Reader (No blocking overlay) -->
                <iframe id="iframeDocReader" src="" style="width: 100%; height: 100%; border: none; display: block;"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
function openDocReaderModal(id, title, category, readUrl, downloadUrl) {
    document.getElementById('modalBacaDokumenLabel').innerText = title;
    document.getElementById('modalDocCategory').innerText = category;
    document.getElementById('btnModalOpenFull').href = readUrl;
    document.getElementById('btnModalDownload').href = downloadUrl;

    const iframe = document.getElementById('iframeDocReader');
    iframe.src = readUrl + '?embed=1';

    const modalEl = document.getElementById('modalBacaDokumen');
    const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
    modal.show();
}

function closeDocReaderModal() {
    const iframe = document.getElementById('iframeDocReader');
    if (iframe) iframe.src = 'about:blank';
}

document.addEventListener('DOMContentLoaded', function() {
    const modalEl = document.getElementById('modalBacaDokumen');
    if (modalEl) {
        modalEl.addEventListener('hidden.bs.modal', function () {
            closeDocReaderModal();
        });
    }
});
</script>

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
    .custom-search-group {
        border-radius: 9999px;
        overflow: hidden;
        border: 1px solid rgba(22, 163, 74, 0.3);
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    }
    .custom-search-group input:focus {
        box-shadow: none;
    }
    .search-submit-btn {
        border-radius: 0 9999px 9999px 0 !important;
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
        box-shadow: 0 12px 28px rgba(0,0,0,0.07);
    }
    .hover-scale {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-scale:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(22, 163, 74, 0.3) !important;
    }
    .doc-download-btn:hover .download-icon-bounce {
        animation: bounceDown 0.6s infinite alternate;
    }
    @keyframes bounceDown {
        from { transform: translateY(0); }
        to { transform: translateY(3px); }
    }
    .hover-white:hover {
        color: #fff !important;
    }
</style>
@endsection
