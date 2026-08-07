<x-app>

    <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
        <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">


            @foreach ($articles as $article)
                <x-article-card :article="$article" />
            @endforeach


        </div>

        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    </div>
</x-app>
