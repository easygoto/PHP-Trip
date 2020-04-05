<?php

namespace Trink\Frame\Component\Response;

use Trink\Frame\Component\BaseResponse;

class WebResponse implements BaseResponse
{
    public function setHeader($key, $value)
    {
        header("{$key}: {$value}");
    }
}
