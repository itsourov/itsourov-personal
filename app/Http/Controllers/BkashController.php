<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Enums\OrderStatus;
use App\Http\Helpers\Bkash;
use App\Enums\PaymentStatus;
use Illuminate\Http\Request;
use App\Models\BkashTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class BkashController extends Controller
{
    public function token()
    {
        return Bkash::getToken();
    }
    public function refresh_token()
    {
        return Bkash::refresh_token();
    }

    public function order_create_payment(Request $request, Order $order, $frontEndprice)
    {

        if ($order->is_paid) {
            return response()->json(['message' => __('Order is alredy paid')]);
        }
        $calculated_order_total = 0;
        foreach ($order->products as $product) {

            $calculated_order_total += $product->selling_price * ($product->pivot->quantity ?? 1);
        }
        if ($order->order_total != $calculated_order_total) {
            $order->update(['order_total' => $calculated_order_total]);

        }
        if ($order->order_total != $frontEndprice) {
            return response()->json(['message' => __('Order Price mismatched. Maybe the product\'s price has been updated. refresh the page to see changes')]);

        }



        $price = $order->order_total;
        $invoice = 'order-' . auth()->user()->id . '-' . $order->id;
        $response = Bkash::create_payment(amount: $price, invoice: $invoice);


        if ($response->status() == 200) {

            $order->bkashTransactions()->create(array_merge($response->json(), ['order_id' => $order->id]));
        }
        return $response->json();
    }

    public function execute_order_payment(Request $request)
    {
        $paymentID = $request->paymentID;

        $bkashTransaction = BkashTransaction::where(['paymentID' => $paymentID])->first();

        if (!$bkashTransaction) {
            return response()->json(['message' => __('Transaction not found. Please contact support')]);

        }
        if ($bkashTransaction->bkash_transactionable_type == Order::class) {


            $order = $bkashTransaction->bkashTransactionable;

            DB::beginTransaction();



            $order->update([
                'order_status' => OrderStatus::processing,
                'payment_status' => PaymentStatus::Paid,
            ]);


            auth()->user()->purchasedItems()->syncWithoutDetaching($order->products->pluck('id'));

            $order->activities()->create([
                'action_by' => 'customer',
                'content' => 'Payment was made via Bkash, Order Status: ' . OrderStatus::processing . ', and Payment status: ' . PaymentStatus::Paid . ' .',
            ]);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'authorization' => $this->token(),
                'x-app-key' => config('services.bkash.app_key'),
            ])->post(config('services.bkash.executeURL') . $paymentID);

            if ($response->json('paymentID') && $response->json('transactionStatus') == 'Completed') {
                $bkashTransaction->update(array_merge($response->json()));
                DB::commit();
            }
            return $response->json();


        }

    }


}