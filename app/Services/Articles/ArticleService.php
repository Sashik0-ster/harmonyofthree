<?php

namespace App\Services\Articles;

use App\Models\Article;
use App\Repositories\Articles\ArticleViewRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ArticleService
{
    public function __construct(
        protected ArticleViewRepository $viewRepository
    ) {}

    /**
     * Фіксує перегляд статті на основі поточного запиту.
     */
    public function trackView(Article $article, Request $request): void
    {
        $this->viewRepository->recordView(
            article: $article,
            userId: $request->user()?->id,
            sessionId: $request->session()->getId(),
            ip: $request->ip(),
        );
    }

    /**
     * Фіксує перегляд статті для Telegram Mini App
     * (де немає класичної сесії — дедуплікація по telegram_user_id).
     */
    public function trackTelegramView(Article $article, int $telegramUserId, string $ip): void
    {
        $this->viewRepository->recordView(
            article: $article,
            userId: $telegramUserId,
            sessionId: "tg_{$telegramUserId}",
            ip: $ip,
        );
    }

    public function getViewsCount(Article $article): int
    {
        return $this->viewRepository->getViewsCount($article);
    }

    public function getMostViewed(int $limit = 5, ?Carbon $since = null)
    {
        return $this->viewRepository->getMostViewed($limit, $since);
    }
}