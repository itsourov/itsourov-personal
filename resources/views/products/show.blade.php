<x-app-layout>
    {{ Breadcrumbs::render('shop.product', $product) }}

    @section('seo')
        {!! seo()->for($product) !!}
    @endsection

    <section class=" container mx-auto px-2 mt-10">
        <div class="  grid grid-cols-1 md:grid-cols-2 gap-10 ">
            <div>
                <div class="relative">


                    <div class="overflow-hidden rounded aspect-w-3 aspect-h-2 ">

                        <img id="productMainImage" src="{{ $product->featured_image }}"
                            class="h-full w-full object-cover object-center ">


                    </div>
                    <div class="absolute right-0 top-0 ">
                        <button onclick="showGallery()"
                            class="flex justify-center align-center hover:bg-gray-300 rounded-lg"><svg fill="none"
                                stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                class="h-7 w-7 m-2 text-primary-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15">
                                </path>
                            </svg></button>
                    </div>
                </div>
                <div class="flex overflow-auto gap-1 py-2" id="product-images">

                    @foreach (array_merge([$product->featured_image], $product->images) as $image)
                        <img src="{{ $image }}"
                            class="sec h-20 w-20 object-cover object-center cursor-pointer flex-none opacity-50 border border-gray-300 dark:border-gray-700   overflow-hidden rounded-lg">
                    @endforeach



                </div>




            </div>
            <div class="">

                <div class=" divide-x">

                    @foreach ($product->categories as $category)
                        <a href="#" class="text-md p-1">{{ $category->title }}</a>
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
                        class="ml-3 text-sm font-medium text-primary-600 hover:text-primary-500">{{ $reviews->total() }}
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

                {{-- <div class="flex items-center mt-10 gap-2">
                    <p>Share: </p>
                    <!-- Facebook -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-5 h-5"
                        style="color: #1877f2;">
                        <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path fill="currentColor"
                            d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
                    </svg>

                    <!-- Messenger -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5"
                        style="color: #0084ff;">
                        <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path fill="currentColor"
                            d="M256.55 8C116.52 8 8 110.34 8 248.57c0 72.3 29.71 134.78 78.07 177.94 8.35 7.51 6.63 11.86 8.05 58.23A19.92 19.92 0 0 0 122 502.31c52.91-23.3 53.59-25.14 62.56-22.7C337.85 521.8 504 423.7 504 248.57 504 110.34 396.59 8 256.55 8zm149.24 185.13l-73 115.57a37.37 37.37 0 0 1-53.91 9.93l-58.08-43.47a15 15 0 0 0-18 0l-78.37 59.44c-10.46 7.93-24.16-4.6-17.11-15.67l73-115.57a37.36 37.36 0 0 1 53.91-9.93l58.06 43.46a15 15 0 0 0 18 0l78.41-59.38c10.44-7.98 24.14 4.54 17.09 15.62z" />
                    </svg>
                    <!-- Twitter -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5"
                        style="color: #1da1f2;">
                        <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path fill="currentColor"
                            d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" />
                    </svg>

                    <!-- Whatsapp -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-5 h-5"
                        style="color: #128c7e;">
                        <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path fill="currentColor"
                            d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                    </svg>

                </div> --}}
            </div>
        </div>

    </section>

    <section class="container mx-auto px-2">

        <div class="mt-5 border-t border-b dark:border-gray-700 py-2">
            <div class="grid grid-cols-2 gap-1 md:block md:space-y-1">
                <button class="rounded bg-gray-100 dark:bg-gray-700 px-4 py-1.5 transition-all duration-200 tab-btn "
                    data-target="description-container">{{ __('Description') }}</button>
                <button class="rounded bg-gray-100 dark:bg-gray-700 px-4 py-1.5 ransition-all duration-200 tab-btn"
                    data-target="reviews-container">{{ __('Reviews') }}</button>
                {{-- <button class="rounded bg-gray-100 dark:bg-gray-700 px-4 py-1.5 ransition-all duration-200 tab-btn"
                    data-target="questions-container">Questions</button>
                <button class="rounded bg-gray-100 dark:bg-gray-700 px-4 py-1.5 ransition-all duration-200 tab-btn"
                    data-target="links-container">Links</button> --}}

            </div>

        </div>

        <div class="my-6 space-y-4 ">
            <div id="description-container" class="tab-content">
                <h4 class="text-base font-bold">{{ __('Description') }}</h4>
                <div class="format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">

                    {!! $product->long_description !!}
                </div>
            </div>
            <div id="reviews-container" class="tab-content">
                <h4 class="text-base font-bold">{{ __('Reviews') }}</h4>
                <div class="grid gap-3 mt-3">
                    @foreach ($reviews as $review)
                        <x-card>
                            <div class="user-info flex items-start gap-3">
                                <img class="rounded-full w-10 h-10"
                                    src="https://picsum.photos/100/100/?{{ $review->id }}" alt="">
                                <div>
                                    <p class="text-sm">{{ $review->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $review->created_at->format('d M, Y') }}</p>
                                    <div class="rating text-yellow-300 ">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= ceil($product->reviews_avg_rating))
                                                <x-svg.star-solid class="w-4 h-4 inline" />
                                            @else
                                                <x-svg.star-outlined class="w-4 h-4 inline" />
                                            @endif
                                        @endfor
                                        <span class="text-gray-500 text-sm">({{ $review->rating }})</span>
                                    </div>
                                    <p class="mt-1">{{ $review->comment }}</p>
                                </div>
                            </div>

                        </x-card>
                    @endforeach
                </div>
                <div class="my-2">
                    {{ $reviews->links('pagination.tailwind') }}
                </div>
            </div>


            {{-- <div id="questions-container" class="tab-content">
                <h4 class="text-base font-bold">reviews</h4>
            </div>
            <div id="links-container" class="tab-content">
                <h4 class="text-base font-bold">reviews</h4>
            </div> --}}
        </div>

    </section>


    @push('scripts')
        <script>
            array = $('#product-images > .sec');
            var gallery = [];
            for (let index = 0; index < array.length; index++) {
                const element = array[index];
                var obj = {
                    src: element.src
                }
                gallery.push(obj)

                if (element.src == $('#productMainImage')[0].src) {
                    $(element).removeClass('opacity-50')
                }
            }

            function showGallery() {
                Spotlight.show(gallery);
            }



            $(".sec").click(function() {
                $(".sec").addClass('opacity-50')
                $(this).removeClass('opacity-50')
                $("#productMainImage").attr('src', $(this).attr('src'))
                first = {
                    src: $(this).attr('src')
                }
                gallery.shift(first)
                gallery.unshift(first)
            })
        </script>
    @endpush
</x-app-layout>
