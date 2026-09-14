<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    public function getHeading(): string
    {
        return 'Kelola Berita';
    }

    public function getSubheading(): ?string
    {
        return 'Daftar rilis berita kegiatan kedinasan dan informasi operasional DLH Kab. Probolinggo';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Berita')
                ->icon('heroicon-o-plus'),
        ];
    }
}
