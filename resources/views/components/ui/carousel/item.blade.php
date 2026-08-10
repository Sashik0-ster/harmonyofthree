@props(['active' => false])

<div {{ $attributes->class(['duration-700 ease-in-out', 'hidden' => !$active]) }} data-carousel-item>
    {{ $slot }}
</div>
