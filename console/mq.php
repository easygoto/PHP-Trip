<?php

use Trink\App\Trip\MQ\AmqpDemo;
use Trink\App\Trip\MQ\LibMqDemo;
use Trink\Core\Component\Logger;

require_once __DIR__ . '/../bootstrap.php';

$startTime = microtime(true);
switch ($argv[1] ?? '') {
    case 'amqp:demo:send':
        (new AmqpDemo())->send();
        break;
    case 'amqp:demo:recv':
        (new AmqpDemo())->recv();
        break;
    case 'libmq:demo:send':
        (new LibMqDemo())->send();
        break;
    case 'libmq:demo:recv':
        (new LibMqDemo())->recv();
        break;
    default:
        helpMessage();
        break;
}
$endTime = microtime(true);
Logger::println('total time: ' . ($endTime - $startTime));

function helpMessage()
{
    Logger::cliLn(Logger::CLI_COLOR_YELLOW, 'amqp', 'depends on amqp extension');
    Logger::cliLn(
        Logger::CLI_COLOR_GREEN,
        '  amqp:demo:send',
        'run the amqp demo server, send message to server'
    );
    Logger::cliLn(
        Logger::CLI_COLOR_GREEN,
        '  amqp:demo:recv',
        'run the amqp demo server, recv message from server'
    );

    Logger::cliLn(Logger::CLI_COLOR_YELLOW, 'libmq', 'composer require php-amqplib/php-amqplib');
    Logger::cliLn(
        Logger::CLI_COLOR_GREEN,
        '  libmq:demo:send',
        'run the libmq demo server, send message to server'
    );
    Logger::cliLn(
        Logger::CLI_COLOR_GREEN,
        '  libmq:demo:recv',
        'run the libmq demo server, recv message from server'
    );
}
