<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make(fn ($record) => $record ? 'Form Edit Galeri' : 'Form Tambah Galeri')
                    ->description('Unggah foto atau tautkan video dokumentasi kegiatan')
                    ->icon('heroicon-m-arrow-left')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('title')
                            ->label('JUDUL GALERI')
                            ->placeholder('Masukkan judul...')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                            
                        Grid::make(2)->schema([
                            Select::make('type')
                                ->label('TIPE MEDIA')
                                ->options([
                                    'foto' => '📸 Foto (Upload Gambar)',
                                    'video' => '🎥 Video (Link)',
                                ])
                                ->default('foto')
                                ->required()
                                ->reactive(),
                                
                            TextInput::make('category')
                                ->label('KATEGORI MEDIA')
                                ->datalist([
                                    'Kegiatan Lapangan',
                                    'Sosialisasi & Edukasi',
                                    'Penghargaan',
                                    'Kerja Bakti & Kebersihan',
                                    'Penghijauan Lingkungan',
                                    'Pengelolaan Sampah',
                                    'Lainnya',
                                ])
                                ->placeholder('Kegiatan Lapangan')
                                ->helperText('ℹ️ Pilih dari Master Kategori atau ketikkan nama kategori baru.'),
                        ]),
                            
                        FileUpload::make('images')
                            ->label(fn ($get) => $get('type') === 'video' ? 'UPLOAD THUMBNAIL / COVER VIDEO (OPSIONAL)' : 'UPLOAD FOTO BARU (BISA LEBIH DARI SATU)')
                            ->image()
                            ->multiple()
                            ->directory('galleries')
                            ->disk('public')
                            ->maxSize(20480)
                            ->helperText('Maksimal ukuran file 20MB per foto. Format yang didukung: JPG, PNG, JPEG.')
                            ->view('filament.forms.components.native-file-upload')
                            ->columnSpanFull(),
                            
                        Textarea::make('description')
                            ->label('DESKRIPSI SINGKAT (OPSIONAL)')
                            ->placeholder('Keterangan singkat tentang media ini...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
            ]);
    }
}