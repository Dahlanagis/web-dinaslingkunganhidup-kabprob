<?php

namespace App\Filament\Resources\ActivityLogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ActivityLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('user_name')
                    ->label('Administrator')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('action')
                    ->label('Aksi')
                    ->badge()
                    ->color(fn (string $state): string => match (strtoupper($state)) {
                        'LOGIN' => 'info',
                        'UPDATE', 'UBAH' => 'warning',
                        'CREATE', 'TAMBAH' => 'success',
                        'DELETE', 'HAPUS' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('module')
                    ->label('Modul')
                    ->badge()
                    ->color('primary'),
                TextColumn::make('description')
                    ->label('Keterangan')
                    ->searchable()
                    ->limit(50),
                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->default('127.0.0.1')
                    ->copyable(),
                TextColumn::make('created_at')
                    ->label('Waktu Aktivitas')
                    ->dateTime('d M Y, H:i:s')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
