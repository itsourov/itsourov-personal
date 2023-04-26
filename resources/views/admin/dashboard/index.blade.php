<x-admin-layout>

    <div class="space-y-5 container mx-auto px-4 py-4">
        <h3 class="font-bold">Dashboard</h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            <x-card class=" text-center text-lg">
                <p>{{ $user_count }}</p>
                <p class="font-bold">Total User</p>
            </x-card>
            <x-card class=" text-center text-lg">
                <p>{{ $product_count }}</p>
                <p class="font-bold">Total Product</p>
            </x-card>
        </div>
    </div>
</x-admin-layout>
