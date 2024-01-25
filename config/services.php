<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'paytm-wallet' => [
    'env' => 'local', // values : (local | production)
    'merchant_id' => env('YOUR_MERCHANT_ID'),
    'merchant_key' => env('YOUR_MERCHANT_KEY'),
    'merchant_website' => env('YOUR_WEBSITE'),
    'channel' => env('YOUR_CHANNEL'),
    'industry_type' => env('YOUR_INDUSTRY_TYPE'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
      'client_id' => '314238153517848',
      'client_secret' => '2b8d341d8dc16987e08c9b1f8ec8cad1',
      'redirect' => 'https://www.supportstock.com/login/facebook/callback',
    ],


    'google' => [
      'client_id' => '307627944542-fbu9f017lmur4hkcf0qahma4gh5pmsrs.apps.googleusercontent.com',
      'client_secret' => 'VQ04iXVi5OQ6kK8b2kj5SvW_',
      'redirect' => 'https://www.supportstock.com/login/google/callback',
    ],

];
