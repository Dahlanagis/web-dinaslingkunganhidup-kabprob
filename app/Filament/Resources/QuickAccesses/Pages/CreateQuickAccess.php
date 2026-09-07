<?php

namespace App\Filament\Resources\QuickAccesses\Pages;

use App\Filament\Resources\QuickAccesses\QuickAccessResource;
use Filament\Resources\Pages\CreateRecord;

class CreateQuickAccess extends CreateRecord
{
    protected static string $resource = QuickAccessResource::class;

    public function getHeading(): string
    {
        return 'Form Tambah Akses Cepat';
    }

    public function getSubheading(): ?string
    {
        return 'Tambahkan tombol pintasan baru di beranda website publik';
    }
}
