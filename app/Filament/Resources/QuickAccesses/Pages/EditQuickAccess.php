<?php

namespace App\Filament\Resources\QuickAccesses\Pages;

use App\Filament\Resources\QuickAccesses\QuickAccessResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditQuickAccess extends EditRecord
{
    protected static string $resource = QuickAccessResource::class;

    public function getHeading(): string
    {
        return 'Edit Akses Cepat';
    }

    public function getSubheading(): ?string
    {
        return 'Perbarui judul, ikon, atau tautan tombol pintasan beranda website';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Pintasan')
                ->icon('heroicon-m-trash'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
