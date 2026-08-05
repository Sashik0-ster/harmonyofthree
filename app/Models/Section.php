<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Section extends Model
{
    use HasFactory;

    /**
     * Поля, дозволені для масового заповнення.
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'sort_order',
        'is_active',
    ];

    /**
     * Автоматичне перетворення типів даних.
     */
    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    /* -------------------------------------------------------------------------- */
    /*                                Зв'язки (Relations)                         */
    /* -------------------------------------------------------------------------- */

    /**
     * Розділ має багато статей.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /* -------------------------------------------------------------------------- */
    /*                                Scope-методи                                */
    /* -------------------------------------------------------------------------- */

    /**
     * Сортування розділів за порядком (sort_order).
     * Використання: Section::ordered()->get();
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order', 'asc');
    }

    /**
     * Фільтр тільки для активних розділів.
     * Використання: Section::active()->get();
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
