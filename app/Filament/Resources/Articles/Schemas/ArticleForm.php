<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Filament\Forms\Components\Summernote;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Form Artikel Edukasi Lingkungan')
                    ->description('Kelola artikel wawasan, edukasi 3R, tips pelestarian lingkungan, dan informasi Adiwiyata.')
                    ->icon('heroicon-o-book-open')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->label('JUDUL ARTIKEL')
                                ->placeholder('Contoh: Pentingnya Memilah Sampah dari Rumah Tangga')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (\Filament\Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),

                            TextInput::make('slug')
                                ->label('SLUG TAUTAN URL')
                                ->placeholder('pentingnya-memilah-sampah-dari-rumah-tangga')
                                ->required()
                                ->unique(ignoreRecord: true),
                        ]),

                        FileUpload::make('image')
                            ->label('GAMBAR SAMPUL ARTIKEL')
                            ->image()
                            ->directory('posts')
                            ->disk('public')
                            ->maxSize(5120)
                            ->helperText('Format: JPG, PNG, JPEG. Ukuran maksimal 5MB.')
                            ->view('filament.forms.components.native-file-upload')
                            ->columnSpanFull(),

                        Summernote::make('content')
                            ->label('KONTEN / ISI ARTIKEL LENGKAP')
                            ->placeholder('Tulis materi edukasi, tips, atau wawasan lingkungan hidup di sini...')
                            ->height(350)
                            ->required()
                            ->columnSpanFull(),

                        Grid::make(2)->schema([
                            Select::make('status')
                                ->label('STATUS PUBLIKASI')
                                ->options([
                                    'published' => 'Dipublikasikan (Tayang di Web)',
                                    'draft' => 'Draft (Disimpan Sementara)',
                                ])
                                ->default('published')
                                ->required(),

                            TextInput::make('views')
                                ->label('JUMLAH PEMBACA')
                                ->numeric()
                                ->default(0)
                                ->disabled()
                                ->helperText('Akumulasi pengunjung yang membaca artikel ini.'),
                        ]),
                    ]),
            ]);
    }
}
