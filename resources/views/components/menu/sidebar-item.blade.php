@props(['href' => '#', 'active' => false])

<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' =>
            'flex items-center p-1 text-base group mt-1 rounded-t-lg transition-colors ' .
            ($active
                ? 'bg-accent text-white'
                : 'text-text hover:bg-accent-light hover:text-accent-dark dark:text-text-muted dark:hover:bg-accent dark:hover:text-white'),
    ]) }}>

    <span class="flex items-center">{{ $slot }}</span>
</a>
