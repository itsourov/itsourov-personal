<div>
    <div class="space-y-5 container mx-auto px-4 py-4">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Order
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Order status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Payment status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product count
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                # {{ $order->id }}
                            </th>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $order->created_at->format('D M, y') }}
                            </td>
                            <td class="px-6 py-4">
                                ৳ {{ $order->order_total }}

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="p-1 rounded {{ \App\Enums\OrderStatus::getClass()[$order->order_status] }}">{{ $order->order_status }}</span>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="p-1 rounded {{ \App\Enums\PaymentStatus::getClass()[$order->payment_status] }}">{{ $order->payment_status }}</span>

                            </td>
                            <td class="px-6 py-4">
                                {{ $order->products_count }} item
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View / Edit</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div>
            {{ $orders->links('pagination.tailwind-livewire') }}
        </div>
    </div>
</div>
