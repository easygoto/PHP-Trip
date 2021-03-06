<?php

namespace Trink\App\Trip\MQ;

use ErrorException;
use Exception;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;
use Trink\Core\Component\Logger;
use Trink\Frame\Container\App;

class LibMqDemo
{
    public const EXCHANGE_NAME = 'test_libmq_exchange_00';
    public const QUEUE_NAME = 'test_libmq_queue_00';
    public const ROUTING_KEY = 'test_libmq_key';

    private ?AMQPStreamConnection $conn = null;
    private ?AMQPChannel $channel = null;

    private array $argv = [];

    public function __construct($argv = [])
    {
        $this->argv = $argv;
        $rabbitCnf = App::instance()->setting->get('rabbit');
        $this->conn = new AMQPStreamConnection(
            $rabbitCnf['host'],
            $rabbitCnf['port'],
            $rabbitCnf['login'],
            $rabbitCnf['password'],
            $rabbitCnf['vhost']
        );
        $this->channel = $this->conn->channel();
        $this->channel->exchange_declare(self::EXCHANGE_NAME, AMQPExchangeType::DIRECT, false, true, false);
        $this->channel->queue_declare(self::QUEUE_NAME, false, true, false, false);
        $this->channel->queue_bind(self::QUEUE_NAME, self::EXCHANGE_NAME, self::ROUTING_KEY);
    }

    public function __destruct()
    {
        try {
            $this->channel->close();
            $this->conn->close();
        } catch (Exception $e) {
        }
    }

    public function send()
    {
        $count = max($this->argv[2] ?? 1e4, 0);
        for ($i = $count; $i > 0; $i--) {
            flush();
            $content = md5(uniqid(microtime()));
            $message = new AMQPMessage($content);
            $this->channel->basic_publish($message, self::EXCHANGE_NAME, self::ROUTING_KEY);
            Logger::println("Send Message: {$content}");
        }
    }

    public function recv()
    {
        $count = max($this->argv[2] ?? 1e4, 0);
        $this->channel->basic_consume(self::QUEUE_NAME, '', false, true, false, false, [$this, 'handleMessage']);
        while ($this->channel->is_consuming() && (--$count >= 0)) {
            try {
                $this->channel->wait();
            } catch (ErrorException $e) {
            }
        }
    }

    public function handleMessage(AMQPMessage $message)
    {
        flush();
        Logger::println('Receive: ' . $message->body);
    }
}
