<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Form Akun Pengguna')
                    ->description('Kelola data akun administrator dan hak akses role sistem.')
                    ->icon('heroicon-o-arrow-left')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('NAMA LENGKAP')
                                ->placeholder('Masukkan nama lengkap...')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('email')
                                ->label('ALAMAT EMAIL')
                                ->placeholder('nama@domain.com')
                                ->email()
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->maxLength(255),
                        ]),
                        Grid::make(2)->schema([
                            Select::make('role')
                                ->label('ROLE / HAK AKSES')
                                ->options([
                                    'super_admin' => 'Super Administrator (Akses Penuh)',
                                    'admin' => 'Admin Pengelola (Kelola Konten & Dokumen)',
                                    'operator' => 'Operator (Input Data Saja)',
                                ])
                                ->default('super_admin')
                                ->required(),
                            TextInput::make('password')
                                ->label('KATA SANDI')
                                ->placeholder('Masukkan kata sandi baru...')
                                ->password()
                                ->revealable()
                                ->dehydrated(fn ($state) => filled($state))
                                ->required(fn (string $context): bool => $context === 'create')
                                ->helperText('Kosongkan jika tidak ingin mengubah password saat edit.'),
                        ]),
                    ]),
            ]);
    }
}
