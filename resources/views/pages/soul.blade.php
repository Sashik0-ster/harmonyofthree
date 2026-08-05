<x-app>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Soul</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($articles as $article)
                <div class="border rounded-lg p-5 shadow-sm bg-white flex flex-col justify-between">
                    <div>
                        {{-- Категорія / Розділ --}}
                        @if ($article->section)
                            <span class="text-xs font-semibold uppercase px-2 py-1 bg-gray-100 rounded text-gray-600">
                                {{ $article->section->name }}
                            </span>
                        @endif

                        {{-- Заголовок --}}
                        <h2 class="text-xl font-semibold mt-3 mb-2 text-gray-900">
                            {{ $article->title }}
                        </h2>

                        {{-- Короткий зміст --}}
                        <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                            {{ $article->content }}
                        </p>
                    </div>

                    {{-- Мета-інформація (Автор та Дата) --}}
                    <div class="text-xs text-gray-500 pt-3 border-t flex justify-between items-center">
                        <span>
                            {{ $article->author?->name ?? 'Анонім' }}
                        </span>
                        <time datetime="{{ $article->created_at }}">
                            {{ $article->created_at->format('d.m.Y') }}
                        </time>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10 text-gray-500">
                    Статей поки немає.
                </div>
            @endforelse
        </div>

        {{-- Пагінація --}}
        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    </div>
</x-app>
