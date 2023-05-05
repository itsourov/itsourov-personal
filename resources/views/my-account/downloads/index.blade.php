<x-my-account.layout title="ORDERS">
    <div class="grid grid-cols-1 gap-3">
        @foreach ($products as $product)
            <div class="border dark:border-gray-700 rounded p-2 space-y-3">

                <h2 class=" text-lg font-bold truncate"> {{ $product->title }}</h2>
                <hr class="dark:border-gray-700">

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2 gap-3">

                    @foreach ($product->downloadItems as $downloadable)
                        <x-card class="space-y-2 px-4 py-4 text-sm">
                            <div class="flex gap-2">
                                <p class=" flex-shrink-0 text-gray-500">File Title:</p>
                                <p class="truncate">{{ $downloadable->title }}</p>
                            </div>
                            <div class="flex gap-2">
                                <p class=" flex-shrink-0 text-gray-500">File Size:</p>
                                <p class="truncate">{{ $downloadable->size }}</p>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('my-account.downloads.show', $downloadable) }}">
                                    <x-button.primary class="text-sm flex items-center gap-2">
                                        <x-svg.arrow-down-tray class="w-4 h-4" />
                                        <span>Download</span>
                                    </x-button.primary>
                                </a>
                            </div>
                        </x-card>
                    @endforeach
                </div>

            </div>
        @endforeach
    </div>

    {{-- <div class="mt-4">
        {{ $products->links('pagination.tailwind') }}
    </div> --}}
</x-my-account.layout>
