<x-app :title="$article->title">
    <div class="max-w-screen-xl mx-auto px-4 pb-5">

        <x-post-hero :article="$article" :is-bookmarked="$isBookmarked" />

        <div class="grid grid-cols-1 gap-1 mt-5">
            <div class="prose max-w-none text-text">
                {!! Str::markdown($article->content) !!}
            </div>
        </div>
    </div>
</x-app>
