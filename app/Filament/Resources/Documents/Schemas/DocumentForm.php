<?php

namespace App\Filament\Resources\Documents\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Form Dokumen & Publikasi')
                    ->description('Unggah berkas dokumen publik, regulasi, SOP, atau laporan kinerja instansi.')
                    ->icon('heroicon-o-arrow-left')
                    ->schema([
                        TextInput::make('title')
                            ->label('JUDUL / NAMA DOKUMEN')
                            ->placeholder('Contoh: Laporan Kinerja Instansi Pemerintah (LKjIP) Tahun 2024')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        \Filament\Schemas\Components\Grid::make(2)->schema([
                            Select::make('category')
                                ->label('KATEGORI DOKUMEN')
                                ->options([
                                    'Perencanaan Kinerja' => 'Perencanaan Kinerja',
                                    'Evaluasi Kinerja' => 'Evaluasi Kinerja',
                                    'Regulasi' => 'Regulasi & Hukum',
                                    'Laporan Tahunan' => 'Laporan Tahunan',
                                    'SOP Pelayanan' => 'SOP Pelayanan',
                                    'Lainnya' => 'Lainnya',
                                ])
                                ->required(),

                            TextInput::make('downloads')
                                ->label('JUMLAH UNDUHAN')
                                ->numeric()
                                ->default(0)
                                ->disabled()
                                ->helperText('Dihitung otomatis ketika pengunjung mengunduh berkas.'),
                        ]),

                        FileUpload::make('file_path')
                            ->label('BERKAS DOKUMEN (PDF, DOCX)')
                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                            ->directory('documents')
                            ->disk('public')
                            ->maxSize(10240)
                            ->openable()
                            ->downloadable()
                            ->helperText('Format yang didukung: PDF, DOC, DOCX. Ukuran maksimal 10MB.')
                            ->view('filament.forms.components.native-file-upload')
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
