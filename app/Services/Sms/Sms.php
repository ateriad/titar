<?php

namespace App\Services\Sms;

interface Sms
{
    /**
     * Send SMS
     *
     * @param string $cellphone
     * @param string $body
     */
    public function send(string $cellphone, string $body): void;
}
