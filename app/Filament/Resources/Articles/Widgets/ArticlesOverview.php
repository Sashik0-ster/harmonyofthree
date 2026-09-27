<?php

namespace App\Filament\Resources\Articles\Widgets;

use App\Services\Articles\ArticleService;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ArticlesOverview extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        // Отримуємо значення з фільтрів дашборду (якщо вони є)
        $startDate = $this->pageFilters['startDate'] ?? null;
        $endDate = $this->pageFilters['endDate'] ?? null;

        /** @var ArticleService $articleService */
        $articleService = app(ArticleService::class);

        return [
            Stat::make(
                label: 'Загальна кількість переглядів',
                value: $articleService->getViewsCount(
                    article: null,
                    startDate: $startDate,
                    endDate: $endDate
                ),
            ),
        ];
    }
}