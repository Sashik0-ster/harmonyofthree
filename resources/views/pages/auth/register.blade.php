<x-app>
    <section class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">

            <div class="flex items-center gap-6 mb-8">
                <a href="{{ route('register') }}"
                    class="text-3xl font-bold transition {{ request()->routeIs('register') ? 'text-black' : 'text-text/40' }}">
                    Реєстрація
                </a>
                <a href="{{ route('login') }}"
                    class="text-3xl font-bold transition {{ request()->routeIs('login') ? 'text-black' : 'text-text/40' }}">
                    Вхід
                </a>
            </div>

            <form method="POST" action="{{ route('register.store') }}"
                class="flex flex-col gap-6 bg-surface rounded-2xl p-6 border-1 border-accent">
                @csrf

                {{-- Ім'я --}}
                <div class="flex flex-col gap-1">
                    <label for="name" class="text-sm font-medium text-text">Ім'я</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="rounded-lg border-1 border-accent bg-body px-4 py-2 text-text" required>
                    @error('name')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Пароль --}}
                <div class="flex flex-col gap-1">
                    <label for="password" class="text-sm font-medium text-text">Пароль</label>
                    <input type="password" id="password" name="password" placeholder="Введіть пароль"
                        class="rounded-lg border-1 border-accent bg-body px-4 py-2 text-text" required>
                    @error('password')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col gap-1">
                    <label for="password_confirmation" class="text-sm font-medium text-text">Підтвердіть пароль</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Підтвердіть пароль"
                        class="rounded-lg border-1 border-accent bg-body px-4 py-2 text-text" required>
                </div>

                <button type="submit"
                    class="self-start rounded-lg bg-accent text-white px-6 py-2 font-medium hover:opacity-90 transition">
                    Зареєструватися
                </button>
            </form>

        </div>
    </section>
</x-app>
