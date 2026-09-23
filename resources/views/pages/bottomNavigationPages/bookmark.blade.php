<x-app>


    <div class="grid grid-cols-1 md:grid-cols-1 sm:grid-cols-1">
        <header class="flex justify-center ">
            <h1>Збережене</h1>
        </header>

        <div class="px-4 py-6">

            @if ($articles->isEmpty())
                <p class="text-text-muted">Ви ще нічого не зберегли.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
                    @foreach ($articles as $article)
                        <x-article-card :article="$article" removable />
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </div>


</x-app>
