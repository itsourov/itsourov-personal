<x-admin-layout>

    <div class="space-y-5 container mx-auto px-4 py-4">
        <h2 class="text-lg font-bold">Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-3 gap-y-5">
            @foreach ($products as $product)
                <x-admin.shop.product-item :product="$product" />
            @endforeach
        </div>
        <div class="mt-2">
            {{ $products->links('pagination.tailwind') }}
        </div>
    </div>
</x-admin-layout>
