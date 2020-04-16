<?php

namespace Trink\Frame\Controller;

use Trink\Frame\Component\BaseController;

class SwooleController extends BaseController
{
    public function ws()
    {
        require TRIP_ROOT . 'src/View/swoole/ws.php';
    }

    private function wss()
    {
        return __METHOD__;
    }
}
