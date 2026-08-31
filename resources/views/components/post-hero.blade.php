@props(['article'])

<div class="max-w-screen-xl">

    {{-- Фото на весь екран з заголовком поверх --}}
    <div class="relative h-[420px] rounded-3xl overflow-hidden shadow-lg">
        <img class="absolute inset-0 w-full h-full object-cover" src="{{ $article->image_url }}"
            alt="{{ $article->title }}">

        {{-- Затемнення знизу для читабельності заголовка --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-black/20"></div>

        {{-- Кнопка "Назад" --}}
        <button onclick="history.back()"
            class="absolute top-5 left-5 w-9 h-9 flex items-center justify-center rounded-full bg-accent text-white backdrop-blur-sm">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        {{-- Бейдж розділу --}}
        @if ($article->section)
            <span
                class="absolute top-5 right-0 px-4 py-2 flex items-center justify-center  bg-accent text-white backdrop-blur-sm">

                {{ $article->section->name }}

            </span>
        @endif

        {{-- Заголовок поверх фото --}}
        <h1 class="absolute left-5 right-5 bottom-8 text-white text-3xl font-extrabold leading-tight">
            {{ $article->title }}
        </h1>
    </div>

    {{-- Блок автора / дати / кнопки збереження --}}
    <div class="flex items-center justify-between px-2 pt-2">
        <div class="flex items-center gap-3">
            <div>
                <p class="text-text-muted text-xs mt-0.5">
                    {{ $article->published_at?->translatedFormat('D, j M Y') ?? 'Чернетка' }}
                </p>
            </div>
        </div>

        <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-accent text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
            </svg>
        </button>
    </div>

</div>
