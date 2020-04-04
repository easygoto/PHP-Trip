<?php

namespace Trink\Core\Exception;

use Exception;
use Throwable;

class HttpException extends Exception
{
    public function __construct($code = 0, $message = "", Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
