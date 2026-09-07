<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->string('url')->default('#')->after('title');
            $table->foreignId('parent_id')->nullable()->constrained('navigations')->nullOnDelete()->after('url');
            $table->integer('order')->default(0)->after('parent_id');
            $table->boolean('is_active')->default(true)->after('order');
            $table->string('target')->default('_self')->after('is_active');
            $table->string('icon')->nullable()->after('target');
        });

        Schema::table('activity_logs', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->after('id');
            $table->string('user_name')->default('Admin DLH')->after('user_id');
            $table->string('action')->after('user_name'); // e.g. Login, Update, Create, Delete
            $table->string('module')->after('action'); // e.g. Pengaturan, Berita, Dokumen, Galeri, Auth
            $table->string('ip_address')->nullable()->after('module');
            $table->text('description')->nullable()->after('ip_address');
        });
    }

    public function down(): void
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn(['title', 'url', 'parent_id', 'order', 'is_active', 'target', 'icon']);
        });

        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'user_name', 'action', 'module', 'ip_address', 'description']);
        });
    }
};
