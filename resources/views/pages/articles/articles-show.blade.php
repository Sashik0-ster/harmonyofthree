<x-app :title="$article->title">
    <div class="max-w-screen-xl mx-auto px-4 pb-5">

        <x-post-hero :article="$article" />

        <div class="grid grid-cols-1 gap-1 mt-5">
            <article class="prose">
                {!! $article->content !!}
            </article>
        </div>
    </div>
</x-app>
