<?php

namespace App\Http\Controllers\Admin\Bkash;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RefundController extends Controller
{
    public function refundPaymeent(Request $request, BkashTransaction $bkashTransaction)
    {

        $validated = $request->validate([
            'reason' => 'max:255',
            'cancel_order' => 'boolean',
            'amount' => 'required|numeric',

        ]);




        $refundResponse = Bkash::refundPayment(
        paymentID: $bkashTransaction->paymentID,
        trxID: $bkashTransaction->trxID,
        amount: $validated['amount'],
        reason: $validated['reason'],
        sku: $bkashTransaction->bkash_transactionable_type . "-" . $bkashTransaction->bkash_transactionable_id
        );

        if ($refundResponse->status() == 401) {
            Bkash::refresh_token();

            $refundResponse = Bkash::refundPayment(
            paymentID: $bkashTransaction->paymentID,
            trxID: $bkashTransaction->trxID,
            amount: $validated['amount'],
            reason: $validated['reason'],
            sku: $bkashTransaction->bkash_transactionable_type . "-" . $bkashTransaction->bkash_transactionable_id
            );
        }


        if ($refundResponse->json('transactionStatus') == 'Completed') {
            DB::beginTransaction();

            $bkashTransaction->update(array_merge($refundResponse->json(), ['transactionStatus' => 'Refunded']));



            if ($bkashTransaction->bkash_transactionable_type == Order::class && $request->has('cancel_order')) {

                $order = $bkashTransaction->bkashTransactionable;
                if (!$order) {
                    return back()->with('message', 'The order was not found for this transaction');
                }

                auth()->user()->purchasedItems()->detach($order->products->pluck('id'));
                $order->update([
                    'order_status' => OrderStatus::Cancled,
                    'payment_status' => PaymentStatus::Refunded,
                ]);

            }

            $order->activities()->create([
                'action_by' => 'admin',
                'content' => 'Bkash payment was refunded, Order Status: ' . OrderStatus::processing . ', and Payment status: ' . PaymentStatus::Paid . ' .',
            ]);
            DB::commit();
            return back()->with('message', "Refunded to customer complite");
        } else {
            return "error:" . $refundResponse;
        }
    }
}