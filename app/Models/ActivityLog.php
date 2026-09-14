<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Catat aktivitas sistem secara otomatis
     */
    public static function record(string $action, string $module, ?string $description = null, ?User $user = null): ?self
    {
        try {
            $user = $user ?? auth()->user();
            $userName = $user?->name ?? 'Administrator DLH';
            $ip = request()?->ip() ?? '127.0.0.1';

            return static::create([
                'user_id' => $user?->id,
                'user_name' => $userName,
                'action' => strtoupper(trim($action)),
                'module' => $module,
                'ip_address' => $ip,
                'description' => $description,
            ]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Gagal mencatat log aktivitas: ' . $e->getMessage());
            return null;
        }
    }
}
