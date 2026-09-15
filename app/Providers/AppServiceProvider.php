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
        \Filament\Tables\Columns\Column::configureUsing(function (\Filament\Tables\Columns\Column $column): void {
            $column->toggleable();
        });

        \Filament\Support\Facades\FilamentView::registerRenderHook(
            'panels::head.start',
            function (): string {
                $setting = \App\Models\Setting::first();
                $fav = $setting?->favicon_path ?: $setting?->logo_path;
                if ($fav) {
                    $url = asset('storage/' . $fav);
                    return '<link rel="icon" type="image/x-icon" href="' . e($url) . '"><link rel="shortcut icon" href="' . e($url) . '"><link rel="apple-touch-icon" href="' . e($url) . '">';
                }
                return '';
            }
        );

        \Filament\Support\Facades\FilamentView::registerRenderHook(
            'panels::head.end',
            function (): string {
                $role = auth()->user()?->role ?? 'super_admin';
                $roleLabel = match($role) {
                    'admin' => 'Admin DLH',
                    'operator' => 'Operator DLH',
                    default => 'Super Admin DLH',
                };
                return '<style>
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
                
                /* Sidebar Items Base - Normal / Unselected Items (Transparent) */
                .fi-sidebar-item > .fi-sidebar-item-btn,
                .fi-sidebar-item-btn {
                    border-radius: 0.6rem !important;
                    margin: 3px 8px !important;
                    padding: 9px 12px !important;
                    transition: all 0.2s ease !important;
                    background-color: transparent !important;
                    background: transparent !important;
                    box-shadow: none !important;
                    border: none !important;
                    outline: none !important;
                    display: flex !important;
                    align-items: center !important;
                    gap: 10px !important;
                }
                .fi-sidebar-item > .fi-sidebar-item-btn .fi-sidebar-item-label {
                    color: #cbd5e1 !important;
                    font-weight: 500 !important;
                    font-size: 0.88rem !important;
                    white-space: nowrap !important;
                    overflow: hidden !important;
                    text-overflow: ellipsis !important;
                }
                .fi-sidebar-item > .fi-sidebar-item-btn .fi-sidebar-item-icon,
                .fi-sidebar-item > .fi-sidebar-item-btn svg {
                    color: #94a3b8 !important;
                    flex-shrink: 0 !important;
                }
                
                /* Hover State on Unselected Items */
                .fi-sidebar-item:not(.fi-active) > .fi-sidebar-item-btn:hover {
                    background-color: rgba(255, 255, 255, 0.08) !important;
                }
                .fi-sidebar-item:not(.fi-active) > .fi-sidebar-item-btn:hover .fi-sidebar-item-label {
                    color: #ffffff !important;
                }
                .fi-sidebar-item:not(.fi-active) > .fi-sidebar-item-btn:hover .fi-sidebar-item-icon,
                .fi-sidebar-item:not(.fi-active) > .fi-sidebar-item-btn:hover svg {
                    color: #86efac !important;
                }

                /* Explicitly ensure inactive items NEVER have green background */
                .fi-sidebar-item:not(.fi-active) > .fi-sidebar-item-btn {
                    background-color: transparent !important;
                    background: transparent !important;
                    box-shadow: none !important;
                }
                
                /* ONLY the single ACTIVE item when clicked / opened gets the Green Pill */
                li.fi-sidebar-item.fi-active > .fi-sidebar-item-btn,
                li.fi-sidebar-item.fi-sidebar-item-active > .fi-sidebar-item-btn,
                .fi-sidebar-item-btn[aria-current="page"] {
                    background-color: #14532d !important; /* Deep forest green */
                    background: linear-gradient(135deg, #166534 0%, #14532d 100%) !important;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3) !important;
                    position: relative !important;
                    border: none !important;
                    outline: none !important;
                    border-radius: 0.6rem !important;
                }
                li.fi-sidebar-item.fi-active > .fi-sidebar-item-btn .fi-sidebar-item-label,
                li.fi-sidebar-item.fi-sidebar-item-active > .fi-sidebar-item-btn .fi-sidebar-item-label,
                .fi-sidebar-item-btn[aria-current="page"] .fi-sidebar-item-label {
                    color: #ffffff !important;
                    font-weight: 700 !important;
                }
                li.fi-sidebar-item.fi-active > .fi-sidebar-item-btn .fi-sidebar-item-icon,
                li.fi-sidebar-item.fi-sidebar-item-active > .fi-sidebar-item-btn .fi-sidebar-item-icon,
                li.fi-sidebar-item.fi-active > .fi-sidebar-item-btn svg,
                li.fi-sidebar-item.fi-sidebar-item-active > .fi-sidebar-item-btn svg,
                .fi-sidebar-item-btn[aria-current="page"] .fi-sidebar-item-icon,
                .fi-sidebar-item-btn[aria-current="page"] svg {
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
                /* Lihat Website Utama link styling */
                .sidebar-nav-website-link .fi-sidebar-item-icon,
                .sidebar-nav-website-link svg {
                    color: #4ade80 !important;
                }
                .sidebar-nav-website-link:hover .fi-sidebar-item-label {
                    color: #ffffff !important;
                }
                
                /* Log Out link styling */
                .sidebar-nav-logout-link .fi-sidebar-item-icon,
                .sidebar-nav-logout-link svg,
                .sidebar-nav-logout-link .fi-sidebar-item-label,
                a[href*="logout"] .fi-sidebar-item-icon,
                a[href*="logout"] svg,
                a[href*="logout"] .fi-sidebar-item-label {
                    color: #ef4444 !important;
                }
                .sidebar-nav-logout-link:hover,
                a[href*="logout"]:hover {
                    background-color: rgba(239, 68, 68, 0.15) !important;
                }
                .sidebar-nav-logout-link:hover .fi-sidebar-item-icon,
                .sidebar-nav-logout-link:hover svg,
                .sidebar-nav-logout-link:hover .fi-sidebar-item-label,
                a[href*="logout"]:hover .fi-sidebar-item-icon,
                a[href*="logout"]:hover svg,
                a[href*="logout"]:hover .fi-sidebar-item-label {
                    color: #f87171 !important;
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
                    background-color: #ffffff !important;
                    border: 1.5px solid #e2e8f0 !important;
                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
                    transition: all 0.2s ease !important;
                    cursor: pointer !important;
                    white-space: nowrap !important;
                    flex-shrink: 0 !important;
                }
                .fi-topbar .fi-user-menu-trigger:hover {
                    background-color: #f8fafc !important;
                    border-color: #cbd5e1 !important;
                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06) !important;
                }
                .fi-topbar .fi-user-menu-trigger::after {
                    content: "' . e($roleLabel) . ' ▾" !important;
                    font-size: 0.82rem !important;
                    font-weight: 700 !important;
                    color: #1e293b !important;
                    white-space: nowrap !important;
                    margin-left: 2px !important;
                }
                .fi-topbar .fi-avatar {
                    width: 28px !important;
                    height: 28px !important;
                    border-radius: 9999px !important;
                    border: 2px solid #86efac !important;
                    box-shadow: 0 1px 4px rgba(22, 101, 52, 0.25) !important;
                    flex-shrink: 0 !important;
                }

                /* =========================================
                   PREMIUM USER DROPDOWN MENU STYLING
                   ========================================= */
                .fi-dropdown-panel {
                    border-radius: 16px !important;
                    border: 1px solid #e2e8f0 !important;
                    background-color: #ffffff !important;
                    padding: 8px !important;
                    min-width: 250px !important;
                    box-shadow: 0 20px 40px -10px rgba(15, 23, 42, 0.14), 0 8px 16px -4px rgba(15, 23, 42, 0.06) !important;
                    overflow: hidden !important;
                    animation: userMenuPop 0.2s cubic-bezier(0.16, 1, 0.3, 1) !important;
                }

                @keyframes userMenuPop {
                    from {
                        opacity: 0;
                        transform: translateY(-6px) scale(0.96);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0) scale(1);
                    }
                }

                .fi-dropdown-list {
                    padding: 0 !important;
                    gap: 2px !important;
                }

                .fi-dropdown-list-item {
                    border-radius: 10px !important;
                    padding: 9px 14px !important;
                    margin: 2px 0 !important;
                    font-weight: 600 !important;
                    font-size: 0.88rem !important;
                    color: #334155 !important;
                    display: flex !important;
                    align-items: center !important;
                    gap: 10px !important;
                    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
                    border: 1px solid transparent !important;
                }

                /* Default / Profile item icon */
                .fi-dropdown-list-item svg,
                .fi-dropdown-list-item .fi-dropdown-list-item-icon {
                    width: 19px !important;
                    height: 19px !important;
                    flex-shrink: 0 !important;
                    transition: all 0.2s ease !important;
                    color: #10b981 !important;
                }

                /* Sembunyikan HANYA header/item "Super Admin" bawaan */
                .fi-dropdown-header,
                .fi-dropdown-panel > .fi-dropdown-header,
                .fi-dropdown-list > a.fi-dropdown-list-item,
                .fi-dropdown-list > button.fi-dropdown-list-item,
                .fi-dropdown-list-item:has(svg[class*="user-circle"]) {
                    display: none !important;
                }

                /* Pastikan form & tombol Keluar (Logout) tetap tampil sempurna */
                form:has(.fi-dropdown-list-item) {
                    display: block !important;
                    margin-top: 4px !important;
                    padding-top: 4px !important;
                    border-top: 1px solid #f1f5f9 !important;
                }

                form .fi-dropdown-list-item,
                .fi-dropdown-list-item[color="danger"],
                .fi-dropdown-list-item:has(svg[class*="arrow-left-end-on-rectangle"]),
                .fi-dropdown-list-item:last-child {
                    color: #475569 !important;
                }

                form .fi-dropdown-list-item svg,
                .fi-dropdown-list-item[color="danger"] svg,
                .fi-dropdown-list-item:has(svg[class*="arrow-left-end-on-rectangle"]) svg,
                .fi-dropdown-list-item:last-child svg {
                    color: #f87171 !important;
                }

                /* Hover state for Logout button */
                form .fi-dropdown-list-item:hover,
                .fi-dropdown-list-item[color="danger"]:hover,
                .fi-dropdown-list-item:has(svg[class*="arrow-left-end-on-rectangle"]):hover,
                .fi-dropdown-list-item:last-child:hover {
                    background-color: #fef2f2 !important;
                    border-color: #fecaca !important;
                    color: #dc2626 !important;
                    transform: translateX(4px) !important;
                }

                form .fi-dropdown-list-item:hover svg,
                .fi-dropdown-list-item[color="danger"]:hover svg,
                .fi-dropdown-list-item:has(svg[class*="arrow-left-end-on-rectangle"]):hover svg,
                .fi-dropdown-list-item:last-child:hover svg {
                    color: #dc2626 !important;
                    transform: scale(1.15) rotate(-6deg) !important;
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
            </style>';
        }
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
                <a href="/" target="_blank" style="display: inline-flex; align-items: center; gap: 7px; background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: #ffffff; padding: 7px 18px; border-radius: 9999px; font-size: 0.82rem; font-weight: 700; text-decoration: none; white-space: nowrap; flex-shrink: 0; line-height: 1; transition: all 0.25s ease; box-shadow: 0 2px 8px rgba(22, 163, 74, 0.28); border: 1px solid rgba(255, 255, 255, 0.25);" onmouseover="this.style.background=\'linear-gradient(135deg, #15803d 0%, #166534 100%)\'; this.style.transform=\'translateY(-1px)\'; this.style.boxShadow=\'0 4px 14px rgba(22, 163, 74, 0.4)\';" onmouseout="this.style.background=\'linear-gradient(135deg, #16a34a 0%, #15803d 100%)\'; this.style.transform=\'translateY(0)\'; this.style.boxShadow=\'0 2px 8px rgba(22, 163, 74, 0.28)\';">
                    <svg style="width: 15px; height: 15px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span style="white-space: nowrap;">Preview Site</span>
                </a>
            </div>'
        );

        /* User Menu Profile Header Card & Interactive Role Switcher */
        \Filament\Support\Facades\FilamentView::registerRenderHook(
            'panels::user-menu.profile.before',
            function (): string {
                $user = auth()->user();
                $name = $user?->name ?? 'Admin';
                $email = $user?->email ?? 'admin@dlh.com';
                $currentRole = $user?->role ?? 'super_admin';
                $initials = strtoupper(substr($name, 0, 2));
                $isSuperAdmin = ($currentRole === 'super_admin');

                $roleBadge = match($currentRole) {
                    'admin' => '<span style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; font-size: 0.62rem; font-weight: 800; padding: 2px 8px; border-radius: 9999px; letter-spacing: 0.04em; display: inline-flex; align-items: center; gap: 4px;"><span style="width: 5px; height: 5px; border-radius: 50%; background-color: #0284c7; display: inline-block;"></span> ADMIN PENGELOLA</span>',
                    'operator' => '<span style="background-color: #fef3c7; color: #b45309; border: 1px solid #fde68a; font-size: 0.62rem; font-weight: 800; padding: 2px 8px; border-radius: 9999px; letter-spacing: 0.04em; display: inline-flex; align-items: center; gap: 4px;"><span style="width: 5px; height: 5px; border-radius: 50%; background-color: #f59e0b; display: inline-block;"></span> OPERATOR</span>',
                    default => '<span style="background-color: #ecfdf5; color: #166534; border: 1px solid #a7f3d0; font-size: 0.62rem; font-weight: 800; padding: 2px 8px; border-radius: 9999px; letter-spacing: 0.04em; display: inline-flex; align-items: center; gap: 4px;"><span style="width: 5px; height: 5px; border-radius: 50%; background-color: #16a34a; display: inline-block;"></span> SUPER ADMIN</span>',
                };

                return '<div style="padding: 4px 4px 6px 4px; min-width: 240px;">
                    <!-- User Header Card (Sleek, Modern & Cool) -->
                    <div style="padding: 11px 13px; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 8px; display: flex; align-items: center; gap: 11px;">
                        <div style="position: relative; flex-shrink: 0;">
                            <div style="width: 40px; height: 40px; border-radius: 11px; background: linear-gradient(135deg, #092612 0%, #166534 100%); color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.95rem; box-shadow: 0 2px 6px rgba(9, 38, 18, 0.25); border: 1px solid rgba(255,255,255,0.2);">
                                ' . e($initials) . '
                            </div>
                            <span style="position: absolute; bottom: -2px; right: -2px; width: 9px; height: 9px; border-radius: 50%; background: #22c55e; border: 2px solid #ffffff;"></span>
                        </div>
                        <div style="display: flex; flex-direction: column; overflow: hidden; flex: 1; min-width: 0;">
                            <span style="font-weight: 800; font-size: 0.88rem; color: #0f172a; line-height: 1.25; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                ' . e($name) . '
                            </span>
                            <span style="font-size: 0.72rem; color: #64748b; line-height: 1.2; margin-top: 1px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                ' . e($email) . '
                            </span>
                            <div style="margin-top: 4px;">
                                ' . $roleBadge . '
                            </div>
                        </div>
                    </div>

                    <!-- Menu Items (Biasa & Keren) -->
                    <div style="display: flex; flex-direction: column; gap: 2px;">


                        <button type="button" onclick="event.preventDefault(); event.stopPropagation(); window.openRoleSelectorModal();" style="width: 100%; border: none; background: transparent; display: flex; align-items: center; justify-content: space-between; padding: 7px 10px; border-radius: 9px; text-decoration: none; color: #1e293b; cursor: pointer; transition: all 0.15s ease; text-align: left;" onmouseover="this.style.backgroundColor=\'#f0fdf4\'; this.style.transform=\'translateX(2px)\';" onmouseout="this.style.backgroundColor=\'transparent\'; this.style.transform=\'translateX(0)\';">
                            <div style="display: flex; align-items: center; gap: 9px;">
                                <div style="width: 28px; height: 28px; border-radius: 8px; background: #f0fdf4; border: 1px solid #86efac; display: flex; align-items: center; justify-content: center; color: #16a34a;">
                                    <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                                </div>
                                <div style="display: flex; flex-direction: column;">
                                    <span style="font-size: 0.8rem; font-weight: 700; color: #1e293b; line-height: 1.2;">Ganti Hak Akses</span>
                                    <span style="font-size: 0.67rem; color: #15803d; line-height: 1.2; font-weight: 600;">Beralih role kerja</span>
                                </div>
                            </div>
                            <span style="font-size: 0.65rem; font-weight: 800; color: #15803d; background: #ecfdf5; border: 1px solid #a7f3d0; padding: 2px 7px; border-radius: 6px;">Pilih ▾</span>
                        </button>
                    </div>

                    <div style="border-top: 1px solid #f1f5f9; margin-top: 7px; margin-bottom: 2px;"></div>
                </div>';
            }
        );

        /* Role Switch Authentication Modal registered at BODY_END */
        \Filament\Support\Facades\FilamentView::registerRenderHook(
            \Filament\View\PanelsRenderHook::BODY_END,
            function (): string {
                $csrfToken = csrf_token();
                $saUser = \App\Models\User::where('role', 'super_admin')->first();
                $adminUser = \App\Models\User::where('role', 'admin')->first();
                $opUser = \App\Models\User::where('role', 'operator')->first();

                $saEmail = $saUser?->email ?? 'superadminDLH@gmail.com';
                $adminEmail = $adminUser?->email ?? 'adminDLH@gmail.com';
                $opEmail = $opUser?->email ?? 'operatorDLH@gmail.com';

                return '
                <!-- Role Selector Popup Modal -->
                <div id="roleSelectorModalBackdrop" 
                     style="display: none; position: fixed; inset: 0; z-index: 999998; background: rgba(9, 38, 18, 0.68); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); align-items: center; justify-content: center; padding: 16px; opacity: 0; transition: opacity 0.2s cubic-bezier(0.16, 1, 0.3, 1);"
                     onclick="if(event.target === this) window.closeRoleSelectorModal();"
                >
                    <div id="roleSelectorModalCard" 
                         style="background: #ffffff; width: 100%; max-width: 420px; border-radius: 20px; box-shadow: 0 20px 50px -10px rgba(9, 38, 18, 0.35); overflow: hidden; transform: scale(0.95); transition: transform 0.2s cubic-bezier(0.16, 1, 0.3, 1); position: relative; font-family: inherit;"
                    >
                        <div style="height: 4px; background: linear-gradient(90deg, #092612 0%, #166534 50%, #15803d 100%); width: 100%;"></div>

                        <div style="padding: 22px 22px 20px 22px;">
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 36px; height: 36px; border-radius: 10px; background: #f0fdf4; border: 1px solid #86efac; display: flex; align-items: center; justify-content: center; color: #16a34a;">
                                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                                    </div>
                                    <div>
                                        <h4 style="margin: 0; font-size: 1.05rem; font-weight: 800; color: #0f172a;">Beralih Hak Akses</h4>
                                        <span style="font-size: 0.72rem; color: #64748b;">Pilih peran akun kerja yang ingin digunakan:</span>
                                    </div>
                                </div>
                                <button type="button" onclick="window.closeRoleSelectorModal()" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #64748b; font-size: 13px; transition: all 0.15s ease;" onmouseover="this.style.background=\'#fee2e2\'; this.style.color=\'#ef4444\';" onmouseout="this.style.background=\'#f8fafc\'; this.style.color=\'#64748b\';">✕</button>
                            </div>

                            <div style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px;">
                                <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 12px; border-radius: 12px; background: #f8fafc; border: 1px solid #e2e8f0; transition: all 0.15s ease;" onmouseover="this.style.borderColor=\'#86efac\'; this.style.background=\'#f0fdf4\';" onmouseout="this.style.borderColor=\'#e2e8f0\'; this.style.background=\'#f8fafc\';">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <span style="font-size: 1.25rem;">🛡️</span>
                                        <div style="display: flex; flex-direction: column;">
                                            <span style="font-size: 0.84rem; font-weight: 700; color: #0f172a;">Super Administrator</span>
                                            <span style="font-size: 0.68rem; color: #64748b;">Akses penuh seluruh fitur & setting</span>
                                        </div>
                                    </div>
                                    <button type="button" onclick="window.closeRoleSelectorModal(); window.openRoleAuthModal(\'super_admin\', \'Super Administrator\', \'Akses penuh seluruh fitur\', \'🛡️\');" style="padding: 5px 13px; border-radius: 8px; background: #166534; color: #ffffff; border: none; font-size: 0.74rem; font-weight: 700; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.background=\'#15803d\';" onmouseout="this.style.background=\'#166534\';">Pilih</button>
                                </div>

                                <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 12px; border-radius: 12px; background: #f8fafc; border: 1px solid #e2e8f0; transition: all 0.15s ease;" onmouseover="this.style.borderColor=\'#7dd3fc\'; this.style.background=\'#f0f9ff\';" onmouseout="this.style.borderColor=\'#e2e8f0\'; this.style.background=\'#f8fafc\';">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <span style="font-size: 1.25rem;">💼</span>
                                        <div style="display: flex; flex-direction: column;">
                                            <span style="font-size: 0.84rem; font-weight: 700; color: #0f172a;">Admin Pengelola</span>
                                            <span style="font-size: 0.68rem; color: #64748b;">Kelola berita, galeri, & dokumen</span>
                                        </div>
                                    </div>
                                    <button type="button" onclick="window.closeRoleSelectorModal(); window.openRoleAuthModal(\'admin\', \'Admin Pengelola\', \'Kelola konten & dokumen\', \'💼\');" style="padding: 5px 13px; border-radius: 8px; background: #166534; color: #ffffff; border: none; font-size: 0.74rem; font-weight: 700; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.background=\'#15803d\';" onmouseout="this.style.background=\'#166534\';">Pilih</button>
                                </div>

                                <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 12px; border-radius: 12px; background: #f8fafc; border: 1px solid #e2e8f0; transition: all 0.15s ease;" onmouseover="this.style.borderColor=\'#fde68a\'; this.style.background=\'#fffbeb\';" onmouseout="this.style.borderColor=\'#e2e8f0\'; this.style.background=\'#f8fafc\';">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <span style="font-size: 1.25rem;">📋</span>
                                        <div style="display: flex; flex-direction: column;">
                                            <span style="font-size: 0.84rem; font-weight: 700; color: #0f172a;">Operator</span>
                                            <span style="font-size: 0.68rem; color: #64748b;">Input data layanan perizinan</span>
                                        </div>
                                    </div>
                                    <button type="button" onclick="window.closeRoleSelectorModal(); window.openRoleAuthModal(\'operator\', \'Operator\', \'Input data pelayanan\', \'📋\');" style="padding: 5px 13px; border-radius: 8px; background: #166534; color: #ffffff; border: none; font-size: 0.74rem; font-weight: 700; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.background=\'#15803d\';" onmouseout="this.style.background=\'#166534\';">Pilih</button>
                                </div>
                            </div>

                            <div style="display: flex; justify-content: flex-end;">
                                <button type="button" onclick="window.closeRoleSelectorModal()" style="padding: 7px 16px; border-radius: 9px; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; font-size: 0.8rem; font-weight: 700; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.background=\'#f1f5f9\';" onmouseout="this.style.background=\'#f8fafc\';">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Role Switch Authentication Modal (DLH Theme) -->
                <div id="roleAuthModalBackdrop" 
                     style="display: none; position: fixed; inset: 0; z-index: 999999; background: rgba(10, 30, 18, 0.72); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); align-items: center; justify-content: center; padding: 16px; opacity: 0; transition: opacity 0.25s cubic-bezier(0.16, 1, 0.3, 1);"
                     onclick="if(event.target === this) window.closeRoleAuthModal();"
                >
                    <div id="roleAuthModalCard" 
                         style="background: #ffffff; width: 100%; max-width: 440px; border-radius: 22px; box-shadow: 0 25px 60px -12px rgba(5, 46, 22, 0.35), 0 0 0 1px rgba(22, 163, 74, 0.15); overflow: hidden; transform: scale(0.95); transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1); position: relative; font-family: inherit;"
                    >
                        <!-- Top Glowing DLH Green Accent Bar -->
                        <div style="height: 5px; background: linear-gradient(90deg, #15803d 0%, #16a34a 50%, #4ade80 100%); width: 100%; box-shadow: 0 2px 10px rgba(34, 197, 94, 0.4);"></div>

                        <!-- Subtle decorative background gradient top -->
                        <div style="position: absolute; top: 5px; left: 0; right: 0; height: 100px; background: radial-gradient(circle at 50% -20%, rgba(34, 197, 94, 0.12) 0%, rgba(255, 255, 255, 0) 70%); pointer-events: none;"></div>

                        <div style="padding: 26px 26px 24px 26px; position: relative;">
                            <!-- Header with DLH Icon & Close Button -->
                            <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 16px;">
                                <div style="display: flex; align-items: center; gap: 14px;">
                                    <div id="roleAuthIconBox" style="width: 50px; height: 50px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: #ffffff; border: 1.5px solid #86efac; box-shadow: 0 4px 16px rgba(22, 163, 74, 0.35); flex-shrink: 0;">
                                        🛡️
                                    </div>
                                    <div>
                                        <div style="display: flex; align-items: center; gap: 6px;">
                                            <span style="font-size: 0.68rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; color: #16a34a;">
                                                DLH KAB. PROBOLINGGO
                                            </span>
                                        </div>
                                        <h3 style="margin: 2px 0 0 0; font-size: 1.15rem; font-weight: 800; color: #0f172a; line-height: 1.25; letter-spacing: -0.01em;">
                                            Verifikasi Hak Akses
                                        </h3>
                                        <div style="margin-top: 5px;">
                                            <div id="roleAuthTargetBadge" style="display: inline-flex; align-items: center; gap: 6px; font-size: 0.75rem; font-weight: 800; color: #15803d; background: #ecfdf5; padding: 3px 10px; border-radius: 9999px; border: 1px solid #86efac; box-shadow: 0 1px 3px rgba(22, 163, 74, 0.1);">
                                                <span style="width: 7px; height: 7px; border-radius: 50%; background: #16a34a; display: inline-block; box-shadow: 0 0 0 2px #bbf7d0;"></span>
                                                <span id="roleAuthTargetBadgeText">Operator</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" 
                                        onclick="window.closeRoleAuthModal()" 
                                        style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #64748b; font-size: 14px; transition: all 0.2s ease; flex-shrink: 0;"
                                        onmouseover="this.style.background=\'#fee2e2\'; this.style.color=\'#ef4444\'; this.style.borderColor=\'#fca5a5\';"
                                        onmouseout="this.style.background=\'#f8fafc\'; this.style.color=\'#64748b\'; this.style.borderColor=\'#e2e8f0\';"
                                        title="Tutup dialog"
                                >
                                    ✕
                                </button>
                            </div>

                            <p id="roleAuthDescText" style="margin: 0 0 18px 0; font-size: 0.82rem; color: #64748b; line-height: 1.5;">
                                Masukkan kredensial resmi untuk beralih dan mengaktifkan fitur role ini.
                            </p>

                            <!-- Form -->
                            <form action="/admin/switch-role-auth" method="POST" id="roleAuthForm">
                                <input type="hidden" name="_token" value="' . $csrfToken . '">
                                <input type="hidden" name="role" id="roleAuthInputRole" value="operator">

                                <!-- Username Input -->
                                <div style="margin-bottom: 14px;">
                                    <label style="display: flex; align-items: center; gap: 5px; font-size: 0.74rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; color: #1e293b; margin-bottom: 6px;">
                                        <svg style="width: 14px; height: 14px; color: #16a34a;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                        Username / Email
                                    </label>
                                    <div style="position: relative; display: flex; align-items: center;">
                                        <input type="text" 
                                               name="username" 
                                               id="roleAuthInputUsername" 
                                               required 
                                               autocomplete="username" 
                                               placeholder="operator@dlh.go.id atau operator"
                                               style="width: 100%; height: 44px; padding: 0 14px; border: 1.5px solid #cbd5e1; border-radius: 12px; font-size: 0.88rem; color: #0f172a; outline: none; background: #f8fafc; transition: all 0.2s ease; box-sizing: border-box;"
                                               onfocus="this.style.borderColor=\'#16a34a\'; this.style.background=\'#ffffff\'; this.style.boxShadow=\'0 0 0 3.5px rgba(22, 163, 74, 0.16)\';"
                                               onblur="this.style.borderColor=\'#cbd5e1\'; this.style.background=\'#f8fafc\'; this.style.boxShadow=\'none\';"
                                        >
                                    </div>
                                </div>

                                <!-- Password Input -->
                                <div style="margin-bottom: 16px;">
                                    <label style="display: flex; align-items: center; gap: 5px; font-size: 0.74rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; color: #1e293b; margin-bottom: 6px;">
                                        <svg style="width: 14px; height: 14px; color: #16a34a;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                                        Kata Sandi / Password
                                    </label>
                                    <div style="position: relative; display: flex; align-items: center;">
                                        <input type="password" 
                                               name="password" 
                                               id="roleAuthInputPassword" 
                                               required 
                                               autocomplete="current-password" 
                                               placeholder="Masukkan kata sandi..."
                                               style="width: 100%; height: 44px; padding: 0 44px 0 14px; border: 1.5px solid #cbd5e1; border-radius: 12px; font-size: 0.88rem; color: #0f172a; outline: none; background: #f8fafc; transition: all 0.2s ease; box-sizing: border-box;"
                                               onfocus="this.style.borderColor=\'#16a34a\'; this.style.background=\'#ffffff\'; this.style.boxShadow=\'0 0 0 3.5px rgba(22, 163, 74, 0.16)\';"
                                               onblur="this.style.borderColor=\'#cbd5e1\'; this.style.background=\'#f8fafc\'; this.style.boxShadow=\'none\';"
                                        >
                                        <button type="button" 
                                                onclick="window.toggleRoleAuthPassword()" 
                                                id="roleAuthEyeBtn"
                                                style="position: absolute; right: 8px; background: none; border: none; cursor: pointer; color: #64748b; display: flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 6px; transition: all 0.15s ease;"
                                                onmouseover="this.style.color=\'#16a34a\'; this.style.background=\'#f0fdf4\';"
                                                onmouseout="this.style.color=\'#64748b\'; this.style.background=\'none\';"
                                                title="Lihat / Sembunyikan Kata Sandi"
                                        >
                                            <svg id="roleAuthEyeIcon" style="width: 18px; height: 18px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- DLH Styled Credentials Hint Box -->
                                <div style="padding: 12px 14px; background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%); border: 1.5px solid #a7f3d0; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(22, 163, 74, 0.05);">
                                    <div style="display: flex; align-items: center; gap: 6px; font-size: 0.72rem; font-weight: 800; color: #166534; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.04em;">
                                        <svg style="width: 14px; height: 14px; color: #16a34a; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/></svg>
                                        Kredensial Default Role:
                                    </div>
                                    <div id="roleAuthHintContent" style="font-size: 0.74rem; color: #1e293b; line-height: 1.6;">
                                        <!-- Dynamically updated by JS -->
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div style="display: flex; align-items: center; gap: 10px; justify-content: flex-end;">
                                    <button type="button" 
                                            onclick="window.closeRoleAuthModal()" 
                                            style="padding: 10px 18px; border-radius: 12px; border: 1.5px solid #cbd5e1; background: #f8fafc; color: #475569; font-size: 0.85rem; font-weight: 700; cursor: pointer; transition: all 0.2s ease;"
                                            onmouseover="this.style.background=\'#f1f5f9\'; this.style.borderColor=\'#94a3b8\'; this.style.color=\'#0f172a\';"
                                            onmouseout="this.style.background=\'#f8fafc\'; this.style.borderColor=\'#cbd5e1\'; this.style.color=\'#475569\';"
                                    >
                                        Batal
                                    </button>
                                    <button type="submit" 
                                            id="roleAuthSubmitBtn"
                                            style="padding: 10px 22px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.25); background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: #ffffff; font-size: 0.86rem; font-weight: 800; cursor: pointer; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 16px rgba(22, 163, 74, 0.4); transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);"
                                            onmouseover="this.style.transform=\'translateY(-2px)\'; this.style.boxShadow=\'0 8px 22px rgba(22, 163, 74, 0.5)\';"
                                            onmouseout="this.style.transform=\'translateY(0)\'; this.style.boxShadow=\'0 4px 16px rgba(22, 163, 74, 0.4)\';"
                                    >
                                        <span>Konfirmasi & Masuk</span>
                                        <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Script -->
                <script>
                    window.openRoleAuthModal = function(roleKey, roleTitle, roleDesc, roleIcon) {
                        // Close topbar user dropdown
                        setTimeout(() => { document.body.click(); }, 10);

                        const backdrop = document.getElementById("roleAuthModalBackdrop");
                        const card = document.getElementById("roleAuthModalCard");
                        const inputRole = document.getElementById("roleAuthInputRole");
                        const inputUsername = document.getElementById("roleAuthInputUsername");
                        const inputPassword = document.getElementById("roleAuthInputPassword");
                        const iconBox = document.getElementById("roleAuthIconBox");
                        const targetBadgeText = document.getElementById("roleAuthTargetBadgeText");
                        const descText = document.getElementById("roleAuthDescText");
                        const hintContent = document.getElementById("roleAuthHintContent");

                        if (!backdrop) return;

                        inputRole.value = roleKey;
                        inputPassword.value = "";
                        iconBox.innerHTML = roleIcon;
                        targetBadgeText.innerText = roleTitle;
                        descText.innerHTML = "Silakan masukkan username dan kata sandi untuk beralih ke mode <strong>" + roleTitle + "</strong> (" + roleDesc + ").";

                        // Set clean badges matching DLH green theme for all roles
                        if (roleKey === "admin") {
                            inputUsername.value = "' . $adminEmail . '";
                            hintContent.innerHTML = "Username: <code style=\"background:#ffffff; padding:2px 7px; border-radius:6px; border:1px solid #86efac; color:#166534; font-weight:800; font-family:monospace;\">' . $adminEmail . '</code> (atau <strong>admin</strong>)<br>Password: <code style=\"background:#ffffff; padding:2px 7px; border-radius:6px; border:1px solid #86efac; color:#166534; font-weight:800; font-family:monospace;\">password</code>";
                        } else if (roleKey === "operator") {
                            inputUsername.value = "' . $opEmail . '";
                            hintContent.innerHTML = "Username: <code style=\"background:#ffffff; padding:2px 7px; border-radius:6px; border:1px solid #86efac; color:#166534; font-weight:800; font-family:monospace;\">' . $opEmail . '</code> (atau <strong>operator</strong>)<br>Password: <code style=\"background:#ffffff; padding:2px 7px; border-radius:6px; border:1px solid #86efac; color:#166534; font-weight:800; font-family:monospace;\">password</code>";
                        } else {
                            inputUsername.value = "' . $saEmail . '";
                            hintContent.innerHTML = "Username: <code style=\"background:#ffffff; padding:2px 7px; border-radius:6px; border:1px solid #86efac; color:#166534; font-weight:800; font-family:monospace;\">' . $saEmail . '</code> (atau <strong>superadmin</strong>)<br>Password: <code style=\"background:#ffffff; padding:2px 7px; border-radius:6px; border:1px solid #86efac; color:#166534; font-weight:800; font-family:monospace;\">password</code>";
                        }

                        backdrop.style.display = "flex";
                        requestAnimationFrame(() => {
                            backdrop.style.opacity = "1";
                            if (card) card.style.transform = "scale(1)";
                            setTimeout(() => { 
                                inputPassword.focus(); 
                            }, 120);
                        });
                    };

                    window.closeRoleAuthModal = function() {
                        const backdrop = document.getElementById("roleAuthModalBackdrop");
                        const card = document.getElementById("roleAuthModalCard");
                        if (!backdrop) return;
                        backdrop.style.opacity = "0";
                        if (card) card.style.transform = "scale(0.95)";
                        setTimeout(() => {
                            backdrop.style.display = "none";
                        }, 220);
                    };

                    window.toggleRoleAuthPassword = function() {
                        const pwd = document.getElementById("roleAuthInputPassword");
                        const eyeIcon = document.getElementById("roleAuthEyeIcon");
                        if (!pwd || !eyeIcon) return;
                        if (pwd.type === "password") {
                            pwd.type = "text";
                            // Eye slash icon
                            eyeIcon.innerHTML = \'<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />\';
                        } else {
                            pwd.type = "password";
                            // Regular eye icon
                            eyeIcon.innerHTML = \'<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>\';
                        }
                    };

                    window.openRoleSelectorModal = function() {
                        setTimeout(() => { document.body.click(); }, 10);
                        const backdrop = document.getElementById("roleSelectorModalBackdrop");
                        const card = document.getElementById("roleSelectorModalCard");
                        if (!backdrop) return;
                        backdrop.style.display = "flex";
                        requestAnimationFrame(() => {
                            backdrop.style.opacity = "1";
                            if (card) card.style.transform = "scale(1)";
                        });
                    };

                    window.closeRoleSelectorModal = function() {
                        const backdrop = document.getElementById("roleSelectorModalBackdrop");
                        const card = document.getElementById("roleSelectorModalCard");
                        if (!backdrop) return;
                        backdrop.style.opacity = "0";
                        if (card) card.style.transform = "scale(0.95)";
                        setTimeout(() => {
                            backdrop.style.display = "none";
                        }, 200);
                    };

                    document.addEventListener("keydown", function(e) {
                        if (e.key === "Escape") {
                            window.closeRoleSelectorModal();
                            window.closeRoleAuthModal();
                        }
                    });
                </script>
                ';
            }
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

        // Register ActivityLog Observers for all dynamic resources
        $observedModels = [
            \App\Models\Post::class,
            \App\Models\Document::class,
            \App\Models\Service::class,
            \App\Models\Gallery::class,
            \App\Models\Banner::class,
            \App\Models\Setting::class,
            \App\Models\Profile::class,
            \App\Models\User::class,
            \App\Models\Navigation::class,
            \App\Models\QuickAccess::class,
            \App\Models\Statistic::class,
            \App\Models\RelatedLink::class,
        ];

        foreach ($observedModels as $modelClass) {
            if (class_exists($modelClass)) {
                $modelClass::observe(\App\Observers\ActivityLogObserver::class);
            }
        }

        // Register Auth Event Listeners for Login/Logout tracking
        \Illuminate\Support\Facades\Event::listen(\Illuminate\Auth\Events\Login::class, function ($event) {
            if ($event->user) {
                \App\Models\ActivityLog::record(
                    action: 'LOGIN',
                    module: 'Autentikasi',
                    description: "Pengguna {$event->user->name} ({$event->user->email}) berhasil masuk ke portal sistem.",
                    user: $event->user
                );
            }
        });

        \Illuminate\Support\Facades\Event::listen(\Illuminate\Auth\Events\Logout::class, function ($event) {
            if ($event->user) {
                \App\Models\ActivityLog::record(
                    action: 'LOGOUT',
                    module: 'Autentikasi',
                    description: "Pengguna {$event->user->name} keluar dari sesi sistem.",
                    user: $event->user
                );
            }
        });
    }
}

