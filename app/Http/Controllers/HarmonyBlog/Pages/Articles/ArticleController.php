<?php

namespace App\Http\Controllers\HarmonyBlog\Pages\Articles;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Section;
use App\Services\Articles\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleService $articleService
    ) {}

    /**
     * Відображає сторінку статті.
     *
     * @param Section $section Автоматично прив'язується через {section:slug}
     * @param Article $article Автоматично прив'язується через {article:slug}
     */
public function show(Section $section, Article $article, Request $request)
{
    $this->articleService->trackView($article, $request);

    $article->loadCount('views');

    $relatedArticles = Article::published()
        ->withCount('views')
        ->where('section_id', $article->section_id)
        ->where('id', '!=', $article->id)
        ->latest('published_at')
        ->take(3)
        ->get();

    return view('pages.articles.articles-show', [
        'section' => $section,
        'article' => $article,
        'relatedArticles' => $relatedArticles,
    ]);
}
}