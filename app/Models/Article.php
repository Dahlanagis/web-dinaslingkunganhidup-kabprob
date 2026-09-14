<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Article extends Post
{
    protected $table = 'posts';

    protected static function booted(): void
    {
        static::addGlobalScope('category_artikel', function (Builder $builder) {
            $builder->where('category', 'artikel');
        });

        static::creating(function ($article) {
            $article->category = 'artikel';
        });
    }
}
