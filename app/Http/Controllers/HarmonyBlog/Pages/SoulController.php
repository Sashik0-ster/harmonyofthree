<?php

namespace App\Http\Controllers\HarmonyBlog\Pages;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Contracts\View\View;

class SoulController extends Controller
{
    public function index(): View
    {
        $articles = Article::with(['section', 'author'])
            ->latest()
            ->paginate(5);

        return view('pages.soul', compact('articles'));
    }
}
