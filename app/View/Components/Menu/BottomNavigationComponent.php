<?php

namespace App\View\Components\Menu;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BottomNavigationComponent extends Component
{

    use BottomNavigationData;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->getnavigationItems();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu.bottom-navigation-component');
    }
}
