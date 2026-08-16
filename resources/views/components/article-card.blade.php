@props(['article'])

<div class="rounded-lg overflow-hidden shadow-lg bg-surface flex flex-col">

    <div class="relative">
        <a href="{{ route('articles.show', [$article->section, $article]) }}" class="block">
            <img class="w-full h-48 md:h-64 object-cover" src="{{ $article->image_url }}" alt="{{ $article->title }}"
                loading="lazy">
            <div class="hover:bg-transparent transition duration-300 absolute inset-0 bg-black opacity-20"></div>
        </a>

        @if ($article->section)
            <a href="#">
                <div
                    class="absolute bottom-0 left-0 bg-accent px-4 py-2 text-white text-sm hover:bg-white hover:text-accent transition duration-500 ease-in-out">
                    {{ $article->section->name }}
                </div>
            </a>
        @endif

        @if ($article->is_featured)
            <span class="absolute top-3 left-3 bg-accent text-white text-xs px-2 py-1 rounded uppercase font-semibold">
                Рекомендовано
            </span>
        @endif
    </div>

    <div class="px-6 py-4">
        <a href="{{ route('articles.show', [$article->section, $article]) }}"
            class="font-semibold text-lg text-text inline-block hover:text-accent transition duration-500 ease-in-out">
            {{ $article->title }}
        </a>
        <p class="text-text-muted text-sm">
            {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 80) }}
        </p>
    </div>

    <div class="px-6 py-4 flex flex-row items-center justify-between mt-auto">
        <span class="py-1 text-sm text-text-muted mr-1 flex flex-row items-center">
            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ $article->published_at?->diffForHumans() }}
        </span>

        <span class="py-1 text-sm text-text-muted flex flex-row items-center">
            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            {{ $article->view_count }}
        </span>
    </div>
</div>
