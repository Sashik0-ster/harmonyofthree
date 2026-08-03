<ul class="flex gap-5">
    @foreach ($menuItems as $menuItem)
        <li class="flex ">
            @php
                $url =
                    !empty($menuItem['route']) && Route::has($menuItem['route'])
                        ? route($menuItem['route'])
                        : $menuItem['url'] ?? '#';
            @endphp

            <x-menu.sidebar-item href="{{ $url }}"
                active="{{ !empty($menuItem['route']) && request()->routeIs($menuItem['route']) }}">
                <img src="{{ asset('img/menuicons/' . $menuItem['icon']) }}"
                    class="w-5 h-5 inline-block mr-2 align-center" alt="icon">
                {{ $menuItem['title'] }}
            </x-menu.sidebar-item>
        </li>
    @endforeach
</ul>
