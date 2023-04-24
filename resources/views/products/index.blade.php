<x-app-layout>
    {{ Breadcrumbs::render('shop') }}
    @section('seo')
        {!! seo() !!}
    @endsection
    <div class="container mx-auto px-2 my-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-3 gap-y-5">
            @foreach ($products as $product)
                <x-card class="px-0 py-0 rounded transition-none overflow-hidden ">

                    <a href="{{ route('shop.products.show', $product) }}">
                        <div class=" aspect-w-16 aspect-h-9 ">

                            @if ($product->getMedia('product-thumbnails')->last())
                                {{ $product->getMedia('product-thumbnails')->last() }}
                            @else
                                {!! $product->getFallbackImage() !!}
                            @endif


                        </div>
                    </a>

                    <div class="info p-2">
                        <a href="{{ route('shop.products.show', $product) }}">
                            <h2 class="truncate font-bold">{{ $product->title }}</h2>
                        </a>
                        <p class=" text-gray-500 text-xs">by Tagdiv in News Editorial</p>
                        <div class="flex items-end justify-between mt-2">
                            <div class="">
                                <h3 class=" font-bold">৳{{ $product->selling_price }}
                                    <span
                                        class="ml-1 font-normal line-through text-gray-500">৳{{ $product->original_price }}</span>
                                </h3>

                                <div class="rating text-yellow-300 ">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= ceil($product->reviews_avg_rating))
                                            <x-svg.star-solid class="w-4 h-4 inline" />
                                        @else
                                            <x-svg.star-outlined class="w-4 h-4 inline" />
                                        @endif
                                    @endfor
                                    <span class="text-gray-500 text-sm">({{ $product->reviews_count }})</span>
                                </div>

                            </div>
                            <div class="">
                                <form action="{{ route('shop.cart.create', $product) }}" method="post">
                                    @csrf
                                    <button
                                        class="border border-primary-600 rounded py-1.5 px-3 hover:bg-primary-600 hover:text-gray-100 transition-all flex items-center gap-1">
                                        <x-svg.cart class="w-5 h-5 inline" />
                                        {{ __('Add to cart') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </x-card>
            @endforeach
        </div>
    </div>
</x-app-layout>
