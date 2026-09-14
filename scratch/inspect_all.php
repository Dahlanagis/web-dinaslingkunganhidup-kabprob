<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "--- ALL PROFILES ---\n";
foreach (App\Models\Profile::all() as $p) {
    echo "ID: {$p->id} | Section: {$p->section} | Title: {$p->title}\n";
}

echo "\n--- ALL SERVICES ---\n";
foreach (App\Models\Service::all() as $s) {
    echo "ID: {$s->id} | Name: {$s->name} | Tag: {$s->tag}\n";
}
