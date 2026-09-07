<?php

namespace App\Filament\Resources\ActivityLogs\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ActivityLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Rincian Log Aktivitas')
                    ->description('Detail rekam jejak aktivitas operasional sistem oleh administrator.')
                    ->icon('heroicon-o-arrow-left')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('user_name')
                                ->label('ADMINISTRATOR')
                                ->disabled(),
                            TextInput::make('action')
                                ->label('AKSI')
                                ->disabled(),
                            TextInput::make('module')
                                ->label('MODUL SISTEM')
                                ->disabled(),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('ip_address')
                                ->label('IP ADDRESS')
                                ->disabled(),
                            TextInput::make('created_at')
                                ->label('WAKTU KEJADIAN')
                                ->disabled(),
                        ]),
                        Textarea::make('description')
                            ->label('DESKRIPSI AKTIVITAS')
                            ->rows(3)
                            ->disabled()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
