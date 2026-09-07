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
                    ->icon('heroicon-o-arrow-left')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->label('NAMA INSTANSI / TAUTAN')
                                ->placeholder('Contoh: Kementerian LHK, Pemkab Probolinggo')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('url')
                                ->label('URL TAUTAN')
                                ->placeholder('Contoh: https://menlhk.go.id')
                                ->url()
                                ->required()
                                ->maxLength(255),
                        ]),

                        Grid::make(2)->schema([
                            TextInput::make('logo')
                                ->label('URL LOGO ATAU IKON (OPSIONAL)')
                                ->placeholder('Contoh: https://... atau bi-link')
                                ->maxLength(255),

                            Toggle::make('is_active')
                                ->label('AKTIFKAN TAUTAN')
                                ->helperText('Tampilkan link ini di footer / halaman publik')
                                ->default(true),
                        ]),
                    ]),
            ]);
    }
}
