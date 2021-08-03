<?php

namespace App\Services\Payment;

use Exception;
use GuzzleHttp\Client;
use Log;
use Throwable;

class Fcp
{
    /**
     * @var Client
     */
    private $http;

    /**
     * @var string
     */
    private $session;

    /**
     * Fcp constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->http = new Client([
            'base_uri' => 'https://fcp.shaparak.ir',
        ]);

        $r = $this->http->post('/ref-payment/RestServices/mts/merchantLogin/', [
            'json' => [
                'UserName' => config('payment.gateways.fcp.username'),
                'Password' => config('payment.gateways.fcp.password'),
            ],
        ]);

        $c = json_decode($r->getBody()->getContents(), true);

        if ($c && isset($c['Result']) && isset($c['SessionId']) && $c['Result'] == 'erSucceed') {
            $this->session = $c['SessionId'];
        } else {
            throw new Exception($c);
        }
    }

    public function __destruct()
    {
        try {
            $this->http->post('/ref-payment/RestServices/mts/merchantLogout/', [
                'json' => [
                    'SessionId' => $this->session,
                ],
            ]);
        } catch (Throwable $e) {
            Log::warning($e);
        }
    }

    /**
     * @param string $referenceId
     * @throws Exception
     */
    public function verify(string $referenceId)
    {
        $r = $this->http->post('/ref-payment/RestServices/mts/simpleVerifyMerchantTrans/', [
            'json' => [
                'WSContext' => [
                    'SessionId' => $this->session,
                ],
                'RefNum' => $referenceId,
            ],
        ]);

        $c = json_decode($r->getBody()->getContents(), 200);

        if ($c && isset($c['Result']) && $c['Result'] == 'erSucceed') {
            return;
        }

        throw new Exception($c);
    }
}
