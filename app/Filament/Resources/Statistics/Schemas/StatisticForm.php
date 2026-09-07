<?php

namespace App\Filament\Resources\Statistics\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StatisticForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Form Data Statistik')
                    ->description('Kelola capaian angka kinerja dan data strategis lingkungan yang tampil di beranda.')
                    ->icon('heroicon-o-arrow-left')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->label('LABEL / NAMA INDIKATOR')
                                ->placeholder('Contoh: Ton Sampah Terkelola, Titik RTH...')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('value')
                                ->label('NILAI / ANGKA STATISTIK')
                                ->placeholder('Contoh: 45.280, 124, 85%')
                                ->required()
                                ->maxLength(100),
                        ]),

                        Grid::make(2)->schema([
                            TextInput::make('icon')
                                ->label('IKON BOOTSTRAP (OPSIONAL)')
                                ->placeholder('Contoh: bi-trash, bi-tree, bi-wind, bi-recycle')
                                ->maxLength(100),

                            Toggle::make('is_active')
                                ->label('TAMPILKAN DI WEBSITE')
                                ->helperText('Tampilkan counter angka ini di halaman beranda')
                                ->default(true),
                        ]),
                    ]),
            ]);
    }
}
