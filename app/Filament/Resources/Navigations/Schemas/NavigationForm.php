<?php

namespace App\Filament\Resources\Navigations\Schemas;

use App\Models\Navigation;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NavigationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Form Menu Navigasi')
                    ->description('Atur tautan menu navigasi yang tampil pada header website publik.')
                    ->icon('heroicon-o-arrow-left')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->label('LABEL MENU')
                                ->placeholder('Contoh: BERITA, PROFIL, LAYANAN')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('url')
                                ->label('TAUTAN URL')
                                ->placeholder('Contoh: /, /#profil, https://...')
                                ->required()
                                ->maxLength(255),
                        ]),
                        Grid::make(2)->schema([
                            Select::make('parent_id')
                                ->label('MENU INDUK (PARENT MENU)')
                                ->placeholder('Pilih jika menu ini merupakan Submenu/Dropdown')
                                ->options(fn () => Navigation::whereNull('parent_id')->pluck('title', 'id'))
                                ->nullable()
                                ->searchable(),
                            TextInput::make('order')
                                ->label('URUTAN TAMPIL')
                                ->numeric()
                                ->default(0)
                                ->required(),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('icon')
                                ->label('IKON BOOTSTRAP (OPSIONAL)')
                                ->placeholder('Contoh: bi-house-door, bi-newspaper')
                                ->maxLength(100),
                            Select::make('target')
                                ->label('TARGET BUKA TAUTAN')
                                ->options([
                                    '_self' => 'Buka di Tab yang Sama (_self)',
                                    '_blank' => 'Buka di Tab Baru (_blank)',
                                ])
                                ->default('_self')
                                ->required(),
                        ]),
                        Toggle::make('is_active')
                            ->label('AKTIFKAN MENU DI WEBSITE')
                            ->helperText('Tampilkan menu ini pada bar navigasi atas')
                            ->default(true),
                    ]),
            ]);
    }
}
