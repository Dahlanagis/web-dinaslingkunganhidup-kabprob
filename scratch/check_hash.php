<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::where('email', 'superadminDLH@gmail.com')->first();
echo "Current hash: " . $user->password . "\n";
echo "Checks 'password': " . (\Illuminate\Support\Facades\Hash::check('password', $user->password) ? 'YES' : 'NO') . "\n";
