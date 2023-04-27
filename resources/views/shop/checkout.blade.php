<x-app-layout>
    {{ Breadcrumbs::render('shop.checkout') }}

    <section class="container mx-auto px-2 my-10">
        <h2 class="sr-only">Checkout</h2>
        <form action="{{ route('shop.order.create.cart') }}" method="post">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 ">
                <div class="space-y-4">
                    <h2 class="text-lg font-medium ml-1">Contact information</h2>


                    <div>
                        <x-input.label :value="__('Name')" required="true" />
                        <x-input.text name="name" type="text" class="mt-1 block w-full dark:bg-gray-800"
                            :value="old('name', $user->name)" required autocomplete="name" />
                        <x-input.error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div>
                        <x-input.label :value="__('Email')" required="true" />
                        <x-input.text name="email" type="email" class="mt-1 block w-full dark:bg-gray-800"
                            :value="old('email', $user->email)" required autocomplete="email" />
                        <x-input.error class="mt-2" :messages="$errors->get('email')" />
                    </div>
                    <div>
                        <x-input.label :value="__('Prone')" required="true" />
                        <x-input.text name="phone" type="phone" class="mt-1 block w-full dark:bg-gray-800"
                            :value="old('phone', $user->phone)" autocomplete="phone" />
                        <x-input.error class="mt-2" :messages="$errors->get('phone')" />
                    </div>
                    <div>
                        <x-input.label :value="__('Order note')" />
                        <x-input.textarea name="order_note" type="text" class="mt-1 block w-full dark:bg-gray-800"
                            rows="5">{{ old('order_note') }}</x-input.textarea>

                        <x-input.error class="mt-2" :messages="$errors->get('order_note')" />
                    </div>
                </div>
                <div class="space-y-4">
                    <h2 class="text-lg font-medium ml-1">Order summary</h2>
                    <x-card class="p-0 transition-none">

                        <div class="products p-4 -my-4 divide-y divide-gray-200 dark:divide-gray-700">

                            @foreach ($products as $product)
                                <div class="flex gap-2 py-4">
                                    <img class=" w-20 h-18 object-cover rounded"
                                        src="{{ $product->media->last()?->preview_url ?? $product->getFallbackImageUrl() }}"
                                        alt="">

                                    <div class="flex-grow">
                                        <h3 class="line-clamp-1 font-medium ">{{ $product->title }}</h3>
                                        <p class="line-clamp-1 text-sm ">Price: ৳{{ $product->selling_price }}</p>
                                        <p class="line-clamp-1 text-sm text-gray-500">Qty:
                                            {{ $product->pivot->quantity }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr class="border-gray-200 dark:border-gray-700">
                        <div class="p-4 space-y-4 font-medium">
                            <div class="flex justify-between">
                                <p class=" ">{{ __('Subtotal') }}</p>
                                <p class="">৳{{ $order_total }}</p>
                            </div>
                            <div class="flex justify-between">
                                <p class=" ">Shipping</p>
                                <p class="">৳0</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="">Taxes</p>
                                <p class="">৳0</p>
                            </div>
                            <hr class="border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between font-bold">
                                <p class="">Total</p>
                                <p class="">৳{{ $order_total }}</p>
                            </div>
                        </div>
                        <hr class="border-gray-200 dark:border-gray-700">
                        <div class="p-4 space-y-4">
                            <x-button.primary class="w-full py-4 group  flex items-center gap-2 ">
                                <x-svg.cart class="w-5 h-5 group-hover:animate-bounce transition-all" />
                                {{ __('Place Order') }}
                            </x-button.primary>
                        </div>
                    </x-card>
                </div>
            </div>
        </form>
    </section>


</x-app-layout>
