<ul class="flex items-center justify-center w-full px-5 py-2 gap-7">
    @foreach ($navigationItems as $navigationItem)
        @php
            $hasRoute = !empty($navigationItem['route']) && Route::has($navigationItem['route']);
            $url = $hasRoute ? route($navigationItem['route']) : $navigationItem['url'] ?? '#';
            $isActive =
                !empty($navigationItem['route']) &&
                (request()->routeIs($navigationItem['route']) ||
                    (isset($article) && $article->section?->slug === ($navigationItem['slug'] ?? null)));
        @endphp

        <li class="flex">
            <x-menu.bottom-navigation-item :href="$url" :active="$isActive" class="inline-flex items-center">
                @if (!empty($navigationItem['icon']))
                    <img src="{{ asset('img/bottomnavbaricons/' . $navigationItem['icon']) }}" class="w-5 h-5"
                        alt="{{ $navigationItem['title'] }}">
                @endif
                <span class="flex items-center text-xs">{{ $navigationItem['title'] }}</span>
            </x-menu.bottom-navigation-item>
        </li>
    @endforeach
</ul>
