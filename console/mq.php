<?php

use Trink\App\Trip\MQ\AmqpBench;
use Trink\App\Trip\MQ\AmqpDemo;
use Trink\App\Trip\MQ\LibMqBench;
use Trink\App\Trip\MQ\LibMqDemo;
use Trink\Core\Component\Logger;

require_once __DIR__ . '/../bootstrap.php';

$startTime = microtime(true);
switch ($argv[1] ?? '') {
    case 'amqp:bench':
        (new AmqpBench($argv))->run();
        break;
    case 'amqp:demo:send':
        (new AmqpDemo($argv))->send();
        break;
    case 'amqp:demo:recv':
        (new AmqpDemo($argv))->recv();
        break;
    case 'libmq:bench':
        (new LibMqBench($argv))->run();
        break;
    case 'libmq:demo:send':
        (new LibMqDemo($argv))->send();
        break;
    case 'libmq:demo:recv':
        (new LibMqDemo($argv))->recv();
        break;
    default:
        helpMessage();
        break;
}
$endTime = microtime(true);
Logger::println('runtime total time: ' . ($endTime - $startTime) . 's');

function helpMessage()
{
    Logger::cliLn(Logger::CLI_COLOR_YELLOW, 'amqp', 'depends on amqp extension');
    Logger::cliLn(
        Logger::CLI_COLOR_GREEN,
        '  amqp:bench',
        ['- benchmark for php-amqp', '- example `php ' . basename(__FILE__) . ' amqp:bench [limit]`']
    );
    Logger::cliLn(
        Logger::CLI_COLOR_GREEN,
        '  amqp:demo:send',
        [
            '- run the amqp demo server, send message to server',
            '- example `php ' . basename(__FILE__) . ' amqp:demo:send [limit]`',
        ]
    );
    Logger::cliLn(
        Logger::CLI_COLOR_GREEN,
        '  amqp:demo:recv',
        '- run the amqp demo server, recv message from server'
    );

    Logger::cliLn(Logger::CLI_COLOR_YELLOW, 'libmq', 'composer require php-amqplib/php-amqplib');
    Logger::cliLn(
        Logger::CLI_COLOR_GREEN,
        '  libmq:bench',
        ['- benchmark for php-amqplib', '- example `php ' . basename(__FILE__) . ' libmq:bench [limit]`']
    );
    Logger::cliLn(
        Logger::CLI_COLOR_GREEN,
        '  libmq:demo:send',
        [
            '- run the libmq demo server, send message to server',
            '- example `php ' . basename(__FILE__) . ' libmq:demo:send [limit]`',
        ]
    );
    Logger::cliLn(
        Logger::CLI_COLOR_GREEN,
        '  libmq:demo:recv',
        '- run the libmq demo server, recv message from server'
    );
}
