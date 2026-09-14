<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    public function getHeading(): string
    {
        return 'Form Tambah Berita';
    }

    public function getSubheading(): ?string
    {
        return 'Tulis dan publikasikan rilis berita dan liputan kegiatan resmi DLH';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['category'] = 'berita';
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
