<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{

    public function toggle(Article $article, Request $request): RedirectResponse|JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();


        $changes = $user->bookmarkedArticles()->toggle($article->id);


        $isBookmarked = count($changes['attached']) > 0;

        $message = $isBookmarked
            ? 'Статтю додано до збережених'
            : 'Статтю вилучено зі збережених';


        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_bookmarked' => $isBookmarked,
                'message' => $message,
            ]);
        }

        return back()->with('status', $message);
    }
}
