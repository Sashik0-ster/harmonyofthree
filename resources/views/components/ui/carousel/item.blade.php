@props(['active' => false])

<div {{ $attributes->class([
    'absolute inset-0 w-full h-full duration-700 ease-in-out transition-transform',
    'hidden' => !$active,
]) }}
    @if ($active) data-carousel-item="active" @else data-carousel-item @endif>
    {{ $slot }}
</div>
