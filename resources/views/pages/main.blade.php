<x-app>

    <div class="mb-10">
        <div class="bg-accent py-1 px-2 mb-2 text-white rounded-sm">
            <span class="text-white text-sm font-bold">
                Найновші статті
            </span>
        </div>

        <x-ui.carousel>
            @foreach ($articles as $article)
                <x-ui.carousel.item :active="$loop->first" :title="$article->title">
                    <x-article-card :article="$article" />
                </x-ui.carousel.item>
            @endforeach

            <x-slot:indicators>
                @foreach ($articles as $index => $article)
                    <x-ui.carousel.indicator :index="$index" :active="$index === 0" />
                @endforeach
            </x-slot:indicators>
        </x-ui.carousel>
    </div>

    <div class="mb-10">
        <div class="bg-accent py-1 px-2 mb-2 text-white rounded-sm">
            <span class="text-white text-sm font-bold">
                Популярні статті
            </span>
        </div>

        <x-ui.carousel>
            @foreach ($articles as $article)
                <x-ui.carousel.item :active="$loop->first" :title="$article->title">
                    <x-article-card :article="$article" />
                </x-ui.carousel.item>
            @endforeach

            <x-slot:indicators>
                @foreach ($articles as $index => $article)
                    <x-ui.carousel.indicator :index="$index" :active="$index === 0" />
                @endforeach
            </x-slot:indicators>
        </x-ui.carousel>
    </div>

</x-app>
