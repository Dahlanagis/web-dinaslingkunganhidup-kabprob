<?php

namespace App\Filament\Resources\Navigations\Pages;

use App\Filament\Resources\Navigations\NavigationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNavigation extends CreateRecord
{
    protected static string $resource = NavigationResource::class;

    public function getHeading(): string
    {
        return 'Form Tambah Menu Navigasi';
    }

    public function getSubheading(): ?string
    {
        return 'Tambahkan tautan navigasi baru untuk header website publik';
    }
}
