<?php

return [
    'gateways' => [
        'mellat' => [
            'terminalId' => env('MELLAT_TERMINAL_ID'),
            'userName' => env('MELLAT_USERNAME'),
            'userPassword' => env('MELLAT_PASSWORD'),
            'payerId' => env('MELLAT_PAYER_ID', 0),
            'wsdl' => 'https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl',
            'url' => 'https://bpm.shaparak.ir/pgwchannel/startpay.mellat',
        ],
        'fcp' => [
            'merchantId' => env('FCP_MERCHANT_ID'),
            'username' => env('FCP_USERNAME'),
            'password' => env('FCP_PASSWORD'),
            'url' => 'https://fcp.shaparak.ir/_ipgw_/payment/simple/',
            'wsdl' => 'https://fcp.shaparak.ir/ref-payment/jax/merchantAuth?wsdl',
        ],
    ],
];
