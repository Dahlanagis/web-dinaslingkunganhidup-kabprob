<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class LatestDocumentsWidget extends Widget
{
    protected string $view = 'filament.widgets.latest-documents-widget';
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 1;

    public static function canView(): bool
    {
        return in_array(auth()->user()?->role, ['super_admin', 'admin']);
    }

    protected function getViewData(): array
    {
        return [
            'documents' => \App\Models\Document::latest()->take(3)->get(),
        ];
    }
}
