<?php

namespace Trink\Frame\Component\Response;

use Trink\Frame\Component\BaseResponse;
use Trink\Frame\Container\SWeb;

class SWebResponse implements BaseResponse
{
    public function setHeader($key, $value)
    {
        SWeb::$response->setHeader($key, $value);
    }
}
