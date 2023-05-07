<div class=" flow-root " x-data="{ cartPreview: false }">
    <button x-on:click="cartPreview = !cartPreview" class="group -m-2 p-2 flex items-center">
        <!-- Heroicon name: outline/shopping-bag -->
        <svg class="flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
        </svg>
        <span class="ml-1 text-sm font-medium text-gray-500">{{ App\Http\Helpers\Cart::getCartItemsCount() }}</span>
        <span class="sr-only">items in cart, view bag</span>
    </button>
    <div x-show="cartPreview" x-cloak class="fixed inset-0 overflow-hidden z-30" aria-labelledby="slide-over-title"
        role="dialog" aria-modal="true">
        <div class="absolute inset-0 overflow-hidden">

            <div x-on:click="cartPreview = !cartPreview" x-show="cartPreview"
                x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">

                <div x-show="cartPreview" x-transition:enter="transform transition ease-in-out duration-500 "
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-500 "
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                    class="w-screen max-w-md">
                    <div class="h-full flex flex-col bg-white dark:bg-gray-900 shadow-xl overflow-y-scroll">
                        <div class="flex-1 py-6 overflow-y-auto px-4 sm:px-6">
                            <div class="flex items-start justify-between">
                                <h2 class="text-lg font-medium " id="slide-over-title">{{ __('Shopping cart') }}</h2>
                                <div class="ml-3 h-7 flex items-center">
                                    <button x-on:click="cartPreview = !cartPreview" type="button"
                                        class="-m-2 p-2 text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">Close panel</span>
                                        <!-- Heroicon name: outline/x -->
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="mt-8">
                                <div class="flow-root">
                                    <ul role="list" class="-my-6 divide-y divide-gray-200 dark:divide-gray-700">


                                        @foreach ($cartItems as $cartItem)
                                            <li class="py-6 flex">
                                                <div
                                                    class="flex-shrink-0 w-24 border border-gray-200 rounded-md overflow-hidden ">
                                                    {!! $cartItem->getMedia('product-thumbnails')->last()
                                                        ?->img() ?? $cartItem->getFallbackImage() !!}
                                                </div>

                                                <div class="ml-4 flex-1 flex flex-col">
                                                    <div>
                                                        <div class="flex justify-between text-base font-medium ">
                                                            <h3 class=" line-clamp-1">
                                                                <a href="#"> {{ $cartItem->title }}</a>
                                                            </h3>
                                                            <p class="ml-4">৳{{ $cartItem->selling_price }}</p>
                                                        </div>
                                                        <p class="mt-1 text-sm text-gray-500">Salmon</p>
                                                    </div>
                                                    <div class="flex-1 flex items-end justify-between text-sm">
                                                        <p class="text-gray-500">Qty 1</p>

                                                        <div class="flex">
                                                            <button wire:click="removeItemFromCart({{ $cartItem->id }})"
                                                                class="font-medium text-indigo-600 hover:text-indigo-500">
                                                                <span wire:loading.remove
                                                                    wire:target="removeItemFromCart({{ $cartItem->id }})">
                                                                    {{ __('Remove') }}
                                                                </span>
                                                                <span wire:loading
                                                                    wire:target="removeItemFromCart({{ $cartItem->id }})">
                                                                    {{ __('Removing') }}
                                                                </span>
                                                            </button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 dark:border-gray-600 py-3 px-4 sm:px-6">
                            <div class="flex justify-between text-base font-medium ">
                                <p>{{ __('Subtotal') }}</p>
                                <p>৳{{ $price }}</p>
                            </div>
                            <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                            <div class="mt-3 grid gap-2">

                                <a href="{{ route('shop.cart.index') }}">
                                    <x-button.secondary class="w-full py-3 group ">View Cart</x-button.secondary>
                                </a>
                                <a href="{{ route('shop.checkout') }}">
                                    <x-button.primary class="w-full py-3 group ">Checkout</x-button.primary>
                                </a>
                            </div>
                            <div class="mt-3 flex justify-center text-sm text-center text-gray-500">
                                <p>
                                    or <button type="button" x-on:click="cartPreview = !cartPreview"
                                        class="text-indigo-600 font-medium hover:text-indigo-500">Continue Shopping<span
                                            aria-hidden="true"> &rarr;</span></button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
