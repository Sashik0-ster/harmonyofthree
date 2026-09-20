<?php

namespace App\View\Components\Menu;

use App\Models\Section;

trait SidebarData
{
    public array $menuItems = [];

    public function getMenuItems(): array
    {
        if (! empty($this->menuItems)) {
            return $this->menuItems;
        }

        // 1. Додаємо статичний пункт "Головна"
        $items = [
            [
                'title' => 'Головна',
                'route' => 'main',
                'icon' => 'icons8-lotus-100.png',
            ],
        ];

        // 2. Отримуємо всі секції з бази даних
        $sections = Section::all();

        // 3. Формуємо масив пунктів на основі даних із БД
        foreach ($sections as $section) {
            $items[] = [
                'title' => $section->name,
                'route' => $section->slug, // або route('sections.show', $section->slug)
            ];
        }

        return $this->menuItems = $items;
    }
}