<?php

namespace App\Filament\Support;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class BootstrapIconSelect
{
    public static function make(string $name = 'icon'): \App\Filament\Forms\Components\IconPicker
    {
        return \App\Filament\Forms\Components\IconPicker::make($name);
    }

    public static function formatTableColumn(?string $state): ?\Illuminate\Support\HtmlString
    {
        if (!$state) return null;
        $cleanName = str_replace(['bi-', 'heroicon-o-', 'heroicon-m-', 'heroicon-s-'], '', $state);
        $iconClass = str_starts_with($state, 'bi-') ? $state : 'bi-' . $cleanName;
        return new \Illuminate\Support\HtmlString("
            <div style='display:inline-flex;align-items:center;gap:7px;'>
                <i class='bi {$iconClass}' style='font-size:1.15rem;color:#16a34a;display:inline-block;'></i>
                <span style='font-family:monospace;font-size:0.75rem;color:#334155;background:#f1f5f9;padding:2px 6px;border-radius:4px;'>{$state}</span>
            </div>
        ");
    }

    public static function getIconOptions(): array
    {
        $icons = [
            // Persampahan, Kebersihan & Armada
            'bi-trash' => 'Tempat Sampah / Kebersihan Umum',
            'bi-trash3' => 'Wadah Sampah / TPS',
            'bi-trash3-fill' => 'Tempat Sampah Terisi (Solid)',
            'bi-recycle' => 'Daur Ulang / Pilah Sampah / TPS3R',
            'bi-truck' => 'Armada Truk Pengangkut Sampah',
            'bi-truck-flatbed' => 'Kendaraan Operasional Lapangan',
            'bi-box-seam' => 'Bank Sampah / Kardus & Kemasan',
            'bi-basket' => 'Keranjang & Penampungan Sampah',
            'bi-bucket' => 'Ember & Penampungan Limbah',
            'bi-water' => 'Saluran Air & Drainase Bersih',

            // Lingkungan, Pohon & Konservasi Alam
            'bi-tree' => 'Pohon / Penghijauan / Hutan Kota',
            'bi-tree-fill' => 'Pohon Lindung Rindang (Solid)',
            'bi-flower1' => 'Bunga & Taman Keanekaragaman Hayati',
            'bi-flower2' => 'Tanaman Hias & RTH Publik',
            'bi-flower3' => 'Flora & Konservasi Tumbuhan',
            'bi-droplet' => 'Tetesan Air / Sumber Daya Air',
            'bi-droplet-half' => 'Uji Kualitas Air / Hidrologi',
            'bi-droplet-fill' => 'Konservasi Air Bersih (Solid)',
            'bi-wind' => 'Angin / Kualitas Udara / Emisi (ISPU)',
            'bi-cloud-sun' => 'Cuaca Bersih & Pantauan Udara',
            'bi-cloud-sun-fill' => 'Iklim & Kualitas Udara (Solid)',
            'bi-cloud-haze2' => 'Kabut & Pemantauan Polusi Asap',
            'bi-sun' => 'Sinar Matahari / Energi Surya',
            'bi-globe-americas' => 'Kelestarian Bumi & Lingkungan Global',
            'bi-globe' => 'Wawasan Lingkungan Global',
            'bi-lightning-charge' => 'Energi Terbarukan / Efisiensi Energi',

            // Pengaduan Masyarakat & Komunikasi
            'bi-megaphone' => 'Pengaduan Masyarakat / Aspirasi',
            'bi-megaphone-fill' => 'Kanal Aduan SP4N LAPOR! (Solid)',
            'bi-headset' => 'Layanan Pelanggan & Call Center (Hallo Sae)',
            'bi-chat-dots' => 'Konsultasi & Kotak Saran Masukan',
            'bi-chat-dots-fill' => 'Pesan Interaktif (Solid)',
            'bi-whatsapp' => 'Kontak WhatsApp Pengaduan Cepat',
            'bi-telephone' => 'Hotline Telepon Pengaduan',
            'bi-telephone-fill' => 'Panggilan Resmi Dinas (Solid)',
            'bi-envelope' => 'Kirim Surat / Surel Pengaduan',

            // Laboratorium & Pengujian Mutu Lingkungan
            'bi-eyedropper' => 'Pipet / Pengambilan Sampel Uji',
            'bi-funnel' => 'Penyaringan & Filtrasi Air Limbah',
            'bi-speedometer2' => 'Alat Ukur / Baku Mutu Lingkungan',
            'bi-thermometer-half' => 'Pengukuran Suhu Lingkungan',
            'bi-clipboard-pulse' => 'Parameter Uji & Catatan Laboratorium',
            'bi-shield-virus' => 'Uji Bakteriologi & Mikrobiologi',

            // Dokumen, Kebijakan & Perizinan
            'bi-file-earmark-check' => 'Dokumen Izin Lingkungan (AMDAL/UKL-UPL)',
            'bi-file-earmark-check-fill' => 'Persetujuan Lingkungan Terbit (Solid)',
            'bi-file-earmark-text' => 'Maklumat Pelayanan Publik',
            'bi-file-earmark-text-fill' => 'Berkas Resmi Pengumuman (Solid)',
            'bi-journal-check' => 'Regulasi & Keputusan Kepala Dinas',
            'bi-file-earmark-ruled' => 'Standar Operasional Prosedur (SOP)',
            'bi-card-checklist' => 'Tugas dan Fungsi (Tupoksi)',
            'bi-shield-check' => 'Legalitas Hukum & Penegakan Perda',
            'bi-award' => 'Sertifikasi / Penghargaan Adipura',
            'bi-award-fill' => 'Prestasi Lingkungan Hidup (Solid)',

            // Lembaga, Pejabat & Struktur
            'bi-building' => 'Kantor Dinas Lingkungan Hidup',
            'bi-building-fill' => 'Gedung Pemerintahan (Solid)',
            'bi-diagram-3' => 'Struktur Organisasi / Bagan',
            'bi-diagram-3-fill' => 'Hirarki Kepemimpinan (Solid)',
            'bi-person-badge' => 'Pejabat Pengelola / Profil Pimpinan',
            'bi-person-badge-fill' => 'Identitas Pegawai ASN (Solid)',
            'bi-people' => 'Pegawai Dinas & Forum Komunitas',
            'bi-people-fill' => 'Kemitraan Masyarakat (Solid)',
            'bi-compass' => 'Visi & Misi Strategis',
            'bi-compass-fill' => 'Arah Kebijakan DLH (Solid)',
            'bi-clock-history' => 'Sejarah & Perkembangan Instansi',
            'bi-geo-alt' => 'Titik Lokasi Pantau & Peta RTH',
            'bi-geo-alt-fill' => 'Koordinat Wilayah Layanan (Solid)',

            // Berita, Publikasi & Multimedia
            'bi-newspaper' => 'Berita Lingkungan & Siaran Pers',
            'bi-journal-richtext' => 'Artikel Edukasi & Opini Lingkungan',
            'bi-images' => 'Galeri Foto & Dokumentasi Kegiatan',
            'bi-camera-video' => 'Dokumentasi Video & Liputan',
            'bi-camera-video-fill' => 'Video Kegiatan Lapangan (Solid)',
            'bi-calendar-event' => 'Agenda Aksi Bersih & Hari Lingkungan',
            'bi-calendar-event-fill' => 'Jadwal Kegiatan Resmi (Solid)',

            // Statistik, Data & Kinerja
            'bi-graph-up-arrow' => 'Grafik Tren & Capaian Indikator',
            'bi-bar-chart-line' => 'Statistik Volume Sampah & IKLH',
            'bi-bar-chart-fill' => 'Diagram Batang Kinerja (Solid)',
            'bi-pie-chart' => 'Komposisi Sampah & Neraca Limbah',
            'bi-pie-chart-fill' => 'Proporsi Data Lingkungan (Solid)',
            'bi-house-door' => 'Beranda Utama Portal Website',
            'bi-house-door-fill' => 'Halaman Awal (Solid)',
        ];

        $rendered = [];
        foreach ($icons as $class => $label) {
            $rendered[$class] = "
                <div style='display:flex;align-items:center;gap:12px;padding:3px 0;'>
                    <i class='bi {$class}' style='font-size:1.35rem;color:#15803d;width:26px;text-align:center;flex-shrink:0;'></i>
                    <div style='display:flex;flex-direction:column;line-height:1.25;'>
                        <span style='font-weight:700;color:#0f172a;font-size:0.92rem;'>{$label}</span>
                        <span style='font-size:0.75rem;color:#64748b;font-family:monospace;'>{$class}</span>
                    </div>
                </div>
            ";
        }

        return $rendered;
    }
}
