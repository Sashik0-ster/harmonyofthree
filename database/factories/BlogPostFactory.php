<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(6),
            'url' => fake()->url(),
            'excerpt' => fake()->paragraph(),
            'image' => fake()->imageUrl(800, 600, 'news', true),
            'source_name' => fake()->randomElement(['Medium', 'Dev.to', 'Laravel News', 'TechCrunch']),
            'source_id' => (string) fake()->unique()->numberBetween(10000, 99999),
            'published_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'imported_at' => now(),
        ];
    }
}
