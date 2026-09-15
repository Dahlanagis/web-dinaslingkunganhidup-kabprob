<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $galleries = \App\Models\Gallery::latest()->take(6)->get();
    $banners = \App\Models\Banner::where('is_active', true)->get();
    return view('welcome', compact('galleries', 'banners'));
});

Route::get('/dashboard', function () {
    return redirect('/admin');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::guard('web')->logout();
    if (function_exists('filament') && filament()->auth()) {
        filament()->auth()->logout();
    }
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login')->with('status', 'Anda telah berhasil keluar (log out).');
})->name('logout.get');

Route::get('/admin/logout', function (\Illuminate\Http\Request $request) {
    return redirect('/logout');
});

// =========================================================================
// 1. PROFIL ROUTES
// =========================================================================
Route::get('/profil', function () {
    return redirect('/profil/sejarah');
});

Route::get('/profil/{slug}', function ($slug) {
    $profile = \App\Models\Profile::where('section', $slug)->first();

    $tabMap = [
        'sejarah' => ['title' => 'Profil Instansi & Sejarah', 'icon' => 'bi-clock-history'],
        'visi-misi' => ['title' => 'Visi & Misi', 'icon' => 'bi-compass'],
        'struktur' => ['title' => 'Struktur Organisasi', 'icon' => 'bi-diagram-3'],
        'tupoksi' => ['title' => 'Tugas dan Fungsi (Tupoksi)', 'icon' => 'bi-card-checklist'],
        'pejabat' => ['title' => 'Pejabat Pengelola', 'icon' => 'bi-person-badge'],
        'maklumat' => ['title' => 'Maklumat Pelayanan', 'icon' => 'bi-file-earmark-text'],
    ];

    $defaultTab = $tabMap[$slug] ?? ['title' => ucwords(str_replace('-', ' ', $slug)), 'icon' => 'bi-building'];
    $activeTab = [
        'title' => $profile?->title ?: $defaultTab['title'],
        'icon' => $defaultTab['icon'],
    ];
    $currentSlug = $slug;

    return view('profil.index', compact('currentSlug', 'activeTab', 'profile'));
});

// =========================================================================
// 2. LAYANAN ROUTES
// =========================================================================
Route::get('/layanan', function () {
    $services = \App\Models\Service::all();
    $currentSlug = 'semua';
    $activeTab = ['title' => 'Semua Layanan Publik DLH'];
    return view('layanan.index', compact('services', 'currentSlug', 'activeTab'));
});

Route::get('/layanan/{slug}', function ($slug) {
    $services = \App\Models\Service::all();
    $currentService = \App\Models\Service::where('slug', $slug)->first();
    if (!$currentService) {
        if ($slug === 'persampahan') {
            $currentService = \App\Models\Service::where('name', 'like', '%Sampah%')->first();
        } elseif ($slug === 'lab') {
            $currentService = \App\Models\Service::where('name', 'like', '%Pencemaran%')->orWhere('name', 'like', '%Lab%')->first();
        } elseif ($slug === 'pengaduan') {
            $currentService = \App\Models\Service::where('name', 'like', '%LAPOR%')->orWhere('name', 'like', '%Pengaduan%')->first();
        }
    }

    $tabData = [
        'persampahan' => [
            'title' => 'Pengelolaan Persampahan & Kebersihan',
            'desc' => 'Informasi operasional pengangkutan sampah, jadwal armada dinas, pembinaan Bank Sampah, dan pengelolaan TPA Seboro.',
            'icon' => 'bi-trash3-fill',
        ],
        'lab' => [
            'title' => 'Laboratorium Pengujian Lingkungan',
            'desc' => 'Layanan uji kualitas air limbah, air sungai/sumur, baku mutu udara ambien, dan penerbitan Sertifikat Hasil Uji (SHU).',
            'icon' => 'bi-droplet-fill',
        ],
        'pengaduan' => [
            'title' => 'Pusat Pengaduan Masyarakat & Aspirasi',
            'desc' => 'Saluran pelaporan cepat pencemaran lingkungan, tumpukan sampah liar, dan pohon tumbang melalui Hallo Sae WhatsApp dan SP4N LAPOR!.',
            'icon' => 'bi-megaphone-fill',
        ],
    ];

    $defaultTab = $tabData[$slug] ?? [
        'title' => ucwords(str_replace('-', ' ', $slug)),
        'desc' => 'Informasi pelayanan resmi Dinas Lingkungan Hidup Kabupaten Probolinggo.',
        'icon' => 'bi-grid-fill',
    ];

    $activeTab = [
        'title' => $currentService?->name ?: $defaultTab['title'],
        'desc' => $defaultTab['desc'],
        'icon' => $currentService?->icon ?: $defaultTab['icon'],
    ];

    $currentSlug = $slug;
    return view('layanan.index', compact('services', 'currentService', 'currentSlug', 'activeTab'));
});

