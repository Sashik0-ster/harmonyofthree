<ul class="flex items-center justify-center w-full px-5 py-3 gap-2">
    @foreach ($menuItems as $menuItem)
        @php
            $hasRoute = !empty($menuItem['route']) && Route::has($menuItem['route']);
            $url = $hasRoute ? route($menuItem['route']) : $menuItem['url'] ?? '#';
            $isActive =
                !empty($menuItem['route']) &&
                (request()->routeIs($menuItem['route']) ||
                    (isset($article) && $article->section?->slug === ($menuItem['slug'] ?? null)));
        @endphp

        <li class="flex border border-accent rounded-lg">
            <x-menu.sidebar-item :href="$url" :active="$isActive" class="inline-flex items-center">
                <span class="flex items-start">{{ $menuItem['title'] }}</span>
            </x-menu.sidebar-item>
        </li>
    @endforeach
</ul>
