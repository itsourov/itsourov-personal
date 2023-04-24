<x-card class="px-0 py-0 mt-4 rounded transition-none overflow-hidden md:max-w-sm">

    <a href="{{ route('admin.products.edit', $product) }}">
        <div class="aspect-w-16 aspect-h-9 ">
            @if ($product->getMedia('product-thumbnails')->last())
                {{ $product->getMedia('product-thumbnails')->last() }}
            @else
                {!! $product->getFallbackImage() !!}
            @endif
        </div>
    </a>

    <div class="info p-2">
        <a href="{{ route('admin.products.edit', $product) }}">
            <h2 class="truncate font-bold">{{ $product->title }}</h2>
        </a>
        <p class=" text-gray-500 text-xs">by Tagdiv in News Editorial</p>
        <div class="flex items-end justify-between mt-2">
            <div class="">
                <h3 class=" font-bold">৳{{ $product->selling_price }}
                    <span class="ml-1 font-normal line-through text-gray-500">৳{{ $product->original_price }}</span>
                </h3>
                <div class="rating text-yellow-300 ">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= ceil($product->reviews_avg_rating))
                            <x-svg.star-solid class="w-4 h-4 inline" />
                        @else
                            <x-svg.star-outlined class="w-4 h-4 inline" />
                        @endif
                    @endfor
                    <span class="text-gray-500 text-sm">(3.5k)</span>
                </div>

            </div>
            <div class="">
                <a href="{{ route('admin.products.edit', $product) }}">

                    <button
                        class="border border-primary-600 rounded py-1.5 px-3 hover:bg-primary-600 hover:text-gray-100 transition-all">
                        <x-svg.edit class="inline w-5 h-5" />
                    </button>
                </a>
                <a href="{{ route('admin.products.manage-downloadables', $product) }}">

                    <button
                        class="border border-primary-600 rounded py-1.5 px-3 hover:bg-primary-600 hover:text-gray-100 transition-all">
                        <x-svg.link class="inline w-5 h-5" />
                    </button>
                </a>
                <a href="{{ route('shop.products.show', $product) }}">

                    <button
                        class="border border-primary-600 rounded py-1.5 px-3 hover:bg-primary-600 hover:text-gray-100 transition-all">
                        <x-svg.eye class="inline w-5 h-5" />
                    </button>
                </a>
            </div>
        </div>
    </div>

</x-card>
