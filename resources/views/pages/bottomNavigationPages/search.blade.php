        @use('App\Support\Highlighter')
        <x-app>

            <form action="{{ route('search') }}" method="GET" role="search" class="mb-6">
                <input type="search" name="q" value="{{ $q ?? '' }}" minlength="2" placeholder="Пошук статей..."
                    class="rounded-lg border px-3 py-1">
                <button type="submit"
                    class="inline-flex items-center px-5 py-2 rounded-xl bg-accent text-white font-medium text-sm hover:opacity-90 transition shadow-sm">
                    Пошук
                </button>
            </form>

            @if ($articles === null)
                <p class="text-text/70">Введіть щонайменше 2 символи.</p>
            @elseif ($articles->isEmpty())
                <p class="text-text/70">Нічого не знайдено за запитом «{{ $q }}».</p>
            @else
                <p class="mb-4 text-sm text-text/70">Знайдено: {{ $articles->total() }}</p>



                <ul class="space-y-4">
                    @foreach ($articles as $article)
                        <li>
                            <a href="{{ route('articles.show', ['section' => $article->section, 'article' => $article]) }}"
                                class="font-bold text-accent">
                                {{ Highlighter::make($article->title, $q) }}
                            </a>
                            @if ($article->excerpt)
                                <p class="text-sm text-text/80">
                                    {{ Highlighter::make(Highlighter::snippet($article->excerpt, $q), $q) }}
                                </p>
                            @endif
                        </li>
                    @endforeach

                    <div class="mt-6">{{ $articles->links() }}</div>
            @endif


        </x-app>
