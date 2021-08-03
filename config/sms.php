<?php

return [
    'driver' => env('SMS_DRIVER', 'candoo-url'),

    'drivers' => [
        'candoo-url' => [
            'endpoint' => env('CANDOO_URL_ENDPOINT', 'https://my.candoosms.com'),
            'username' => env('CANDOO_URL_USERNAME'),
            'password' => env('CANDOO_URL_PASSWORD'),
            'source' => env('CANDOO_URL_SOURCE'),
            'flash' => env('CANDOO_URL_FLASH', 0),
        ]
    ],
];
