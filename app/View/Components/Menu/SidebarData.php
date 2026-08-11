<?php

namespace App\View\Components\Menu;

trait SidebarData
{
    public array $menuItems = [];

    public function getMenuItems(): array
    {

        if (!empty($this->menuItems)) {
            return $this->menuItems;
        }

        return $this->menuItems = [
            ['title' => 'Головна', 'route' => 'main', 'icon' => 'icons8-lotus-100.png'],
            ['title' => 'Душа', 'route' => 'soul', 'icon' => 'icons8-meditation-100.png'],
            ['title' => 'Тіло', 'route' => 'body', 'icon' => 'icons8-priest-100.png'],
            ['title' => 'Розум', 'route' => 'mind', 'icon' => 'icons8-destiny-100.png'],
            ['title' => 'Блог', 'route' => 'blog', 'icon' => 'icons8-temple-100.png'],
        ];
    }
}
