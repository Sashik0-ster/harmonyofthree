<?php

namespace App\Http\Controllers\HarmonyBlog\Pages\Articles;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Section; // Додайте імпорт моделі Section

class ArticleController extends Controller
{
    /**
     * Відображає сторінку статті.
     *
     * @param Section $section Автоматично прив'язується через {section:slug}
     * @param Article $article Автоматично прив'язується через {article:slug}
     */
    public function show(Section $section, Article $article)
    {
        $relatedArticles = Article::published()
            ->where('section_id', $article->section_id)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.articles.articles-show', compact('section', 'article', 'relatedArticles'));
    }
}
