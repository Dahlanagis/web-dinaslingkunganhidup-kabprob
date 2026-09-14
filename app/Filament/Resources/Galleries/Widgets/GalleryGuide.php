<?php

namespace App\Filament\Resources\Galleries\Widgets;

use Filament\Widgets\Widget;

class GalleryGuide extends Widget
{
    protected string $view = 'filament.resources.galleries.widgets.gallery-guide';
    protected int | string | array $columnSpan = 'full';
}
