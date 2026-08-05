<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SectionFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'icon' => fake()->randomElement(['heroicon-o-home', 'heroicon-o-user', 'heroicon-o-cog', 'heroicon-o-folder', 'heroicon-o-document-text']),
            'sort_order' => fake()->numberBetween(1, 100),
            'is_active' => fake()->boolean(80),
        ];
    }
}
