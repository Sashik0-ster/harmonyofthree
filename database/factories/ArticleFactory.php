<?php

namespace Database\Factories;

use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->unique()->sentence(6);

        return [
            'section_id' => Section::factory(),
            'author_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => fake()->paragraph(),
            'content' => fake()->paragraphs(5, true),
            'image' => fake()->imageUrl(800, 600, 'articles', true),
            'status' => fake()->randomElement(['draft', 'published', 'archived']),
            'is_featured' => fake()->boolean(20),
            'view_count' => fake()->numberBetween(0, 5000),
            'published_at' => fake()->optional(0.8)->dateTimeThisYear(),
        ];
    }


    public function published(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'published',
            'published_at' => now()->subDays(rand(1, 30)),
        ]);
    }
}
