<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $galleries = \App\Models\Gallery::latest()->take(6)->get();
    return view('welcome', compact('galleries'));
});

Route::get('/dashboard', function () {
    return redirect('/admin');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public Page Routes (Fallback / Under Construction)
$pages = [
    'profil/{slug}' => 'Profil',
    'layanan/{slug}' => 'Layanan',
    'dokumen/{slug}' => 'Dokumen',
    'informasi/{slug}' => 'Informasi',
    'berita/{slug}' => 'Berita',
];

foreach ($pages as $route => $prefix) {
    Route::get('/' . $route, function ($slug) use ($prefix) {
        $title = $prefix . ' - ' . ucwords(str_replace('-', ' ', $slug));
        return view('page', compact('title'));
    });
}

// Base generic routes
$basePages = [
    'profil' => 'Profil Instansi',
    'layanan' => 'Semua Layanan',
    'dokumen' => 'Dokumen Publik',
    'informasi' => 'Pusat Informasi',
    'berita' => 'Berita Terkini',
    'galeri' => 'Galeri Dokumentasi',
];

foreach ($basePages as $route => $title) {
    Route::get('/' . $route, function () use ($title) {
        return view('page', compact('title'));
    });
}

Route::get('/kontak', function () {
    return view('page', ['title' => 'Hubungi Kami']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Redirect old filament login route to the new custom login route
Route::redirect('/admin/login', '/login');
