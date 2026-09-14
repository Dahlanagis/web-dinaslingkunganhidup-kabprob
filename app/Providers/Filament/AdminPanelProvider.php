<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Filament\Support\Assets\Css;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            // ->login() // Dinonaktifkan untuk menggunakan halaman login kustom Laravel
            ->brandName('Portal Admin DLH')
            ->favicon(function () {
                $setting = \App\Models\Setting::first();
                $fav = $setting?->favicon_path ?: $setting?->logo_path;
                return $fav ? asset('storage/' . $fav) : null;
            })
            ->renderHook(
                'panels::styles.after',
                fn (): string => new \Illuminate\Support\HtmlString('
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
                    <link rel="stylesheet" href="/vendor/summernote/summernote-lite.min.css">
                    <script src="/vendor/summernote/jquery.min.js"></script>
                    <script src="/vendor/summernote/summernote-lite.min.js"></script>
                    <style>
                        /* SUMMERNOTE LITE CUSTOM THEME */
                        .summernote-editor-container {
                            width: 100% !important;
                            display: block !important;
                        }
                        .note-editor.note-frame {
                            border: 1px solid #cbd5e1 !important;
                            border-radius: 0.5rem !important;
                            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
                            background-color: #ffffff !important;
                            font-family: inherit !important;
                            overflow: visible !important;
                        }
                        .note-editor.note-frame:focus-within {
                            border-color: #10b981 !important;
                            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2) !important;
                        }
                        .note-editor.note-frame .note-toolbar {
                            background-color: #f8fafc !important;
                            border-bottom: 1px solid #e2e8f0 !important;
                            padding: 8px 10px !important;
                            border-top-left-radius: 0.5rem !important;
                            border-top-right-radius: 0.5rem !important;
                            display: flex !important;
                            flex-wrap: wrap !important;
                            align-items: center !important;
                            gap: 4px !important;
                        }
                        .note-editor.note-frame .note-btn-group {
                            margin-right: 6px !important;
                            margin-bottom: 4px !important;
                            background: #ffffff !important;
                            border: 1px solid #e2e8f0 !important;
                            border-radius: 0.375rem !important;
                            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03) !important;
                            display: inline-flex !important;
                            align-items: center !important;
                        }
                        .note-editor.note-frame .note-btn {
                            background: #ffffff !important;
                            border: none !important;
                            border-right: 1px solid #f1f5f9 !important;
                            color: #334155 !important;
                            padding: 6px 10px !important;
                            font-size: 13px !important;
                            transition: all 0.15s ease !important;
                            cursor: pointer !important;
                        }
                        .note-editor.note-frame .note-btn:last-child {
                            border-right: none !important;
                        }
                        .note-editor.note-frame .note-btn:hover,
                        .note-editor.note-frame .note-btn.active {
                            background-color: #f1f5f9 !important;
                            color: #0f172a !important;
                        }
                        .note-editor.note-frame .note-editing-area {
                            background-color: #ffffff !important;
                            position: relative !important;
                        }
                        .note-editor.note-frame .note-editable {
                            font-family: inherit !important;
                            font-size: 0.95rem !important;
                            line-height: 1.6 !important;
                            color: #1e293b !important;
                            background-color: #ffffff !important;
                            padding: 14px 16px !important;
                        }
                        .note-placeholder {
                            color: #94a3b8 !important;
                            font-size: 0.95rem !important;
                            padding: 14px 16px !important;
                        }
                        .note-modal {
                            z-index: 100050 !important;
                        }
                        .note-modal-backdrop {
                            z-index: 100040 !important;
                            background-color: rgba(15, 23, 42, 0.5) !important;
                        }
                        .note-dropdown-menu {
                            z-index: 100060 !important;
                            border: 1px solid #e2e8f0 !important;
                            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
                            border-radius: 0.375rem !important;
                            background-color: #ffffff !important;
                        }
                        .note-editor.note-frame .note-statusbar {
                            background-color: #f8fafc !important;
                            border-top: 1px solid #e2e8f0 !important;
                            border-bottom-left-radius: 0.5rem !important;
                            border-bottom-right-radius: 0.5rem !important;
                        }

                        /* NATIVE FILE UPLOAD STYLING (Matching User Screenshot) */
                        .native-file-upload-box {
                            border: 1.5px dashed #cbd5e1 !important;
                            border-radius: 12px !important;
                            background-color: #f8fafc !important;
                            padding: 18px 22px !important;
                            transition: border-color 0.2s ease !important;
                        }
                        .native-file-upload-box:hover {
                            border-color: #94a3b8 !important;
                        }
                        .native-file-input-control {
                            display: block !important;
                            width: 100% !important;
                            background: #ffffff !important;
                            border: 1px solid #e2e8f0 !important;
                            border-radius: 8px !important;
                            padding: 5px 6px !important;
                            font-size: 14px !important;
                            color: #334155 !important;
                            box-sizing: border-box !important;
                            cursor: pointer !important;
                            outline: none !important;
                        }
                        .native-file-input-control:focus {
                            border-color: #10b981 !important;
                            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.15) !important;
                        }
                        .native-file-input-control::file-selector-button,
                        .native-file-input-control::-webkit-file-upload-button {
                            background-color: #166534 !important; /* Forest Green matching screenshot */
                            color: #ffffff !important;
                            border: none !important;
                            border-radius: 6px !important;
                            padding: 8px 18px !important;
                            font-weight: 600 !important;
                            font-size: 13.5px !important;
                            cursor: pointer !important;
                            margin-right: 14px !important;
                            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
                            transition: all 0.2s ease !important;
                        }
                        .native-file-input-control::file-selector-button:hover,
                        .native-file-input-control::-webkit-file-upload-button:hover {
                            background-color: #14532d !important;
                            transform: translateY(-1px) !important;
                        }

                        /* Suppress duplicate outer helper text when native file upload is used */
                        .fi-fo-field-wrp:has(.native-file-upload-box) > .fi-fo-field-wrp-helper-text,
                        .fi-fo-field-wrp:has(.native-file-upload-box) > div > .fi-fo-field-wrp-helper-text {
                            display: none !important;
                        }
                        .native-file-upload-box .native-file-helper-text {
                            display: block !important;
                        }

                        /* RESET: Menghapus semua kotak latar belakang pada menu */
                        .fi-sidebar-item,
                        .fi-sidebar-item > a,
                        .fi-sidebar-item > button,
                        .fi-sidebar-item-active,
                        .fi-sidebar-item-active > a,
                        .fi-sidebar-item-active > button {
                            background-color: transparent !important;
                            background: transparent !important;
                            box-shadow: none !important;
                            border: none !important;
                            border-radius: 0 !important;
                            margin: 0 !important;
                        }
                        
                        /* Menghapus pseudo-element bawaan */
                        .fi-sidebar-item > a::before,
                        .fi-sidebar-item-active > a::before {
                            display: none !important;
                        }

                        /* BASE STYLE: Text dan jarak */
                        .fi-sidebar-item > a,
                        .fi-sidebar-item > button {
                            padding: 0.75rem 1rem !important;
                            color: #cbd5e1 !important; /* Slate 300 - Natural text */
                            font-weight: 500 !important;
                            border-left: none !important;
                            border: none !important;
                            transition: all 0.2s ease-in-out !important;
                            border-bottom: 1px solid rgba(255, 255, 255, 0.03) !important;
                        }
                        
                        /* Ikon bawaan */
                        .fi-sidebar-item > a > svg,
                        .fi-sidebar-item > button > svg {
                            color: #94a3b8 !important; /* Slate 400 */
                            transition: color 0.2s ease-in-out !important;
                        }

                        /* HOVER STATE */
                        .fi-sidebar-item > a:hover,
                        .fi-sidebar-item > button:hover {
                            background-color: rgba(255, 255, 255, 0.04) !important;
                            color: #f8fafc !important; /* Slate 50 - lebih terang */
                        }
                        .fi-sidebar-item > a:hover > svg,
                        .fi-sidebar-item > button:hover > svg {
                            color: #10b981 !important; /* Emerald 500 - Teal/Green */
                        }

                        /* ACTIVE STATE */
                        .fi-sidebar-item-active > a,
                        .fi-sidebar-item-active > button {
                            border-left: none !important;
                            border: none !important;
                            outline: none !important;
                            color: #ffffff !important;
                            background-color: rgba(255, 255, 255, 0.02) !important; /* Sangat subtle */
                        }
                        .fi-sidebar-item-active > a > svg,
                        .fi-sidebar-item-active > button > svg {
                            color: #34d399 !important; /* Emerald 400 - Ikon lebih menonjol */
                        }
                        
                        /* Menghapus border bawah pada item terakhir grup */
                        .fi-sidebar-group:last-child .fi-sidebar-item:last-child > a {
                            border-bottom: none !important;
                        }

                        /* =========================================
                           PUSATKAN POSISI & TATA LETAK FORM (CENTERED)
                           ========================================= */
                        
                        /* Pusatkan seluruh halaman Create & Edit di tengah layar */
                        .fi-resource-create-record-page,
                        .fi-resource-edit-record-page,
                        .fi-page:has(.fi-sc-form) {
                            display: flex !important;
                            flex-direction: column !important;
                            align-items: center !important;
                            width: 100% !important;
                        }

                        .fi-resource-create-record-page .fi-page-header-main-ctn,
                        .fi-resource-edit-record-page .fi-page-header-main-ctn,
                        .fi-page-header-main-ctn:has(.fi-sc-form) {
                            width: 100% !important;
                            max-width: 920px !important;
                            margin-left: auto !important;
                            margin-right: auto !important;
                        }

                        .fi-page-main,
                        .fi-page-content {
                            width: 100% !important;
                        }

                        /* Form pembungkus berada di tengah dengan lebar maksimal 920px */
                        .fi-sc-form {
                            width: 100% !important;
                            max-width: 920px !important;
                            margin-left: auto !important;
                            margin-right: auto !important;
                        }

                        /* Pastikan grid form tidak membatasi menjadi 2 kolom terjepit */
                        .fi-sc-form > .fi-grid,
                        .fi-sc-form > .fi-grid.lg\:fi-grid-cols {
                            --cols-lg: repeat(1, minmax(0, 1fr)) !important;
                            --cols-default: repeat(1, minmax(0, 1fr)) !important;
                            grid-template-columns: repeat(1, minmax(0, 1fr)) !important;
                            width: 100% !important;
                        }

                        .fi-sc-form > .fi-grid > .fi-grid-col {
                            grid-column: 1 / -1 !important;
                            width: 100% !important;
                        }

                        /* Container Card (Form Section) */
                        .fi-section,
                        .fi-sc-section {
                            background-color: #ffffff !important;
                            border: 1px solid #e2e8f0 !important;
                            border-radius: 16px !important;
                            box-shadow: 0 4px 25px -3px rgba(0, 0, 0, 0.06), 0 2px 8px -2px rgba(0, 0, 0, 0.03) !important;
                            padding: 2.25rem 2.5rem !important;
                            transition: all 0.3s ease !important;
                            width: 100% !important;
                            max-width: 920px !important;
                            margin-left: auto !important;
                            margin-right: auto !important;
                            box-sizing: border-box !important;
                        }

                        .fi-ta-ctn,
                        .fi-wi {
                            transition: all 0.3s ease !important;
                            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03), 0 2px 4px -2px rgba(0, 0, 0, 0.03) !important;
                            border: 1px solid rgba(226, 232, 240, 0.8) !important;
                            border-radius: 14px !important;
                            background-color: #ffffff !important;
                        }

                        /* Sembunyikan header luar default Filament pada halaman Create & Edit agar tampilan fokus pada kartu */
                        .fi-resource-create-page > .fi-header,
                        .fi-resource-edit-page > .fi-header,
                        .fi-page-create-record > .fi-header,
                        .fi-page-edit-record > .fi-header,
                        .fi-resource-create-record-page > .fi-page-header-main-ctn > .fi-header,
                        .fi-resource-edit-record-page > .fi-page-header-main-ctn > .fi-header {
                            display: none !important;
                        }

                        /* =========================================
                           HEADER KARTU DENGAN TOMBOL KEMBALI [ ← ]
                           ========================================= */
                        .fi-section-header {
                            display: flex !important;
                            align-items: center !important;
                            gap: 1rem !important;
                            padding-bottom: 1.25rem !important;
                            margin-bottom: 1.75rem !important;
                            border-bottom: 1px solid #f1f5f9 !important;
                        }

                        /* Tombol Kotak Kembali [ ← ] seperti di gambar referensi */
                        .fi-section-header-icon-ctn,
                        .fi-section-header .fi-icon-btn,
                        .fi-section-header > svg,
                        .fi-section-header .fi-section-header-icon {
                            background-color: #f1f5f9 !important;
                            border: 1.5px solid #e2e8f0 !important;
                            border-radius: 12px !important;
                            width: 42px !important;
                            height: 42px !important;
                            min-width: 42px !important;
                            min-height: 42px !important;
                            display: flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                            color: #1e293b !important;
                            cursor: pointer !important;
                            transition: all 0.25s ease !important;
                            padding: 8px !important;
                            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
                        }

                        .fi-section-header-icon-ctn:hover,
                        .fi-section-header .fi-section-header-icon:hover {
                            background-color: #e2e8f0 !important;
                            color: #0f172a !important;
                            transform: translateX(-3px) !important;
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08) !important;
                        }

                        .fi-section-header-heading {
                            font-size: 1.35rem !important;
                            font-weight: 700 !important;
                            color: #0f172a !important;
                            letter-spacing: -0.01em !important;
                            line-height: 1.3 !important;
                        }

                        .fi-section-header-description {
                            font-size: 0.875rem !important;
                            color: #64748b !important;
                            margin-top: 0.25rem !important;
                            line-height: 1.4 !important;
                        }

                        /* =========================================
                           PREMIUM FORM (LABELS & INPUTS)
                           ========================================= */
                        
                        /* Field Labels: Huruf Kapital Rapi */
                        .fi-fo-field-wrp-label label,
                        .fi-fo-field-wrp-label span {
                            font-size: 0.775rem !important;
                            font-weight: 700 !important;
                            text-transform: uppercase !important;
                            letter-spacing: 0.05em !important;
                            color: #334155 !important;
                        }

                        /* Form Inputs & Selects */
                        .fi-input-wrapper {
                            border-radius: 10px !important;
                            border: 1.5px solid #cbd5e1 !important;
                            background-color: #ffffff !important;
                            transition: all 0.25s ease !important;
                            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03) !important;
                        }
                        .fi-input-wrapper:focus-within {
                            background-color: #ffffff !important;
                            border-color: #10b981 !important;
                            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15) !important;
                        }
                        .fi-input {
                            background: transparent !important;
                            font-size: 0.925rem !important;
                            color: #1e293b !important;
                        }
                        .fi-input::placeholder {
                            color: #94a3b8 !important;
                        }

                        /* =========================================
                           TABLE PAGINATION ("per halaman") STYLING
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

                        /* Selection Indicator Bar ("X data dipilih | Hapus semua pilihan | Batalkan semua pilihan") */
                        .fi-ta-selection-indicator {
                            align-items: center !important;
                            justify-content: space-between !important;
                            padding: 10px 18px !important;
                            background-color: #f8fafc !important;
                            border-bottom: 1px solid #e2e8f0 !important;
                        }
                        .fi-ta-selection-indicator:not([hidden]):not([style*="display: none"]):not([x-cloak]) {
                            display: flex !important;
                        }
                        .fi-ta-selection-indicator[hidden],
                        .fi-ta-selection-indicator[style*="display: none"],
                        [hidden].fi-ta-selection-indicator,
                        [x-cloak].fi-ta-selection-indicator {
                            display: none !important;
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

                        /* =========================================
                           SUPER KEREN: FILE UPLOAD DROPZONE
                           ========================================= */

                        /* Hapus double box & reset padding luar */
                        .fi-fo-file-upload {
                            border: none !important;
                            background: transparent !important;
                            padding: 0 !important;
                            box-shadow: none !important;
                        }

                        .fi-fo-file-upload .filepond--root {
                            margin-bottom: 0 !important;
                            font-family: inherit !important;
                        }

                        /* Single elegant dropzone panel dengan border halus */
                        .fi-fo-file-upload .filepond--panel-root {
                            background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%) !important;
                            border: 2px dashed #94a3b8 !important;
                            border-radius: 16px !important;
                            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02) !important;
                        }

                        /* Efek Hover File Upload: Glow Hijau DLH (Emerald) */
                        .fi-fo-file-upload:hover .filepond--panel-root {
                            border-color: #10b981 !important;
                            background: linear-gradient(180deg, #f0fdf4 0%, #ecfdf5 100%) !important;
                            box-shadow: 0 8px 24px -4px rgba(16, 185, 129, 0.18) !important;
                            transform: translateY(-2px);
                        }

                        /* Label Dropzone dengan layout vertikal yang rapi */
                        .fi-fo-file-upload .filepond--drop-label {
                            min-height: 130px !important;
                            cursor: pointer !important;
                            display: flex !important;
                            flex-direction: column !important;
                            align-items: center !important;
                            justify-content: center !important;
                            padding: 1.5rem 1rem !important;
                        }

                        /* Ikon Awan Upload Modern di atas teks */
                        .fi-fo-file-upload .filepond--drop-label::before {
                            content: "" !important;
                            display: block !important;
                            width: 50px !important;
                            height: 50px !important;
                            margin-bottom: 0.75rem !important;
                            background-color: #ffffff !important;
                            background-image: url("data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.8%22 stroke=%22%23059669%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z%22 /%3E%3C/svg%3E") !important;
                            background-repeat: no-repeat !important;
                            background-position: center !important;
                            background-size: 26px 26px !important;
                            border-radius: 12px !important;
                            border: 1px solid #e2e8f0 !important;
                            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.04) !important;
                            transition: all 0.3s ease !important;
                        }

                        .fi-fo-file-upload:hover .filepond--drop-label::before {
                            background-color: #10b981 !important;
                            background-image: url("data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.8%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z%22 /%3E%3C/svg%3E") !important;
                            transform: translateY(-3px) scale(1.06) !important;
                            box-shadow: 0 6px 14px rgba(16, 185, 129, 0.35) !important;
                            border-color: #10b981 !important;
                        }

                        .fi-fo-file-upload .filepond--drop-label label {
                            font-size: 0.95rem !important;
                            color: #475569 !important;
                            font-weight: 500 !important;
                            cursor: pointer !important;
                            line-height: 1.5 !important;
                        }

                        .fi-fo-file-upload .filepond--label-action {
                            color: #059669 !important;
                            font-weight: 700 !important;
                            text-decoration: none !important;
                            padding: 3px 10px !important;
                            border-radius: 6px !important;
                            background-color: #ffffff !important;
                            border: 1.5px solid #cbd5e1 !important;
                            box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important;
                            margin-left: 6px !important;
                            display: inline-block !important;
                            transition: all 0.2s ease !important;
                        }

                        .fi-fo-file-upload .filepond--label-action:hover {
                            background-color: #10b981 !important;
                            color: #ffffff !important;
                            border-color: #10b981 !important;
                            box-shadow: 0 3px 8px rgba(16, 185, 129, 0.35) !important;
                        }

                        /* =========================================
                           SUPER KEREN: RICH TEXT EDITOR
                           ========================================= */

                        .fi-fo-rich-editor {
                            border: 1.5px solid #cbd5e1 !important;
                            border-radius: 14px !important;
                            background-color: #ffffff !important;
                            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03) !important;
                            overflow: hidden !important;
                            transition: all 0.25s ease !important;
                        }

                        .fi-fo-rich-editor:focus-within {
                            border-color: #10b981 !important;
                            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15), 0 4px 12px rgba(0, 0, 0, 0.04) !important;
                        }

                        /* Toolbar Header Editor */
                        .fi-fo-rich-editor-toolbar {
                            background: #f8fafc !important;
                            border-bottom: 1.5px solid #f1f5f9 !important;
                            padding: 0.5rem 0.75rem !important;
                            display: flex !important;
                            flex-wrap: wrap !important;
                            align-items: center !important;
                            gap: 0.35rem !important;
                        }

                        /* Grouping Tombol Toolbar */
                        .fi-fo-rich-editor-toolbar-group {
                            display: flex !important;
                            align-items: center !important;
                            gap: 2px !important;
                            padding: 2px 4px !important;
                            border-radius: 8px !important;
                            background-color: rgba(241, 245, 249, 0.8) !important;
                            border: 1px solid rgba(226, 232, 240, 0.9) !important;
                        }

                        /* Tombol Ikon Toolbar */
                        .fi-fo-rich-editor-tool {
                            border-radius: 6px !important;
                            color: #475569 !important;
                            width: 32px !important;
                            height: 32px !important;
                            display: inline-flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                            transition: all 0.15s ease !important;
                            border: none !important;
                            background: transparent !important;
                        }

                        .fi-fo-rich-editor-tool:hover {
                            background-color: #ffffff !important;
                            color: #059669 !important;
                            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08) !important;
                            transform: translateY(-1px) !important;
                        }

                        /* Tombol Aktif / Terpilih */
                        .fi-fo-rich-editor-tool[data-active],
                        .fi-fo-rich-editor-tool.fi-active {
                            background-color: #ecfdf5 !important;
                            color: #059669 !important;
                            font-weight: 700 !important;
                            box-shadow: inset 0 1px 2px rgba(5, 150, 105, 0.15) !important;
                        }

                        /* Area Menulis Konten Berita */
                        .fi-fo-rich-editor-content,
                        .fi-fo-rich-editor-content .ProseMirror,
                        .fi-fo-rich-editor-main {
                            min-height: 280px !important;
                            padding: 1.25rem 1.5rem !important;
                            font-size: 0.95rem !important;
                            line-height: 1.75 !important;
                            color: #1e293b !important;
                            background-color: #ffffff !important;
                            outline: none !important;
                        }

                        .fi-fo-rich-editor-content .ProseMirror p.is-editor-empty:first-child::before {
                            color: #94a3b8 !important;
                            font-style: normal !important;
                        }

                        /* =========================================
                           TOMBOL AKSI FORM (ACTION BUTTONS)
                           ========================================= */
                        
                        .fi-form-actions {
                            display: flex !important;
                            align-items: center !important;
                            gap: 0.75rem !important;
                            padding-top: 1.5rem !important;
                            margin-top: 1.5rem !important;
                            border-top: 1px solid #f1f5f9 !important;
                        }

                        .fi-btn {
                            transition: all 0.25s ease-in-out !important;
                            border-radius: 10px !important;
                            font-weight: 600 !important;
                            font-size: 0.925rem !important;
                            padding: 0.65rem 1.25rem !important;
                        }

                        /* Primary Button (Simpan) */
                        .fi-btn[color="primary"], 
                        button[type="submit"].fi-btn {
                            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
                            border: none !important;
                            color: #ffffff !important;
                            box-shadow: 0 4px 14px 0 rgba(16, 185, 129, 0.4) !important;
                        }
                        .fi-btn[color="primary"]:hover,
                        button[type="submit"].fi-btn:hover {
                            background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
                            transform: translateY(-2px) !important;
                            box-shadow: 0 6px 18px 0 rgba(16, 185, 129, 0.5) !important;
                        }

                        /* Cancel/Secondary Button */
                        .fi-btn[color="gray"] {
                            background-color: #ffffff !important;
                            border: 1.5px solid #cbd5e1 !important;
                            color: #475569 !important;
                            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02) !important;
                        }
                        .fi-btn[color="gray"]:hover {
                            background-color: #f1f5f9 !important;
                            color: #0f172a !important;
                            border-color: #94a3b8 !important;
                            transform: translateY(-2px) !important;
                        }

                        /* =========================================
                           TABS STYLING
                           ========================================= */
                        .fi-tabs {
                            display: none !important; /* Disembunyikan karena sudah dipindah ke dalam header tabel */
                        }

                        /* Pastikan area kiri table header tetap normal */
                        .fi-ta-header {
                            min-height: auto !important;
                            display: flex !important;
                            justify-content: space-between !important;
                            align-items: center !important;
                            padding-top: 1rem !important;
                            padding-bottom: 1rem !important;
                        }
                        
                        /* Munculkan kembali heading tabel jika ada */
                        .fi-ta-header .fi-ta-header-heading,
                        .fi-ta-header .fi-ta-header-description {
                            display: block !important;
                        }
                        /* =========================================
                           MODAL CUSTOMIZATION (Premium UI)
                           ========================================= */
                        /* Efek blur pada latar belakang (Mac/iOS style) */
                        .fi-modal-backdrop {
                            background-color: rgba(15, 23, 42, 0.4) !important;
                            backdrop-filter: blur(8px) !important;
                            -webkit-backdrop-filter: blur(8px) !important;
                        }

                        /* Kotak Utama Pop-up */
                        .fi-modal-window {
                            border-radius: 32px !important;
                            box-shadow: 0 35px 60px -15px rgba(0, 0, 0, 0.3) !important;
                            border: 1px solid rgba(255, 255, 255, 0.5) !important;
                            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%) !important;
                            overflow: hidden !important;
                            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
                        }
                        
                        /* Area Icon Header */
                        .fi-modal-header {
                            padding-top: 2.5rem !important;
                            padding-bottom: 0.5rem !important;
                        }
                        
                        /* Delete/Danger Icon di tengah (diperbesar dan menyala) */
                        .fi-modal-header div[class*="bg-danger-"] {
                            border-radius: 50% !important;
                            padding: 1.2rem !important;
                            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.25) !important;
                            transform: scale(1.15) !important;
                            margin-bottom: 1rem !important;
                        }
                        
                        /* Teks Judul dan Deskripsi */
                        .fi-modal-heading {
                            font-size: 1.35rem !important;
                            font-weight: 800 !important;
                            color: #0f172a !important;
                            letter-spacing: -0.02em !important;
                        }
                        .fi-modal-description {
                            font-size: 1rem !important;
                            color: #64748b !important;
                            margin-top: 0.5rem !important;
                        }

                        /* Footer (Area Tombol) */
                        .fi-modal-footer {
                            padding: 1.75rem 2rem !important;
                            background: rgba(248, 250, 252, 0.6) !important;
                            border-top: 1px solid rgba(0, 0, 0, 0.04) !important;
                        }
                        
                        /* Modal Footer Buttons */
                        .fi-modal-footer .fi-btn {
                            border-radius: 16px !important;
                            font-weight: 700 !important;
                            padding-top: 0.8rem !important;
                            padding-bottom: 0.8rem !important;
                            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                            text-transform: uppercase !important;
                            letter-spacing: 0.5px !important;
                            font-size: 0.85rem !important;
                        }
                        
                        /* Hover Effect for Buttons */
                        .fi-modal-footer .fi-btn:hover {
                            transform: translateY(-3px) !important;
                            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
                        }

                    </style>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            document.addEventListener("click", function(e) {
                                const backBtn = e.target.closest(".fi-section-header-icon-ctn") || e.target.closest(".fi-section-header-icon");
                                if (backBtn && (window.location.pathname.includes("/create") || window.location.pathname.includes("/edit"))) {
                                    e.preventDefault();
                                    window.history.back();
                                }
                            });
                        });
                    </script>
                ')
            )
            ->colors([
                'primary' => '#1b5e20', // DLH Green
                'gray' => Color::Slate,
            ])
            ->font('Plus Jakarta Sans')
            ->sidebarCollapsibleOnDesktop()
            ->darkMode(false)
            ->navigationGroups([
                \Filament\Navigation\NavigationGroup::make()->label('KELOLA KONTEN'),
                \Filament\Navigation\NavigationGroup::make()->label('MENU UTAMA'),
            ])
            ->navigationItems([
                \Filament\Navigation\NavigationItem::make('Lihat Website Utama')
                    ->url('/', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->group('MENU UTAMA')
                    ->sort(5)
                    ->extraAttributes(['class' => 'sidebar-nav-website-link']),
                \Filament\Navigation\NavigationItem::make('Log Out')
                    ->url('/logout')
                    ->icon('heroicon-o-arrow-left-on-rectangle')
                    ->group('MENU UTAMA')
                    ->sort(6)
                    ->extraAttributes(['class' => 'sidebar-nav-logout-link']),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                \App\Filament\Widgets\GreetingWidget::class,
                \App\Filament\Widgets\OverviewStatsWidget::class,
                \App\Filament\Widgets\LatestDocumentsWidget::class,
                \App\Filament\Widgets\LatestNewsWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
