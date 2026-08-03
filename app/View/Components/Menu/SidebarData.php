<?php

namespace App\View\Components\Menu;

trait SidebarData
{

    public array $menuItems;

    public function getMenuItems()
    {

        $this->menuItems = [
            ['title' => 'Main', 'route' => '', 'icon' => 'icons8-lotus-100.png'],
            ['title' => 'Soul', 'route' => '', 'icon' => 'icons8-meditation-100.png'],
            ['title' => 'Body', 'route' => '', 'icon' => 'icons8-priest-100.png'],
            ['title' => 'Maind', 'route' => '', 'icon' => 'icons8-destiny-100.png'],
            ['title' => 'Blog', 'route' => '', 'icon' => 'icons8-temple-100.png'],
        ];
    }
}
