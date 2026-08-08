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
        // 1. Очищаємо папку в S3 перед початком
        Storage::disk('s3')->deleteDirectory('articles');

        // 2. Готуємо залежності
        $sections = Section::all();
        if ($sections->isEmpty()) {
            $sections = Section::factory(3)->create();
        }

        $users = User::all();
        if ($users->isEmpty()) {
            $users = User::factory(5)->create();
        }

        // 3. Генеруємо статті та завантажуємо зображення в S3
        Article::factory(30)->make()->each(function ($article) use ($sections, $users) {
            $article->section_id = $sections->random()->id;
            $article->author_id = fake()->boolean(80) ? $users->random()->id : null;

            // Завантажуємо рандомне фото з Picsum
            $imageContent = Http::get('https://picsum.photos/640/480')->body();
            $imagePath = 'articles/' . uniqid() . '.jpg';

            // Зберігаємо безпосередньо в S3
            Storage::disk('s3')->put($imagePath, $imageContent);

            // У БД зберігаємо тільки відносний шлях: "articles/65f123abc456.jpg"
            $article->image = $imagePath;
            $article->save();
        });
    }
}
