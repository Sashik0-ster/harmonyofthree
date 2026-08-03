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
            ['title' => 'Main', 'route' => 'main', 'icon' => 'icons8-lotus-100.png'],
            ['title' => 'Soul', 'route' => 'soul', 'icon' => 'icons8-meditation-100.png'],
            ['title' => 'Body', 'route' => 'body', 'icon' => 'icons8-priest-100.png'],
            ['title' => 'Mind', 'route' => 'mind', 'icon' => 'icons8-destiny-100.png'],
            ['title' => 'Blog', 'route' => 'blog', 'icon' => 'icons8-temple-100.png'],
        ];
    }
}
