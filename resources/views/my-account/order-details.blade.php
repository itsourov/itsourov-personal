<x-my-account.layout title="Dashboard">
    <x-card class="px-4 py-4 sm:px-8 sm:py-8 space-y-8">
        <div class=" grid grid-cols-2">
            <h2 class="text-xl font-bold mb-4">Order #{{ $order->id }}</h2>
            <div class="text-end space-y-1">
                <img class="w-24 ml-auto" src="{{ asset('images/logo.png') }}" alt="">
                <h2 class=" font-bold">{{ config('app.name') }}</h2>
                <p class=" text-sm">291 N 4th St, San Jose, CA 95112, USA</p>
            </div>
        </div>

        <div>
            <h3 class=" text-lg font-medium">Bill to</h3>
            <div class="text-gray-500 text-sm">

                <p>{{ $order->name }}</p>
                <p>{{ $order->email }}</p>
                <p>{{ $order->phone }}</p>
            </div>
        </div>
        <div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Product name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Qty
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->products as $product)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 max-w-xs :max-w-sm font-medium text-gray-900 whitespace-nowrap dark:text-white truncate">
                                    {{ $product->title }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $product->selling_price }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->pivot->quantity }}
                                </td>
                                <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $product->selling_price * $product->pivot->quantity }}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>
        <div class="space-y-2 md:max-w-sm ml-auto">
            <div class="flex justify-between">
                <h3 class="text-gray-500">Sub total</h3>
                <p>{{ $order->order_total }}</p>
            </div>
            <div class="flex justify-between">
                <h3 class="text-gray-500">Tax</h3>
                <p>৳0</p>
            </div>
            <div class="flex justify-between">
                <h3 class="text-gray-500">Discount</h3>
                <p>৳0</p>
            </div>
            <div class="flex justify-between">
                <h3 class="">Total</h3>
                <p>{{ $order->order_total }}</p>
            </div>
        </div>
        <div class="space-y-2">
            <h3>Order Status: <span class="bg-gray-200 dark:bg-gray-700 rounded px-2">{{ $order->order_status }}</span>
            </h3>
            <h3>Payment Status: <span
                    class="bg-gray-200 dark:bg-gray-700 rounded px-2">{{ $order->payment_status }}</span></h3>
            <h3>Payment Method: <span
                    class="bg-gray-200 dark:bg-gray-700 rounded px-2">{{ $order->payment_method }}</span></h3>
        </div>
        @if (!$order->isPaid)
            <div class="text-end">

                <x-button.primary class="w-full" id="bKash_button">Pay now</x-button.primary>
            </div>
        @endif

    </x-card>

    <x-modal-static name="bkash-error-modal" maxWidth="sm" focusable>
        <div class="p-4">
            <div>
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <!-- Heroicon name: outline/check -->
                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-lg leading-6 font-medium " id="bkash-error-modal-title">Payment error</h3>

                </div>
            </div>
            <div class="mt-5 sm:mt-6">
                <x-button.primary class="w-full" x-on:click="$dispatch('close')">Continue</x-button.primary>
            </div>
        </div>
    </x-modal-static>


    <div id="loading-overlay" style="display: none"
        class="fixed z-40 flex tems-center justify-center inset-0 bg-gray-700 dark:bg-gray-900 dark:bg-opacity-50 bg-opacity-50 transition-opacity">
        <div class="flex items-center justify-center ">
            <div class="w-40 h-40 border-t-4 border-b-4 border-green-900 rounded-full animate-spin">
            </div>
        </div>
    </div>
    @push('scripts')
        <script id="myScript" src="{{ config('services.bkash.script') }}"></script>
        <script>
            var accessToken = "{{ session('id_token') }}";
            var refreshed = false;
            var createCheckoutURL =
                '{{ route('bkash.payment.create.order', ['order' => $order, 'price' => $order->order_total]) }}'
            var executeCheckoutURL = '{{ route('bkash.payment.execute.order') }}'
            $(document).ready(function() {
                regenerateToken('{{ route('bkash.token') }}');



                var paymentRequest = {
                    amount: {{ $order->order_total }},
                    intent: 'sale'
                };
                console.log(JSON.stringify(paymentRequest));
                bKash.init({
                    paymentMode: 'checkout',
                    paymentRequest: paymentRequest,
                    createRequest: function(request) {

                        $.ajax({
                            url: createCheckoutURL,
                            type: 'GET',
                            contentType: 'application/json',
                            success: function(data) {

                                var obj = data;

                                console.log(data);
                                if (data && obj.paymentID != null) {
                                    paymentID = obj.paymentID;
                                    bKash.create().onSuccess(obj);
                                } else {

                                    if (!refreshed) {
                                        if (obj.message == 'Unauthorized' || obj.message ==
                                            'The incoming token has expired') {
                                            regenerateToken(
                                                '{{ route('bkash.token.refresh') }}',
                                                true);
                                        } else {
                                            showError(obj.message)
                                        }
                                    } else {
                                        showError(obj.message)

                                    }
                                    bKash.create().onError();
                                }
                                $('#loading-overlay').hide();
                            },
                            error: function(e) {

                                $('#loading-overlay').hide();
                                showError(e.status + " - " + e.statusText);
                                bKash.create().onError();
                            }
                        });
                    },

                    executeRequestOnAuthorization: function() {
                        console.log('=> executeRequestOnAuthorization');
                        $.ajax({
                            url: executeCheckoutURL + "?paymentID=" + paymentID,
                            type: 'GET',
                            contentType: 'application/json',
                            success: function(data) {

                                if (data && data.paymentID != null) {
                                    alert('[SUCCESS] data : ' + JSON.stringify(data));
                                    // window.location.href = "success.html";
                                } else {

                                    showError("Error - " + data.errorMessage);
                                    bKash.execute().onError();
                                }
                            },
                            error: function(e) {
                                showError(e.status + " - " + e.statusText);
                                bKash.execute().onError();
                            }
                        });
                    },
                    onClose: function() {
                        showError('Payment Window closed')
                    }
                });

                console.log("Right after init ");


            });

            function callReconfigure(val) {
                bKash.reconfigure(val);
            }

            $("#bKash_button").click(function() {
                $('#loading-overlay').show();
            });

            function postRefresh() {
                $("#bKash_button").trigger('click');

            }

            function showError(text) {
                $('#bkash-error-modal-title').text(text)
                window.dispatchEvent(new CustomEvent('open-modal', {
                    detail: 'bkash-error-modal'
                }));
                window.dispatchEvent(new CustomEvent('open-modal', {
                    detail: 'bkash-error-modal'
                }));

            }

            function regenerateToken(tokenUrl, refreshRequest = false) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: tokenUrl,
                    type: 'POST',
                    contentType: 'application/json',
                    success: function(data) {

                        accessToken = JSON.stringify(data);

                        if (refreshRequest) {
                            refreshed = true;
                            postRefresh();

                        }
                    },
                    error: function(e) {

                        if (refreshRequest) {
                            showError(e.statusText)

                        } else {
                            regenerateToken('{{ route('bkash.token.refresh') }}', true);
                        }


                    }
                });
            }
        </script>
    @endpush

</x-my-account.layout>
