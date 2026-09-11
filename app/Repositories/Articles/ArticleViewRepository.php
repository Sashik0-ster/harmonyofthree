<?php

namespace App\Repositories\Articles;

use App\Models\Article;
use App\Models\ArticleView;
use Illuminate\Support\Carbon;

class ArticleViewRepository
{
    /**
     * Фіксує перегляд статті, якщо унікальний перегляд
     * (по user_id або session_id) не був зафіксований за останні 24 години.
     */
    public function recordView(Article $article, ?int $userId, string $sessionId, string $ip): void
    {
        if ($this->hasRecentView($article, $userId, $sessionId)) {
            return;
        }

        ArticleView::create([
            'article_id'  => $article->id,
            'user_id'     => $userId,
            'session_id'  => $sessionId,
            'ip_address'  => $ip,
        ]);
    }

    /**
     * Перевіряє, чи вже був зафіксований перегляд цим користувачем/сесією
     * за останні 24 години.
     */
    protected function hasRecentView(Article $article, ?int $userId, string $sessionId): bool
    {
        return ArticleView::query()
            ->where('article_id', $article->id)
            ->where(function ($query) use ($userId, $sessionId) {
                $userId
                    ? $query->where('user_id', $userId)
                    : $query->where('session_id', $sessionId);
            })
            ->where('created_at', '>=', Carbon::now()->subHours(24))
            ->exists();
    }

    /**
     * Кількість унікальних переглядів статті.
     */
    public function getViewsCount(Article $article): int
    {
        return ArticleView::query()
            ->where('article_id', $article->id)
            ->count();
    }

    /**
     * Топ статей за переглядами за період (наприклад, для віджета "популярне").
     */
    public function getMostViewed(int $limit = 5, ?Carbon $since = null): \Illuminate\Support\Collection
    {
        $query = ArticleView::query()
            ->selectRaw('article_id, COUNT(*) as views_count')
            ->groupBy('article_id')
            ->orderByDesc('views_count')
            ->limit($limit);

        if ($since) {
            $query->where('created_at', '>=', $since);
        }

        return $query->get();
    }
}