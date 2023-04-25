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
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z">
                                </path>
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
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z">
                                </path>
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
                            {{ __('Categories') }}
                        </x-slot>


                    </x-admin.sidebar-menu-item>



                    <x-admin.sidebar-menu-item :active="request()->routeIs('admin.orders*')" :dropdown="true">

                        <x-slot name="icon">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z">
                                </path>
                            </svg>
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
