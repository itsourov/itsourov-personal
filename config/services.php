<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],


    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => config('app.url') . '/auth/google/callback',
    ],
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => config('app.url') . '/auth/facebook/callback',
    ],

    'bkash' => [
        'app_key' => env('BKASH_TEST_MODE') ? env('TEST_BKASH_APP_KEY') : env('BKASH_APP_KEY'),
        'app_secret' => env('BKASH_TEST_MODE') ? env('TEST_BKASH_APP_SECRET') : env('BKASH_APP_SECRET'),
        'username' => env('BKASH_TEST_MODE') ? env('TEST_BKASH_USERNAME') : env('BKASH_USERNAME'),
        'password' => env('BKASH_TEST_MODE') ? env('TEST_BKASH_PASSWORD') : env('BKASH_PASSWORD'),
        'createURL' => (env('BKASH_TEST_MODE') ? env('TEST_BKASH_API_ROOT') : env('BKASH_API_ROOT')) . '/checkout/payment/create',
        'executeURL' => (env('BKASH_TEST_MODE') ? env('TEST_BKASH_API_ROOT') : env('BKASH_API_ROOT')) . '/checkout/payment/execute/',
        'refundURL' => (env('BKASH_TEST_MODE') ? env('TEST_BKASH_API_ROOT') : env('BKASH_API_ROOT')) . '/checkout/payment/refund/',
        'tokenURL' => (env('BKASH_TEST_MODE') ? env('TEST_BKASH_API_ROOT') : env('BKASH_API_ROOT')) . '/checkout/token/grant',
        'script' => env('BKASH_TEST_MODE') ? 'https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js' : 'https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js',
    ],

];