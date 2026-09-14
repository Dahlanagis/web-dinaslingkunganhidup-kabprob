<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Banner;
use App\Models\Document;
use App\Models\Gallery;
use App\Models\Navigation;
use App\Models\Post;
use App\Models\Profile;
use App\Models\QuickAccess;
use App\Models\RelatedLink;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Statistic;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ActivityLogObserver
{
    /**
     * Dapatkan nama modul ramah dan nama/label objek
     */
    protected function getModuleAndLabel(Model $model): array
    {
        $class = get_class($model);

        $module = match ($class) {
            Post::class => 'Berita & Publikasi',
            Document::class => 'Dokumen Kinerja',
            Service::class => 'Layanan Publik',
            Gallery::class => 'Galeri Foto',
            Banner::class => 'Banner & Spanduk',
            Setting::class => 'Pengaturan Website',
            Profile::class => 'Profil Instansi',
            User::class => 'Users & Role',
            Navigation::class => 'Menu Navigasi',
            QuickAccess::class => 'Akses Cepat',
            Statistic::class => 'Data Statistik',
            RelatedLink::class => 'Tautan Terkait',
            default => class_basename($model),
        };

        $label = $model->title 
            ?? $model->name 
            ?? $model->site_name 
            ?? $model->label 
            ?? $model->caption 
            ?? ('ID #' . $model->getKey());

        return [$module, (string) $label];
    }

    /**
     * Handle model "created" event.
     */
    public function created(Model $model): void
    {
        if ($model instanceof ActivityLog) {
            return;
        }

        [$module, $label] = $this->getModuleAndLabel($model);
        ActivityLog::record(
            action: 'CREATE',
            module: $module,
            description: "Menambahkan data baru pada {$module}: \"{$label}\""
        );
    }

    /**
     * Handle model "updated" event.
     */
    public function updated(Model $model): void
    {
        if ($model instanceof ActivityLog) {
            return;
        }

        // Jangan log jika hanya timestamps atau remember_token yang berubah
        $dirty = array_keys($model->getDirty());
        $ignored = ['updated_at', 'remember_token'];
        $meaningfulChanges = array_diff($dirty, $ignored);
        if (empty($meaningfulChanges)) {
            return;
        }

        [$module, $label] = $this->getModuleAndLabel($model);
        ActivityLog::record(
            action: 'UPDATE',
            module: $module,
            description: "Memperbarui data pada {$module}: \"{$label}\""
        );
    }

    /**
     * Handle model "deleted" event.
     */
    public function deleted(Model $model): void
    {
        if ($model instanceof ActivityLog) {
            return;
        }

        [$module, $label] = $this->getModuleAndLabel($model);
        ActivityLog::record(
            action: 'DELETE',
            module: $module,
            description: "Menghapus data dari {$module}: \"{$label}\""
        );
    }
}
