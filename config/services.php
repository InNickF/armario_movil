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
    'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
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
    'webhook' => [
      'secret' => env('STRIPE_WEBHOOK_SECRET'),
      'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
    ],
  ],

  'facebook' => [
    'client_id' => env('FACEBOOK_KEY'),
    'client_secret' => env('FACEBOOK_SECRET'),
    'redirect' => env('FACEBOOK_REDIRECT_URI')
  ],

  'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => env('GOOGLE_CALLBACK_URL'),
  ],

  'gacela' => [
    'url' => env('GACELA_URL'),
    'store_email' => env('GACELA_STORE_EMAIL'),
    'store_password' => env('GACELA_STORE_PASSWORD'),
    'company_email' => env('GACELA_COMPANY_EMAIL'),
    'company_password' => env('GACELA_COMPANY_PASSWORD'),
  ],

  'paymentez' => [
    'card_url' => env('PAYMENTEZ_CARDS_PAYMENT_URL'),
    'client_app_code' => env('PAYMENTEZ_CLIENT_APP_CODE'),
    'client_app_key' => env('PAYMENTEZ_CLIENT_APP_KEY'),
    'server_app_code' => env('PAYMENTEZ_SERVER_APP_CODE'),
    'server_app_key' => env('PAYMENTEZ_SERVER_APP_KEY'),
    'url' => env('PAYMENTEZ_URL'),
    'js' => env('PAYMENTEZ_JS_URL'),
    'checkout' => env('PAYMENTEZ_CHECKOUT_URL'),
    'css' => env('PAYMENTEZ_CSS_URL'),
  ],

  'perseo' => [
    'url' => env('PERSEO_URL'),
    'user' => env('PERSEO_USER'),
    'password' => env('PERSEO_PASSWORD'),
    'db' => env('PERSEO_DB'),
  ],

  'urbano' => [
    'url' => env('URBANO_URL'),
    'user' => env('URBANO_USER'),
    'password' => env('URBANO_PASSWORD'),
    'line' => env('URBANO_LINE'),
    'contract_id' => env('URBANO_CONTRACT_ID'),
  ],
  'fcm' => [
    'key' => env('FCM_SERVER_KEY')
  ],
  'glovo' => [
    'url' => env('GLOVO_URL'),
    'key' => env('GLOVO_KEY'),
    'secret' => env('GLOVO_SECRET'),
    'credential' => env('GLOVO_CREDENTIAL')
  ]

];
