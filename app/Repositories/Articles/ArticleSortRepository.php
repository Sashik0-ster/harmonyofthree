<?php

namespace App\Repositories\Articles;

use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleSortRepository
{
    protected Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Отримати найпопулярніші статті за кількістю записів у таблиці article_views.
     */
    public function getSortedByViews(int $perPage = 6): LengthAwarePaginator
    {
        return $this->article->with('section')->withCount('views')->orderBy('views_count', 'desc')->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Отримати пагіновані статті, відсортовані за датою створення.
     */
    public function getSortedByDate(string $direction = 'desc', int $perPage = 5): LengthAwarePaginator
    {
        return $this->article->with('section')->withCount('views')->orderBy('created_at', $direction)->paginate($perPage);
    }

    /**
     * Сортування статей за масивом ID.
     */
    public function sortByCustomOrder(array $articleIds, int $perPage = 5): LengthAwarePaginator
    {
        if (empty($articleIds)) {
            return $this->article->whereRaw('1 = 0')->paginate($perPage);
        }

        return $this->article
            ->with('section')
            ->whereIn('id', $articleIds)
            ->orderByRaw('FIELD(id, ' . implode(',', array_map('intval', $articleIds)) . ')')
            ->paginate($perPage);
    }
}
