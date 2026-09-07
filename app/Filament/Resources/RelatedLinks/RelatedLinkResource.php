<?php

namespace App\Filament\Resources\RelatedLinks;

use App\Filament\Resources\RelatedLinks\Pages\CreateRelatedLink;
use App\Filament\Resources\RelatedLinks\Pages\EditRelatedLink;
use App\Filament\Resources\RelatedLinks\Pages\ListRelatedLinks;
use App\Filament\Resources\RelatedLinks\Schemas\RelatedLinkForm;
use App\Filament\Resources\RelatedLinks\Tables\RelatedLinksTable;
use App\Models\RelatedLink;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RelatedLinkResource extends Resource
{
    protected static ?string $model = RelatedLink::class;

    public static function getNavigationGroup(): ?string
    {
        return 'KELOLA KONTEN';
    }
    protected static string|BackedEnum|null $navigationIcon = \Filament\Support\Icons\Heroicon::OutlinedLink;

    protected static ?string $modelLabel = 'Tautan Terkait';
    protected static ?string $pluralModelLabel = 'Tautan Terkait';


    

    

    public static function form(Schema $schema): Schema
    {
        return RelatedLinkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RelatedLinksTable::configure($table);
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
            'index' => ListRelatedLinks::route('/'),
            'create' => CreateRelatedLink::route('/create'),
            'edit' => EditRelatedLink::route('/{record}/edit'),
        ];
    }
}
