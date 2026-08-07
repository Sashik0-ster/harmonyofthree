<?php

use App\Http\Controllers\HarmonyBlog\IndexController;
use App\Http\Controllers\HarmonyBlog\Pages\MindController;
use App\Http\Controllers\HarmonyBlog\Pages\MainController;
use App\Http\Controllers\HarmonyBlog\Pages\SoulController;
use App\Http\Controllers\HarmonyBlog\Pages\BodyController;
use App\Http\Controllers\HarmonyBlog\Pages\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HarmonyBlog\Pages\Articles\ArticleController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('main', [MainController::class, 'index'])->name('main');
Route::get('soul', [SoulController::class, 'index'])->name('soul');
Route::get('body', [BodyController::class, 'index'])->name('body');
Route::get('mind', [MindController::class, 'index'])->name('mind');
Route::get('blog', [BlogController::class, 'index'])->name('blog');




Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
