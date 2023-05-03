<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Illuminate\Http\Request;
use App\Models\BkashTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\BkashTokenized;

class BkashTokenizedController extends Controller
{

    public function order_create_payment(Request $request, Order $order)
    {


        if ($order->is_paid) {
            return back()->with('message', __('Order is alredy paid'));
        }
        $calculated_order_total = 0;
        foreach ($order->products as $product) {

            $calculated_order_total += $product->selling_price * ($product->pivot->quantity ?? 1);
        }
        if ($order->order_total != $calculated_order_total) {
            $order->update(['order_total' => $calculated_order_total]);

        }



        $price = $order->order_total;
        $invoice = 'order-' . auth()->user()->id . '-' . $order->id;
        $response = BkashTokenized::create_payment(amount: $price, invoice: $invoice, callbackUrl: route('bkash-tokenized.callback.order'), customerMobileNumber: $order->phone);


        if ($response->status() == 200) {

            $order->bkashTransactions()->create(array_merge($response->json(), ['order_id' => $order->id, 'createTime' => $response->json('paymentCreateTime')]));

            return redirect($response->json('bkashURL'));
        } elseif ($response->status() == 401 && !$request->token_refreshed) {
            BkashTokenized::grant_token();
            return redirect(route('bkash-tokenized.payment.create.order', ['order' => $order, 'token_refreshed' => 1]));
        }

        return $response->json();
    }
    public function order_callback(Request $request)
    {
        if ($request->status == 'success' && $request->paymentID) {

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
                $response = BkashTokenized::execute_payment(paymentID: $request->paymentID);
                if ($response->json('paymentID') && $response->json('transactionStatus') == 'Completed') {
                    $bkashTransaction->update(array_merge($response->json()));
                    DB::commit();
                    return redirect(route('my-account.orders.show', $order))->with('message', "payment successful");
                }
                return $response->json();
            }

        }
    }

}