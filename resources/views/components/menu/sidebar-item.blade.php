@props(['href' => '#', 'active' => false])

<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' =>
            'flex items-center p-2 text-base text-black rounded-lg hover:bg-pink-500 group dark:text-gray-500 dark:hover:bg-pink-500 dark:hover:text-white' .
            ($active ? 'bg-gray-100 dark:bg-pink-500 dark:text-white' : ''),
    ]) }}>

    <span class="flex items-center">{{ $slot }}</span>
</a>
