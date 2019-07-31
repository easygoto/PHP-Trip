<?php


namespace Test\Trip\App\Demo;

use AMQPChannel;
use AMQPChannelException;
use AMQPConnection;
use AMQPConnectionException;
use AMQPEnvelope;
use AMQPEnvelopeException;
use AMQPExchange;
use AMQPExchangeException;
use AMQPQueue;
use AMQPQueueException;
use Test\Trip\TestCase;
use Trink\Core\Library\Config;

class RabbitTest extends TestCase
{
    const E_NAME    = 'e_trink';
    const Q_NAME    = 'q_trink';
    const KEY_ROUTE = 'key';

    /**
     * 消费回调函数
     * 处理消息
     *
     * @param AMQPEnvelope $envelope
     * @param AMQPQueue    $queue
     */
    public static function processMessage(AMQPEnvelope $envelope, AMQPQueue $queue)
    {
        try {
            ob_flush();
            $msg = $envelope->getBody();
            echo $msg . "\n"; //处理消息
            $queue->ack($envelope->getDeliveryTag()); //手动发送ACK应答
        } catch (AMQPChannelException $e) {
        } catch (AMQPConnectionException $e) {
        }
    }

    public function test()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function send()
    {
        try {
            $conn = new AMQPConnection(Config::instance()->rabbit);
            $conn->connect() or die("不能连接!\n");
            $channel = new AMQPChannel($conn);

            //创建交换机对象
            $ex = new AMQPExchange($channel);
            $ex->setName(self::E_NAME);

            //$channel->startTransaction(); //开始事务
            while (true) {
                usleep(rand(100000, 500000));

                //消息内容
                $ip      = rand(1, 255) . '.' . rand(1, 255) . '.' . rand(1, 255) . '.' . rand(1, 255);
                $message = "测试消息_" . date("Y-m-d H:i:s") . ", 这个是 {$ip} 发送的";
                $bool    = $ex->publish($message, self::KEY_ROUTE);
                ob_flush();
                echo "Send Message: " . ($bool ? '入队成功' : '入队失败') . "\n";
            }
            //$channel->commitTransaction(); //提交事务

            $conn->disconnect();
        } catch (AMQPConnectionException $e) {
        } catch (AMQPExchangeException $e) {
        } catch (AMQPChannelException $e) {
        }
        $this->assertTrue(true);
    }

    /** @test */
    public function customer()
    {
        try {
            $conn = new AMQPConnection(Config::instance()->rabbit);
            $conn->connect() or die("不能连接!\n");
            $channel = new AMQPChannel($conn);

            //创建交换机
            $ex = new AMQPExchange($channel);
            $ex->setName(self::E_NAME);
            $ex->setType(AMQP_EX_TYPE_DIRECT); //direct类型
            $ex->setFlags(AMQP_DURABLE); //持久化
            echo "Exchange Status:" . $ex->declareExchange() . "\n";

            //创建队列
            $q = new AMQPQueue($channel);
            $q->setName(self::Q_NAME);
            $q->setFlags(AMQP_DURABLE); //持久化
            echo "Message Total:" . $q->declareQueue() . "\n";

            //绑定交换机与队列，并指定路由键
            echo 'Queue Bind: ' . $q->bind(self::E_NAME, self::KEY_ROUTE) . "\n";

            //阻塞模式接收消息
            echo "Message:\n";
            while (true) {
                $q->consume('Test\Trip\demo\RabbitTest::processMessage');
                //$q->consume('Test\Trip\demo\RabbitTest::processMessage', AMQP_AUTOACK); //自动ACK应答
            }
            $conn->disconnect();
        } catch (AMQPConnectionException $e) {
        } catch (AMQPExchangeException $e) {
        } catch (AMQPQueueException $e) {
        } catch (AMQPChannelException $e) {
        } catch (AMQPEnvelopeException $e) {
        }
        $this->assertTrue(true);
    }
}
