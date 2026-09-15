<?php

namespace App\Filament\Resources\Galleries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ViewColumn::make('images')
                    ->label('Media / Album')
                    ->view('filament.tables.columns.gallery-preview'),

                TextColumn::make('title')
                    ->label('Judul Galeri')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->searchable()
                    ->badge(),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'foto' => 'success',
                        'video' => 'danger',
                        default => 'primary',
                    }),
                TextColumn::make('created_at')
                    ->label('Diunggah Pada')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->heading(fn () => view('filament.components.gallery-tabs'))
            ->headerActions([
                \Filament\Actions\Action::make('create_photo')
                    ->label('Tambah Foto')
                    ->icon('heroicon-o-camera')
                    ->color('success')
                    ->visible(fn ($livewire) => $livewire->activeTab === 'foto' || $livewire->activeTab === null)
                    ->url(fn () => \App\Filament\Resources\Galleries\GalleryResource::getUrl('create')),
                \Filament\Actions\Action::make('create_video')
                    ->label('Tambah Video')
                    ->icon('heroicon-o-video-camera')
                    ->color('success')
                    ->visible(fn ($livewire) => $livewire->activeTab === 'video')
                    ->url(fn () => \App\Filament\Resources\Galleries\GalleryResource::getUrl('create') . '?type=video'),
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