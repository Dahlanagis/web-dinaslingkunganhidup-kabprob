<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$user = App\Models\User::first();
auth()->login($user);

$livewire = Livewire\Livewire::test(App\Filament\Resources\Galleries\Pages\EditGallery::class, [
    'record' => 1
]);

dump('Livewire data state:', $livewire->get('data'));
