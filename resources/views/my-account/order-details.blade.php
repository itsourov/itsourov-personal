<x-my-account.layout title="Dashboard">
    <x-card class="px-4 py-4 sm:px-8 sm:py-8 space-y-8">
        <div class=" grid grid-cols-2">
            <h2 class="text-xl font-bold mb-4">Order #{{ $order->id }}</h2>
            <div class="text-end space-y-1">
                <img class="w-24 ml-auto" src="{{ asset('images/logo.png') }}" alt="">
                <h2 class=" font-bold">{{ config('app.name') }}</h2>
                <p class=" text-sm">{{ config('seo.site_name') }}</p>
            </div>
        </div>

        <div>
            <h3 class=" text-lg font-medium">Bill to</h3>
            <div class="text-gray-500 text-sm">

                <p>{{ $order->name }}</p>
                <p>{{ $order->email }}</p>
                <p>{{ $order->phone }}</p>
            </div>
        </div>
        <div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Product name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Qty
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->products as $product)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 max-w-xs :max-w-sm font-medium text-gray-900 whitespace-nowrap dark:text-white truncate">
                                    {{ $product->title }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $product->selling_price }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->pivot->quantity }}
                                </td>
                                <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $product->selling_price * $product->pivot->quantity }}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>
        <div class="space-y-2 md:max-w-sm ml-auto">
            <div class="flex justify-between">
                <h3 class="text-gray-500">Sub total</h3>
                <p>{{ $order->order_total }}</p>
            </div>
            <div class="flex justify-between">
                <h3 class="text-gray-500">Tax</h3>
                <p>৳0</p>
            </div>
            <div class="flex justify-between">
                <h3 class="text-gray-500">Discount</h3>
                <p>৳0</p>
            </div>
            <div class="flex justify-between">
                <h3 class="">Total</h3>
                <p>{{ $order->order_total }}</p>
            </div>
        </div>
        <div class="space-y-2">
            <h3>Order Status: <span class="bg-gray-200 dark:bg-gray-700 rounded px-2">{{ $order->order_status }}</span>
            </h3>
            <h3>Payment Status: <span
                    class="bg-gray-200 dark:bg-gray-700 rounded px-2">{{ $order->payment_status }}</span></h3>
            <h3>Payment Method: <span
                    class="bg-gray-200 dark:bg-gray-700 rounded px-2">{{ $order->payment_method }}</span></h3>
        </div>


    </x-card>
    @if (!$order->isPaid)
        <div class="space-y-2 mt-4">
            @if (auth()->user()->bkashAgreement?->agreementID)
                <div class="flex gap-4">
                    <a class=" flex-grow" href="{{ route('bkash-tokenized.agreement.payment.create.order', $order) }}">
                        <x-button.primary class="w-full text-sm">Instant Pay With Bkash
                            ({{ auth()->user()->bkashAgreement->customerMsisdn }})</x-button.primary>
                    </a>
                    <form action="{{ route('bkash-tokenized.agreement.delete') }}" method="post">
                        @method('DELETE')
                        @csrf

                        <x-button.secondary class="w-full text-sm" type="submit">
                            <p class="sr-only">Removr Bkash Account</p>
                            <x-svg.trash class="w-5 h-5" />
                        </x-button.secondary>
                    </form>
                </div>
            @else
                <div>
                    <a
                        href="{{ route('bkash-tokenized.agreement.create', ['redirect_to' => route('bkash-tokenized.agreement.payment.create.order', $order)]) }}">
                        <x-button.primary class="w-full text-sm">
                            <x-svg.bkash class="w-8 h-8" />Save Bkash and pay
                        </x-button.primary>
                    </a>
                </div>
            @endif
            <div>
                <a href="{{ route('bkash-tokenized.payment.create.order', $order) }}">
                    <x-button.secondary class="w-full text-sm">Pay With Bkash</x-button.secondary>
                </a>
            </div>
        </div>
    @endif


</x-my-account.layout>
