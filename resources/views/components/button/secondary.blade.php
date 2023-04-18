<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center  px-4 py-2 text-base font-semibold text-white transition-all duration-200 bg-orange-600 border border-transparent rounded-md focus:outline-none hover:bg-orange-700 focus:bg-orange-700']) }}>
    {{ $slot }}
</button>
