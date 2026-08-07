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
            ['title' => 'Home', 'route' => '#', 'icon' => 'home_icon.svg'],
            ['title' => 'Search', 'route' => '#', 'icon' => 'search_icon.svg'],
            ['title' => 'Saved', 'route' => '#', 'icon' => 'bookmark_icon.svg'],
            ['title' => 'Profile', 'route' => '#', 'icon' => 'user_icon.svg'],
        ];
    }
}
