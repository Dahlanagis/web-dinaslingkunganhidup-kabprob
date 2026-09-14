<?php

namespace App\Filament\Resources\Profiles\Schemas;

use App\Filament\Forms\Components\Summernote;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Form Profil Instansi')
                    ->description('Kelola bagian profil, visi misi, tugas pokok, struktur, dan informasi kedinasan.')
                    ->icon('heroicon-o-arrow-left')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('section')
                                ->label('HALAMAN SUB-MENU PROFIL')
                                ->options([
                                    'sejarah' => 'Profil Instansi & Sejarah Singkat (/profil/sejarah)',
                                    'visi-misi' => 'Visi & Misi DLH (/profil/visi-misi)',
                                    'struktur' => 'Bagan Struktur Organisasi (/profil/struktur)',
                                    'tupoksi' => 'Tugas Pokok & Fungsi / Tupoksi (/profil/tupoksi)',
                                    'pejabat' => 'Daftar Pejabat Pengelola (/profil/pejabat)',
                                    'maklumat' => 'Maklumat Pelayanan (/profil/maklumat)',
                                ])
                                ->required()
                                ->helperText('Pilih submenu profil yang ingin ditampilkan di website.'),

                            TextInput::make('title')
                                ->label('JUDUL HALAMAN')
                                ->placeholder('Contoh: Profil & Sejarah Singkat DLH')
                                ->required()
                                ->maxLength(255),
                        ]),

                        Summernote::make('content')
                            ->label('KONTEN / ISI PROFIL')
                            ->placeholder('Ketik konten di sini (bisa sisipkan gambar/tabel)...')
                            ->height(300)
                            ->required()
                            ->columnSpanFull(),

                        FileUpload::make('image')
                            ->label('FOTO / ILUSTRASI PENDUKUNG (OPSIONAL)')
                            ->image()
                            ->directory('profiles')
                            ->disk('public')
                            ->maxSize(4096)
                            ->helperText('Format: JPG, PNG, JPEG. Ukuran maksimal 4MB.')
                            ->view('filament.forms.components.native-file-upload')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
