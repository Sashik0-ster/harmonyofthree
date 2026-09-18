<?php

namespace App\Http\Controllers\HarmonyBlog\Pages;

use App\Http\Controllers\Controller;
use App\Repositories\Articles\ArticleSortRepository;
use Illuminate\Contracts\View\View;

class MainController extends Controller
{
    /**
     * Відображення головної сторінки з останніми та популярними статтями.
     */
    public function index(ArticleSortRepository $repository): View
    {
        // 5 останніх опублікованих статей
        $articles = $repository->getSortedByDate(direction: 'desc', perPage: 5);

        // 6 найпопулярніших статей за переглядами
        $popularArticles = $repository->getSortedByViews(perPage: 6);

        return view('pages.main', compact('articles', 'popularArticles'));
    }
}