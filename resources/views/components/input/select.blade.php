<select
    {{ $attributes->merge(['class' => 'p-2.5 border border-gray-200 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 focus:outline-none focus:border-blue-600']) }}>

    {!! $slot !!}
</select>
