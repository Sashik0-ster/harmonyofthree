<x-app>

    {{-- Найновші статті --}}
    <div class="mb-10 sm:mb-5 md:mb-5">
        <div class="bg-accent py-1 px-2 mb-2 text-white rounded-sm">
            <span class="text-white text-sm font-bold">
                Найновші статті
            </span>
        </div>

        <x-ui.carousel.carousel>
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
        </x-ui.carousel.carousel>
    </div>

    {{-- Популярні статті --}}
    <div class="mt-10 sm:mb-5 md:mb-5">
        <div class="bg-accent py-1 px-2 mb-2 text-white rounded-sm">
            <span class="text-white text-sm font-bold">
                Популярні статті
            </span>
        </div>

        <x-ui.carousel.carousel>
            @foreach ($popularArticles as $popularArticle)
                <x-ui.carousel.item :active="$loop->first" :title="$popularArticle->title">
                    <x-article-card :article="$popularArticle" />
                </x-ui.carousel.item>
            @endforeach

            <x-slot:indicators>
                @foreach ($popularArticles as $index => $popularArticle)
                    <x-ui.carousel.indicator :index="$index" :active="$index === 0" />
                @endforeach
            </x-slot:indicators>
        </x-ui.carousel.carousel>
    </div>

</x-app>
