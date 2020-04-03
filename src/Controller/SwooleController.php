<?php

namespace Trink\Frame\Controller;

use Trink\Frame\Component\BaseController;

class SwooleController extends BaseController
{
    public function actionWs()
    {
        require __DIR__ . '/../View/swoole/ws.php';
    }
}
