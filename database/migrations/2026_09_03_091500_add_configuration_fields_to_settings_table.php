<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // Identitas Website
            $table->string('site_name')->default('Dinas Lingkungan Hidup Kab. Probolinggo')->nullable();
            $table->string('site_short_name')->default('DLH Kab. Probolinggo')->nullable();
            $table->string('site_tagline')->default('Mewujudkan Kabupaten Probolinggo yang Bersih, Hijau, dan Berkelanjutan')->nullable();
            $table->text('site_description')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('favicon_path')->nullable();

            // Tampilan & Warna
            $table->string('primary_color')->default('#1b5e20')->nullable();
            $table->string('secondary_color')->default('#103312')->nullable();
            $table->string('accent_color')->default('#fbc02d')->nullable();
            $table->string('hero_title')->default('Selamat Datang di Portal Resmi')->nullable();
            $table->string('hero_subtitle')->default('Dinas Lingkungan Hidup Kabupaten Probolinggo')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_banner_path')->nullable();
            $table->text('running_text')->nullable();

            // Sambutan Pimpinan
            $table->string('leader_name')->default('Drs. H. Ahmad Pribadi, M.Si')->nullable();
            $table->string('leader_title')->default('Kepala Dinas Lingkungan Hidup')->nullable();
            $table->text('leader_speech')->nullable();
            $table->string('leader_photo_path')->nullable();

            // Kontak & Medsos
            $table->string('phone')->default('(0335) 421234')->nullable();
            $table->string('whatsapp')->default('081234567890')->nullable();
            $table->string('email')->default('dlh@probolinggokab.go.id')->nullable();
            $table->text('address')->nullable();
            $table->string('working_hours')->default('Senin - Jumat: 07.30 - 16.00 WIB')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('twitter_url')->nullable();

            // Footer
            $table->text('footer_text')->nullable();
            $table->string('copyright_text')->default('© 2026 Dinas Lingkungan Hidup Kabupaten Probolinggo. Hak Cipta Dilindungi.')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'site_name', 'site_short_name', 'site_tagline', 'site_description', 'logo_path', 'favicon_path',
                'primary_color', 'secondary_color', 'accent_color', 'hero_title', 'hero_subtitle', 'hero_description', 'hero_banner_path', 'running_text',
                'leader_name', 'leader_title', 'leader_speech', 'leader_photo_path',
                'phone', 'whatsapp', 'email', 'address', 'working_hours', 'facebook_url', 'instagram_url', 'youtube_url', 'twitter_url',
                'footer_text', 'copyright_text'
            ]);
        });
    }
};
