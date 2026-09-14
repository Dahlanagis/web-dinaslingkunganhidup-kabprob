<?php

namespace App\Filament\Resources\Galleries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images')
                    ->label('Preview Media')
                    ->disk('public')
                    ->square()
                    ->size(80)
                    ->stacked()
                    ->limit(3)
                    ->getStateUsing(function ($record) {
                        // Jika ada gambar yang diupload, gunakan gambar tersebut
                        if (!empty($record->images)) {
                            return $record->images;
                        }
                        
                        // Jika tipe video dan ada link youtube, ambil thumbnail youtube
                        if ($record->type === 'video' && !empty($record->video_url)) {
                            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $record->video_url, $match);
                            if (isset($match[1])) {
                                return ['https://img.youtube.com/vi/' . $match[1] . '/hqdefault.jpg'];
                            }
                        }
                        
                        return null;
                    }),
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