<?php

namespace Trink\Frame\Controller;

use Swoole\Client;
use Trink\Frame\Component\BaseController;

class SwooleController extends BaseController
{
    private string $host = 'host.docker.internal';

    public function actionTcp()
    {
        $client = new Client(SWOOLE_SOCK_TCP);
        if (!$client->connect($this->host, 9501)) {
            exit("连接失败");
        }
        $client->send('hello');
        $result = $client->recv();
        print_r($result);
        $client->close();
    }

    public function actionUdp()
    {
        $client = new Client(SWOOLE_SOCK_UDP);
        if (!$client->connect($this->host, 9502)) {
            exit("连接失败");
        }
        $client->send("hello");
        $result = $client->recv();
        print_r($result);
        $client->close();
    }

    public function actionWs()
    {
        require __DIR__ . '/../View/swoole/ws.php';
    }
}
