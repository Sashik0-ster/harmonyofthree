@props(['id' => 'carousel-' . uniqid()])

<div id="{{ $id }}" class="relative w-full" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-48 sm:h-64 md:h-96 rounded-2xl bg-surface">
        {{ $slot }}
    </div>

    <!-- Slider indicators -->
    @isset($indicators)
        <div
            class="absolute z-30 flex -translate-x-1/2 bottom-3 sm:bottom-5 left-1/2 space-x-2 sm:space-x-3 rtl:space-x-reverse">
            {{ $indicators }}
        </div>
    @endisset

    <!-- Slider controls -->
    <button type="button"
        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-2 sm:px-4 cursor-pointer group focus:outline-none touch-manipulation"
        data-carousel-prev>
        <span
            class="inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-accent backdrop-blur-sm active:bg-accent/80 sm:group-hover:bg-accent/80 group-focus:ring-2 group-focus:ring-accent transition-colors">
            <svg class="w-4 h-4 text-text rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m15 19-7-7 7-7" />
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button"
        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-2 sm:px-4 cursor-pointer group focus:outline-none touch-manipulation"
        data-carousel-next>
        <span
            class="inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-accent backdrop-blur-sm active:bg-accent/80 sm:group-hover:bg-accent/80 group-focus:ring-2 group-focus:ring-accent transition-colors">
            <svg class="w-4 h-4 text-text rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m9 5 7 7-7 7" />
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
