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
            ['title' => 'Про нас', 'route' => 'index', 'icon' => 'home_icon.svg'],
            ['title' => 'Пошук', 'route' => 'search', 'icon' => 'search_icon.svg'],
            ['title' => 'Збережене', 'route' => 'bookmark', 'icon' => 'bookmark_icon.svg'],
            ['title' => 'Профіль', 'route' => 'profilesetting', 'icon' => 'user_icon.svg'],
        ];
    }
}
