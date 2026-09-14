<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Filament\Forms\Components\Summernote;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Form Berita & Publikasi')
                    ->description('Kelola artikel berita, liputan kegiatan lapangan, dan pengumuman instansi.')
                    ->icon('heroicon-o-arrow-left')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->label('JUDUL BERITA')
                                ->placeholder('Contoh: DLH Ajak Masyarakat Pilah Sampah dari Rumah')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (\Filament\Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),

                            TextInput::make('slug')
                                ->label('SLUG TAUTAN URL')
                                ->placeholder('dlh-ajak-masyarakat-pilah-sampah')
                                ->required()
                                ->unique(ignoreRecord: true),
                        ]),

                        FileUpload::make('image')
                            ->label('GAMBAR SAMPUL BERITA')
                            ->image()
                            ->directory('posts')
                            ->disk('public')
                            ->maxSize(5120)
                            ->helperText('Format yang didukung: JPG, PNG, JPEG. Ukuran maksimal 5MB.')
                            ->view('filament.forms.components.native-file-upload')
                            ->columnSpanFull(),

                        Summernote::make('content')
                            ->label('KONTEN / ISI BERITA LENGKAP')
                            ->placeholder('Ketik konten di sini (bisa sisipkan gambar/tabel)...')
                            ->height(350)
                            ->required()
                            ->columnSpanFull(),

                        Grid::make(3)->schema([
                            Select::make('category')
                                ->label('KATEGORI KONTEN')
                                ->options(fn () => \App\Models\Category::whereIn('type', ['konten', 'master'])->where('is_active', true)->pluck('name', 'slug')->toArray() ?: [
                                    'berita' => 'Berita Kegiatan / Terkini',
                                    'artikel' => 'Artikel Edukasi Lingkungan',
                                ])
                                ->createOptionForm([
                                    TextInput::make('name')
                                        ->label('Nama Kategori Baru')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn ($set, $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                                    TextInput::make('slug')
                                        ->label('Slug / Kode')
                                        ->required(),
                                ])
                                ->createOptionUsing(function (array $data) {
                                    $cat = \App\Models\Category::create([
                                        'name' => $data['name'],
                                        'slug' => $data['slug'],
                                        'type' => 'konten',
                                        'is_active' => true,
                                    ]);
                                    return $cat->slug;
                                })
                                ->helperText('Pilih kategori atau klik tombol + untuk menambah baru.')
                                ->default('berita')
                                ->required(),

                            Select::make('status')
                                ->label('STATUS PUBLIKASI')
                                ->options([
                                    'published' => 'Dipublikasikan (Tayang di Web)',
                                    'draft' => 'Draft (Disimpan Sementara)',
                                ])
                                ->default('published')
                                ->required(),

                            TextInput::make('views')
                                ->label('JUMLAH TAYANGAN')
                                ->numeric()
                                ->default(0)
                                ->disabled()
                                ->helperText('Akumulasi pembaca yang mengakses artikel ini.'),
                        ]),
                    ]),
            ]);
    }
}
