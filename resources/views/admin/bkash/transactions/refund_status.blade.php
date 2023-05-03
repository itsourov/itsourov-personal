<x-admin-layout>


    <div class="space-y-5 container mx-auto px-4 py-4">
        <x-card class="space-y-3">
            <div class="header border-b dark:border-gray-600 p-1">
                <h2 class=" font-medium text-lg">{{ __('Refund Status') }}</h2>
                <p class="text-sm text-gray-500">{{ __('Check status of a refunded transaction') }}</p>
            </div>
            <div>
                <form class="grid gap-3" method="GET" action="{{ route('admin.bkash.refundStatus') }}">

                    <div>
                        <x-input.label value="{{ __('paymentID') }}" required="true" />
                        <x-input.text placeholder="{{ __('paymentID') }}" name="paymentID"
                            value="{{ request('paymentID') ?? '' }}" />
                        <x-input.error :messages="$errors->get('paymentID')" />
                    </div>
                    <div>
                        <x-input.label value="{{ __('trxID') }}" required="true" />
                        <x-input.text placeholder="{{ __('trxID') }}" name="trxID"
                            value="{{ request('trxID') ?? '' }}" />
                        <x-input.error :messages="$errors->get('trxID')" />
                    </div>
                    <x-button.primary>{{ __('Search') }}</x-button.primary>
                </form>

            </div>
        </x-card>

        @if ($response)

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
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
