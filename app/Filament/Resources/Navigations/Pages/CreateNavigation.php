<?php

namespace App\Filament\Resources\Navigations\Pages;

use App\Filament\Resources\Navigations\NavigationResource;
use App\Models\Navigation;
use Filament\Resources\Pages\CreateRecord;

class CreateNavigation extends CreateRecord
{
    protected static string $resource = NavigationResource::class;

    public function getHeading(): string
    {
        return 'Form Tambah Menu Navigasi';
    }

    public function getSubheading(): ?string
    {
        return 'Tambahkan tautan navigasi baru untuk header website publik';
    }

    public function mount(): void
    {
        parent::mount();

        if (request()->has('parent_id')) {
            $parentId = request()->query('parent_id');
            $nextOrder = Navigation::where('parent_id', $parentId)->count() + 1;
            $this->form->fill([
                'parent_id' => $parentId,
                'order' => $nextOrder,
                'is_active' => true,
                'target' => '_self',
            ]);
        } else {
            $nextOrder = Navigation::whereNull('parent_id')->count() + 1;
            $this->form->fill([
                'order' => $nextOrder,
                'is_active' => true,
                'target' => '_self',
            ]);
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
