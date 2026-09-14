<?php

namespace App\Filament\Resources\QuickAccesses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QuickAccessForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Form Akses Cepat')
                    ->description('Kelola tombol pintasan / akses cepat pada beranda website publik.')
                    ->icon('heroicon-o-arrow-left')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->label('JUDUL AKSES CEPAT')
                                ->placeholder('Contoh: SP4N LAPOR!, Halo Sae DLH')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('url')
                                ->label('TAUTAN URL')
                                ->placeholder('Contoh: https://... atau /...')
                                ->url()
                                ->required()
                                ->maxLength(255),
                        ]),

                        \App\Filament\Support\BootstrapIconSelect::make('icon')
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('AKTIFKAN DI WEBSITE')
                            ->helperText('Tampilkan tombol pintasan ini di beranda')
                            ->default(true),
                    ]),
            ]);
    }
}
