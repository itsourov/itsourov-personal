<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Bkash
{

    public static function getToken()
    {

        if (Session::get('id_token')) {
            return Session::get('id_token');
        } else {
            return self::refresh_token();
        }
    }

    public static function refresh_token()
    {

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'password' => config('services.bkash.password'),
            'username' => config('services.bkash.username'),
        ])->post(config('services.bkash.tokenURL'), [
                'app_key' => config('services.bkash.app_key'),
                'app_secret' => config('services.bkash.app_secret'),
            ]);

        if ($response->json('id_token')) {
            Session::put('id_token', $response->json('id_token'));
            return $response->json('id_token');
        } else {
            Session::forget('id_token');
            return 'error';
        }
    }

    public static function create_payment($amount, $invoice)
    {

        $intent = "sale";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'authorization' => self::getToken(),
            'x-app-key' => config('services.bkash.app_key'),
        ])->post(config('services.bkash.createURL'), [
                'amount' => $amount,
                'currency' => 'BDT',
                'merchantInvoiceNumber' => $invoice,
                'intent' => $intent
            ]);

        return $response;
    }

    public static function refundPayment($paymentID, $trxID, $amount, $sku, $reason)
    {



        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'authorization' => self::getToken(),
            'x-app-key' => config('services.bkash.app_key'),
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