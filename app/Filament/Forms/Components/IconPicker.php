<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;

class IconPicker extends Field
{
    protected string $view = 'filament.forms.components.icon-picker';

    public static function make(?string $name = 'icon'): static
    {
        return parent::make($name)
            ->label('IKON BOOTSTRAP (BI-*)')
            ->default('bi-file-text');
    }
}
