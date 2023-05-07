<?php

namespace App\Http\Controllers\Admin\Bkash;

use App\Http\Helpers\BkashTokenized;
use App\Models\Order;
use App\Enums\OrderStatus;
use App\Http\Helpers\Bkash;
use App\Enums\PaymentStatus;
use Illuminate\Http\Request;
use App\Models\BkashTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RefundController extends Controller
{
    public function refundPaymeent(Request $request, BkashTransaction $bkashTransaction)
    {


        // new start
        $validated = $request->validate([
            'reason' => 'max:255',
            'cancel_order' => 'boolean',
            'amount' => 'required|numeric',

        ]);

        DB::beginTransaction();

        if ($bkashTransaction->bkash_transactionable_type == Order::class) {

            $order = $bkashTransaction->bkashTransactionable;
            if (!$order) {
                return back()->withNotification('The order was not found for this transaction');
            }

            if ($request->has('cancel_order')) {
                auth()->user()->purchasedItems()->detach($order->products->pluck('id'));
                $order->update([
                    'order_status' => OrderStatus::Cancled,
                    'payment_status' => PaymentStatus::Refunded,
                ]);

                $order->activities()->create([
                    'action_by' => 'admin',
                    'content' => 'Bkash payment was refunded, Order Status: ' . OrderStatus::Cancled . ', and Payment status: ' . PaymentStatus::Refunded . ' .',
                ]);
            } else {
                $order->activities()->create([
                    'action_by' => 'admin',
                    'content' => 'Bkash payment was refunded but the order status was unchanged, Payment status: ' . PaymentStatus::Refunded . ' .',
                ]);
            }

        } else {
            return 'This situation is Unhandled. This Payment was for this model : ' . $bkashTransaction->bkash_transactionable_type;
        }
        $refundResponse = BkashTokenized::refundPayment(
            paymentID: $bkashTransaction->paymentID,
            trxID: $bkashTransaction->trxID,
            amount: $validated['amount'],
            reason: $validated['reason'],
            sku: $bkashTransaction->bkash_transactionable_type . "-" . $bkashTransaction->bkash_transactionable_id
        );



        if ($refundResponse->status() == 401) {
            BkashTokenized::grant_token();

            $refundResponse = BkashTokenized::refundPayment(
                paymentID: $bkashTransaction->paymentID,
                trxID: $bkashTransaction->trxID,
                amount: $validated['amount'],
                reason: $validated['reason'],
                sku: $bkashTransaction->bkash_transactionable_type . "-" . $bkashTransaction->bkash_transactionable_id
            );
        }



        if ($refundResponse->json('transactionStatus') == 'Completed') {


            $bkashTransaction->update(array_merge($refundResponse->json(), ['transactionStatus' => 'Refunded', 'refundTime' => $refundResponse->json('completedTime')]));

            DB::commit();
            return back()->withNotification("Refunded to customer complite");
        } else {
            return "error:" . $refundResponse;
        }
    }
}