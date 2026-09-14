<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::where('email', 'superadminDLH@gmail.com')->first();
if ($user) {
    echo "User found: " . $user->name . "\n";
    $passwordsToTest = ['password', 'admin123', 'admin', 'superadmin', 'superadmin123', 'dlh12345', '12345678', 'probolinggo'];
    foreach ($passwordsToTest as $p) {
        if (\Illuminate\Support\Facades\Hash::check($p, $user->password)) {
            echo "MATCHING PASSWORD: " . $p . "\n";
            exit;
        }
    }
    echo "No common password matched.\n";
} else {
    echo "User not found.\n";
}
