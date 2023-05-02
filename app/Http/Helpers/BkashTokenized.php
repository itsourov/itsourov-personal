<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BkashTokenized
{

    public static function getToken()
    {

        if (Session::get('bkash_tokenized_id_token')) {
            return Session::get('bkash_tokenized_id_token');
        } else {
            return self::refresh_token();
        }
    }

    public static function refresh_token()
    {

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'password' => config('services.bkash-tokenized.password'),
            'username' => config('services.bkash-tokenized.username'),
        ])->post(config('services.bkash-tokenized.tokenURL'), [
                'app_key' => config('services.bkash-tokenized.app_key'),
                'app_secret' => config('services.bkash-tokenized.app_secret'),
            ]);

        if ($response->json('id_token')) {
            Session::put('bkash_tokenized_id_token', $response->json('id_token'));
            return $response->json('id_token');
        } else {
            Session::forget('bkash_tokenized_id_token');
            return 'error';
        }
    }

    public static function create_payment($amount, $invoice, $callbackUrl)
    {


        $intent = "sale";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'authorization' => self::refresh_token(),
            'x-app-key' => config('services.bkash-tokenized.app_key'),
        ])->post(config('services.bkash-tokenized.createURL'), [
                "mode" => "0011",
                "payerReference" => "01929918378",
                "callbackURL" => $callbackUrl,
                'amount' => $amount,
                'currency' => 'BDT',
                'merchantInvoiceNumber' => $invoice,
                'intent' => $intent
            ]);

        return $response;
    }
    public static function execute_payment($paymentID)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'authorization' => self::getToken(),
            'x-app-key' => config('services.bkash-tokenized.app_key'),
        ])->post(config('services.bkash-tokenized.executeURL'), [
                "paymentID" => $paymentID,

            ]);

        return $response;

    }

}