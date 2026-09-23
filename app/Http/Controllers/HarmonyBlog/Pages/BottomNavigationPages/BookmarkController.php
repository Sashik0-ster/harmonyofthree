<?php

namespace App\Http\Controllers\HarmonyBlog\Pages\BottomNavigationPages;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index(Request $request): View
    {
        $articles = $request->user()
            ->bookmarks()
            ->where('status', 'published')
            ->withCount('views')
            ->orderByPivot('created_at', 'desc')
            ->paginate(12);

        return view('pages.bottomNavigationPages.bookmark', compact('articles'));
    }

    public function toggle(Request $request, Article $article): RedirectResponse|JsonResponse
    {
        abort_unless($article->status === 'published', 404);

        $result = $request->user()->bookmarks()->toggle($article->id);
        $bookmarked = ! empty($result['attached']);

        if ($request->expectsJson()) {
            return response()->json(['bookmarked' => $bookmarked]);
        }

        return back();
    }
}