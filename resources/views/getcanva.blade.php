<x-app-layout>
    <div class="container mx-auto mt-10 font-surjo ">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 ">

            <div class="flex justify-center md:justify-end text-6xl ">
                <img src="{{ asset('images/image1.webp') }}" class="max-w-sm w-9/12 " alt="">
            </div>

            <div class="flex justify-center md:justify-start md:order-first items-center ">

                <div class="flex-col items-center text-center md:text-start pt-5 pb-10 px-2">




                    <h2 class="text-6xl mt-10 font-bold dark:text-white">{{ __('ক্যানভা প্রো কিনুন ') }}
                    </h2>
                    <p class=" text-lg ml-1 text-gray-900 dark:text-white">
                        {{ __('মাত্র') }}
                        ৳{{ $product->selling_price }}
                        <span class="ml-1 font-normal line-through text-gray-500">৳{{ $product->original_price }}</span>
                        {{ __('টাকা') }}
                    </p>
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


                    <button
                        class="mt-2 border shadow-lg dark:shadow-gray-600  border-primary-500 rounded px-10 py-2 hover:bg-primary-400 hover:text-white inline-flex gap-2">
                        <x-svg.cart class="w-5 h-5" />{{ __('কিনুন') }}</button>





                </div>



            </div>


        </div>
    </div>

    <section class="container mx-auto px-2 my-44">

        <div id="reviews">
            <livewire:shop.product-reviews :product="$product" />
        </div>

    </section>


</x-app-layout>
