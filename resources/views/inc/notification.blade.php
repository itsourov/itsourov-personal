@if (session()->has('message'))
    <div aria-live="assertive" x-data="{ show: true }"
        class="fixed  z-50 inset-0 flex items-end center px-4 py-6 pointer-events-none sm:p-6 sm:items-end ">
        <div class="w-full flex flex-col items-center space-y-4 sm:items-end ">

            <div x-show="show" x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="max-w-sm w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg pointer-events-auto ring-1 ring-black dark:ring-gray-700 ring-opacity-5 overflow-hidden">
                <div class="p-4 z-40">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: outline/check-circle -->
                            <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium ">{{ session('message') }}</p>
                            {{-- <p class="mt-1 text-sm text-gray-500">Anyone with a link can now view this file.</p> --}}
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button x-on:click="show=false "
                                class=" rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none ">
                                <span class="sr-only">Close</span>
                                <!-- Heroicon name: solid/x -->
                                <x-svg.x class="w-5 h-5" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
