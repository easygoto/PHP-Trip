<?php


namespace Trink\Frame\Controller;

use Swoole\Client;
use Trink\Frame\Component\BaseController;

class SwooleController extends BaseController
{
    private string $host = 'host.docker.internal';
    private int    $port = 9502;

    public function actionTcp()
    {
        $client = new Client(SWOOLE_SOCK_TCP);
        $client->connect($this->host, $this->port);
        $client->send('hello');
        $client->close();
    }

    public function actionWs()
    {
        require __DIR__ . '/../View/swoole/ws.php';
    }
}
