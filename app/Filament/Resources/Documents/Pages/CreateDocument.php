<?php

namespace App\Filament\Resources\Documents\Pages;

use App\Filament\Resources\Documents\DocumentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDocument extends CreateRecord
{
    protected static string $resource = DocumentResource::class;

    public function getHeading(): string
    {
        return 'Form Tambah Dokumen';
    }

    public function getSubheading(): ?string
    {
        return 'Unggah berkas dokumen publik, regulasi, atau laporan kinerja baru';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
