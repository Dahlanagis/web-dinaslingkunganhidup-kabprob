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
                        Grid::make(3)->schema([
                            TextInput::make('name')
                                ->label('NAMA LAYANAN')
                                ->placeholder('Contoh: Pengangkutan Sampah, Pengujian Air Limbah')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('slug')
                                ->label('SLUG SUB-MENU')
                                ->placeholder('persampahan / lab / pengaduan')
                                ->helperText('Untuk URL sub-menu (misal: persampahan, lab, pengaduan).')
                                ->maxLength(100),

                            \Filament\Forms\Components\Select::make('tag')
                                ->label('TAG / KATEGORI')
                                ->options(fn () => \App\Models\Category::whereIn('type', ['layanan', 'master'])->where('is_active', true)->pluck('name', 'name')->toArray() ?: [
                                    'Kebersihan' => 'Kebersihan',
                                    'Laboratorium' => 'Laboratorium',
                                    'Pengaduan' => 'Pengaduan',
                                    'Perizinan' => 'Perizinan',
                                    'Ruang Hijau' => 'Ruang Hijau',
                                ])
                                ->createOptionForm([
                                    TextInput::make('name')
                                        ->label('Nama Kategori Layanan')
                                        ->placeholder('Contoh: Edukasi Lingkungan')
                                        ->required(),
                                ])
                                ->createOptionUsing(function (array $data) {
                                    $cat = \App\Models\Category::create([
                                        'name' => $data['name'],
                                        'slug' => \Illuminate\Support\Str::slug($data['name']),
                                        'type' => 'layanan',
                                        'is_active' => true,
                                    ]);
                                    return $cat->name;
                                })
                                ->helperText('Pilih kategori atau klik + untuk menambah.')
                                ->searchable(),
                        ]),

                        \App\Filament\Support\BootstrapIconSelect::make('icon')
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
