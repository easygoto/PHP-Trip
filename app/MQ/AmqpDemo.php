<?php

namespace Trink\App\Trip\MQ;

use AMQPChannel;
use AMQPConnection;
use AMQPEnvelope;
use AMQPExchange;
use AMQPQueue;
use Exception;
use Trink\Core\Component\Logger;
use Trink\Frame\Container\App;

class AmqpDemo
{
    public const EXCHANGE_NAME = 'test_amqp_exchange_00';
    public const QUEUE_NAME = 'test_amqp_queue_00';
    public const ROUTING_KEY = 'test_amqp_key';

    private ?AMQPConnection $conn;
    private ?AMQPChannel $channel;
    private ?AMQPExchange $exchange;
    private ?AMQPQueue $queue;

    public function __construct()
    {
        $this->conn = new AMQPConnection(App::instance()->setting->get('rabbit'));
        try {
            $this->conn->connect() or die("不能连接!\n");
            $this->channel = new AMQPChannel($this->conn);

            $this->exchange = new AMQPExchange($this->channel);
            $this->exchange->setName(self::EXCHANGE_NAME);
            $this->exchange->setType(AMQP_EX_TYPE_DIRECT);
            $this->exchange->setFlags(AMQP_DURABLE);
            $this->exchange->declareExchange();

            $this->queue = new AMQPQueue($this->channel);
            $this->queue->setName(self::QUEUE_NAME);
            $this->queue->setFlags(AMQP_DURABLE);
            $this->queue->declareQueue();

            $this->queue->bind(self::EXCHANGE_NAME, self::ROUTING_KEY);
        } catch (Exception $e) {
        }
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->conn->disconnect();
    }

    public function send()
    {
        try {
            for ($i = 2e5; $i > 0; $i--) {
                flush();
                $message = md5(uniqid(microtime()));
                $result = $this->exchange->publish($message, self::ROUTING_KEY);
                Logger::println("Send Message: {$message}, " . ($result ? 'success' : 'fail'));
            }
        } catch (Exception $e) {
        }
    }

    public function recv()
    {
        try {
            while (true) {
                $this->queue->consume([$this, 'handleMessage'], AMQP_AUTOACK);
            }
        } catch (Exception $e) {
        }
    }

    public function handleMessage(AMQPEnvelope $envelope)
    {
        try {
            flush();
            Logger::println('Receive: ' . $envelope->getBody());
        } catch (Exception $e) {
        }
    }
}
