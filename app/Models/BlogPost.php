<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BlogPost extends Model
{
    use HasFactory;

    /**
     * Поля, дозволені для масового заповнення.
     */
    protected $fillable = [
        'title',
        'url',
        'excerpt',
        'image',
        'source_name',
        'source_id',
        'published_at',
        'imported_at',
    ];

    /**
     * Автоматичне перетворення типів даних.
     */
    protected $casts = [
        'published_at' => 'datetime',
        'imported_at' => 'datetime',
    ];

    /* -------------------------------------------------------------------------- */
    /*                                Scope-методи                                */
    /* -------------------------------------------------------------------------- */

    /**
     * Фільтр за назвою джерела.
     * Використання: BlogPost::fromSource('Medium')->get();
     */
    public function scopeFromSource(Builder $query, string $sourceName): Builder
    {
        return $query->where('source_name', $sourceName);
    }

    /**
     * Сортування від найновіших за датою публікації.
     * Використання: BlogPost::latestPublished()->get();
     */
    public function scopeLatestPublished(Builder $query): Builder
    {
        return $query->orderBy('published_at', 'desc');
    }
}
