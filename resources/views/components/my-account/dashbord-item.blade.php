@props(['title'])
<a
    {{ $attributes->merge(['class' => 'bg-gray-50 dark:bg-gray-800 rounded shadow hover:bg-gray-100 dark:hover:bg-gray-700 items-center flex flex-col px-3 py-3 group']) }}>
    {{-- <img src="{{ $imageLink }}" alt="" class=" w-14 grayscale group-hover:grayscale-0"> --}}
    {{ $slot }}

    <h4 class=" text-sm">{{ $title }}</h4>
</a>
