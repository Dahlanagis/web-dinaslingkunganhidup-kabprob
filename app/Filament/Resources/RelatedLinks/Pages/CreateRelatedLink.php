<?php

namespace App\Filament\Resources\RelatedLinks\Pages;

use App\Filament\Resources\RelatedLinks\RelatedLinkResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRelatedLink extends CreateRecord
{
    protected static string $resource = RelatedLinkResource::class;

    public function getHeading(): string
    {
        return 'Form Tambah Tautan Terkait';
    }

    public function getSubheading(): ?string
    {
        return 'Tambahkan tautan portal instansi mitra atau kemitraan baru';
    }
}
