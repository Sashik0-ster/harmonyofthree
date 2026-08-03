@props(['href' => '#', 'active' => true])

<a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'flex items-end p-2 text-base text-black rounded-lg hover:bg-gray-100 group dark:text-gray-500 dark:hover:bg-gray-700 ' . ($active ? 'bg-gray-100 dark:bg-gray-700' : '')]) }}>
    {{--    {{ $icon }} --}}
    <span class="ml-3">{{ $slot }}</span>
</a>
