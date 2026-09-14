<?php

namespace App\Filament\Resources\Articles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Sampul')
                    ->square(),
                TextColumn::make('title')
                    ->label('Judul Artikel')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->description(fn (\App\Models\Article $record): string => \Illuminate\Support\Str::limit($record->slug, 35)),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'published' => 'Dipublikasikan',
                        'draft' => 'Draft',
                        default => ucfirst($state),
                    }),
                TextColumn::make('views')
                    ->label('Dibaca')
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-o-eye'),
                TextColumn::make('created_at')
                    ->label('Diterbitkan')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'published' => 'Dipublikasikan',
                        'draft' => 'Draft',
                    ]),
            ])
            ->headerActions([
                \Filament\Actions\CreateAction::make()
                    ->label('Tambah Artikel')
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
