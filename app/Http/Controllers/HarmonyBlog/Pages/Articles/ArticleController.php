<?php

namespace App\Http\Controllers\HarmonyBlog\Pages\Articles;

use App\Http\Controllers\Controller;
use App\Models\Article;

use Illuminate\Http\Request;

class ArticleController extends Controller
{



    public function show(Article $article)
    {
        $relatedArticles = Article::published()
            ->where('section_id', $article->section_id)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.articles.articles-show', compact('article', 'relatedArticles'));
    }

}
