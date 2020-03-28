<?php

use Trink\App\Trip\Swoole\HttpServer;
use Trink\App\Trip\Swoole\WsServer;
use Trink\Core\Component\Logger;

require_once __DIR__ . '/../bootstrap.php';

switch ($argv[1] ?? '') {
    case 'http':
        (new HttpServer())->run();
        break;
    case 'ws':
        (new WsServer())->run();
        break;
    default:
        helpMessage();
        break;
}

function helpMessage()
{
    Logger::cliLn(
        Logger::CLI_COLOR_YELLOW,
        'http',
        ['run the http server', 'example `php ' . basename(__FILE__) . ' http`']
    );
    Logger::cliLn(
        Logger::CLI_COLOR_YELLOW,
        'ws',
        ['run the ws server', 'example `php ' . basename(__FILE__) . ' ws`']
    );
    Logger::cliLn(
        Logger::CLI_COLOR_YELLOW,
        'tcp',
        ['run the tcp server', 'example `php ' . basename(__FILE__) . ' tcp`']
    );
    Logger::cliLn(
        Logger::CLI_COLOR_YELLOW,
        'udp',
        ['run the udp server', 'example `php ' . basename(__FILE__) . ' udp`']
    );
}
