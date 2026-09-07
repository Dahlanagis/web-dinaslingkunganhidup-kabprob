<?php

namespace App\Filament\Resources\QuickAccesses\Pages;

use App\Filament\Resources\QuickAccesses\QuickAccessResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuickAccesses extends ListRecords
{
    protected static string $resource = QuickAccessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
