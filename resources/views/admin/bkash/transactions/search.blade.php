<x-admin-layout>


    <div class="space-y-5 container mx-auto px-4 py-4">
        <x-card class=" space-y-3">
            <div class="header border-b dark:border-gray-600 p-1">
                <h2 class=" font-medium text-lg">{{ __('Search Transaction') }}</h2>
                <p class="text-sm text-gray-500">{{ __('get all the relevant information of a transaction') }}</p>
            </div>
            <div>
                <form class="flex items-center" method="GET" action="{{ route('admin.bkash.searchTransaction') }}">

                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <x-svg.search class="w-5 h-5 text-gray-400 dark:text-gray-600" />
                        </div>

                        <x-input.text class="pl-10 " name="trxID" placeholder="trxID"
                            value="{{ request('trxID') ?? '' }}" />
                    </div>
                    <button type="submit"
                        class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <x-svg.search class="w-5 h-5" />

                    </button>
                </form>

            </div>
        </x-card>

        @if ($response)

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Key
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Value
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($response as $key => $value)
                            @if ($loop->iteration % 2 == 0)
                                <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $key }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $value }}
                                    </td>

                                </tr>
                            @else
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $key }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $value }}
                                    </td>

                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endif




    </div>
</x-admin-layout>
