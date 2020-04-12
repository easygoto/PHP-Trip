<?php

namespace Trink\App\Trip\Swoole;

use Swoole\Coroutine\Http\Client;
use Trink\Core\Component\Logger;

class CoHttpClient
{
    public function run()
    {
        $client = new Client('127.0.0.1', 9503);
        $client->setHeaders(
            [
                'Host' => '127.0.0.1',
                'User-Agent' => 'Swoole Bench',
                'Accept' => 'text/html,application/xhtml+xml,application/xml',
                'Accept-Encoding' => 'gzip',
            ]
        );
        $client->set(['timeout' => 1]);
        $time = microtime(true);
        $client->get('/phpinfo.php');
        $time = microtime(true) - $time;
        Logger::println($client->body);
        Logger::println("use time: {$time}s");
        $client->close();
    }
}
