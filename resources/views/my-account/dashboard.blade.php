<x-my-account.layout title="Dashboard">
    <div class="space-y-3">

        <h3>Hello <span class="font-bold text-orange-500">{{ auth()->user()->name }}</span></h3>
        <p>From your account dashboard you can view your recent orders, manage your shipping and billing
            addresses, and edit your password and account details.</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">

            <x-my-account.dashbord-item :href="route('my-account.orders')" title="{{ __('Orders') }}">

                <x-svg.clipboard-document class="w-12 h-12" stroke-width="0.5" />
            </x-my-account.dashbord-item>
            <x-my-account.dashbord-item :href="route('my-account.downloads')" title="{{ __('Downloads') }}">

                <x-svg.arrow-down-tray class="w-12 h-12" stroke-width="0.5" />
            </x-my-account.dashbord-item>
            <x-my-account.dashbord-item :href="route('my-account.profile.edit')" title="{{ __('Profile') }}">

                <x-svg.user-circle class="w-12 h-12" stroke-width="0.5" />

            </x-my-account.dashbord-item>


        </div>
    </div>
</x-my-account.layout>
