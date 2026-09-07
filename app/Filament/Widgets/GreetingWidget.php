<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class GreetingWidget extends Widget
{
    protected string $view = 'filament.widgets.greeting-widget';
    
    protected static ?int $sort = -1;
    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        \Carbon\Carbon::setLocale('id');
        return [
            'currentDate' => now()->translatedFormat('l, d F Y'),
        ];
    }
}
