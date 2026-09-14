<?php

namespace App\Filament\Resources\Navigations\Pages;

use App\Filament\Resources\Navigations\NavigationResource;
use App\Models\Navigation;
use Filament\Resources\Pages\ListRecords;

class ListNavigations extends ListRecords
{
    protected static string $resource = NavigationResource::class;

    protected string $view = 'filament.pages.manage-navigations';

    public function getRoots()
    {
        return Navigation::whereNull('parent_id')
            ->with(['children' => fn ($q) => $q->orderBy('order', 'asc')])
            ->orderBy('order', 'asc')
            ->get();
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
