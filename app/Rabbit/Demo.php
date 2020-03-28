<?php

namespace Trink\App\Trip\Rabbit;

use ErrorException;
use Exception;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Trink\Core\Component\Logger;
use Trink\Frame\Container\App;

class Demo
{
    private const ROUTING_KEY = 'test00';
    private const QUEUE_NAME  = 'test00';

    private ?AMQPStreamConnection $connection = null;

    public function __construct()
    {
        $rabbitCnf = App::instance()->setting->get('rabbit');
        $this->connection = new AMQPStreamConnection(
            $rabbitCnf['host'],
            $rabbitCnf['port'],
            $rabbitCnf['login'],
            $rabbitCnf['password'],
            $rabbitCnf['vhost']
        );
    }

    public function __destruct()
    {
        try {
            $this->connection->close();
        } catch (Exception $e) {
        }
    }

    public function send()
    {
        $channel = $this->connection->channel();
        $channel->queue_declare(self::QUEUE_NAME, false, false, false, false);

        for ($i = 5e4; $i > 0; $i--) {
            $content = md5(uniqid(microtime()));
            $message = new AMQPMessage($content);
            $channel->basic_publish($message, '', self::ROUTING_KEY);
            Logger::println('[x] Sent: ' . $content);
        }
        $channel->close();
    }

    public function recv()
    {
        $channel = $this->connection->channel();
        $channel->queue_declare(self::QUEUE_NAME, false, false, false, false);
        $callback = function (AMQPMessage $message) {
            flush();
            Logger::println('[x] Received: ' . $message->body);
        };
        $channel->basic_consume(self::QUEUE_NAME, '', false, true, false, false, $callback);
        while ($channel->is_consuming()) {
            try {
                $channel->wait();
            } catch (ErrorException $e) {
            }
        }
        $channel->close();
    }
}
