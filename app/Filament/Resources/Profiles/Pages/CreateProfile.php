<?php

namespace App\Filament\Resources\Profiles\Pages;

use App\Filament\Resources\Profiles\ProfileResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProfile extends CreateRecord
{
    protected static string $resource = ProfileResource::class;

    public function getHeading(): string
    {
        return 'Form Tambah Profil';
    }

    public function getSubheading(): ?string
    {
        return 'Tambahkan bagian atau section profil instansi baru';
    }
}
