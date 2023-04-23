<x-admin-layout>


    <div class="space-y-5 container mx-auto px-4 py-4">

        <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-4 gap-3">
            <x-card class="space-y-3 sm:col-span-3 md:col-span-3 py-4">
                <h3 class="font-bold">Order info:</h3>

                <form action="{{ route('admin.orders.update', $order) }}" method="post" class="space-y-3">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <x-input.label :value="__('Customer Name')" required="true" />
                            <x-input.text name="name" :value="old('name', $order->name)" type="text" class="mt-1 block w-full" />
                            <x-input.error :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input.label :value="__('Customer email')" required="true" />
                            <x-input.text name="email" :value="old('email', $order->email)" type="text" class="mt-1 block w-full" />
                            <x-input.error :messages="$errors->get('email')" />
                        </div>


                    </div>
                    <div>
                        <x-input.label :value="__('Order note')" required="true" />
                        <x-input.textarea disabled class="text-gray-500">{{ $order->order_note }}</x-input.textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <x-input.label :value="__('Customer Number')" />
                            <x-input.text name="phone" :value="old('phone', $order->phone)" class="mt-1 block w-full " />
                            <x-input.error :messages="$errors->get('phone')" />
                        </div>

                        <div>
                            <x-input.label :value="__('Customer email')" required="true" />
                            <x-input.text name="order_total" :value="$order->order_total" type="text"
                                class="mt-1 block w-full text-gray-500" disabled />
                            <x-input.error :messages="$errors->get('order_total')" />
                        </div>


                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <x-input.label :value="__('Order Status')" />
                            <x-input.select name="order_status" class="mt-1 block w-full">
                                <option value="" disabled>Select an option</option>
                                @foreach (\App\Enums\OrderStatus::toArray() as $order_status)
                                    <option
                                        {{ old('order_status') == $order_status || $order->order_status == $order_status ? ' selected ' : '' }}>
                                        {{ $order_status }}
                                    </option>
                                @endforeach
                            </x-input.select>
                            <x-input.error :messages="$errors->get('order_status')" />
                        </div>

                        <div>
                            <x-input.label :value="__('payment status')" required="true" />
                            <x-input.select name="payment_status" class="mt-1 block w-full">
                                <option value="" disabled>Select an option</option>
                                @foreach (\App\Enums\PaymentStatus::toArray() as $payment_status)
                                    <option {{ $order->payment_status == $payment_status ? ' selected ' : '' }}>
                                        {{ $payment_status }}
                                    </option>
                                @endforeach
                            </x-input.select>
                            <x-input.error :messages="$errors->get('payment_status')" />
                        </div>


                    </div>
                    <x-button.primary>Update</x-button.primary>
                </form>
            </x-card>
            <x-card class="sm:col-span-2 md:col-span-1 space-y-3 py-4">
                <h2 class="font-bold">{{ __('Activity history') }}</h2>
                <div class="grid gap-3">

                    @foreach ($order->activities as $activity)
                        <div class="border border-primary-500 rounded p-2">
                            <p> {!! __($activity->content) !!}</p>
                            <p class="text-sm text-gray-500">{{ $activity->created_at->diffForHumans() }} </p>
                            <p class="text-sm"> by <span class="text-gray-500">{{ $activity->action_by }}</span></p>
                        </div>
                    @endforeach

                </div>
            </x-card>
        </div>


        <div>
            <h2 class="text-lg font-bold">Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-3 gap-y-5">
                @foreach ($order->products as $product)
                    <x-card class="px-0 py-0 rounded transition-none overflow-hidden ">

                        <a href="{{ route('admin.products.edit', $product) }}">
                            <div class="aspect-w-16 aspect-h-9 ">
                                <img src="{{ $product->featured_image }}" alt="" class=" object-cover">
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
                @endforeach
            </div>
        </div>

        <div>
            <h2 class="text-lg font-bold">Download Links:</h2>
        </div>

    </div>
</x-admin-layout>
