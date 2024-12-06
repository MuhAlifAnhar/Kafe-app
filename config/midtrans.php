<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'is_production' => env('MIDTRANS_PRODUCTION', true),
    'is_sanitized' => env('MIDTRANS_SANITIZED', true),
    'is_3ds' => env('MIDTRANS_3DS', true),
];
