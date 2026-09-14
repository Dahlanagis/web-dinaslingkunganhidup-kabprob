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
                                ->default(request()->query('type', 'foto'))
                                ->required()
                                ->live(),
                                
                            Select::make('category')
                                ->label('KATEGORI MEDIA')
                                ->options(fn () => \App\Models\Category::whereIn('type', ['galeri', 'master'])->where('is_active', true)->pluck('name', 'name')->toArray() ?: [
                                    'Kegiatan Lapangan' => 'Kegiatan Lapangan',
                                    'Sosialisasi & Edukasi' => 'Sosialisasi & Edukasi',
                                    'Penghargaan Lingkungan' => 'Penghargaan Lingkungan',
                                    'Kerja Bakti & Kebersihan' => 'Kerja Bakti & Kebersihan',
                                    'Penghijauan & RTH' => 'Penghijauan & RTH',
                                ])
                                ->createOptionForm([
                                    TextInput::make('name')
                                        ->label('Nama Kategori Galeri')
                                        ->placeholder('Contoh: Kegiatan Pameran Lingkungan')
                                        ->required(),
                                ])
                                ->createOptionUsing(function (array $data) {
                                    $cat = \App\Models\Category::create([
                                        'name' => $data['name'],
                                        'slug' => \Illuminate\Support\Str::slug($data['name']),
                                        'type' => 'galeri',
                                        'is_active' => true,
                                    ]);
                                    return $cat->name;
                                })
                                ->helperText('Pilih kategori atau klik tombol + untuk menambah baru.')
                                ->searchable(),

                            TextInput::make('video_url')
                                ->label('LINK VIDEO YOUTUBE')
                                ->placeholder('https://www.youtube.com/watch?v=...')
                                ->url()
                                ->visible(fn ($get, $record) => $get('type') === 'video' || ($record && $record->type === 'video'))
                                ->required(fn ($get, $record) => $get('type') === 'video' || ($record && $record->type === 'video'))
                                ->columnSpanFull(),
                        ]),
                            
                        FileUpload::make('images')
                            ->label(fn ($get, $record) => ($get('type') === 'video' || ($record && $record->type === 'video')) ? 'UPLOAD THUMBNAIL / COVER VIDEO (OPSIONAL)' : 'UPLOAD FOTO BARU (BISA LEBIH DARI SATU)')
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