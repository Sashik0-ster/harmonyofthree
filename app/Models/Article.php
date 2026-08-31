<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Article extends Model
{
    use HasFactory;

    /**
     * Поля, дозволені для масового заповнення.
     */
    protected $fillable = [
        'section_id',
        'author_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'status',
        'is_featured',
        'view_count',
        'published_at',
    ];

    /**
     * Кастування типів даних.
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'view_count' => 'integer',
        'published_at' => 'datetime',
    ];

    /* -------------------------------------------------------------------------- */
    /*                                Зв'язки (Relations)                         */
    /* -------------------------------------------------------------------------- */

    /**
     * Стаття належить до розділу.
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Стаття належить до автора (користувача).
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /* -------------------------------------------------------------------------- */
    /*                                Scope-методи                                */
    /* -------------------------------------------------------------------------- */

    /**
     * Фільтр тільки для опублікованих статей.
     * Використання: Article::published()->get();
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Фільтр для виділених/обраних статей.
     * Використання: Article::featured()->get();
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->image) {
                    // Якщо в БД шлях починається з "uploads/", прибираємо або обробляємо
                    if (str_starts_with($this->image, 'uploads/')) {
                        return asset($this->image);
                    }

                    // Для файлів з storage/app/public/articles/...
                    return Storage::disk('public')->url($this->image);
                }

                return asset('img/services/services.png');
            }
        );
    }
}
