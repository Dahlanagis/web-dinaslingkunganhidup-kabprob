<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class LatestDocumentsWidget extends Widget
{
    protected string $view = 'filament.widgets.latest-documents-widget';
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 1;

    protected function getViewData(): array
    {
        return [
            'documents' => \App\Models\Document::latest()->take(3)->get(),
        ];
    }
}
