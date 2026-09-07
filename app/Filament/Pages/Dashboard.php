<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Actions\Action;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Dashboard Overview';

    public function getSubheading(): string | Htmlable | null
    {
        return 'Dinas Lingkungan Hidup Kab. Probolinggo Control Panel';
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('preview')
                ->label('Preview Site')
                ->icon('heroicon-o-eye')
                ->url('/')
                ->color('gray')
                ->button(),
        ];
    }
}