// =========================================================================
// 3. DOKUMEN ROUTES
// =========================================================================
Route::get('/dokumen', function (\Illuminate\Http\Request $request) {
    $query = \App\Models\Document::latest();
    if ($request->filled('q')) {
        $q = $request->input('q');
        $query->where('title', 'like', "%{$q}%")
              ->orWhere('category', 'like', "%{$q}%");
    }
    $documents = $query->paginate(10);
    $currentSlug = 'semua';
    $activeTab = [
        'title' => 'Semua Dokumen Publik',
        'desc' => 'Pusat unduhan arsip dokumen kinerja, rencana strategis, dan regulasi resmi Dinas Lingkungan Hidup Kabupaten Probolinggo.',
        'icon' => 'bi-files',
    ];
    return view('dokumen.index', compact('documents', 'currentSlug', 'activeTab'));
});

Route::get('/dokumen/kinerja', function (\Illuminate\Http\Request $request) {
    $query = \App\Models\Document::where(function($q) {
        $q->where('category', 'like', '%Kinerja%')
          ->orWhere('category', 'like', '%Perencanaan%')
          ->orWhere('category', 'like', '%Laporan%')
          ->orWhere('category', 'like', '%Indikator%')
          ->orWhere('category', 'like', '%Evaluasi%');
    })->latest();

    if ($request->filled('q')) {
        $q = $request->input('q');
        $query->where('title', 'like', "%{$q}%");
    }
    $documents = $query->paginate(10);
    $currentSlug = 'kinerja';
    $activeTab = [
        'title' => 'Dokumen Akuntabilitas & Kinerja',
        'desc' => 'Laporan Kinerja Instansi Pemerintah (LKjIP), Renstra, Perjanjian Kinerja (PK), dan Indikator Kinerja Utama (IKU) DLH Kab. Probolinggo.',
        'icon' => 'bi-journal-check',
    ];
    return view('dokumen.index', compact('documents', 'currentSlug', 'activeTab'));
});

Route::get('/dokumen/regulasi', function (\Illuminate\Http\Request $request) {
    $query = \App\Models\Document::where(function($q) {
        $q->where('category', 'like', '%Regulasi%')
          ->orWhere('category', 'like', '%Operasional%')
          ->orWhere('category', 'like', '%SOP%')
          ->orWhere('category', 'like', '%Hukum%')
          ->orWhere('category', 'like', '%Perda%');
    })->latest();

    if ($request->filled('q')) {
        $q = $request->input('q');
        $query->where('title', 'like', "%{$q}%");
    }
    $documents = $query->paginate(10);
    $currentSlug = 'regulasi';
    $activeTab = [
        'title' => 'Regulasi, Perda & SOP Pelayanan',
        'desc' => 'Kumpulan peraturan daerah, surat keputusan bupati, dan standar operasional prosedur penyelenggaraan layanan lingkungan hidup.',
        'icon' => 'bi-file-earmark-ruled',
    ];
    return view('dokumen.index', compact('documents', 'currentSlug', 'activeTab'));
});

Route::get('/dokumen/baca/{id}', function ($id, \Illuminate\Http\Request $request) {
    $doc = \App\Models\Document::findOrFail($id);
    return view('dokumen.baca', compact('doc'));
})->name('dokumen.baca');

