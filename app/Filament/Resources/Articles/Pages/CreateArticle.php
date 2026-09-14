<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    public function getHeading(): string
    {
        return 'Form Tambah Artikel';
    }

    public function getSubheading(): ?string
    {
        return 'Tulis dan terbitkan artikel wawasan atau edukasi lingkungan hidup';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['category'] = 'artikel';
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
