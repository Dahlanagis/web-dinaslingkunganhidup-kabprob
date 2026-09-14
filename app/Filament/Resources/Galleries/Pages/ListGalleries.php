<?php

namespace App\Filament\Resources\Galleries\Pages;

use App\Filament\Resources\Galleries\GalleryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListGalleries extends ListRecords
{
    protected static string $resource = GalleryResource::class;

    public function getTabs(): array
    {
        return [
            'foto' => Tab::make('Galeri Foto')
                ->icon('heroicon-m-camera')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'foto')),
            'video' => Tab::make('Galeri Video')
                ->icon('heroicon-m-video-camera')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'video')),
        ];
    }
}
