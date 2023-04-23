<x-app-layout>
    {{ Breadcrumbs::render('my-account', $title) }}


    <section class="container mx-auto px-2 mt-10 mb-20">
        <h2 class="sr-only">{{ $title }}</h2>
        <div
            class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3 md:divide-x divide-gray-200 dark:divide-gray-700">
            <div class="">
                <h2 class=" font-bold text-lg">MY ACCOUNT</h2>
                <hr class="my-2 border-gray-200 dark:border-gray-700">
                <div class="items grid gap-2">

                    <x-my-account.sidebar-item href="{{ route('my-account.index') }}">
                        Dashboard
                    </x-my-account.sidebar-item>
                    <x-my-account.sidebar-item href="{{ route('my-account.orders') }}">
                        Orders
                    </x-my-account.sidebar-item>
                    <x-my-account.sidebar-item href="{{ route('my-account.downloads') }}">
                        Downloads
                    </x-my-account.sidebar-item>
                    <x-my-account.sidebar-item href="{{ route('my-account.profile.edit') }}">
                        Profile
                    </x-my-account.sidebar-item>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-my-account.sidebar-item :href="route('logout')"
                            onclick="event.preventDefault();
                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-my-account.sidebar-item>
                    </form>
                </div>
            </div>
            <div class=" md:col-span-2 lg:col-span-3 md:pl-3">
                {{ $slot }}
            </div>

        </div>
    </section>


</x-app-layout>
