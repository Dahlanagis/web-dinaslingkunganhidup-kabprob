<?php

namespace App\Filament\Resources\RelatedLinks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RelatedLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Form Tautan Terkait')
                    ->description('Kelola tautan instansi terkait, kemitraan, atau portal eksternal pemerintah.')
                    ->icon('heroicon-o-link')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->label('NAMA INSTANSI / TAUTAN')
                                ->placeholder('Contoh: Kementerian LHK, Pemkab Probolinggo')
                                ->prefixIcon('heroicon-m-building-library')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('url')
                                ->label('URL TAUTAN')
                                ->placeholder('Contoh: https://menlhk.go.id')
                                ->prefixIcon('heroicon-m-globe-alt')
                                ->url()
                                ->required()
                                ->maxLength(255),
                        ]),

                        Grid::make(2)->schema([
                            \Filament\Forms\Components\FileUpload::make('logo')
                                ->label('UPLOAD LOGO / IKON (OPSIONAL)')
                                ->image()
                                ->directory('links-logo')
                                ->maxSize(2048)
                                ->helperText('Maksimal ukuran file 2MB. Boleh dikosongkan jika menggunakan teks/ikon bawaan.')
                                ->view('filament.forms.components.native-file-upload'),

                            Toggle::make('is_active')
                                ->label('AKTIFKAN TAUTAN')
                                ->helperText('Tampilkan link ini di footer / halaman publik')
                                ->onColor('success')
                                ->default(true),
                        ]),
                    ]),
            ]);
    }
}
