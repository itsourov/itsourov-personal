<x-app-layout>
    {{ Breadcrumbs::render('shop.cart') }}


    <section class="container mx-auto px-2 my-10">
        <h2 class="sr-only">Cart</h2>
        @if ($productCount > 0)

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                <div class="lg:col-span-2 divide-y ">

                    @foreach ($products as $product)
                        <div class="grid grid-cols-4 gap-3 py-4">
                            <div class=" self-center">
                                <div class="aspect-w-16 aspect-h-9 rounded overflow-hidden">
                                    @if ($product->getMedia('product-thumbnails')->last())
                                        {{ $product->getMedia('product-thumbnails')->last() }}
                                    @else
                                        {!! $product->getFallbackImage() !!}
                                    @endif

                                </div>
                            </div>
                            <div class=" col-span-3 flex justify-between">
                                <div class="">

                                    <h3
                                        class="line-clamp-1 font-medium text-base
                                lg:text-xl mt-0">
                                        {{ $product->title }}
                                    </h3>
                                    <p>Price: <span class="font-bold">৳{{ $product->selling_price }}</span></p>
                                    <p class="text-gray-500">Qty: 1</p>

                                </div>
                                <form action="{{ route('shop.cart.destroy', $product) }}" method="post">
                                    @method('DELETE')
                                    @csrf

                                    <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                                        <x-svg.trash class="w-5 h-5 " />
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach


                </div>
                <div>
                    <x-card class="bg-gray-100 ">

                        <div class="p-3 space-y-4 text-sm">
                            <h2 class="text-lg font-medium">Order summary</h2>
                            <div class="flex justify-between">
                                <p class="">{{ __('Subtotal') }}</p>
                                <p class="">৳{{ $order_total }}</p>
                            </div>

                            <hr class="border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between">
                                <p class="">Shipping estimate</p>
                                <p class="">৳0</p>
                            </div>
                            <hr class="border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between">
                                <p class="">Tax estimate</p>
                                <p class="">৳0</p>
                            </div>
                            <hr class="border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between font-medium text-base">
                                <p class="">Order total</p>
                                <p class="">৳{{ $order_total }}</p>
                            </div>

                        </div>
                        <div class="p-3">
                            <a href="{{ route('shop.checkout') }}">
                                <x-button.primary class="w-full py-4">Proceed to Checkout</x-button.primary>
                            </a>
                        </div>
                    </x-card>
                </div>
            </div>
        @else
            <div class="text-center space-y-3">

                <img src="{{ asset('images/flaticon/cart-empty.png') }}" class="w-44 h-44 max-w-full mx-auto"
                    alt="">
                <h2 class="font-bold text-2xl lg:text-4xl">{{ __('Your cart is currently empty.') }}</h2>
                <p class="max-w-lg mx-auto">
                    {{ __('Before proceed to checkout you must add some products to your shopping cart. You will find a lot of interesting products on our "Shop" page.') }}
                </p>
                <a class=" inline-block" href="{{ route('shop.index') }}">
                    <x-button.primary class="  focus:transform focus:-translate-x-4">{{ __('Return to Shop') }}
                    </x-button.primary>
                </a>
            </div>
        @endif
    </section>


</x-app-layout>
