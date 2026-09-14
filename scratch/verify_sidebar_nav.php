<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Authenticate as super_admin
$user = \App\Models\User::where('role', 'super_admin')->first();
if ($user) {
    auth()->login($user);
}

$panel = \Filament\Facades\Filament::getPanel('admin');
$navItems = $panel->getNavigation();

echo "--- Filament Navigation for " . ($user ? $user->email : 'Guest') . " ---\n";
foreach ($navItems as $group) {
    $label = $group->getLabel() ?? '(No Group)';
    echo "\n[GROUP: {$label}]\n";
    foreach ($group->getItems() as $item) {
        echo "  -> " . $item->getLabel() . " (URL: " . $item->getUrl() . ", Sort: " . $item->getSort() . ")\n";
    }
}
