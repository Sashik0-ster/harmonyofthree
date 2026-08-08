<?php

use App\Http\Controllers\HarmonyBlog\IndexController;
use App\Http\Controllers\HarmonyBlog\Pages\MindController;
use App\Http\Controllers\HarmonyBlog\Pages\MainController;
use App\Http\Controllers\HarmonyBlog\Pages\SoulController;
use App\Http\Controllers\HarmonyBlog\Pages\BodyController;
use App\Http\Controllers\HarmonyBlog\Pages\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HarmonyBlog\Pages\Articles\ArticleController;
use App\Http\Controllers\HarmonyBlog\Pages\Articles\BookmarkController;
use App\Http\Controllers\Telegram\WebhookController;


// Route::get('/', function () {
//     return view('welcome');
// });

// Telegram Bot API надсилає сюди всі оновлення (повідомлення, команди тощо).
Route::post('/telegram/webhook', [WebhookController::class, 'handle']);



Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('main', [MainController::class, 'index'])->name('main');
Route::get('soul', [SoulController::class, 'index'])->name('soul');
Route::get('body', [BodyController::class, 'index'])->name('body');
Route::get('mind', [MindController::class, 'index'])->name('mind');
Route::get('blog', [BlogController::class, 'index'])->name('blog');




Route::get('{section:slug}/articles/{article:slug}', [ArticleController::class, 'show'])
    ->name('articles.show');

// Route::middleware('auth')->group(function () {
//     Route::post('/articles/{article}/bookmark', [BookmarkController::class, 'toggle'])
//         ->name('articles.bookmark');
// });
