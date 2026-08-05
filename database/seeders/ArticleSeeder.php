<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $sections = Section::all();
        $users = User::all();


        if ($users->isEmpty()) {
            $users = User::factory(5)->create();
        }

        Article::factory(30)->make()->each(function ($article) use ($sections, $users) {
            $article->section_id = $sections->random()->id;
            $article->author_id = fake()->boolean(80) ? $users->random()->id : null;
            $article->save();
        });
    }
}
