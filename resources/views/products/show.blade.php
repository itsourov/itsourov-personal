<x-app-layout>
    {{ Breadcrumbs::render('shop.product', $product) }}


    <section class=" container mx-auto px-2 mt-10">
        <div class="  grid grid-cols-1 md:grid-cols-2 gap-8 ">
            <div>
                <div class="relative">


                    <div class="overflow-hidden rounded aspect-w-3 aspect-h-2 ">

                        @if ($product->getMedia('product-thumbnails')->last())
                            {{ $product->getMedia('product-thumbnails')->last()->img()->attributes(['id' => 'productMainImage']) }}
                        @else
                            {!! $product->getFallbackImage() !!}
                        @endif


                    </div>
                    <div class="absolute right-0 top-0 ">
                        <button data-src="{{ $product->getMedia('product-thumbnails')->last()?->getFullUrl() }}"
                            data-animation="fade" id="fullScreenButton"
                            class="spotlight flex justify-center align-center hover:bg-gray-500 hover:bg-opacity-30 rounded-lg"><svg
                                fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                class="h-7 w-7 m-2 text-primary-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15">
                                </path>
                            </svg></button>
                    </div>
                </div>
                <div class="flex overflow-auto gap-1 py-2" id="product-images">

                    {{ $product->getMedia('product-thumbnails')->last()?->img()->attributes(['class' => ' sec h-20 w-20 object-cover object-center cursor-pointer flex-none border border-gray-300 dark:border-gray-700  overflow-hidden rounded-lg']) }}
                    <div class="sr-only spotlight"
                        data-src="{{ $product->getMedia('product-thumbnails')->last()?->getFullUrl() }}"></div>
                    @foreach ($product->getMedia('product-images') as $image)
                        <div class="sr-only spotlight" data-src="{{ $image->getFullUrl() }}"
                            data-title="{{ $image->name }}"></div>
                        {{ $image->img()->attributes(['class' => ' sec h-20 w-20 object-cover object-center cursor-pointer flex-none border border-gray-300 dark:border-gray-700  overflow-hidden rounded-lg']) }}
                    @endforeach



                </div>




            </div>
            <div class="">

                <div class=" ">

                    @foreach ($product->categories as $category)
                        <a href="{{ route('shop.index', ['category' => $category->id]) }}"
                            class="text-sm bg-primary-500 dark:bg-opacity-40 rounded px-1 py-0.5 text-white">{{ $category->title }}</a>
                    @endforeach
                </div>
                <h1 class="text-3xl mt-2 font-bold line-clamp-2">{{ $product->title }}</h1>

                <div class="rating text-yellow-300 my-2 ">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= ceil($product->reviews_avg_rating))
                            <x-svg.star-solid class="w-4 h-4 inline" />
                        @else
                            <x-svg.star-outlined class="w-4 h-4 inline" />
                        @endif
                    @endfor
                    <span
                        class="bg-blue-100 text-blue-800 text-xs  px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">{{ round($product->reviews_avg_rating, 2) }}</span>

                    <a href="#"
                        class="ml-3 text-sm font-medium text-primary-600 hover:text-primary-500">{{ $product->reviews_count }}
                        {{ __('Reviews') }}</a>
                </div>


                <h3 class=" font-bold text-2xl mt-3">৳{{ $product->selling_price }}
                    <span class="ml-1 font-normal line-through text-gray-500">৳{{ $product->original_price }}</span>
                </h3>

                <p class="my-5 text-gray-500">{{ $product->short_description }}</p>

                <div class="space-y-3 mt-5">
                    <hr class="dark:border-gray-500">
                    <form class="inline" action="{{ route('shop.cart.create', $product) }}" method="post">
                        @csrf
                        <x-button.primary class="hover:scale-105 focus:translate-y-2 flex items-center gap-2">
                            <x-svg.cart class="w-5 h-5 " />{{ __('Add to cart') }}
                        </x-button.primary>
                    </form>
                    <x-button.primary class="relative flex items-center gap-2"
                        data-tooltip-target="tooltip-feature-unavailable">
                        <span class=" absolute  -top-1 -right-1 flex h-3 w-3">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-pink-500"></span>
                        </span>
                        <x-svg.bolt class="w-5 h-5 " /></i>{{ __('Buy now') }}
                    </x-button.primary>
                    <div id="tooltip-feature-unavailable" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium  transition-opacity duration-300  rounded-lg shadow-sm opacity-0 tooltip bg-black dark:bg-gray-300 text-gray-100 dark:text-gray-900">
                        {{ __('This feature is not implemented yet') }}
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    <hr class="dark:border-gray-500">
                </div>


            </div>
        </div>

    </section>

    <section class="container mx-auto px-2">

        <div class="mt-5 border-t border-b dark:border-gray-700 py-2">
            <div class="grid grid-cols-2 gap-1 md:block md:space-y-1">

                <a type="button" href="#description"
                    class="rounded border dark:border-gray-700 hover:bg-orange-400 dark:hover:bg-orange-500 hover:text-white dark:hover:text-white  px-4 py-1.5 bg-white dark:bg-gray-800 inline-block shadow transition-all font-medium text-sm text-gray-700 dark:text-gray-200">
                    {{ __('Description') }}
                </a>
                <a type="button" href="#reviews"
                    class="rounded border dark:border-gray-700 hover:bg-orange-400 dark:hover:bg-orange-500 hover:text-white dark:hover:text-white  px-4 py-1.5 bg-white dark:bg-gray-800 inline-block shadow transition-all font-medium text-sm text-gray-700 dark:text-gray-200">
                    {{ __('Reviews') }}
                </a>




            </div>

        </div>

        <div class="my-6 space-y-8 ">
            <div id="description">
                <h4 class="text-base font-bold">{{ __('Description') }}</h4>
                <div class="format   dark:format-invert max-w-none format-a:text-blue-600 ">

                    {!! $product->long_description !!}
                </div>
            </div>
            <div id="reviews">
                <livewire:shop.product-reviews :product="$product" />
            </div>


        </div>

    </section>


    @push('scripts')
        <script>
            array = $('#product-images > .sec');

            for (let index = 0; index < array.length; index++) {
                const element = array[index];


                if (element.src == $('#productMainImage')[0].src) {
                    $(element).addClass('opacity-50')
                }
            }




            $(".sec").click(function() {
                $(".sec").removeClass('opacity-50')
                $(this).addClass('opacity-50')
                $("#productMainImage").attr('src', $(this).attr('src'))
                $("#productMainImage").attr('srcset', $(this).attr('srcset'))
                $("#fullScreenButton").attr('data-src', $(this).attr('src'))


            })
        </script>
    @endpush
</x-app-layout>