Route::get('/dokumen/unduh/{id}', function ($id) {
    $doc = \App\Models\Document::findOrFail($id);
    $doc->increment('downloads');

    if (!empty($doc->file_path)) {
        $filePath = storage_path('app/public/' . $doc->file_path);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
    }

    // Fallback: If physical file is not present, serve an official printable document page
    return response("<!DOCTYPE html>
    <html lang='id'>
    <head>
        <meta charset='utf-8'>
        <title>{$doc->title} - DLH Kab. Probolinggo</title>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css'>
    </head>
    <body class='bg-light py-5'>
        <div class='container' style='max-width: 680px;'>
            <div class='card p-4 p-md-5 shadow-sm border-0 rounded-4 text-center bg-white'>
                <div class='mb-3 text-success' style='font-size: 3.5rem;'><i class='bi bi-file-earmark-check-fill'></i></div>
                <h4 class='fw-bold text-dark mb-2'>{$doc->title}</h4>
                <div class='mb-3'>
                    <span class='badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1.5'>{$doc->category}</span>
                    <span class='text-muted small ms-2'><i class='bi bi-download me-1'></i> {$doc->downloads} kali diunduh</span>
                </div>
                <p class='text-muted small mb-4' style='line-height: 1.8;'>
                    Dokumen resmi ini telah tercatat dalam arsip publik Dinas Lingkungan Hidup Kabupaten Probolinggo.
                </p>
                <div class='d-flex gap-2 justify-content-center flex-wrap'>
                    <button onclick='window.print()' class='btn btn-success rounded-pill px-4 fw-bold'><i class='bi bi-printer me-1'></i> Cetak / Simpan PDF</button>
                    <a href='/dokumen' class='btn btn-outline-secondary rounded-pill px-4'>Kembali ke Pusat Dokumen</a>
                </div>
            </div>
        </div>
    </body>
    </html>", 200, ['Content-Type' => 'text/html']);
});

Route::get('/dokumen/{slug}', function ($slug) {
    return redirect('/dokumen');
});

// =========================================================================
// 4. INFORMASI ROUTES (BERITA, ARTIKEL, GALERI)
// =========================================================================
Route::get('/informasi', function () {
    return redirect('/informasi/berita');
});

Route::get('/informasi/berita', function (\Illuminate\Http\Request $request) {
    $query = \App\Models\Post::where('category', 'berita')->latest();
    if ($request->filled('q')) {
        $q = $request->input('q');
        $query->where(function($w) use ($q) {
            $w->where('title', 'like', "%{$q}%")
              ->orWhere('content', 'like', "%{$q}%");
        });
    }
    $posts = $query->paginate(9);
    $category = 'berita';
    $pageTitle = 'Berita Terkini DLH';
    return view('berita.index', compact('posts', 'pageTitle', 'category'));
});

Route::get('/berita', function () {
    return redirect('/informasi/berita');
});

Route::get('/informasi/artikel', function (\Illuminate\Http\Request $request) {
    $query = \App\Models\Post::where('category', 'artikel')->latest();
    if ($request->filled('q')) {
        $q = $request->input('q');
        $query->where(function($w) use ($q) {
            $w->where('title', 'like', "%{$q}%")
              ->orWhere('content', 'like', "%{$q}%");
        });
    }
    $posts = $query->paginate(9);
    $category = 'artikel';
    $pageTitle = 'Artikel Lingkungan Hidup';
    return view('berita.index', compact('posts', 'pageTitle', 'category'));
});

Route::get('/artikel', function () {
    return redirect('/informasi/artikel');
});

Route::get('/berita/{slug}', function ($slug) {
    $post = \App\Models\Post::where('slug', $slug)->first();
    if (!$post && is_numeric($slug)) {
        $post = \App\Models\Post::find($slug);
    }
    if (!$post) {
        abort(404);
    }
    $post->increment('views');
    // Related posts in same category
    $recentPosts = \App\Models\Post::where('category', $post->category ?? 'berita')
        ->where('id', '!=', $post->id)
        ->latest()
        ->take(4)
        ->get();
    return view('berita.show', compact('post', 'recentPosts'));
});

Route::get('/artikel/{slug}', function ($slug) {
    $post = \App\Models\Post::where('slug', $slug)->first();
    if (!$post && is_numeric($slug)) {
        $post = \App\Models\Post::find($slug);
    }
    if (!$post) {
        abort(404);
    }
    $post->increment('views');
    // Related posts in same category
    $recentPosts = \App\Models\Post::where('category', 'artikel')
        ->where('id', '!=', $post->id)
        ->latest()
        ->take(4)
        ->get();
    return view('berita.show', compact('post', 'recentPosts'));
});

// Galeri Foto & Video Dokumentasi
Route::get('/informasi/galeri', function (\Illuminate\Http\Request $request) {
    $activeType = $request->query('type', 'foto');

    $photoGalleries = \App\Models\Gallery::where(function($q) {
        $q->where('type', 'foto')
          ->orWhereNull('type');
    })->where(function($q) {
        $q->whereNull('video_url')
          ->orWhere('video_url', '');
    })->latest()->get();

    $videoGalleries = \App\Models\Gallery::where(function($q) {
        $q->where('type', 'video')
          ->orWhere(function($q2) {
              $q2->whereNotNull('video_url')->where('video_url', '!=', '');
          });
    })->latest()->get();

    $galleries = $photoGalleries; // Fallback compatibility

    return view('galeri.index', compact('photoGalleries', 'videoGalleries', 'galleries', 'activeType'));
});

Route::get('/informasi/video', function () {
    return redirect('/informasi/galeri?type=video');
});

Route::get('/video', function () {
    return redirect('/informasi/galeri?type=video');
});

Route::get('/galeri', function () {
    return redirect('/informasi/galeri');
});

Route::get('/gambar', function () {
    return redirect('/informasi/galeri');
});

Route::get('/kontak', function () {
    $siteSetting = \App\Models\Setting::first() ?? new \App\Models\Setting();
    return view('kontak', compact('siteSetting'));
})->name('kontak');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Redirect old filament login route to the new custom login route
Route::redirect('/admin/login', '/login');

// Redirect deleted category resource to main admin dashboard
Route::any('/admin/categories/{any?}', function () {
    return redirect('/admin');
})->where('any', '.*');

// Switch Role with Authentication (Username & Password verification)
Route::middleware('auth')->post('/admin/switch-role-auth', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'role' => 'required|in:super_admin,admin,operator',
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $targetRole = $request->input('role');
    $inputUsername = trim($request->input('username'));
    $inputPassword = $request->input('password');

    // Find candidate user by email or name
    $candidateUser = \App\Models\User::where('email', $inputUsername)
        ->orWhere('name', $inputUsername)
        ->first();

    // Fallback: match by role alias
    if (!$candidateUser) {
        $aliasRole = match(strtolower($inputUsername)) {
            'superadmin', 'super_admin', 'super admin' => 'super_admin',
            'admin', 'pengelola', 'admin pengelola' => 'admin',
            'operator' => 'operator',
            default => null,
        };
        if ($aliasRole) {
            $candidateUser = \App\Models\User::where('role', $aliasRole)->first();
        }
    }

    $authenticated = false;

    // A. Check candidate user credentials
    if ($candidateUser && \Illuminate\Support\Facades\Hash::check($inputPassword, $candidateUser->password)) {
        $authenticated = true;
        // If candidate user already has the target role, login as candidate
        if ($candidateUser->role === $targetRole) {
            \Illuminate\Support\Facades\Auth::login($candidateUser);
        } else {
            // Switch to existing account for target role if exists
            $targetUser = \App\Models\User::where('role', $targetRole)->first();
            if ($targetUser) {
                \Illuminate\Support\Facades\Auth::login($targetUser);
            } else {
                $candidateUser->update(['role' => $targetRole]);
                \Illuminate\Support\Facades\Auth::login($candidateUser);
            }
        }
    } else {
        // B. Check if currently logged in user entered their own password
        $currentUser = auth()->user();
        if ($currentUser && \Illuminate\Support\Facades\Hash::check($inputPassword, $currentUser->password)) {
            $authenticated = true;
            $targetUser = \App\Models\User::where('role', $targetRole)->first();
            if ($targetUser) {
                \Illuminate\Support\Facades\Auth::login($targetUser);
            } else {
                $currentUser->update(['role' => $targetRole]);
            }
        }
    }

    if ($authenticated) {
        $roleName = match($targetRole) {
            'super_admin' => 'Super Administrator (Akses Penuh)',
            'admin' => 'Admin Pengelola (Konten & Dokumen)',
            'operator' => 'Operator (Input Data Pelayanan)',
            default => 'User',
        };

        $activeUser = auth()->user();
        \App\Models\ActivityLog::record(
            action: 'GANTI ROLE',
            module: 'Role & Hak Akses',
            description: "Pengguna {$activeUser?->name} beralih hak akses ke {$roleName}.",
            user: $activeUser
        );

        \Filament\Notifications\Notification::make()
            ->title('Verifikasi Berhasil!')
            ->body("Autentikasi sukses. Anda sekarang masuk sebagai: {$roleName}")
            ->success()
            ->send();

        return redirect('/admin');
    }

    // Authentication failed
    \Filament\Notifications\Notification::make()
        ->title('Autentikasi Gagal')
        ->body('Username atau kata sandi yang Anda masukkan salah. Akses ke role ditolak.')
        ->danger()
        ->send();

    return redirect('/admin');
})->name('admin.switch-role-auth');

