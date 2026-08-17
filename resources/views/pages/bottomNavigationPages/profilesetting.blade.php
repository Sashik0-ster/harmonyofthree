<x-app>
    <div class="min-h-screen bg-body flex flex-col items-center pb-12">
        <div class="w-full max-w-2xl bg-body overflow-hidden relative">

            {{-- Хедер з обкладинкою та хвилею --}}
            <div class="relative h-48 sm:h-56 w-full bg-accent/20">
                <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80"
                    alt="Cover" class="w-full h-full object-cover">

                {{-- Хвильовий шар (Wave SVG) підлітає під фоновий колір сторінки --}}
                <div class="absolute bottom-0 left-0 right-0 leading-none">
                    <svg class="w-full h-12 text-body fill-current" viewBox="0 0 1440 120" preserveAspectRatio="none">
                        <path
                            d="M0,32L60,42.7C120,53,240,75,360,80C480,85,600,75,720,58.7C840,43,960,21,1080,16C1200,11,1320,21,1380,26.7L1440,32L1440,120L1380,120C1320,120,1200,120,1080,120C960,120,840,120,720,120C600,120,480,120,360,120C240,120,120,120,60,120L0,120Z">
                        </path>
                    </svg>
                </div>
            </div>

            {{-- Блок з аватаркою та кнопкою "Edit profile" --}}
            <div class="relative px-6 -mt-16 sm:-mt-20 flex justify-between items-end">

                {{-- Порожній блок для симетрії слева --}}
                <div class="w-24 hidden sm:block"></div>

                {{-- Аватарка по центру --}}
                <div class="relative mx-auto sm:mx-0">
                    <div
                        class="w-28 h-28 sm:w-36 sm:h-36 rounded-full border-4 border-accent p-1 bg-body overflow-hidden shadow-lg">
                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}"
                                class="w-full h-full object-cover rounded-full">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random"
                                alt="{{ $user->name }}" class="w-full h-full object-cover rounded-full">
                        @endif
                    </div>
                </div>

                {{-- Кнопка редагування справа --}}
                <div class="absolute right-6 top-20 sm:static">
                    <a href="#edit-modal" onclick="document.getElementById('edit-form').classList.toggle('hidden')"
                        class="inline-flex items-center px-5 py-2 rounded-xl bg-accent text-white font-medium text-sm hover:opacity-90 transition shadow-sm">
                        Редагувати
                    </a>
                </div>
            </div>

            {{-- Основна інформація користувача --}}
            <div class="text-center mt-4 px-6 flex flex-col items-center">
                <h1 class="text-2xl sm:text-3xl font-bold text-text">
                    {{ $user->name }}
                </h1>

                <p class="text-sm text-text/70 mt-1 font-medium">
                    {{ $user->email }}
                </p>

                {{-- Геолокація / Telegram --}}
                @if ($user->telegram_username || $user->telegram_id)
                    <div class="flex items-center gap-1.5 mt-2 text-sm text-text/80 font-medium">
                        <svg class="w-4 h-4 text-red-500 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                        </svg>
                        <span>{{ $user->telegram_username ? '@' . $user->telegram_username : 'ID: ' . $user->telegram_id }}</span>
                    </div>
                @endif
            </div>

            {{-- Статистика (Followers / Following / Likes) --}}
            <div class="grid grid-cols-3 gap-4 mt-8 px-8 py-4 border-t border-b border-accent/20 text-center">
                <div>
                    <span class="block text-xl font-bold text-accent">12K</span>
                    <span class="text-xs text-text/70 font-medium lowercase">підписників</span>
                </div>
                <div>
                    <span class="block text-xl font-bold text-accent">67</span>
                    <span class="text-xs text-text/70 font-medium lowercase">підписок</span>
                </div>
                <div>
                    <span class="block text-xl font-bold text-accent">37K</span>
                    <span class="text-xs text-text/70 font-medium lowercase">вподобайок</span>
                </div>
            </div>

            {{-- Прихована форма редагування профілю --}}
            <div id="edit-form" class="hidden mt-8 px-6">
                <div class="bg-surface p-6 rounded-2xl border border-accent">
                    <h3 class="text-lg font-bold text-text mb-4">Редагувати дані</h3>

                    <form method="POST" action="{{ route('profilesetting.update') }}" enctype="multipart/form-data"
                        class="flex flex-col gap-4">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label class="block text-xs font-medium text-text/70 mb-1">Фото профілю</label>
                            <input type="file" name="avatar" accept="image/*" class="text-xs text-text">
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-text/70 mb-1">Ім'я</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full rounded-lg border border-accent bg-body px-3 py-2 text-text text-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-text/70 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="w-full rounded-lg border border-accent bg-body px-3 py-2 text-text text-sm">
                        </div>

                        <div class="flex justify-between items-center pt-2">
                            <button type="submit"
                                class="px-5 py-2 bg-accent text-white text-xs font-bold rounded-lg hover:opacity-90">
                                Зберегти
                            </button>
                    </form>

                    {{-- Форма виходу --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs text-red-500 hover:underline">
                            Вийти з акаунту
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app>
