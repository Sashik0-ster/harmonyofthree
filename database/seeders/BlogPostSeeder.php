<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        // Створюємо 50 зовнішніх статей для тестування
        BlogPost::factory(10)->create();
    }
}
