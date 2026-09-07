<?php

namespace App\Filament\Resources\Profiles\Pages;

use App\Filament\Resources\Profiles\ProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProfile extends EditRecord
{
    protected static string $resource = ProfileResource::class;

    public function getHeading(): string
    {
        return 'Edit Bagian Profil Instansi';
    }

    public function getSubheading(): ?string
    {
        return 'Perbarui visi misi, tugas pokok fungsi, atau rincian profil kedinasan';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Profil')
                ->icon('heroicon-m-trash'),
        ];
    }
}
