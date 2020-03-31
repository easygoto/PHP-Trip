<?php

use Trink\Core\Component\Logger;
use Trink\Core\Helper\Format;

use function Co\run;

require_once __DIR__ . '/../bootstrap.php';

$command = $argv[1] ?? '';
$className = Format::toCamelCase(str_replace(':', '_', $command));
$class = 'Trink\\App\\Trip\\Swoole\\' . ucfirst($className);
switch ($command) {
    case 'async:tcp:server':
    case 'async:udp:server':
    case 'async:http:server':
    case 'async:ws:server':
        (fn () => (new ReflectionClass($class))->newInstance()->run())();
        break;
    case 'co:tcp:server':
    case 'co:tcp:client':
    case 'co:udp:server':
    case 'co:udp:client':
    case 'co:http:server':
    case 'co:http:client':
    case 'co:ws:server':
    case 'co:ws:client':
        run(fn () => (new ReflectionClass($class))->newInstance()->run());
        break;
    default:
        helpMessage();
        break;
}

function helpMessage()
{
    Logger::cliLn(Logger::CLI_COLOR_YELLOW, 'tcp');
    Logger::cliLn(Logger::CLI_COLOR_GREEN, '  async:tcp:server', 'run the async tcp server');
    Logger::cliLn(Logger::CLI_COLOR_GREEN, '  co:tcp:server', 'run the co tcp server');
    Logger::cliLn(Logger::CLI_COLOR_GREEN, '  co:tcp:client', 'run the co tcp client');

    Logger::cliLn(Logger::CLI_COLOR_YELLOW, 'udp');
    Logger::cliLn(Logger::CLI_COLOR_GREEN, '  async:udp:server', 'run the async udp server');
    Logger::cliLn(Logger::CLI_COLOR_GREEN, '  co:udp:server', 'run the co udp server');
    Logger::cliLn(Logger::CLI_COLOR_GREEN, '  co:udp:client', 'run the co udp client');

    Logger::cliLn(Logger::CLI_COLOR_YELLOW, 'http');
    Logger::cliLn(Logger::CLI_COLOR_GREEN, '  async:http:server', 'run the async http server');
    Logger::cliLn(Logger::CLI_COLOR_GREEN, '  co:http:server', 'run the co http server');
    Logger::cliLn(Logger::CLI_COLOR_GREEN, '  co:http:client', 'run the co http client');

    Logger::cliLn(Logger::CLI_COLOR_YELLOW, 'ws');
    Logger::cliLn(Logger::CLI_COLOR_GREEN, '  async:ws:server', 'run the async ws server');
    Logger::cliLn(Logger::CLI_COLOR_GREEN, '  co:ws:server', 'run the co ws server');
    Logger::cliLn(Logger::CLI_COLOR_GREEN, '  co:ws:client', 'run the co ws client');
}
