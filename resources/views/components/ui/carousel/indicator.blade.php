@props(['index', 'active' => false])

<button type="button"
    class="w-2.5 h-2.5 rounded-full bg-highlight aria-[current=true]:bg-accent aria-[current=true]:w-4 transition-all"
    aria-current="{{ $active ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"
    data-carousel-slide-to="{{ $index }}"></button>
