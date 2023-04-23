<x-my-account.layout title="Dashboard">
    <div class="space-y-3">

        <h3>Hello <span class="font-bold text-orange-500">{{ auth()->user()->name }}</span></h3>
        <p>From your account dashboard you can view your recent orders, manage your shipping and billing
            addresses, and edit your password and account details.</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">

            <x-my-account.dashbord-item :href="route('my-account.orders')" :imageLink="asset('images/flaticon/orders.png')">
                Orders
            </x-my-account.dashbord-item>
            <x-my-account.dashbord-item :href="route('my-account.downloads')" :imageLink="asset('images/flaticon/download.png')">
                Downloads
            </x-my-account.dashbord-item>
            <x-my-account.dashbord-item :href="route('my-account.profile.edit')" :imageLink="asset('images/flaticon/profile.png')">
                Profile
            </x-my-account.dashbord-item>

        </div>
    </div>
</x-my-account.layout>
