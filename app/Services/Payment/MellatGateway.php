<?php

namespace App\Services\Payment;

use Exception;
use Str;
use SoapClient;
use SoapFault;

class MellatGateway
{
    /**
     * @var string
     */
    private $terminalId;

    /**
     * @var string
     */
    private $userName;

    /**
     * @var string
     */
    private $userPassword;

    /**
     * @var string
     */
    private $payerId;

    /**
     * @var SoapClient|object
     */
    private $soap;

    /**
     * MellatGateway constructor.
     *
     * @throws SoapFault
     */
    public function __construct()
    {
        $this->terminalId = config('banks.drivers.mellat.terminalId');
        $this->userName = config('banks.drivers.mellat.userName');
        $this->userPassword = config('banks.drivers.mellat.userPassword');
        $this->payerId = config('banks.drivers.mellat.payerId');

        $this->soap = new SoapClient(config('banks.drivers.mellat.wsdl'));
    }

    /**
     * Mellat Gateway url
     *
     * @return string
     */
    public function url(): string
    {
        return config('banks.drivers.mellat.url');
    }

    /**
     * Request for a new payment
     *
     * @param int $orderId
     * @param int $amount
     * @return string
     * @throws Exception
     */
    public function request(int $orderId, int $amount): string
    {
        $response = $this->soap->bpPayRequest([
            'terminalId' => $this->terminalId,
            'userName' => $this->userName,
            'userPassword' => $this->userPassword,
            'orderId' => $orderId,
            'amount' => $amount,
            'localDate' => date('Ymd'),
            'localTime' => date('His'),
            'additionalData' => '',
            'callBackUrl' => route('callback'),
            'payerId' => $this->payerId,
        ]);

        $return = $response->return ?? 'error';
        if (Str::startsWith($return, '0,')) {
            return substr($return, strlen('0,'));
        }

        throw new Exception(json_encode($response));
    }

    /**
     * Verify and settle the payment
     *
     * @param array $parameters
     * @return array
     * @throws Exception
     */
    public function settle(array $parameters): array
    {
        if (
            !isset($parameters['RefId']) ||
            !isset($parameters['SaleOrderId']) ||
            !isset($parameters['SaleReferenceId']) ||
            !isset($parameters['ResCode']) ||
            $parameters['ResCode'] != 0
        ) {
            throw new Exception($parameters);
        }

        $verify = $this->soap->bpVerifyRequest([
            'terminalId' => $this->terminalId,
            'userName' => $this->userName,
            'userPassword' => $this->userPassword,
            'orderId' => $parameters['SaleOrderId'],
            'saleOrderId' => $parameters['SaleOrderId'],
            'saleReferenceId' => $parameters['SaleReferenceId'],
        ]);

        $return = $verify->return ?? 'error';
        if ($return == 0) {
            $settle = $this->soap->bpSettleRequest($parameters);

            $return = $settle->return ?? 'error';
            if ($return == 0) {
                return $parameters;
            } else {
                $this->soap->bpReversalRequest($parameters);
            }
        }

        throw new Exception($parameters);
    }
}
