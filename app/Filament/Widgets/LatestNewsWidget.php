<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class LatestNewsWidget extends Widget
{
    protected string $view = 'filament.widgets.latest-news-widget';
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 1;

    public static function canView(): bool
    {
        return in_array(auth()->user()?->role, ['super_admin', 'admin']);
    }

    protected function getViewData(): array
    {
        return [
            'posts' => \App\Models\Post::latest()->take(3)->get(),
        ];
    }
}
