@props(['active' => false])

<div {{ $attributes->class([
    'absolute inset-0 w-full h-full duration-700 ease-in-out transition-transform',
    'hidden' => !$active,
]) }}
    data-carousel-item>
    {{ $slot }}
</div>
