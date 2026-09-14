<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Service;

echo "=== SERVICES ===\n";
foreach (Service::all() as $s) {
    echo "ID: {$s->id} | Name: {$s->name} | Tag: {$s->tag} | Icon: {$s->icon}\n";
    echo "Desc: {$s->description}\n\n";
}
