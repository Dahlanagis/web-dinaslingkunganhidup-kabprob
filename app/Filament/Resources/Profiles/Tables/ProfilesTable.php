<?php

namespace App\Filament\Resources\Profiles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('section')
                    ->label('Sub-Menu Profil')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'sejarah' => 'Profil & Sejarah',
                        'visi-misi' => 'Visi & Misi',
                        'struktur' => 'Struktur Organisasi',
                        'tupoksi' => 'Tupoksi',
                        'pejabat' => 'Pejabat Pengelola',
                        'maklumat' => 'Maklumat Pelayanan',
                        default => ucwords(str_replace('-', ' ', (string) $state))
                    })
                    ->badge()
                    ->color('success')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Judul Bagian')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                ImageColumn::make('image')
                    ->label('Gambar / Bagan')
                    ->circular(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Profil')
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
