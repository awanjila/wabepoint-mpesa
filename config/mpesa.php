<?php

return [
    'env' => env('MPESA_ENV', 'sandbox'),
    'consumer_key' => env('MPESA_CONSUMER_KEY'),
    'consumer_secret' => env('MPESA_CONSUMER_SECRET'),
    'shortcode' => env('MPESA_SHORTCODE'),
    'initiator_name' => env('MPESA_INITIATOR_NAME'),
    'initiator_password' => env('MPESA_INITIATOR_PASSWORD'),
    'result_url' => env('MPESA_RESULT_URL'),
    'timeout_url' => env('MPESA_TIMEOUT_URL'),
    'certificate_path' => env('MPESA_CERTIFICATE_PATH', storage_path('app/mpesa/SandboxCertificate.cer')),

    'urls' => [
        'sandbox' => [
            'auth' => 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',
            'b2c' => 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest',
        ],
        'production' => [
            'auth' => 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',
            'b2c' => 'https://api.safaricom.co.ke/mpesa/b2c/v1/paymentrequest',
        ],
    ],
];
