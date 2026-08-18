<?php

use App\Http\Controllers\HarmonyBlog\Pages\Articles\ArticleController;
use App\Http\Controllers\HarmonyBlog\Pages\BlogController;
use App\Http\Controllers\HarmonyBlog\Pages\BodyController;
use App\Http\Controllers\HarmonyBlog\Pages\BottomNavigationPages\BookmarkController;
use App\Http\Controllers\HarmonyBlog\Pages\BottomNavigationPages\IndexController;
use App\Http\Controllers\HarmonyBlog\Pages\BottomNavigationPages\ProfileSettingController;
use App\Http\Controllers\HarmonyBlog\Pages\BottomNavigationPages\SearchController;
use App\Http\Controllers\HarmonyBlog\Pages\MainController;
use App\Http\Controllers\HarmonyBlog\Pages\MindController;
use App\Http\Controllers\HarmonyBlog\Pages\SoulController;
use App\Http\Controllers\Telegram\WebhookController;
use Illuminate\Support\Facades\Route;

// Telegram Webhook
Route::post('telegram/webhook', [WebhookController::class, 'handle'])
    ->name('telegram.webhook');

// Публічні сторінки (доступні всім)
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('search', [SearchController::class, 'index'])->name('search');
Route::get('main', [MainController::class, 'index'])->name('main');
Route::get('soul', [SoulController::class, 'index'])->name('soul');
Route::get('body', [BodyController::class, 'index'])->name('body');
Route::get('mind', [MindController::class, 'index'])->name('mind');
Route::get('blog', [BlogController::class, 'index'])->name('blog');

// Статті
Route::get('{section:slug}/articles/{article:slug}', [ArticleController::class, 'show'])
    ->name('articles.show');

// Сторінки авторизації / реєстрації
Route::get('register', [ProfileSettingController::class, 'register'])->name('register');
Route::post('register', [ProfileSettingController::class, 'registerUser'])->name('register.store');
Route::get('login', [ProfileSettingController::class, 'login'])->name('login');
Route::post('login', [ProfileSettingController::class, 'loginUser'])->name('login.store');

// Захищені сторінки (потребують авторизації користувача)
Route::middleware('auth')->group(function () {
    Route::get('profilesetting', [ProfileSettingController::class, 'index'])->name('profilesetting');
    Route::patch('profilesetting', [ProfileSettingController::class, 'update'])->name('profilesetting.update');

    Route::post('logout', [ProfileSettingController::class, 'logout'])->name('logout');

    Route::get('bookmark', [BookmarkController::class, 'index'])->name('bookmark');
    Route::post('articles/{article}/bookmark', [BookmarkController::class, 'toggle'])->name('articles.bookmark');
});
