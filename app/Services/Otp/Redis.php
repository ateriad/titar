<?php

namespace App\Services\Otp;

use App\Exceptions\ApiErrorException;
use Illuminate\Support\Facades\Redis as R;
use App\Services\Utils\Random;

class Redis implements Otp
{
    private $connection = 'default';

    private $ttl;

    public function __construct()
    {
    }

    /**
     * @inheritDoc
     */
    public function store(string $id): string
    {
        $otp = Random::numeric(100000, 999999);

        R::connection($this->connection)->command('SET', ["otp:$id", $otp, 180]);

        return $otp;
    }

    /**
     * @inheritDoc
     */
    public function check(string $id, string $otp): bool
    {
        return $otp == R::connection($this->connection)->command('GET', ["otp:$id"]);
    }
}
