<?php

namespace App\Filament\Resources\QuickAccesses;

use App\Filament\Resources\QuickAccesses\Pages\CreateQuickAccess;
use App\Filament\Resources\QuickAccesses\Pages\EditQuickAccess;
use App\Filament\Resources\QuickAccesses\Pages\ListQuickAccesses;
use App\Filament\Resources\QuickAccesses\Schemas\QuickAccessForm;
use App\Filament\Resources\QuickAccesses\Tables\QuickAccessesTable;
use App\Models\QuickAccess;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class QuickAccessResource extends Resource
{
    protected static ?string $model = QuickAccess::class;

    public static function canViewAny(): bool
    {
        return in_array(auth()->user()?->role, ['super_admin', 'operator']);
    }

    public static function getNavigationGroup(): ?string
    {
        return 'DATA PELAYANAN';
    }
    protected static string|BackedEnum|null $navigationIcon = \Filament\Support\Icons\Heroicon::OutlinedCursorArrowRays;

    protected static ?string $modelLabel = 'Akses Cepat';
    protected static ?string $pluralModelLabel = 'Akses Cepat';


    

    

    public static function form(Schema $schema): Schema
    {
        return QuickAccessForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuickAccessesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQuickAccesses::route('/'),
            'create' => CreateQuickAccess::route('/create'),
            'edit' => EditQuickAccess::route('/{record}/edit'),
        ];
    }
}
