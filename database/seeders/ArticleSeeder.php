<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Очищаємо та створюємо папку ОДИН РАЗ перед початком
        Storage::disk('public')->deleteDirectory('articles');
        Storage::disk('public')->makeDirectory('articles');

        // 2. Перевіряємо та готуємо залежності
        $sections = Section::all();
        if ($sections->isEmpty()) {
            $sections = Section::factory(3)->create();
        }

        $users = User::all();
        if ($users->isEmpty()) {
            $users = User::factory(5)->create();
        }

        // 3. Генеруємо статті та зображення для кожної з них
        Article::factory(30)->make()->each(function ($article) use ($sections, $users) {
            $article->section_id = $sections->random()->id;
            $article->author_id = fake()->boolean(80) ? $users->random()->id : null;

            // Завантажуємо та зберігаємо фото для конкретної статті
            $imageContent = Http::get('https://picsum.photos/640/480')->body();
            $imagePath = 'articles/' . uniqid() . '.jpg';

            Storage::disk('public')->put($imagePath, $imageContent);

            $article->image = $imagePath;
            $article->save();
        });
    }
}
