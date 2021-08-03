<?php

use App\Enums\Clients;

return [
    'versions' => [
        Clients::ANDROID => [
            'last' => env('CLIENTS_VERSIONS_ANDROID_LAST'),
            'supported' => env('CLIENTS_VERSIONS_ANDROID_SUPPORTED'),
            'url' => env('CLIENTS_VERSIONS_ANDROID_URL'),
        ],
        Clients::WINDOWS => [
            'last' => env('CLIENTS_VERSIONS_WINDOWS_LAST'),
            'supported' => env('CLIENTS_VERSIONS_WINDOWS_SUPPORTED'),
            'url' => env('CLIENTS_VERSIONS_WINDOWS_URL'),
        ],
    ],
];
