<x-app>

    <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
        @foreach ($articles as $article)
            <x-article-card :article="$article" />
        @endforeach

    </div>

    <div class="mt-8">
        {{ $articles->links() }}
    </div>

</x-app>
