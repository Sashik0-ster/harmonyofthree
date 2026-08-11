<?php

namespace App\View\Components\Menu;

trait BottomNavigationData
{
    public array $navigationItems = [];

    public function getnavigationItems(): array
    {

        if (!empty($this->navigationItems)) {
            return $this->navigationItems;
        }

        return $this->navigationItems = [
            ['title' => 'Про нас', 'route' => '#', 'icon' => 'home_icon.svg'],
            ['title' => 'Пошук', 'route' => '#', 'icon' => 'search_icon.svg'],
            ['title' => 'Збережене', 'route' => '#', 'icon' => 'bookmark_icon.svg'],
            ['title' => 'Профіль', 'route' => '#', 'icon' => 'user_icon.svg'],
        ];
    }
}
