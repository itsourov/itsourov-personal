<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class Bkash
{

    public static function getToken()
    {


        if (Cache::get('bkash_checkout_id_token')) {
            return Cache::get('bkash_checkout_id_token');
        } else {
            return self::grant_token();
        }
    }

    public static function grant_token()
    {

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'password' => config('bkash.bkash.checkout.password'),
            'username' => config('bkash.bkash.checkout.username'),
        ])->post(config('bkash.bkash.checkout.tokenURL'), [
                'app_key' => config('bkash.bkash.checkout.app_key'),
                'app_secret' => config('bkash.bkash.checkout.app_secret'),
            ]);


        if ($response->json('id_token')) {
            Cache::put('bkash_checkout_id_token', $response->json('id_token'), now()->addMinutes(50));
            Cache::put('bkash_checkout_refresh_token', $response->json('refresh_token'), now()->addMinutes(50));
            return $response->json('id_token');
        } else {
            Cache::forget('bkash_checkout_id_token');
            Cache::forget('bkash_checkout_refresh_token');
            return $response;
        }
    }

    public static function create_payment($amount, $invoice)
    {

        $intent = "sale";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'authorization' => self::getToken(),
            'x-app-key' => config('bkash.bkash.checkout.app_key'),


        ])->post(config('bkash.bkash.checkout.createURL'), [
                'amount' => $amount,
                'currency' => 'BDT',
                'merchantInvoiceNumber' => $invoice,
                'intent' => $intent
            ]);

        return $response;
    }

    public static function refundPayment($paymentID, $trxID, $amount, $sku, $reason)
    {
        dd($paymentID);


        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'authorization' => self::getToken(),
            'x-app-key' => config('services.bkash.checkout.app_key'),
        ])->post(config('services.bkash.refundURL'), [
                'amount' => $amount,
                'paymentID' => $paymentID,
                'trxID' => $trxID,
                'sku' => $sku,
                'reason' => $reason,
            ]);


        return $response;
    }
}