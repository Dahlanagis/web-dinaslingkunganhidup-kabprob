<?php

namespace App\Filament\Resources\RelatedLinks\Pages;

use App\Filament\Resources\RelatedLinks\RelatedLinkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRelatedLinks extends ListRecords
{
    protected static string $resource = RelatedLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
