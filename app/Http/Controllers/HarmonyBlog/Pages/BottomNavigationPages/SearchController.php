<?php

namespace App\Http\Controllers\HarmonyBlog\Pages\BottomNavigationPages;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $articles = null;

        if (mb_strlen($q) >= 2) {
            $articles = Article::search($q)
                ->query(fn ($query) => $query
                    ->with('author')
                    ->where('status', 'published')
                    ->latest('published_at'))
                ->paginate(10)
                ->withQueryString();
        }

        return view('/pages.bottomNavigationPages.search', compact('q', 'articles'));
    }

}

