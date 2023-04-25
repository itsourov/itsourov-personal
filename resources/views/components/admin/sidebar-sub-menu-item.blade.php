@props(['active'])

@php
    if ($active ?? false) {
        $classes = 'bg-gray-100 dark:bg-gray-700';
    } else {
        $classes = '';
    }
    $classes = $classes . ' flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 border border-dashed dark:border-gray-700';
    
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
</li>
