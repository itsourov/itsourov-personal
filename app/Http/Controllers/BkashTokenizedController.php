<?php

namespace App\Http\Controllers;


use App\Models\Order;
use Illuminate\Http\Request;
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
        $response = BkashTokenized::create_payment(amount: $price, invoice: $invoice, callbackUrl: route('bkash-tokenized.callback.order'));


        // if ($response->status() == 200) {

        //     $order->bkashTransactions()->create(array_merge($response->json(), ['order_id' => $order->id]));
        // }

        return $response->json();
    }
    public function order_callback(Request $request)
    {
        if ($request->status == 'success' && $request->paymentID) {
            $response = BkashTokenized::execute_payment(paymentID: $request->paymentID);
            return $response->json();
        }
    }

}