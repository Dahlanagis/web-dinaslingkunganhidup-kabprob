<?php

namespace App\Filament\Resources\Banners\Pages;

use App\Filament\Resources\Banners\BannerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBanner extends EditRecord
{
    protected static string $resource = BannerResource::class;

    public function getHeading(): string
    {
        return 'Edit Banner & Spanduk';
    }

    public function getSubheading(): ?string
    {
        return 'Perbarui informasi dan gambar banner beranda website publik';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Banner')
                ->icon('heroicon-m-trash'),
        ];
    }
}
