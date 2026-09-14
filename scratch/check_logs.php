<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$logs = \App\Models\ActivityLog::latest()->get();
echo "Total Activity Logs: " . $logs->count() . "\n";
foreach ($logs as $log) {
    echo sprintf("[%s] %s | %s | %s | %s | %s\n", 
        $log->created_at->format('d/m/Y H:i:s'), 
        $log->user_name, 
        $log->action, 
        $log->module, 
        $log->ip_address,
        $log->description
    );
}
