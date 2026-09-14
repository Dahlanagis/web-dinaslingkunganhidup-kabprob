<?php
require __DIR__ . '/../vendor/autoload.php';
$rc = new ReflectionClass('Filament\View\PanelsRenderHook');
foreach ($rc->getConstants() as $name => $val) {
    if (str_contains($val, 'sidebar')) {
        echo "$name => $val\n";
    }
}
