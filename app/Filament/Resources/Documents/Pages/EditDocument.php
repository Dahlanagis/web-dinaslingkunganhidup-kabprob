<?php

namespace App\Filament\Resources\Documents\Pages;

use App\Filament\Resources\Documents\DocumentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDocument extends EditRecord
{
    protected static string $resource = DocumentResource::class;

    public function getHeading(): string
    {
        return 'Edit Dokumen & Publikasi';
    }

    public function getSubheading(): ?string
    {
        return 'Perbarui berkas dokumen publik, regulasi, atau laporan kinerja instansi';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Dokumen')
                ->icon('heroicon-m-trash'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
