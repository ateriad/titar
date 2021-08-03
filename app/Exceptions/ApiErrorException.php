<?php

namespace App\Exceptions;

use Exception;

class ApiErrorException extends Exception
{
    public function __construct($error, $code = 400)
    {
        parent::__construct($error, $code, null);
    }
}
