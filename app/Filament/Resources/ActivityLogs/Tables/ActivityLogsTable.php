<?php

namespace App\Filament\Resources\ActivityLogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
                        'LOGOUT' => 'gray',
                        'UPDATE', 'UBAH' => 'warning',
                        'CREATE', 'TAMBAH' => 'success',
                        'DELETE', 'HAPUS' => 'danger',
                        'GANTI ROLE', 'SWITCH ROLE' => 'primary',
                        default => 'gray',
                    }),
                TextColumn::make('module')
                    ->label('Modul')
                    ->badge()
                    ->color('primary'),
                TextColumn::make('description')
                    ->label('Keterangan')
                    ->searchable()
                    ->wrap(),
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
                SelectFilter::make('action')
                    ->label('Filter Aksi')
                    ->options([
                        'LOGIN' => 'LOGIN',
                        'LOGOUT' => 'LOGOUT',
                        'CREATE' => 'CREATE (Tambah)',
                        'UPDATE' => 'UPDATE (Ubah)',
                        'DELETE' => 'DELETE (Hapus)',
                        'GANTI ROLE' => 'GANTI ROLE',
                    ]),
                SelectFilter::make('module')
                    ->label('Filter Modul')
                    ->options([
                        'Autentikasi' => 'Autentikasi',
                        'Role & Hak Akses' => 'Role & Hak Akses',
                        'Berita & Publikasi' => 'Berita & Publikasi',
                        'Dokumen Kinerja' => 'Dokumen Kinerja',
                        'Layanan Publik' => 'Layanan Publik',
                        'Galeri Foto' => 'Galeri Foto',
                        'Banner & Spanduk' => 'Banner & Spanduk',
                        'Pengaturan Website' => 'Pengaturan Website',
                        'Users & Role' => 'Users & Role',
                        'Menu Navigasi' => 'Menu Navigasi',
                    ]),
            ])
            ->recordActions([
                ViewAction::make()
                    ->modalHeading('Rincian Log Aktivitas Sistem')
                    ->modalDescription('Detail lengkap rekam jejak operasional administrator pada sistem portal.')
                    ->modalWidth('2xl')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
