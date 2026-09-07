<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        \Filament\Support\Facades\FilamentView::registerRenderHook(
            'panels::head.end',
            fn (): string => '<style>
                /* ===== SIDEBAR BASE (Dark Green matching Login) ===== */
                .fi-sidebar,
                .fi-sidebar-header,
                aside.fi-sidebar,
                aside.fi-sidebar > * {
                    background-color: #092612 !important;
                }
                .fi-sidebar {
                    border-right: 1px solid rgba(255, 255, 255, 0.05) !important;
                }
                
                /* Layout Desktop: Pinned Green Sidebar reaching top=0 and Topbar/Main offset */
                @media (min-width: 1024px) {
                    aside.fi-sidebar,
                    #fi-main-sidebar {
                        position: fixed !important;
                        top: 0 !important;
                        bottom: 0 !important;
                        left: 0 !important;
                        height: 100vh !important;
                        width: 17.5rem !important;
                        z-index: 40 !important;
                        background-color: #092612 !important;
                    }
                    /* Only shift the outer container, not both! */
                    .fi-topbar-ctn {
                        margin-left: 17.5rem !important;
                        width: calc(100% - 17.5rem) !important;
                    }
                    .fi-topbar {
                        margin-left: 0 !important;
                        width: 100% !important;
                    }
                    /* Shift Main Content container so it is NOT hidden underneath sidebar */
                    .fi-main-ctn {
                        margin-left: 17.5rem !important;
                        width: calc(100% - 17.5rem) !important;
                    }
                }
                
                /* Hide default sidebar header so profile starts at the very top */
                .fi-sidebar-header-ctn,
                .fi-sidebar-header {
                    display: none !important;
                }
                
                /* Hide ugly scrollbar in sidebar on all browsers */
                .fi-sidebar,
                .fi-sidebar-nav,
                .fi-sidebar-nav-groups,
                aside.fi-sidebar,
                aside.fi-sidebar * {
                    scrollbar-width: none !important;
                    -ms-overflow-style: none !important;
                }
                .fi-sidebar::-webkit-scrollbar,
                .fi-sidebar-nav::-webkit-scrollbar,
                .fi-sidebar *::-webkit-scrollbar {
                    display: none !important;
                    width: 0 !important;
                    height: 0 !important;
                }
                
                /* Sidebar Group Labels */
                .fi-sidebar-group-label {
                    color: #86efac !important;
                    font-weight: 800 !important;
                    font-size: 0.72rem !important;
                    text-transform: uppercase;
                    letter-spacing: 0.08em;
                    margin-top: 1.2rem;
                    margin-bottom: 0.4rem;
                    padding-left: 12px !important;
                }
                
                /* Sidebar Items Base */
                .fi-sidebar-item-btn {
                    border-radius: 0.6rem !important;
                    margin: 3px 8px !important;
                    padding: 9px 12px !important;
                    transition: all 0.2s ease !important;
                    background-color: transparent !important;
                    display: flex !important;
                    align-items: center !important;
                    gap: 10px !important;
                }
                .fi-sidebar-item-btn:hover {
                    background-color: rgba(255, 255, 255, 0.08) !important;
                }
                .fi-sidebar-item-btn .fi-sidebar-item-label {
                    color: #bbf7d0 !important;
                    font-weight: 600 !important;
                    font-size: 0.88rem !important;
                    white-space: nowrap !important;
                    overflow: hidden !important;
                    text-overflow: ellipsis !important;
                }
                .fi-sidebar-item-btn .fi-sidebar-item-icon {
                    color: #86efac !important;
                    flex-shrink: 0 !important;
                }
                
                /* Active Sidebar Item - Dark Green Pill with Left Glowing Bar */
                .fi-sidebar-item.fi-active > .fi-sidebar-item-btn,
                .fi-active .fi-sidebar-item-btn {
                    background-color: #133e1f !important;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35) !important;
                    position: relative !important;
                    border-left: 3px solid #4ade80 !important;
                    border-radius: 0.6rem !important;
                }
                .fi-sidebar-item.fi-active > .fi-sidebar-item-btn .fi-sidebar-item-label,
                .fi-active .fi-sidebar-item-btn .fi-sidebar-item-label {
                    color: #ffffff !important;
                    font-weight: 700 !important;
                }
                .fi-sidebar-item.fi-active > .fi-sidebar-item-btn .fi-sidebar-item-icon,
                .fi-active .fi-sidebar-item-btn .fi-sidebar-item-icon,
                .fi-sidebar-item.fi-active > .fi-sidebar-item-btn svg,
                .fi-active .fi-sidebar-item-btn svg {
                    color: #ffffff !important;
                }
                
                /* Specific Item Icons */
                a[href*="/admin/posts"] .fi-sidebar-item-icon,
                a[href*="/admin/documents"] .fi-sidebar-item-icon,
                a[href*="/admin/galleries"] .fi-sidebar-item-icon,
                .fi-sidebar-group button[x-on\:click*="Kelola Konten"] .fi-sidebar-item-icon,
                button[x-on\:click*="Kelola Konten"] svg {
                    color: #f59e0b !important;
                }
                a[href*="/admin/activity-logs"] .fi-sidebar-item-icon,
                a[href*="/admin/activity-logs"] svg {
                    color: #38bdf8 !important;
                }
                a[href*="/admin/navigations"] .fi-sidebar-item-icon,
                a[href*="/admin/navigations"] svg {
                    color: #34d399 !important;
                }
                a[href*="/admin/settings"] .fi-sidebar-item-icon,
                a[href*="/admin/settings"] svg {
                    color: #a855f7 !important;
                }
                a[href*="/admin/users"] .fi-sidebar-item-icon,
                a[href*="/admin/users"] svg {
                    color: #ec4899 !important;
                }
                a[href*="logout"] .fi-sidebar-item-icon,
                a[href*="logout"] svg,
                a[href*="logout"] .fi-sidebar-item-label {
                    color: #ef4444 !important;
                }
                
                /* ===== MAIN BODY ===== */
                .fi-main {
                    background-color: #f1f5f9 !important;
                }
                
                /* ===== TOPBAR ===== */
                .fi-topbar {
                    background-color: #ffffff !important;
                    border-bottom: 1px solid #e2e8f0 !important;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.05) !important;
                    height: 64px !important;
                    padding-left: 1rem !important;
                    padding-right: 1.5rem !important;
                }
                
                /* Move search field next to Tambah button and remove empty space */
                .fi-ta {
                    position: relative !important;
                }
                
                /* ===== MODAL & VIEW STYLING ===== */
                .fi-modal-window {
                    border-radius: 20px !important;
                    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
                    border: 1px solid #e2e8f0 !important;
                    overflow: hidden !important;
                }
                .fi-modal-header {
                    background: linear-gradient(to right, #f8fafc, #ffffff) !important;
                    border-bottom: 1px solid #f1f5f9 !important;
                    padding: 24px !important;
                }
                /* End Modal Styling */
                
                /* Hide default page header */
                .fi-header {
                    display: none !important;
                }
                
                /* Hide brand text, breadcrumbs, and stray chevron in topbar */
                .fi-topbar .fi-logo,
                .fi-topbar .fi-breadcrumbs,
                .fi-topbar-collapse-sidebar-btn-ctn,
                .fi-topbar-open-collapse-sidebar-btn,
                .fi-topbar-close-collapse-sidebar-btn,
                .fi-topbar-open-sidebar-btn,
                .fi-topbar-close-sidebar-btn,
                .fi-topbar nav > button:first-child {
                    display: none !important;
                }
                
                /* User menu button in topbar - Pill shape with name and avatar */
                .fi-topbar .fi-user-menu-trigger {
                    display: inline-flex !important;
                    align-items: center !important;
                    gap: 8px !important;
                    padding: 4px 14px 4px 4px !important;
                    border-radius: 9999px !important;
                    background-color: #f8fafc !important;
                    border: 1px solid #e2e8f0 !important;
                    transition: all 0.2s ease !important;
                    cursor: pointer !important;
                    white-space: nowrap !important;
                    flex-shrink: 0 !important;
                }
                .fi-topbar .fi-user-menu-trigger:hover {
                    background-color: #f1f5f9 !important;
                    border-color: #cbd5e1 !important;
                }
                .fi-topbar .fi-user-menu-trigger::after {
                    content: "Super Admin DLH ▾" !important;
                    font-size: 0.82rem !important;
                    font-weight: 700 !important;
                    color: #0f172a !important;
                    white-space: nowrap !important;
                    margin-left: 2px !important;
                }
                .fi-topbar .fi-avatar {
                    width: 30px !important;
                    height: 30px !important;
                    border-radius: 9999px !important;
                    background: linear-gradient(135deg, #16a34a 0%, #15803d 100%) !important;
                    border: 2px solid #22c55e !important;
                    color: #ffffff !important;
                    font-weight: 700 !important;
                    font-size: 0.72rem !important;
                    display: flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    flex-shrink: 0 !important;
                }
                
                /* Remove search field entirely as requested */
                .fi-ta-search-field {
                    display: none !important;
                }

                /* Selection Indicator Bar ("X data dipilih | Hapus semua pilihan | Batalkan semua pilihan") */
                .fi-ta-selection-indicator {
                    display: flex !important;
                    align-items: center !important;
                    justify-content: space-between !important;
                    padding: 10px 18px !important;
                    background-color: #f8fafc !important;
                    border-bottom: 1px solid #e2e8f0 !important;
                }

                .fi-ta-selection-indicator > div:last-child {
                    display: inline-flex !important;
                    align-items: center !important;
                    gap: 16px !important;
                }

                .fi-ta-selection-indicator-actions-ctn {
                    display: inline-flex !important;
                    align-items: center !important;
                    gap: 16px !important;
                }
                
                /* Ensure proper padding for the top section */
                .fi-ta-header {
                    padding-bottom: 24px !important;
                }
                
                /* =========================================
                   FLAT SEAMLESS FORM STYLING (Like Screenshot)
                   ========================================= */
                
                /* Form Sections (Cards) - Completely Flat */
                .fi-section {
                    background-color: transparent !important;
                    border: none !important;
                    border-radius: 0 !important;
                    box-shadow: none !important;
                }
                .fi-section:hover {
                    box-shadow: none !important;
                }
                
                /* Section Headers - Flat */
                .fi-section-header {
                    padding: 0 0 16px 0 !important;
                    border-bottom: none !important;
                    background-color: transparent !important;
                }
                .fi-section-header-heading {
                    font-size: 1.25rem !important;
                    font-weight: 700 !important;
                    color: #0f172a !important;
                }
                
                /* Form Input Fields (Scoped so pagination & table filters are not affected) */
                .fi-fo-field-wrp .fi-input, 
                .fi-fo-field-wrp .fi-select-input, 
                .fi-fo-field-wrp .fi-textarea,
                .fi-modal .fi-input,
                .fi-modal .fi-select-input,
                .fi-modal .fi-textarea {
                    background-color: #ffffff !important;
                    border: 1px solid #cbd5e1 !important;
                    border-radius: 8px !important;
                    padding: 10px 14px !important;
                    color: #1e293b !important;
                    font-weight: 400 !important;
                    box-shadow: none !important;
                    transition: border-color 0.2s ease !important;
                }
                
                /* Input Focus States */
                .fi-fo-field-wrp .fi-input:focus, 
                .fi-fo-field-wrp .fi-select-input:focus, 
                .fi-fo-field-wrp .fi-textarea:focus,
                .fi-fo-field-wrp .fi-input-wrapper:focus-within,
                .fi-modal .fi-input-wrapper:focus-within {
                    background-color: #ffffff !important;
                    border-color: #166534 !important;
                    box-shadow: 0 0 0 1px #166534 !important;
                    outline: none !important;
                }

                /* =========================================
                   TABLE PAGINATION ("per halaman") STYLING (ALL PAGES)
                   ========================================= */
                .fi-pagination {
                    display: flex !important;
                    align-items: center !important;
                    justify-content: space-between !important;
                    gap: 12px !important;
                    padding-top: 16px !important;
                    padding-bottom: 8px !important;
                }
                
                .fi-pagination-overview {
                    font-size: 0.85rem !important;
                    color: #64748b !important;
                    font-weight: 500 !important;
                }
                
                .fi-pagination-records-per-page-select-ctn {
                    display: inline-flex !important;
                    align-items: center !important;
                }
                
                /* Outer Pill/Wrapper for "per halaman" */
                .fi-pagination-records-per-page-select .fi-input-wrp {
                    background-color: #ffffff !important;
                    border: 1px solid #cbd5e1 !important;
                    border-radius: 8px !important;
                    display: inline-flex !important;
                    align-items: center !important;
                    overflow: hidden !important;
                    height: 38px !important;
                    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04) !important;
                    transition: all 0.2s ease !important;
                    padding: 0 !important;
                }
                
                .fi-pagination-records-per-page-select .fi-input-wrp:hover {
                    border-color: #94a3b8 !important;
                }
                
                .fi-pagination-records-per-page-select .fi-input-wrp:focus-within {
                    border-color: #166534 !important;
                    box-shadow: 0 0 0 1px #166534 !important;
                }
                
                /* Prefix Tag: "per halaman" */
                .fi-pagination-records-per-page-select .fi-input-wrp-prefix {
                    background-color: #f8fafc !important;
                    border-right: 1px solid #e2e8f0 !important;
                    border-top: none !important;
                    border-bottom: none !important;
                    border-left: none !important;
                    padding: 0 14px !important;
                    height: 100% !important;
                    display: inline-flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                }
                
                .fi-pagination-records-per-page-select .fi-input-wrp-label {
                    font-size: 0.84rem !important;
                    font-weight: 500 !important;
                    color: #475569 !important;
                    white-space: nowrap !important;
                    line-height: 1 !important;
                }
                
                .fi-pagination-records-per-page-select .fi-input-wrp-content-ctn {
                    height: 100% !important;
                    display: inline-flex !important;
                    align-items: center !important;
                    padding: 0 !important;
                }
                
                /* Select element inside "per halaman": Clean, seamlessly integrated, no inner border */
                .fi-pagination-records-per-page-select select,
                .fi-pagination-records-per-page-select .fi-select-input,
                .fi-pagination-records-per-page-select select.fi-select-input {
                    border: none !important;
                    border-radius: 0 !important;
                    background-color: transparent !important;
                    box-shadow: none !important;
                    height: 100% !important;
                    padding-top: 0 !important;
                    padding-bottom: 0 !important;
                    padding-left: 12px !important;
                    padding-right: 36px !important; /* Prevents number from overlapping chevron */
                    min-width: 74px !important;
                    font-size: 0.875rem !important;
                    font-weight: 600 !important;
                    color: #0f172a !important;
                    cursor: pointer !important;
                    outline: none !important;
                    line-height: 38px !important;
                    background-position: right 10px center !important;
                }
                
                .fi-pagination-records-per-page-select select:focus,
                .fi-pagination-records-per-page-select .fi-select-input:focus {
                    box-shadow: none !important;
                    border: none !important;
                    outline: none !important;
                }
                
                /* Pagination item buttons (1, 2, 3...) */
                .fi-pagination-items {
                    display: inline-flex !important;
                    align-items: center !important;
                    gap: 4px !important;
                }
                
                .fi-pagination-item-btn {
                    border-radius: 8px !important;
                    font-weight: 600 !important;
                    font-size: 0.85rem !important;
                    transition: all 0.2s ease !important;
                }
                
                .fi-pagination-item.fi-active .fi-pagination-item-btn {
                    background-color: #166534 !important;
                    color: #ffffff !important;
                    box-shadow: 0 2px 6px rgba(22, 101, 52, 0.3) !important;
                }
                
                /* Disabled / View-Only Fields (For Activity Log & Modals) */
                .fi-input:disabled, .fi-select-input:disabled, .fi-textarea:disabled {
                    background-color: #f8fafc !important; /* Soft gray */
                    border: 1px solid #e2e8f0 !important;
                    border-left: 4px solid #166534 !important; /* Premium dark green accent line */
                    color: #0f172a !important; /* Dark text for readability */
                    font-weight: 700 !important;
                    border-radius: 6px !important;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.02) !important;
                    cursor: default !important;
                }
                .fi-input-wrapper:has(.fi-input:disabled), 
                .fi-input-wrapper:has(.fi-textarea:disabled) {
                    background-color: transparent !important;
                    border: none !important;
                    box-shadow: none !important;
                }
                
                /* Field Labels - UPPERCASE and BOLD */
                .fi-fo-field-wrp-label label {
                    text-transform: uppercase !important;
                    font-weight: 700 !important;
                    color: #475569 !important;
                    font-size: 0.75rem !important;
                    letter-spacing: 0.05em !important;
                    margin-bottom: 8px !important;
                }
                
                /* File Upload Area */
                .fi-fo-file-upload {
                    border: 1px dashed #cbd5e1 !important;
                    border-radius: 8px !important;
                    background-color: #ffffff !important;
                    transition: all 0.2s ease !important;
                    padding: 12px !important;
                }
                
                /* Native File Input Button Styling (Dark Green Accent) */
                input[type="file"]::file-selector-button {
                    background-color: #166534 !important;
                    color: #ffffff !important;
                    border: none !important;
                    border-radius: 6px !important;
                    padding: 8px 16px !important;
                    font-weight: 600 !important;
                    cursor: pointer !important;
                    transition: all 0.2s ease !important;
                    margin-right: 12px !important;
                    box-shadow: none !important;
                }
                input[type="file"]::file-selector-button:hover {
                    background-color: #14532d !important;
                }
                
                /* Form Action Buttons Wrapper */
                .fi-form-actions {
                    margin-top: 32px !important;
                    padding-top: 24px !important;
                    border-top: 1px solid #e2e8f0 !important;
                    display: flex !important;
                    gap: 12px !important;
                    align-items: center !important;
                }
                
                /* Submit / Save Button */
                .fi-form-actions button[type="submit"], .fi-btn-primary {
                    background-color: #166534 !important;
                    background-image: none !important;
                    border: none !important;
                    border-radius: 8px !important;
                    color: white !important;
                    font-weight: 600 !important;
                    padding: 10px 24px !important;
                    box-shadow: none !important;
                    transition: all 0.2s ease !important;
                }
                .fi-form-actions button[type="submit"]:hover, .fi-btn-primary:hover {
                    background-color: #14532d !important;
                    transform: none !important;
                    box-shadow: none !important;
                }
                
                /* Cancel / Secondary Button */
                .fi-form-actions button[type="button"], .fi-btn-secondary {
                    background-color: #ffffff !important;
                    border: 1px solid #cbd5e1 !important;
                    border-radius: 8px !important;
                    color: #475569 !important;
                    font-weight: 600 !important;
                    padding: 10px 24px !important;
                    box-shadow: none !important;
                    transition: all 0.2s ease !important;
                }
                .fi-form-actions button[type="button"]:hover, .fi-btn-secondary:hover {
                    background-color: #f8fafc !important;
                    border-color: #94a3b8 !important;
                    color: #0f172a !important;
                }
            </style>'
        );

        /* Sidebar Profile at start */
        \Filament\Support\Facades\FilamentView::registerRenderHook(
            'panels::sidebar.nav.start',
            fn (): string => \Illuminate\Support\Facades\Blade::render('@include("filament.sidebar-profile")'),
        );

        /* Topbar Title & Subtitle (Dynamic based on current URL) */
        \Filament\Support\Facades\FilamentView::registerRenderHook(
            'panels::topbar.start',
            function (): string {
                $path = request()->path();
                $title = 'Dashboard Overview';
                $subtitle = 'DLH Kab. Probolinggo Control Panel';

                if (str_contains($path, 'admin/services')) {
                    $title = 'Kelola Layanan Publik';
                    $subtitle = 'Manajemen daftar program dan layanan publik Dinas Lingkungan Hidup';
                } elseif (str_contains($path, 'admin/settings')) {
                    $title = 'Pengaturan Website & Tampilan';
                    $subtitle = 'Kustomisasi identitas, tema warna, banner hero, kontak, dan informasi publik';
                } elseif (str_contains($path, 'admin/posts')) {
                    $title = 'Kelola Berita & Publikasi';
                    $subtitle = 'Manajemen artikel, pengumuman, dan liputan kegiatan resmi';
                } elseif (str_contains($path, 'admin/documents')) {
                    $title = 'Kelola Dokumen Kinerja';
                    $subtitle = 'Manajemen dokumen transparansi, renja, lakip, dan informasi publik';
                } elseif (str_contains($path, 'admin/galleries')) {
                    $title = 'Kelola Galeri Foto';
                    $subtitle = 'Dokumentasi album foto dan kegiatan lapangan instansi';
                } elseif (str_contains($path, 'admin/banners')) {
                    $title = 'Kelola Banner & Spanduk';
                    $subtitle = 'Manajemen banner promosi dan pengumuman beranda';
                } elseif (str_contains($path, 'admin/profiles')) {
                    $title = 'Kelola Profil Instansi';
                    $subtitle = 'Manajemen visi misi, struktur organisasi, dan profil kedinasan';
                } elseif (str_contains($path, 'admin/quick-accesses')) {
                    $title = 'Kelola Akses Cepat';
                    $subtitle = 'Manajemen tombol pintasan dan layanan cepat publik';
                } elseif (str_contains($path, 'admin/statistics')) {
                    $title = 'Kelola Data & Statistik';
                    $subtitle = 'Manajemen capaian angka kinerja lingkungan dan data strategis';
                } elseif (str_contains($path, 'admin/related-links')) {
                    $title = 'Kelola Tautan Terkait';
                    $subtitle = 'Manajemen tautan instansi kementerian dan mitra eksternal';
                } elseif (str_contains($path, 'admin/navigations')) {
                    $title = 'Kelola Menu Navigasi';
                    $subtitle = 'Pengaturan tautan dan navigasi pada website publik';
                } elseif (str_contains($path, 'admin/activity-logs')) {
                    $title = 'Log Aktivitas Sistem';
                    $subtitle = 'Riwayat rekam jejak aktivitas admin di dalam portal';
                } elseif (str_contains($path, 'admin/users')) {
                    $title = 'Manajemen Users & Role';
                    $subtitle = 'Pengaturan pengguna terdaftar dan hak akses super admin';
                }

                return '<div style="display: flex; flex-direction: column; justify-content: center; white-space: nowrap;">
                    <h1 style="font-weight: 800; font-size: 1.22rem; color: #0f172a; line-height: 1.2; letter-spacing: -0.02em; margin: 0; white-space: nowrap;">' . e($title) . '</h1>
                    <p style="font-size: 0.78rem; color: #64748b; font-weight: 500; margin: 2px 0 0 0; white-space: nowrap;">' . e($subtitle) . '</p>
                </div>';
            }
        );

        /* Topbar Preview Site Button (Placed right before User Menu) */
        \Filament\Support\Facades\FilamentView::registerRenderHook(
            'panels::user-menu.before',
            fn (): string => '<div style="display: flex; align-items: center; margin-right: 12px; flex-shrink: 0;">
                <a href="/" target="_blank" style="display: inline-flex; align-items: center; gap: 7px; background-color: #0f172a; color: #ffffff; padding: 7px 18px; border-radius: 9999px; font-size: 0.8rem; font-weight: 700; text-decoration: none; white-space: nowrap; flex-shrink: 0; line-height: 1; transition: all 0.2s ease; box-shadow: 0 2px 6px rgba(15, 23, 42, 0.2);" onmouseover="this.style.backgroundColor=\'#1e293b\'; this.style.transform=\'translateY(-1px)\';" onmouseout="this.style.backgroundColor=\'#0f172a\'; this.style.transform=\'translateY(0)\';">
                    <svg style="width: 15px; height: 15px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span style="white-space: nowrap;">Preview Site</span>
                </a>
            </div>'
        );

        /* "Hapus semua pilihan" action button in Table Selection Bar */
        \Filament\Support\Facades\FilamentView::registerRenderHook(
            \Filament\Tables\View\TablesRenderHook::SELECTION_INDICATOR_ACTIONS_BEFORE,
            fn (): string => '<button 
                type="button" 
                x-on:click="mountAction(\'delete\', {}, { table: true, bulk: true })" 
                class="fi-ta-selection-bulk-delete-btn"
                style="display: inline-flex; align-items: center; gap: 5px; color: #dc2626 !important; font-size: 0.875rem !important; font-weight: 600 !important; cursor: pointer !important; background: none; border: none; padding: 0; text-decoration: underline; text-underline-offset: 3px; transition: all 0.15s ease;"
                onmouseover="this.style.color=\'#991b1b\'; this.style.textDecorationColor=\'#991b1b\';" 
                onmouseout="this.style.color=\'#dc2626\'; this.style.textDecorationColor=\'#dc2626\';"
            >
                <svg style="width: 15px; height: 15px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                <span>Hapus semua pilihan</span>
            </button>'
        );

        \Filament\Support\Facades\FilamentIcon::register([
            'forms:components.rich-editor.toolbar.attach-files' => 'heroicon-m-photo',
        ]);
    }
}

