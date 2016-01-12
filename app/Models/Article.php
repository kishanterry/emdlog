<?php

namespace App\Models;

use App\Models\Traits\CreatesSlugs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use CreatesSlugs;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'published',
        'path',
        'file',
        'published',
        'author_id',
    ];

    protected $appends = ['article'];

    /**
     * Show only published articles to guests
     */
    protected static function boot()
    {
        parent::boot();

        if (app('auth')->guest()) {
            static::addGlobalScope('published', function (Builder $query) {
                $query->where('published', '=', true);
            });
        }
    }

    /**
     * @return string
     */
    protected function getArticleAttribute()
    {
        $path = $this->path;
        $file = $this->file;

        try {
            return app('files')->get("{$path}/{$file}");
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return '';
    }
}
