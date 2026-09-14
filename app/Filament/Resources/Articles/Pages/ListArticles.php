<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    public function getHeading(): string
    {
        return 'Kelola Artikel Lingkungan';
    }

    public function getSubheading(): ?string
    {
        return 'Daftar materi edukasi, tips pemilahan sampah, dan panduan pelestarian lingkungan hidup';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Artikel')
                ->icon('heroicon-o-plus'),
        ];
    }
}
