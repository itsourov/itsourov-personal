@props(['name', 'tabItem'])
@php
    if ($tabItem == $name) {
        $classes = 'rounded bg-primary-400 dark:bg-primary-400 text-white px-4 py-1.5 transition-all duration-200';
    } else {
        $classes = 'rounded bg-gray-100 dark:bg-gray-700 px-4 py-1.5 transition-all duration-200 ';
    }
@endphp
<button {{ $attributes->merge(['class' => $classes]) }} wire:click="setTab('{{ $name }}')">
    {{ $slot }}</button>
