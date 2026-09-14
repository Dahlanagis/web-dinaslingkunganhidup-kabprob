<?php

namespace App\Filament\Resources\Statistics\Pages;

use App\Filament\Resources\Statistics\StatisticResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStatistic extends CreateRecord
{
    protected static string $resource = StatisticResource::class;

    public function getHeading(): string
    {
        return 'Form Tambah Data Statistik';
    }

    public function getSubheading(): ?string
    {
        return 'Tambahkan indikator capaian kinerja dan data strategis lingkungan baru';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
