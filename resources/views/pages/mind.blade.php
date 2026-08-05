<x-app>
    <div class="container mx-auto px-2 py-5">
        <h1 class="text-3xl font-bold mb-5">Mind</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($articles as $article)
                <div
                    class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-accent-dark via-accent to-accent-light p-6 shadow-xl">

                    <div class="absolute inset-0 opacity-10"
                        style="background-image: radial-gradient(circle, #fff 1px, transparent 1px);
                                background-size: 30px 30px;">
                    </div>

                    <div class="relative">
                        @if ($article->section)
                            <span
                                class="inline-block text-xs font-semibold uppercase px-3 py-1
                                         bg-white/15 backdrop-blur rounded-full text-white/90 tracking-wide">
                                {{ $article->section->name }}
                            </span>
                        @endif

                        <h2 class="text-xl font-extrabold text-white mt-4 mb-2 leading-snug">
                            {{ $article->title }}
                        </h2>
                        <div class="h-1 w-16 bg-white/60 rounded-full mb-4"></div>

                        <div class="bg-white/10 backdrop-blur rounded-xl p-4 mb-4">
                            <p class="text-white/80 text-sm line-clamp-3">
                                {{ $article->content }}
                            </p>
                        </div>

                        <div
                            class="flex justify-between items-center text-xs text-white/60 pt-3 border-t border-white/15">
                            <span>{{ $article->author?->name ?? 'Анонім' }}</span>
                            <time datetime="{{ $article->created_at }}">
                                {{ $article->created_at->format('d.m.Y') }}
                            </time>
                        </div>

                        <a href="#"
                            class="mt-5 inline-block bg-white text-accent-dark
                                  font-bold uppercase text-xs px-6 py-3 rounded-full shadow-md
                                  hover:bg-white/90 hover:-translate-y-0.5 transition">
                            Читати далі
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10 text-gray-500">
                    Статей поки немає.
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    </div>
</x-app>
