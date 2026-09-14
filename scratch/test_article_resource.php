<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Article::count(): " . App\Models\Article::count() . "\n";
foreach (App\Models\Article::all() as $a) {
    echo "  - [Article] {$a->id} : {$a->title}\n";
}

echo "\nPost (category=berita): " . App\Models\Post::where('category', 'berita')->count() . "\n";
foreach (App\Models\Post::where('category', 'berita')->get() as $p) {
    echo "  - [News] {$p->id} : {$p->title}\n";
}

$testArt = App\Models\Article::create([
    'title' => 'Tes Otomatis Artikel',
    'slug' => 'tes-otomatis-artikel-999',
    'content' => 'Konten uji coba',
    'status' => 'draft',
]);
echo "\nCreated Article category: [{$testArt->category}]\n";
$testArt->delete();
echo "Cleaned up test article.\n";
