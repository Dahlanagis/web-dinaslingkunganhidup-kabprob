<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$u = App\Models\User::first();
if ($u) {
    $u->password = bcrypt('password');
    $u->save();
    echo 'OK';
} else {
    echo 'No user';
}
