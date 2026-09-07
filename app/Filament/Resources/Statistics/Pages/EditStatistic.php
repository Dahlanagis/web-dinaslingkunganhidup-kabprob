<?php

namespace App\Filament\Resources\Statistics\Pages;

use App\Filament\Resources\Statistics\StatisticResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStatistic extends EditRecord
{
    protected static string $resource = StatisticResource::class;

    public function getHeading(): string
    {
        return 'Edit Data Statistik';
    }

    public function getSubheading(): ?string
    {
        return 'Perbarui angka indikator capaian kinerja dan data strategis lingkungan';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Statistik')
                ->icon('heroicon-m-trash'),
        ];
    }
}
