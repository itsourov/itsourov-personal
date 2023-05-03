<?php

$testMode = false;

if (!$testMode) {
    return [





        'checkout' => [

            'app_key' => env('BKASH_CHECKOUT_APP_KEY'),
            'app_secret' => env('BKASH_CHECKOUT_APP_SECRET'),
            'username' => env('BKASH_CHECKOUT_USERNAME'),
            'password' => env('BKASH_CHECKOUT_PASSWORD'),


            'createURL' => env('BKASH_CHECKOUT_API_ROOT') . '/checkout/payment/create',
            'executeURL' => env('BKASH_CHECKOUT_API_ROOT') . '/checkout/payment/execute/',
            'refundURL' => env('BKASH_CHECKOUT_API_ROOT') . '/checkout/payment/refund/',
            'tokenURL' => env('BKASH_CHECKOUT_API_ROOT') . '/checkout/token/grant',
            'script' => 'https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js',
        ],
        'tokenized' => [
            'app_key' => env('BKASH_TOKENIZED_APP_KEY'),
            'app_secret' => env('BKASH_TOKENIZED_APP_SECRET'),
            'username' => env('BKASH_TOKENIZED_USERNAME'),
            'password' => env('BKASH_TOKENIZED_PASSWORD'),

            'createURL' => env('BKASH_TOKENIZED_API_ROOT') . '/tokenized/checkout/create',
            'executeURL' => env('BKASH_TOKENIZED_API_ROOT') . '/tokenized/checkout/execute',
            'queryPaymentURL' => env('BKASH_TOKENIZED_API_ROOT') . '/tokenized/checkout/payment/status',
            'searchTransactionUrl' => env('BKASH_TOKENIZED_API_ROOT') . '/tokenized/checkout/general/searchTransaction',
            'refundURL' => env('BKASH_TOKENIZED_API_ROOT') . '/tokenized/checkout/payment/refund',
            'refundStatusURL' => env('BKASH_TOKENIZED_API_ROOT') . '/tokenized/checkout/payment/refund',
            'tokenURL' => env('BKASH_TOKENIZED_API_ROOT') . '/tokenized/checkout/token/grant',
        ],



    ];

} else {

    return [





        'checkout' => [
            'app_key' => env('BKASH_CHECKOUT_TEST_APP_KEY'),
            'app_secret' => env('BKASH_CHECKOUT_TEST_APP_SECRET'),
            'username' => env('BKASH_CHECKOUT_TEST_USERNAME'),
            'password' => env('BKASH_CHECKOUT_TEST_PASSWORD'),


            'createURL' => env('BKASH_TEST_CHECKOUT_API_ROOT') . '/checkout/payment/create',
            'executeURL' => env('BKASH_TEST_CHECKOUT_API_ROOT') . '/checkout/payment/execute/',
            'refundURL' => env('BKASH_TEST_CHECKOUT_API_ROOT') . '/checkout/payment/refund/',
            'tokenURL' => env('BKASH_TEST_CHECKOUT_API_ROOT') . '/checkout/token/grant',
            'script' => 'https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js',
        ],

        'tokenized' => [
            'app_key' => env('BKASH_TOKENIZED_TEST_APP_KEY'),
            'app_secret' => env('BKASH_TOKENIZED_TEST_APP_SECRET'),
            'username' => env('BKASH_TOKENIZED_TEST_USERNAME'),
            'password' => env('BKASH_TOKENIZED_TEST_PASSWORD'),


            'createURL' => env('BKASH_TOKENIZED_TEST_API_ROOT') . '/tokenized/checkout/create',
            'executeURL' => env('BKASH_TOKENIZED_TEST_API_ROOT') . '/tokenized/checkout/execute',
            'queryPaymentURL' => env('BKASH_TOKENIZED_TEST_API_ROOT') . '/tokenized/checkout/payment/status',
            'searchTransactionUrl' => env('BKASH_TOKENIZED_TEST_API_ROOT') . '/tokenized/checkout/general/searchTransaction',
            'refundURL' => env('BKASH_TOKENIZED_TEST_API_ROOT') . '/tokenized/checkout/payment/refund',
            'refundStatusURL' => env('BKASH_TOKENIZED_TEST_API_ROOT') . '/tokenized/checkout/payment/refund',
            'tokenURL' => env('BKASH_TOKENIZED_TEST_API_ROOT') . '/tokenized/checkout/token/grant',
        ],


    ];
}