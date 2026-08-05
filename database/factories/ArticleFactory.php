<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        $title = fake()->unique()->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => fake()->paragraphs(3, true),
            'section_id' => Section::inRandomOrder()->first()?->id ?? Section::factory(),
            'author_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
        ];
    }
}
