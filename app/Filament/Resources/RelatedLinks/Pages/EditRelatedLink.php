<?php

namespace App\Filament\Resources\RelatedLinks\Pages;

use App\Filament\Resources\RelatedLinks\RelatedLinkResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRelatedLink extends EditRecord
{
    protected static string $resource = RelatedLinkResource::class;

    public function getHeading(): string
    {
        return 'Edit Tautan Terkait';
    }

    public function getSubheading(): ?string
    {
        return 'Perbarui tautan instansi mitra atau portal eksternal pemerintah';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Tautan')
                ->icon('heroicon-m-trash'),
        ];
    }
}
