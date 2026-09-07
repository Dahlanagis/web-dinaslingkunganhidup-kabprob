<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Filament\Forms\Components\Summernote;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Form Layanan Masyarakat')
                    ->description('Kelola daftar program dan layanan publik yang disediakan Dinas Lingkungan Hidup.')
                    ->icon('heroicon-o-arrow-left')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('NAMA LAYANAN')
                                ->placeholder('Contoh: Pengangkutan Sampah, Pengujian Air Limbah')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('tag')
                                ->label('TAG / KATEGORI LAYANAN')
                                ->placeholder('Contoh: Kebersihan, Perizinan, Pengaduan')
                                ->maxLength(100),
                        ]),

                        TextInput::make('icon')
                            ->label('IKON BOOTSTRAP (OPSIONAL)')
                            ->placeholder('Contoh: bi-trash, bi-droplet, bi-tree, bi-recycle')
                            ->maxLength(100)
                            ->helperText('Gunakan kode class Bootstrap Icons (misal: bi-recycle, bi-truck).')
                            ->columnSpanFull(),

                        Summernote::make('description')
                            ->label('DESKRIPSI LAYANAN')
                            ->placeholder('Ketik konten di sini (bisa sisipkan gambar/tabel)...')
                            ->height(260)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
