<aside id="sidebar"
    class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 {{ 'hidden' }} w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width"
    aria-label="Sidebar">
    <div
        class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                <ul class="pb-2 space-y-2">
                    <li>
                        <form action="#" method="GET" class="lg:hidden">
                            <label for="mobile-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" name="email" id="mobile-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-200 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Search">
                            </div>
                        </form>
                    </li>



                    <x-admin.sidebar-menu-item :active="request()->routeIs('admin.posts*')" :dropdown="true">

                        <x-slot name="icon">
                            <svg class="w-5 h-5" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" fill="none"
                                stroke="currentColor" stroke-width="1.5">
                                <rect x="8" y="8" width="12" height="12" />
                                <rect x="26" y="8" width="12" height="12" />
                                <rect x="26" y="44" width="12" height="12" />
                                <rect x="44" y="8" width="12" height="12" />
                                <rect x="8" y="26" width="12" height="12" />
                                <rect x="26" y="26" width="12" height="12" />
                                <rect x="44" y="26" width="12" height="12" />
                                <rect x="8" y="44" width="12" height="12" />
                                <rect x="44" y="44" width="12" height="12" />
                            </svg>
                        </x-slot>
                        <x-slot name="title">
                            {{ __('Posts') }}
                        </x-slot>

                        <x-slot name="submenu">
                            <x-admin.sidebar-sub-menu-item :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.index')">
                                View all Posts
                            </x-admin.sidebar-sub-menu-item>
                            <x-admin.sidebar-sub-menu-item :href="route('admin.posts.create')" :active="request()->routeIs('admin.posts.create')">
                                Add new Posts
                            </x-admin.sidebar-sub-menu-item>
                            {{-- <x-admin.sidebar-sub-menu-item :href="route('admin.movies.genres')" :active="request()->routeIs('admin.posts.categories')">
                                Genres
                            </x-admin.sidebar-sub-menu-item> --}}
                        </x-slot>

                    </x-admin.sidebar-menu-item>

                    <x-admin.sidebar-menu-item :active="request()->routeIs('admin.products*')" :dropdown="true">

                        <x-slot name="icon">
                            <svg class="w-5 h-5" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" fill="none"
                                stroke="currentColor" stroke-width="1.5">
                                <rect x="8" y="8" width="12" height="12" />
                                <rect x="26" y="8" width="12" height="12" />
                                <rect x="26" y="44" width="12" height="12" />
                                <rect x="44" y="8" width="12" height="12" />
                                <rect x="8" y="26" width="12" height="12" />
                                <rect x="26" y="26" width="12" height="12" />
                                <rect x="44" y="26" width="12" height="12" />
                                <rect x="8" y="44" width="12" height="12" />
                                <rect x="44" y="44" width="12" height="12" />
                            </svg>
                        </x-slot>
                        <x-slot name="title">
                            {{ __('Products') }}
                        </x-slot>

                        <x-slot name="submenu">
                            <x-admin.sidebar-sub-menu-item :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')">
                                View all Products
                            </x-admin.sidebar-sub-menu-item>
                            <x-admin.sidebar-sub-menu-item :href="route('admin.products.create')" :active="request()->routeIs('admin.products.create')">
                                Add new Product
                            </x-admin.sidebar-sub-menu-item>
                            {{-- <x-admin.sidebar-sub-menu-item :href="route('admin.movies.genres')" :active="request()->routeIs('admin.posts.categories')">
                                Genres
                            </x-admin.sidebar-sub-menu-item> --}}
                        </x-slot>

                    </x-admin.sidebar-menu-item>


                    <x-admin.sidebar-menu-item :active="request()->routeIs('admin.categories.index')" :href="route('admin.categories.index')">

                        <x-slot name="icon">
                            <svg class="w-5 h-5" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"
                                fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="8" y="8" width="12" height="12" />
                                <rect x="26" y="8" width="12" height="12" />
                                <rect x="26" y="44" width="12" height="12" />
                                <rect x="44" y="8" width="12" height="12" />
                                <rect x="8" y="26" width="12" height="12" />
                                <rect x="26" y="26" width="12" height="12" />
                                <rect x="44" y="26" width="12" height="12" />
                                <rect x="8" y="44" width="12" height="12" />
                                <rect x="44" y="44" width="12" height="12" />
                            </svg>
                        </x-slot>
                        <x-slot name="title">
                            {{ __('Categories') }}
                        </x-slot>


                    </x-admin.sidebar-menu-item>



                    <x-admin.sidebar-menu-item :active="request()->routeIs('admin.orders*')" :dropdown="true">

                        <x-slot name="icon">
                            {{-- <x-ri-article-line /> --}}
                        </x-slot>
                        <x-slot name="title">
                            {{ __('Orders') }}
                        </x-slot>

                        <x-slot name="submenu">
                            <x-admin.sidebar-sub-menu-item :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.index')">
                                View all Orders
                            </x-admin.sidebar-sub-menu-item>

                        </x-slot>

                    </x-admin.sidebar-menu-item>
                    {{-- <x-admin.sidebar-menu-item :active="request()->routeIs('admin.bkash*')" :dropdown="true">

                        <x-slot name="icon">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 7.5l.415-.207a.75.75 0 011.085.67V10.5m0 0h6m-6 0h-1.5m1.5 0v5.438c0 .354.161.697.473.865a3.751 3.751 0 005.452-2.553c.083-.409-.263-.75-.68-.75h-.745M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </x-slot>
                        <x-slot name="title">
                            {{ __('Bkash') }}
                        </x-slot>

                        <x-slot name="submenu">
                            <x-admin.sidebar-sub-menu-item :href="route('admin.bkash.transactions')" :active="request()->routeIs('admin.bkash.transactions')">
                                View all transaction
                            </x-admin.sidebar-sub-menu-item>

                        </x-slot>

                    </x-admin.sidebar-menu-item> --}}


                </ul>

            </div>
        </div>

    </div>
</aside>
<div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>
