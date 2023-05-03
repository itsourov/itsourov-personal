<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class BkashTokenized
{

    public static function getToken()
    {

        if (Cache::get('bkash_tokenized_id_token')) {
            return Cache::get('bkash_tokenized_id_token');
        } else {
            return self::grant_token();
        }
    }


    public static function grant_token()
    {

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'password' => config('bkash.bkash.tokenized.password'),
            'username' => config('bkash.bkash.tokenized.username'),
        ])->post(config('bkash.bkash.tokenized.tokenURL'), [
                'app_key' => config('bkash.bkash.tokenized.app_key'),
                'app_secret' => config('bkash.bkash.tokenized.app_secret'),
            ]);


        if ($response->json('id_token')) {
            Cache::put('bkash_tokenized_id_token', $response->json('id_token'), now()->addMinutes(50));
            Cache::put('bkash_tokenized_refresh_token', $response->json('refresh_token'), now()->addMinutes(50));
            return $response->json('id_token');
        } else {
            Cache::forget('bkash_tokenized_id_token');
            Cache::forget('bkash_tokenized_refresh_token');
            return 'error';
        }
    }


    public static function create_payment($amount, $invoice, $callbackUrl, $customerMobileNumber)
    {



        $intent = "sale";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'authorization' => self::getToken(),
            'x-app-key' => config('bkash.bkash.tokenized.app_key'),
        ])->post(config('bkash.bkash.tokenized.createURL'), [
                "mode" => "0011",
                "payerReference" => $customerMobileNumber,
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
            'x-app-key' => config('bkash.bkash.tokenized.app_key'),
        ])->post(config('bkash.bkash.tokenized.executeURL'), [
                "paymentID" => $paymentID,

            ]);

        return $response;

    }

}