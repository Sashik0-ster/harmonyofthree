@props(['href' => '#', 'active' => false])

<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' =>
            'flex flex-col items-center gap-1 text-xs group transition-colors ' .
            ($active ? 'text-accent font-semibold' : 'text-text-muted hover:text-accent-light dark:hover:text-accent'),
    ]) }}>

    <span class="flex items-center">{{ $slot }}</span>
</a>
