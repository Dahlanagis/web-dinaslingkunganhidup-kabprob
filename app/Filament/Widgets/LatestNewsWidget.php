<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class LatestNewsWidget extends Widget
{
    protected string $view = 'filament.widgets.latest-news-widget';
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 1;

    protected function getViewData(): array
    {
        return [
            'posts' => \App\Models\Post::latest()->take(3)->get(),
        ];
    }
}
