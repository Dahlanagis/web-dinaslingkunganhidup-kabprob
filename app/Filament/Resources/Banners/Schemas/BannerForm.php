<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Form Banner & Spanduk')
                    ->description('Unggah banner pengumuman atau spanduk promosi program DLH.')
                    ->icon('heroicon-o-arrow-left')
                    ->schema([
                        TextInput::make('title')
                            ->label('JUDUL BANNER / SPANDUK')
                            ->placeholder('Contoh: Sosialisasi Pengurangan Sampah Plastik')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        FileUpload::make('image')
                            ->label('GAMBAR BANNER')
                            ->image()
                            ->directory('banners')
                            ->disk('public')
                            ->maxSize(5120)
                            ->helperText('Format: JPG, PNG, JPEG. Ukuran maksimal 5MB. Disarankan berorientasi landscape.')
                            ->view('filament.forms.components.native-file-upload')
                            ->required()
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('AKTIFKAN BANNER')
                            ->helperText('Tampilkan banner ini di beranda website publik')
                            ->default(true),
                    ]),
            ]);
    }
}
