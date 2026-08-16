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
        // 1. Очищаємо папку на дефолтному диску перед початком
        Storage::deleteDirectory('articles');

        // 2. Готуємо залежності
        $sections = Section::all();
        if ($sections->isEmpty()) {
            $sections = Section::factory(3)->create();
        }

        $users = User::all();
        if ($users->isEmpty()) {
            $users = User::factory(5)->create();
        }

        // 3. Генеруємо статті та завантажуємо зображення
        Article::factory(30)->make()->each(function (Article $article) use ($sections, $users) {
            $article->section_id = $sections->random()->id;
            $article->author_id = fake()->boolean(80) ? $users->random()->id : null;

            $imagePath = 'articles/' . uniqid() . '.jpg';

            try {
                $response = Http::timeout(10)->get('https://picsum.photos/640/480');

                if ($response->successful()) {
                    Storage::put($imagePath, $response->body());
                    $article->image = $imagePath;
                } else {
                    $this->command->warn("Не вдалося завантажити зображення для статті: {$article->title}");
                }
            } catch (\Throwable $e) {
                $this->command->warn("Помилка завантаження зображення: {$e->getMessage()}");
            }

            $article->save();
        });

        $this->command->info('Створено 30 статей.');
    }
}
