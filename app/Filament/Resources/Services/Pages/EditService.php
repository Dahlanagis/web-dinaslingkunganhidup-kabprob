<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    public function getHeading(): string
    {
        return 'Edit Layanan Masyarakat';
    }

    public function getSubheading(): ?string
    {
        return 'Perbarui rincian program dan alur pelayanan publik dinas';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Layanan')
                ->icon('heroicon-m-trash'),
        ];
    }
}
