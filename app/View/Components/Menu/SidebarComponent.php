<?php

namespace App\View\Components\Menu;

use App\View\Components\Menu\SidebarData;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarComponent extends Component
{
    /**
     * Create a new component instance.
     */
    use SidebarData;

    public function __construct()
    {
        $this->getMenuItems();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu.sidebar-component');
    }
}
