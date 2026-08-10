<x-app>

    <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">

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
