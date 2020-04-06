<?php

namespace Trink\App\Trip\MQ;

use AMQPChannel;
use AMQPConnection;
use AMQPExchange;
use AMQPQueue;
use Exception;
use Trink\Core\Component\Logger;
use Trink\Frame\Container\App;

class AmqpBench
{
    public const EXCHANGE_NAME = 'test.amqp.exchange.bench';

    private ?AMQPConnection $conn;
    private ?AMQPChannel $channel;
    private ?AMQPExchange $exchange;
    private ?AMQPQueue $queue;

    private array $argv = [];

    public function __construct($argv = [])
    {
        $this->argv = $argv;
        $this->conn = new AMQPConnection(App::instance()->setting->get('rabbit'));
        try {
            $this->conn->connect() or die("不能连接!\n");
            $this->channel = new AMQPChannel($this->conn);

            $this->exchange = new AMQPExchange($this->channel);
            $this->exchange->setType(AMQP_EX_TYPE_FANOUT);
            $this->exchange->setFlags(AMQP_AUTODELETE);
            $this->exchange->setName(self::EXCHANGE_NAME);
            $this->exchange->declareExchange();

            $this->queue = new AMQPQueue($this->channel);
            $this->queue->setFlags(AMQP_AUTODELETE);
            $this->queue->declareQueue();

            $this->queue->bind($this->exchange->getName());
        } catch (Exception $e) {
            Logger::println($e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->conn->disconnect();
    }

    public function run()
    {
        $iterations = max((int)($this->argv[2] ?? 1e4), 0);

        // 生产
        Logger::println("running {$iterations} iterations:");
        $message = str_shuffle(str_repeat(md5(uniqid()), 10));
        $timer = microtime(true);
        try {
            for ($i = 0; $i < $iterations; $i++) {
                $this->exchange->publish($message);
            }
        } catch (Exception $e) {
            Logger::println($e->getMessage());
        }
        $timer = microtime(true) - $timer;
        Logger::println("Publish: {$iterations} iterations took {$timer}s");

        // 消费
        $consumerIterations = $iterations;
        $timer = microtime(true);
        try {
            $this->queue->consume(
                function () use (&$consumerIterations) {
                    return (--$consumerIterations > 0);
                },
                AMQP_AUTOACK
            );
        } catch (Exception $e) {
            Logger::println($e->getMessage());
        }
        $timer = microtime(true) - $timer;
        Logger::println("Consume: {$iterations} iterations took {$timer}s");

        try {
            $this->queue->delete();
            $this->exchange->delete();
        } catch (Exception $e) {
            Logger::println($e->getMessage());
        }
    }
}
