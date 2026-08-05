@props(['href' => '#', 'active' => false])

<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' =>
            'flex items-center p-1 text-base group mt-1 rounded-t-lg transition-colors ' .
            ($active
                ? 'bg-accent text-white'
                : 'text-black hover:bg-accent hover:text-white dark:text-gray-400 dark:hover:bg-accent dark:hover:text-white'),
    ]) }}>

    <span class="flex items-center">{{ $slot }}</span>
</a>
