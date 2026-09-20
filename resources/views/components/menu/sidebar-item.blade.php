@props(['href' => '#', 'active' => false])

<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' =>
            'flex items-center px-4 py-1 text-base group rounded-lg transition-colors ' .
            ($active
                ? 'bg-accent text-white'
                : 'text-text hover:bg-accent-light hover:text-accent-dark dark:text-text dark:hover:bg-accent dark:hover:text-white'),
    ]) }}>

    <span class="flex items-center">{{ $slot }}</span>
</a>
