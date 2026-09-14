<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

use Illuminate\Http\Request;

$urls = [
    '/informasi/berita',
    '/informasi/artikel',
];

foreach ($urls as $url) {
    $request = Request::create($url, 'GET');
    $response = $kernel->handle($request);
    echo "URL: {$url} -> Status: " . $response->getStatusCode() . " | Length: " . strlen($response->getContent()) . "\n";
    $kernel->terminate($request, $response);
}

// Test Article click:
$firstArticle = App\Models\Article::first();
if ($firstArticle) {
    $artUrl = '/artikel/' . $firstArticle->slug;
    $request = Request::create($artUrl, 'GET');
    $response = $kernel->handle($request);
    echo "URL: {$artUrl} -> Status: " . $response->getStatusCode() . " | Contains title: " . (str_contains($response->getContent(), $firstArticle->title) ? "YES" : "NO") . "\n";
    $kernel->terminate($request, $response);
}

// Test News click:
$firstNews = App\Models\Post::where('category', 'berita')->first();
if ($firstNews) {
    $newsUrl = '/berita/' . $firstNews->slug;
    $request = Request::create($newsUrl, 'GET');
    $response = $kernel->handle($request);
    echo "URL: {$newsUrl} -> Status: " . $response->getStatusCode() . " | Contains title: " . (str_contains($response->getContent(), e($firstNews->title)) ? "YES" : "NO") . "\n";
    $kernel->terminate($request, $response);
}

// Test Admin access:
$user = App\Models\User::first();
auth()->login($user);
$reqAdmin1 = Request::create('/admin/posts', 'GET');
$respAdmin1 = $kernel->handle($reqAdmin1);
echo "Admin /admin/posts (Berita Terbaru) Status: " . $respAdmin1->getStatusCode() . "\n";
$kernel->terminate($reqAdmin1, $respAdmin1);

$reqAdmin2 = Request::create('/admin/articles', 'GET');
$respAdmin2 = $kernel->handle($reqAdmin2);
echo "Admin /admin/articles (Artikel Lingkungan) Status: " . $respAdmin2->getStatusCode() . "\n";
$kernel->terminate($reqAdmin2, $respAdmin2);
