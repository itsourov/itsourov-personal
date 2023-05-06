<x-admin-layout>


    <div class="space-y-5 container mx-auto px-4 py-4">

        <div class="buttons">
            <x-card>
                @if ($bkashTransaction->transactionStatus == App\Enums\BkashTransactionStatus::Completed)
                    <form action="{{ route('admin.bkash.refund', $bkashTransaction) }}" method="post" class="space-y-3">
                        @csrf
                        @method('DELETE')
                        <h2>Refund Payment</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <x-input.label :value="__('Refund Reason')" />
                                <x-input.text name="reason" :value="old('reason')" type="text" class="mt-1 block w-full" />
                                <x-input.error :messages="$errors->get('reason')" />
                            </div>
                            <div>
                                <x-input.label :value="__('Refund amound')" required="true" />
                                <x-input.text name="amount" :value="old('amount', $bkashTransaction->amount)" type="number"
                                    class="mt-1 block w-full" />
                                <x-input.error :messages="$errors->get('amount')" />

                            </div>
                        </div>

                        @if ($bkashTransaction->bkash_transactionable_type == App\Models\Order::class)
                            <div>
                                <input type="checkbox" name="cancel_order" id="cancel_order" checked value="1">
                                <x-input.label :value="__('Cancel Order')" for="cancel_order" />

                            </div>
                            <x-input.error :messages="$errors->get('cancel_order')" />
                        @endif
                        <x-button.primary>Refund</x-button.primary>
                    </form>
                @endif
            </x-card>


            @if ($bkashTransaction->bkash_transactionable_type == App\Models\Order::class)
                <a href="{{ route('admin.orders.show', $bkashTransaction->bkash_transactionable_id) }}">
                    <x-button.primary>View Order</x-button.primary>
                </a>
            @endif
        </div>


        <div class="relative overflow-x-auto">
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
                    @foreach ($bkashTransaction->toArray() as $key => $value)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                            <td class="px-6 py-4">
                                {{ $key }}
                            </td>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $value }}
                            </th>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>






    </div>
</x-admin-layout>
