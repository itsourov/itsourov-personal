@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>

    <div class="space-y-4">
        <div class="px-2 py-2 text-lg text-gray-700 dark:text-gray-300 font-medium border-b dark:border-gray-700">
            {{ $title }}
        </div>

        <div class="px-2 py-2">
            {{ $content }}
        </div>


        <div class="px-2 py-2 border-t dark:border-gray-700 text-right">
            {{ $footer }}
        </div>
    </div>
</x-modal>
