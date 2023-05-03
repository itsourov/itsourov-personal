<x-my-account.layout title="ORDERS">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2 gap-3">
        @foreach ($orders as $order)
            <x-card class="space-y-3">
                <div class="flex justify-between">
                    <h3 class="text-sm font-medium text-gray-500">ORDER</h3>
                    <p>#{{ $order->id }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-medium text-gray-500">DATE</h3>
                    <p>{{ $order->created_at->format('M d, Y') }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-medium text-gray-500">STATUS</h3>
                    <p>{{ $order->order_status }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-medium text-gray-500">TOTAL</h3>
                    <p>{{ $order->order_total }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-medium text-gray-500">ITEM COUNT</h3>
                    <p>{{ $order->products_count }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-medium text-gray-500">ACTIONS</h3>
                    <a href="{{ route('my-account.orders.show', $order) }}">
                        <x-button.primary style="padding: 1px 3px">View</x-button.primary>
                    </a>
                </div>
            </x-card>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $orders->links('pagination.tailwind') }}
    </div>
</x-my-account.layout>
