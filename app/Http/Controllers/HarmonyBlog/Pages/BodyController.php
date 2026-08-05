<?php

namespace App\Http\Controllers\HarmonyBlog\Pages;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Contracts\View\View;

class BodyController extends Controller
{
    public function index(): View
    {
        $articles = Article::with(['section', 'author'])
            ->whereHas('section', function ($query) {
                $query->where('slug', 'body');
            })
            ->latest('published_at')
            ->paginate(6);

        return view('pages.body', compact('articles'));

    }
}
