<x-app :title="$article->title">
    <div class="max-w-screen-xl mx-auto px-4 py-5">

        <x-post-hero :article="$article" />

        <div class="grid grid-cols-1 lg:grid-cols-1 gap-10 mt-5">
            <article class="lg:col-span-2 prose">
                {!! $article->content !!}
            </article>

        </div>
    </div>
</x-app>
