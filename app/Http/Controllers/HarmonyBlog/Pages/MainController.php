<?php

namespace App\Http\Controllers\HarmonyBlog\Pages;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Contracts\View\View;

class MainController extends Controller
{
    public function index()
    {


        $articles = Article::with(['section', 'author'])
            ->whereHas('section', function ($query) {
                $query->where('slug', 'soul');
            })
            ->latest('published_at')
            ->paginate(6);





        return view('pages.main', compact('articles'));

    }
}