// Protected fallback for direct GET access: requires password
Route::middleware('auth')->get('/admin/switch-role/{role}', function ($role) {
    \Filament\Notifications\Notification::make()
        ->title('Autentikasi Diperlukan')
        ->body('Silakan pilih role melalui menu akun dan masukkan username serta password.')
        ->warning()
        ->send();

    return redirect('/admin');
})->name('admin.switch-role');

// Delete navigation item route
Route::middleware('auth')->post('/admin/navigations/{id}/delete', function ($id) {
    if (auth()->user()?->role !== 'super_admin') {
        abort(403);
    }
    $nav = \App\Models\Navigation::findOrFail($id);
    // Delete child items if this is a parent
    \App\Models\Navigation::where('parent_id', $nav->id)->delete();
    $title = $nav->title;
    $nav->delete();

    \Filament\Notifications\Notification::make()
        ->title('Menu Navigasi Dihapus')
        ->body("Menu \"{$title}\" berhasil dihapus dari struktur navigasi.")
        ->success()
        ->send();

    return redirect('/admin/navigations');
})->name('admin.navigations.delete-custom');

// Direct public storage file serving (handles Windows symlink/junction issues & dev environments)
Route::get('/storage/{path}', function (string $path) {
    $filePath = storage_path('app/public/' . $path);
    if (!file_exists($filePath) || is_dir($filePath)) {
        abort(404);
    }

    $mimeType = mime_content_type($filePath) ?: 'application/octet-stream';
    return response()->file($filePath, [
        'Content-Type' => $mimeType,
        'Cache-Control' => 'public, max-age=86400',
    ]);
})->where('path', '.*')->name('public.storage');

// Google Indonesian Female Text-to-Speech Streaming & Caching
Route::get('/audio-tts', function (\Illuminate\Http\Request $request) {
    $text = trim($request->query('text', ''));
    if (!$text) {
        return response('', 400);
    }

    $text = mb_substr($text, 0, 250);
    $cacheDir = storage_path('app/tts');
    if (!file_exists($cacheDir)) {
        mkdir($cacheDir, 0755, true);
    }
    
    $cacheFile = $cacheDir . '/' . md5($text) . '.mp3';
    if (!file_exists($cacheFile) || filesize($cacheFile) === 0) {
        $encoded = urlencode($text);
        $url = "https://translate.google.com/translate_tts?ie=UTF-8&tl=id&client=tw-ob&q={$encoded}";
        $opts = [
            'http' => [
                'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\r\n"
            ]
        ];
        $context = stream_context_create($opts);
        $content = @file_get_contents($url, false, $context);
        if ($content && strlen($content) > 500) {
            file_put_contents($cacheFile, $content);
        } else {
            return response('', 502);
        }
    }

    return response()->file($cacheFile, [
        'Content-Type' => 'audio/mpeg',
        'Cache-Control' => 'public, max-age=604800',
    ]);
});


