<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            ['name' => 'Новини', 'slug' => 'news', 'icon' => 'newspaper', 'sort_order' => 1],
            ['name' => 'Технології', 'slug' => 'tech', 'icon' => 'cpu-chip', 'sort_order' => 2],
            ['name' => 'Огляди', 'slug' => 'reviews', 'icon' => 'star', 'sort_order' => 3],
            ['name' => 'Аналітика', 'slug' => 'analytics', 'icon' => 'chart-bar', 'sort_order' => 4],
        ];

        foreach ($sections as $section) {
            Section::updateOrCreate(
                ['slug' => $section['slug']], // Шукаємо за slug
                [                             // Оновлюємо або створюємо з цими даними
                    'name' => $section['name'],
                    'icon' => $section['icon'],
                    'sort_order' => $section['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
