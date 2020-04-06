<?php

namespace Trink\App\Trip\MQ;

use Exception;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;
use Trink\Core\Component\Logger;
use Trink\Frame\Container\App;

class LibMqBench
{
    public const EXCHANGE_NAME = 'test.libmq.exchange.bench';

    private ?AMQPStreamConnection $conn;
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
        $this->channel->exchange_declare(self::EXCHANGE_NAME, AMQPExchangeType::FANOUT, false, false, true);
        $this->channel->queue_declare('', false, false, false, true);
        $this->channel->queue_bind('', self::EXCHANGE_NAME);
    }

    public function __destruct()
    {
        try {
            $this->channel->close();
            $this->conn->close();
        } catch (Exception $e) {
            Logger::println($e->getMessage());
        }
    }

    public function run()
    {
        $iterations = max((int)($this->argv[2] ?? 1e4), 0);

        // 生产
        Logger::println("running {$iterations} iterations:");
        $content = str_shuffle(str_repeat(md5(uniqid()), 10));
        $message = new AMQPMessage($content);
        $timer = microtime(true);
        for ($i = 0; $i < $iterations; $i++) {
            $this->channel->basic_publish($message, self::EXCHANGE_NAME);
        }
        $timer = microtime(true) - $timer;
        Logger::println("Publish: {$iterations} iterations took {$timer}s");

        // 消费
        $consumerIterations = $iterations;
        $timer = microtime(true);
        $this->channel->basic_consume('', '', false, true, false, false);
        while ($this->channel->is_consuming() && (--$consumerIterations) >= 0) {
            try {
                $this->channel->wait();
            } catch (Exception $e) {
                Logger::println($e->getMessage());
            }
        }
        $timer = microtime(true) - $timer;
        Logger::println("Consume: {$iterations} iterations took {$timer}s");

        $this->channel->queue_delete();
        $this->channel->exchange_delete(self::EXCHANGE_NAME);
    }
}
