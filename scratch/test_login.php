<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = \App\Http\Requests\Auth\LoginRequest::create('/login', 'POST', [
    'email' => 'superadminDLH',
    'password' => 'password',
]);

try {
    $request->authenticate();
    echo "LOGIN USERNAME SUCCESS: User is " . \Illuminate\Support\Facades\Auth::user()->name . "\n";
} catch (\Exception $e) {
    echo "LOGIN FAILED: " . $e->getMessage() . "\n";
}
