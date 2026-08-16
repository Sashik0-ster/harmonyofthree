<x-app>
    <section class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">

            <h2 class="text-3xl font-bold text-text mb-8">Профіль</h2>

            @if (session('status'))
                <div class="mb-6 rounded-lg bg-accent/20 text-text px-4 py-3">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="#" enctype="multipart/form-data"
                class="flex flex-col gap-6 bg-surface rounded-2xl p-6 border-1 border-accent">
                @csrf
                @method('PATCH')

                {{-- Аватар --}}
                {{-- <div class="flex items-center gap-4">
                    <img src="{{ $user->avatar_url }}" alt="Аватар {{ $user->name }}"
                        class="w-20 h-20 rounded-full object-cover">

                    <div class="flex flex-col gap-1">
                        <label for="avatar" class="text-sm font-medium text-text">Змінити фото</label>
                        <input type="file" id="avatar" name="avatar" accept="image/*"
                            class="text-sm text-text-muted">
                        @error('avatar')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div> --}}

                {{-- Ім'я --}}
                <div class="flex flex-col gap-1">
                    <label for="name" class="text-sm font-medium text-text">Ім'я</label>
                    <input type="text" id="name" name="name" value="1"
                        class="rounded-lg border-1 border-accent bg-body px-4 py-2 text-text">
                    @error('name')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="flex flex-col gap-1">
                    <label for="email" class="text-sm font-medium text-text">Email</label>
                    <input type="email" id="email" name="email" value="1"
                        class="rounded-lg border-1 border-accent bg-body px-4 py-2 text-text">
                    @error('email')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="self-start rounded-lg bg-accent text-white px-6 py-2 font-medium hover:opacity-90 transition">
                    Зберегти
                </button>
            </form>

        </div>
    </section>
</x-app>
