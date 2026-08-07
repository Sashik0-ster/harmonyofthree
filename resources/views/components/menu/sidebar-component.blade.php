<nav class="fixed top-0 left-0 w-full z-50 bg-surface border-t border-accent">

    <ul class="flex items-center justify-between w-full px-4 py-2">
        @foreach ($menuItems as $menuItem)
            @php
                $hasRoute = !empty($menuItem['route']) && Route::has($menuItem['route']);
                $url = $hasRoute ? route($menuItem['route']) : $menuItem['url'] ?? '#';
                $isActive =
                    !empty($menuItem['route']) &&
                    (request()->routeIs($menuItem['route']) ||
                        (isset($article) && $article->section?->slug === ($menuItem['slug'] ?? null)));
            @endphp

            <li class="flex">
                <x-menu.sidebar-item :href="$url" :active="$isActive" class="inline-flex items-center">
                    @if (!empty($menuItem['icon']))
                        <img src="{{ asset('img/menuicons/' . $menuItem['icon']) }}" class="w-5 h-5 shrink-0 mr-2"
                            alt="{{ $menuItem['title'] }}">
                    @endif
                    <span class="flex items-start">{{ $menuItem['title'] }}</span>
                </x-menu.sidebar-item>
            </li>
        @endforeach
    </ul>
</nav>
