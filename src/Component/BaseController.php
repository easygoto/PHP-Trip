<?php

namespace Trink\Frame\Component;

use Trink\Frame\Container\App;

class BaseController
{
    public BaseResponse $response;

    public function __construct()
    {
        $this->response = App::instance()->response;
    }
}
