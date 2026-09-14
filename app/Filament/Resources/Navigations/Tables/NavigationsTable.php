<?php

namespace App\Filament\Resources\Navigations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NavigationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('order', 'asc')
            ->columns([
                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable()
                    ->badge()
                    ->color('gray'),
                TextColumn::make('title')
                    ->label('Label Menu')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('icon')
                    ->label('Ikon')
                    ->formatStateUsing(fn ($state) => \App\Filament\Support\BootstrapIconSelect::formatTableColumn($state)),
                TextColumn::make('parent.title')
                    ->label('Induk Menu')
                    ->default('Menu Utama (Root)')
                    ->badge()
                    ->color(fn ($state) => $state === 'Menu Utama (Root)' ? 'success' : 'info'),
                TextColumn::make('url')
                    ->label('URL Target')
                    ->searchable()
                    ->limit(30),
                IconColumn::make('is_active')
                    ->label('Status Aktif')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                \Filament\Actions\CreateAction::make()
                    ->label('Tambah Menu')
                    ->icon('heroicon-o-plus'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
