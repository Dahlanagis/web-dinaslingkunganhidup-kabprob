<?php
$models = [
    'Banner' => ['label' => 'Banner Utama', 'icon' => 'heroicon-o-photo'],
    'QuickAccess' => ['label' => 'Kartu Akses Cepat', 'icon' => 'heroicon-o-bolt'],
    'Profile' => ['label' => 'Halaman Profil', 'icon' => 'heroicon-o-building-office-2'],
    'RelatedLink' => ['label' => 'Tautan Terkait Logo', 'icon' => 'heroicon-o-link'],
    'Statistic' => ['label' => 'Statistik Ternak', 'icon' => 'heroicon-o-chart-bar'],
];

foreach ($models as $model => $config) {
    $dir = __DIR__ . "/app/Filament/Resources/{$model}s";
    @mkdir($dir, 0755, true);
    @mkdir("$dir/Pages", 0755, true);
    
    $resourceCode = <<<PHP
<?php

namespace App\Filament\Resources\\{$model}s;

use App\Models\\$model;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class {$model}Resource extends Resource
{
    protected static ?string \$model = $model::class;
    protected static ?string \$navigationIcon = '{$config['icon']}';
    protected static ?string \$navigationLabel = '{$config['label']}';

    public static function getNavigationGroup(): ?string
    {
        return 'KELOLA KONTEN';
    }

    public static function form(Schema \$schema): Schema
    {
        return \$schema->components([]);
    }

    public static function table(Table \$table): Table
    {
        return \$table->columns([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\List{$model}s::route('/'),
        ];
    }
}
PHP;

    file_put_contents("$dir/{$model}Resource.php", $resourceCode);

    $pageCode = <<<PHP
<?php

namespace App\Filament\Resources\\{$model}s\Pages;

use App\Filament\Resources\\{$model}s\\{$model}Resource;
use Filament\Resources\Pages\ListRecords;

class List{$model}s extends ListRecords
{
    protected static string \$resource = {$model}Resource::class;
}
PHP;
    file_put_contents("$dir/Pages/List{$model}s.php", $pageCode);
}
echo "Resources created.\n";
