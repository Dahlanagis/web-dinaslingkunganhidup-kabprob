<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$superAdmin = \App\Models\User::where('role', 'super_admin')->first();
$admin = \App\Models\User::where('role', 'admin')->first();
$operator = \App\Models\User::where('role', 'operator')->first();

\App\Models\ActivityLog::truncate();

\App\Models\ActivityLog::create([
    'user_id' => $superAdmin?->id,
    'user_name' => $superAdmin?->name ?? 'Super Admin DLH',
    'action' => 'LOGIN',
    'module' => 'Autentikasi',
    'ip_address' => '127.0.0.1',
    'description' => 'Pengguna ' . ($superAdmin?->name ?? 'Super Admin') . ' (' . ($superAdmin?->email ?? 'superadminDLH@gmail.com') . ') berhasil masuk ke portal sistem.',
    'created_at' => now()->subHours(4),
    'updated_at' => now()->subHours(4),
]);

\App\Models\ActivityLog::create([
    'user_id' => $superAdmin?->id,
    'user_name' => $superAdmin?->name ?? 'Super Admin DLH',
    'action' => 'UPDATE',
    'module' => 'Pengaturan Website',
    'ip_address' => '127.0.0.1',
    'description' => 'Memperbarui data pada Pengaturan Website: "Dinas Lingkungan Hidup Kab. Probolinggo"',
    'created_at' => now()->subHours(3)->addMinutes(15),
    'updated_at' => now()->subHours(3)->addMinutes(15),
]);

\App\Models\ActivityLog::create([
    'user_id' => $admin?->id ?? $superAdmin?->id,
    'user_name' => $admin?->name ?? 'Admin Pengelola',
    'action' => 'CREATE',
    'module' => 'Berita & Publikasi',
    'ip_address' => '127.0.0.1',
    'description' => 'Menambahkan data baru pada Berita & Publikasi: "Gerakan Bersih Pantai dan Konservasi Mangrove Pesisir Dringu"',
    'created_at' => now()->subHours(2)->addMinutes(40),
    'updated_at' => now()->subHours(2)->addMinutes(40),
]);

\App\Models\ActivityLog::create([
    'user_id' => $superAdmin?->id,
    'user_name' => $superAdmin?->name ?? 'Super Admin DLH',
    'action' => 'GANTI ROLE',
    'module' => 'Role & Hak Akses',
    'ip_address' => '127.0.0.1',
    'description' => 'Pengguna ' . ($superAdmin?->name ?? 'Super Admin DLH') . ' beralih hak akses ke Admin Pengelola (Konten & Dokumen).',
    'created_at' => now()->subHours(1)->addMinutes(50),
    'updated_at' => now()->subHours(1)->addMinutes(50),
]);

\App\Models\ActivityLog::create([
    'user_id' => $operator?->id ?? $superAdmin?->id,
    'user_name' => $operator?->name ?? 'Operator Pelayanan',
    'action' => 'UPDATE',
    'module' => 'Layanan Publik',
    'ip_address' => '127.0.0.1',
    'description' => 'Memperbarui data pada Layanan Publik: "Pengujian Laboratorium Lingkungan dan Sampel Air"',
    'created_at' => now()->subMinutes(35),
    'updated_at' => now()->subMinutes(35),
]);

\App\Models\ActivityLog::create([
    'user_id' => $superAdmin?->id,
    'user_name' => $superAdmin?->name ?? 'Super Admin DLH',
    'action' => 'GANTI ROLE',
    'module' => 'Role & Hak Akses',
    'ip_address' => '127.0.0.1',
    'description' => 'Pengguna ' . ($superAdmin?->name ?? 'Super Admin DLH') . ' beralih hak akses ke Super Administrator (Akses Penuh).',
    'created_at' => now()->subMinutes(10),
    'updated_at' => now()->subMinutes(10),
]);

echo 'Activity logs successfully seeded. Total records: ' . \App\Models\ActivityLog::count() . PHP_EOL;
