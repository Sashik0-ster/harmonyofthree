<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SectionFactory extends Factory
{
    protected $model = Section::class;

    public function definition(): array
    {
        // Генеруємо повністю випадкову назву замість статичного масиву
        $name = fake()->unique()->words(2, true);

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'icon' => 'heroicon-o-folder',
            'sort_order' => fake()->numberBetween(1, 100),
            'is_active' => true,
        ];
    }
}
