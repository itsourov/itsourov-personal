<x-admin-layout>


    <div class="space-y-5 container mx-auto px-4 py-4">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            trxID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            paymentID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            customerMsisdn
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr class="bg-white btransaction-b dark:bg-gray-800 dark:btransaction-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                # {{ $transaction->id }}
                            </th>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $transaction->created_at->format('D M, y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $transaction->amount . ' ' . $transaction->currency }}


                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="p-1 rounded {{ \App\Enums\BkashTransactionStatus::getClass()[$transaction->transactionStatus] }}">{{ $transaction->transactionStatus }}</span>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $transaction->trxID }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $transaction->paymentID }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $transaction->customerMsisdn }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.bkash.transactions.show', $transaction) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View / Edit</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div>
            {{ $transactions->links('pagination.tailwind') }}
        </div>

    </div>
</x-admin-layout>
