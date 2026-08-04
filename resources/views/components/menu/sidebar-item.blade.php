@props(['href' => '#', 'active' => false])

<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' =>
            'flex items-center p-1 text-base text-black hover:bg-teal-500 hover:rounded-t-lg group dark:text-gray-500 dark:hover:bg-teal-500 dark:hover:text-white' .
            ($active
                ? 'mt-1 bg-teal-500 text-white rounded-t-lg dark:bg-teal-500 dark:text-white'
                : 'mt-1 text-black hover:bg-teal-500 dark:text-gray-500 dark:hover:bg-teal-500 dark:hover:text-white'),
    ]) }}>

    <span class="flex items-center">{{ $slot }}</span>
</a>
