<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class OverviewStatsWidget extends Widget
{
    protected string $view = 'filament.widgets.overview-stats-widget';
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 0;

    protected function getViewData(): array
    {
        return [
            'documentsCount' => \App\Models\Document::count(),
            'postsCount' => \App\Models\Post::count(),
            'galleriesCount' => \App\Models\Gallery::count(),
            'reportsCount' => \App\Models\Report::count(),
            'servicesCount' => \App\Models\Service::count(),
            'quickAccessCount' => \App\Models\QuickAccess::count(),
            'statisticsCount' => \App\Models\Statistic::count(),
            'role' => auth()->user()?->role ?? 'super_admin',
        ];
    }
}
