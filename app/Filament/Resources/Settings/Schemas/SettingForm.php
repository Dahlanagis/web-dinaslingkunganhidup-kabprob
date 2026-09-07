<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Tabs::make('Pengaturan Website')
                    ->tabs([
                        Tab::make('Identitas Website')
                            ->icon('heroicon-o-building-office-2')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('site_name')
                                        ->label('Nama Lengkap Website / Instansi')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('site_short_name')
                                        ->label('Nama Singkat / Brand')
                                        ->placeholder('Contoh: DLH Kab. Probolinggo')
                                        ->maxLength(100),
                                ]),
                                TextInput::make('site_tagline')
                                    ->label('Slogan / Tagline Instansi')
                                    ->placeholder('Mewujudkan Lingkungan Hidup Lestari...')
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Textarea::make('site_description')
                                    ->label('Deskripsi Singkat Website')
                                    ->rows(3)
                                    ->columnSpanFull(),
                                Grid::make(2)->schema([
                                    FileUpload::make('logo_path')
                                        ->label('Logo Instansi (Transparan PNG/SVG)')
                                        ->image()
                                        ->directory('settings')
                                        ->maxSize(2048)
                                        ->view('filament.forms.components.native-file-upload'),
                                    FileUpload::make('favicon_path')
                                        ->label('Favicon Website (Icon Kecil Tab Browser)')
                                        ->image()
                                        ->directory('settings')
                                        ->maxSize(1024)
                                        ->view('filament.forms.components.native-file-upload'),
                                ]),
                            ]),

                        Tab::make('Warna & Tema Tampilan')
                            ->icon('heroicon-o-paint-brush')
                            ->schema([
                                Section::make('Kustomisasi Warna Website')
                                    ->description('Ubah warna tema website publik secara langsung dan dinamis.')
                                    ->schema([
                                        Grid::make(3)->schema([
                                            ColorPicker::make('primary_color')
                                                ->label('Warna Utama (Primary)')
                                                ->default('#1b5e20'),
                                            ColorPicker::make('secondary_color')
                                                ->label('Warna Gelap / Header (Secondary)')
                                                ->default('#103312'),
                                            ColorPicker::make('accent_color')
                                                ->label('Warna Aksen / Tombol (Accent)')
                                                ->default('#fbc02d'),
                                        ]),
                                    ]),
                                Section::make('Banner Hero Utama')
                                    ->description('Sesuaikan teks sambutan banner di bagian paling atas halaman depan.')
                                    ->schema([
                                        TextInput::make('hero_title')
                                            ->label('Judul Banner')
                                            ->maxLength(255),
                                        TextInput::make('hero_subtitle')
                                            ->label('Subjudul Banner')
                                            ->maxLength(255),
                                        Textarea::make('hero_description')
                                            ->label('Deskripsi Banner Hero')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        FileUpload::make('hero_banner_path')
                                            ->label('Gambar Background Banner (Opsional)')
                                            ->image()
                                            ->directory('settings')
                                            ->maxSize(5120)
                                            ->view('filament.forms.components.native-file-upload')
                                            ->columnSpanFull(),
                                        Textarea::make('running_text')
                                            ->label('Teks Berjalan / Pengumuman Topbar')
                                            ->rows(2)
                                            ->placeholder('Teks berita berjalan di atas header...')
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        Tab::make('Sambutan Pimpinan')
                            ->icon('heroicon-o-user-circle')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('leader_name')
                                        ->label('Nama Lengkap Pimpinan & Gelar')
                                        ->maxLength(255),
                                    TextInput::make('leader_title')
                                        ->label('Jabatan Pimpinan')
                                        ->placeholder('Contoh: Kepala Dinas Lingkungan Hidup')
                                        ->maxLength(255),
                                ]),
                                \App\Filament\Forms\Components\Summernote::make('leader_speech')
                                    ->label('Teks Kata Sambutan')
                                    ->placeholder('Tuliskan naskah kata sambutan pimpinan di sini...')
                                    ->height(280)
                                    ->columnSpanFull(),
                                FileUpload::make('leader_photo_path')
                                    ->label('Foto Resmi Pimpinan')
                                    ->image()
                                    ->directory('settings')
                                    ->maxSize(3072)
                                    ->view('filament.forms.components.native-file-upload'),
                            ]),

                        Tab::make('Kontak & Media Sosial')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Grid::make(3)->schema([
                                    TextInput::make('phone')
                                        ->label('Nomor Telepon Kantor')
                                        ->tel(),
                                    TextInput::make('whatsapp')
                                        ->label('Nomor WhatsApp Pengaduan / Pelayanan')
                                        ->tel(),
                                    TextInput::make('email')
                                        ->label('Email Resmi')
                                        ->email(),
                                ]),
                                Textarea::make('address')
                                    ->label('Alamat Lengkap Kantor')
                                    ->rows(2)
                                    ->columnSpanFull(),
                                TextInput::make('working_hours')
                                    ->label('Jam Operasional Pelayanan')
                                    ->placeholder('Senin - Jumat: 07.30 - 16.00 WIB')
                                    ->columnSpanFull(),
                                Section::make('Tautan Media Sosial Resmi')->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('facebook_url')
                                            ->label('URL Facebook')
                                            ->url()
                                            ->placeholder('https://facebook.com/...'),
                                        TextInput::make('instagram_url')
                                            ->label('URL Instagram')
                                            ->url()
                                            ->placeholder('https://instagram.com/...'),
                                        TextInput::make('youtube_url')
                                            ->label('URL YouTube Channel')
                                            ->url()
                                            ->placeholder('https://youtube.com/...'),
                                        TextInput::make('twitter_url')
                                            ->label('URL X / Twitter')
                                            ->url()
                                            ->placeholder('https://x.com/...'),
                                    ]),
                                ]),
                            ]),

                        Tab::make('Footer & Hak Cipta')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Textarea::make('footer_text')
                                    ->label('Teks Penjelasan Singkat di Footer')
                                    ->rows(3)
                                    ->columnSpanFull(),
                                TextInput::make('copyright_text')
                                    ->label('Teks Copyright')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
