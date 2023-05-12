<?php

namespace App\Http\Controllers\Bkash;

use App\Models\BkashAgreement;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\BkashTokenized;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;

class AgreementController extends Controller
{
    public function create(Request $request)
    {
        Redirect::setIntendedUrl($request->redirect_to ?? url()->previous());

        $createAgreementResponse = BkashTokenized::createAgreement(
            callbackUrl: route('bkash-tokenized.agreement.callback', ['redirect_to' => $request->redirect_to]), payerReference: auth()->user()->email
        );

        if ($createAgreementResponse->status() == 200) {
            auth()->user()->bkashAgreement()->updateOrCreate([], $createAgreementResponse->json());
            return redirect($createAgreementResponse->json('bkashURL'));
        } elseif ($createAgreementResponse->status() == 401 && !$request->token_refreshed) {
            BkashTokenized::grant_token();
            return redirect(route('bkash-tokenized.agreement.create', ['token_refreshed' => 1]));
        }
        return $createAgreementResponse->json();
    }
    public function callback(Request $request)
    {
        if ($request->status == 'success' && $request->paymentID) {

            $paymentID = $request->paymentID;

            $bkashAgreement = BkashAgreement::where(['paymentID' => $paymentID])->first();

            if (!$bkashAgreement) {
                return response()->json(['message' => __('Agreement not found. Please contact support')]);
            }
            $executeAgreementResponse = BkashTokenized::execute_agreement(paymentID: $paymentID);
            if ($executeAgreementResponse->json('agreementID') && $executeAgreementResponse->json('agreementStatus') == 'Completed') {
                $bkashAgreement->update($executeAgreementResponse->json());
                return redirect()->intended(RouteServiceProvider::HOME)->withNotification("Agreement complited");
            } else {
                return redirect()->intended(RouteServiceProvider::HOME)->withNotification("Agreement failed");
            }

        } else {
            return redirect()->intended(RouteServiceProvider::HOME)->withNotification("Agreement failed");
        }
    }
    public function create_order_payment(Request $request, Order $order)
    {
        Redirect::setIntendedUrl(url()->previous());
        if (!auth()->user()->bkashAgreement?->agreementID) {
            return redirect()->intended(RouteServiceProvider::HOME)->withNotification("No agreement was found");
        }

        if ($order->is_paid) {
            return back()->withNotification(__('Order is alredy paid'));
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
        $createPaymentResponse = BkashTokenized::create_payment(amount: $price, invoice: $invoice, callbackUrl: route('bkash-tokenized.payment.execute'), payerReference: auth()->user()->email, agreementID: auth()->user()->bkashAgreement->agreementID);
        // return $createPaymentResponse->json();
        if ($createPaymentResponse->status() == 200 && $createPaymentResponse->json('bkashURL')) {

            $order->bkashTransactions()->create(array_merge($createPaymentResponse->json(), ['order_id' => $order->id]));

            return redirect($createPaymentResponse->json('bkashURL'));
        } elseif ($createPaymentResponse->status() == 401 && !$request->token_refreshed) {
            BkashTokenized::grant_token();
            return redirect(route('bkash-tokenized.agreement.payment.create.order', ['order' => $order, 'token_refreshed' => 1]));
        }

        // error handeling
        if ($createPaymentResponse->json('statusCode') == 2051) {
            return self::create($request);
        }
        return $createPaymentResponse->json();

    }

    public function delete()
    {
        auth()->user()->bkashAgreement()->delete();
        return back()->withNotification(__("Agreement Deleted"));
    }
}