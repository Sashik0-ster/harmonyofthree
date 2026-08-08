@props(['article'])

<div class="rounded-lg overflow-hidden shadow-lg bg-surface flex flex-col justify-between">

    <div>
        {{-- Зображення з обгорткою-посиланням --}}
        <div class="relative">
            <img class="w-full h-64 md:h-80 object-cover"
                src="{{ $article->image ? Storage::url($article->image) : asset('images/placeholder.jpg') }}"
                alt="{{ $article->title }}">
            <div class="absolute inset-0 bg-black opacity-20 hover:opacity-10 transition-opacity"></div>


            @if ($article->is_featured)
                <span class="absolute top-3 left-3 bg-body text-white text-xs px-2 py-1 rounded uppercase font-semibold">
                    Рекомендовано
                </span>
            @endif



        </div>

        {{-- Контентна частина --}}
        <div class="px-6 py-4">
            <h2 class="font-semibold text-2xl md:text-3xl text-text inline-block hover:text-accent transition-colors">
                {{ $article->title }}
            </h2>

            @if ($article->excerpt)
                <p class="text-text-muted text-sm mt-2">
                    {{ $article->excerpt }}
                </p>
            @endif
        </div>
    </div>

    {{-- Футер картки --}}
    <div class="px-6 py-4 flex flex-row items-center justify-between border-t border-border">
        <span class="py-1 text-sm text-text-muted mr-1 flex flex-row items-center" title="Автор">
            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            {{ $article->author?->name ?? 'Анонім' }}
        </span>

        <span class="py-1 text-sm text-text-muted mr-1 flex flex-row items-center" title="Дата публікації">
            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ $article->published_at?->diffForHumans() ?? 'Чернетка' }}
        </span>

        <span class="py-1 text-sm text-text-muted flex flex-row items-center" title="Перегляди">
            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            {{ $article->view_count ?? 0 }}
        </span>
    </div>
</div>
