<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingResource;
use App\Models\Setting;
use Filament\Resources\Pages\ListRecords;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;

    public function mount(): void
    {
        $setting = Setting::firstOrCreate(['id' => 1]);

        $this->redirect(SettingResource::getUrl('edit', ['record' => $setting]));
    }
}
