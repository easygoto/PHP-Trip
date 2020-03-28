<?php

use Trink\App\Trip\Rabbit\Demo;
use Trink\Core\Component\Logger;

require_once __DIR__ . '/../bootstrap.php';

switch ($argv[1] ?? '') {
    case 'demo:send':
        (new Demo())->send();
        break;
    case 'demo:recv':
        (new Demo())->recv();
        break;
    default:
        helpMessage();
        break;
}

function helpMessage()
{
    Logger::cliLn(
        Logger::CLI_COLOR_YELLOW,
        'demo:send',
        'run the demo server, send message to server'
    );
    Logger::cliLn(
        Logger::CLI_COLOR_YELLOW,
        'demo:recv',
        'run the demo server, recv message from server'
    );
}
