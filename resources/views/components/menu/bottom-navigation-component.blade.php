<nav class="fixed bottom-0 left-0 w-full z-50 bg-surface border-t border-border">

    <div class="min-h-full  flex flex-col items-center  m-0">
        <ul class="flex items-center justify-around w-full px-5 py-2 gap-14">
            @foreach ($navigationItems as $navigationItem)
                @php
                    // $hasRoute = !empty($menuItem['route']) && Route::has($menuItem['route']);
                    // $url = $hasRoute ? route($menuItem['route']) : $menuItem['url'] ?? '#';
                    $isActive = !empty($navigationItem['route']) && request()->routeIs($navigationItem['route']);
                @endphp
                <li class="flex-1">
                    <x-menu.bottom-navigation-item :href="$navigationItem['route']" :active="$isActive"
                        class="flex flex-col items-center justify-center mx-2">
                        @if (!empty($navigationItem['icon']))
                            <img src="{{ asset('img/bottomnavbaricons/' . $navigationItem['icon']) }}" class="w-5 h-5"
                                alt="{{ $navigationItem['title'] }}">
                        @endif
                        <span class="flex items-center text-xs">{{ $navigationItem['title'] }}</span>
                    </x-menu.bottom-navigation-item>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
