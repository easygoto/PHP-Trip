<?php


namespace Test\Trip\Core;

use Swoole\Async;
use Swoole\Coroutine;
use Swoole\Coroutine\MySQL;
use Swoole\Coroutine\Redis;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server as HttpServer;
use Swoole\Process;
use Swoole\Process\Pool;
use Swoole\Server;
use Test\Trip\TestCase;
use Trink\Core\Component\Logger;
use Trink\Core\Component\Swoole\WebSocket;
use Trink\Frame\Container\App;

class SwooleTest extends TestCase
{
    private string $host = '0.0.0.0';

    public function test()
    {
        var_dump(class_exists('\Swoole\Async'));
        var_dump(class_exists('\Swoole\Redis\Server'));
        var_dump(class_exists('\Swoole\Coroutine\Redis'));
        var_dump(class_exists('\Swoole\Coroutine\MySQL'));
        var_dump(class_exists('\Swoole\Process'));
        $this->assertTrue(true);
    }

    /**
     * @test
     *
     * 多进程不停的往 redis 中加数据
     */
    public function processPool()
    {
        $workerNum = 10;
        $pool = new Pool($workerNum);

        $handleWorkerStart = function (Pool $pool, $workerId) {
            $redisConfig = App::instance()->setting->get('redis');
            Logger::println("Worker#{$workerId} is started");
            $redis = new \Redis();
            $redis->pconnect($redisConfig['host'], $redisConfig['port']);
            $redis->auth($redisConfig['pass']);
            $key = uniqid();
            for ($i = 0; $i < 10; $i++) {
                $redis->lPush($key, rand(1e6, 1e7 - 1));
            }
            ob_flush();
            flush();
        };
        $handleWorkerStop = function (Pool $pool, $workerId) {
            Logger::println("Worker#{$workerId} is stopped");
            ob_flush();
            flush();
        };

        $pool->on("WorkerStart", $handleWorkerStart);
        $pool->on("WorkerStop", $handleWorkerStop);
        $pool->start();

        $this->assertTrue(true);
    }

    /**
     * @test
     *
     * 进程使用管道读写数据
     */
    public function process()
    {
        /** @var Process[] $workerList */
        $workerList = [];
        for ($n = 1; $n <= 3; $n++) {
            $process = new Process(function (Process $process) use ($n) {
                sleep($n);
                $process->write("Child #" . getmypid() . " start and sleep {$n}s");
            }, true);
            $pid = $process->start();
            $workerList["$pid"] = $process;
        }

        foreach ($workerList as $worker) {
            Logger::println($worker->read());
            ob_flush();
            flush();
        }

        for ($n = 11; $n--;) {
            $status = Process::wait(true);
            if (!$status) {
                continue;
            }
            Logger::println($status);
        }

        Logger::println('Parent #' . getmypid() . ' exit');
        $this->assertTrue(true);
    }

    /** @test */
    public function file()
    {
        Async::readFile(TEMP_DIR . 'read.txt', function ($filename, $content) {
            echo "read file path: {$filename}\n";
            echo "read file content: {$content}\n";
        });
        Async::writeFile(TEMP_DIR . 'write.txt', 'hello swoole', function ($filename) {
            echo "write file path: {$filename}\n";
        });
        echo "start\n";
        $this->assertTrue(true);
    }

    /** @test */
    public function mysql()
    {
        Coroutine::create(function () {
            $db = new MySQL();
            $dbConfig = App::instance()->setting->get('db');
            $db->connect([
                'host'     => $dbConfig['host'],
                'port'     => $dbConfig['port'],
                'user'     => $dbConfig['user'],
                'password' => $dbConfig['pass'],
                'database' => $dbConfig['dbname'],
            ]);
            $res = $db->query("select sleep(1)");
            var_dump($res);
        });
        echo 'start';
        $this->assertTrue(true);
    }

    /** @test */
    public function redis()
    {
        Coroutine::create(function () {
            $redis = new Redis();
            $redisConfig = App::instance()->setting->get('redis');
            $redis->connect($redisConfig['host'], $redisConfig['port']);
            $redis->auth($redisConfig['pass']);
            $res = $redis->get('key');
            $allKeyList = $redis->keys('*');
            var_dump($res, $allKeyList);
        });
        echo 'start';
        $this->assertTrue(true);
    }

    /** @test */
    public function tcpServer()
    {
        $handleConnect = function (Server $server, int $fd, int $reactorId) {
            echo "Client({$reactorId} - {$fd}): Connect.\n";
        };
        $handleReceive = function (Server $server, int $fd, int $reactorId, string $data) {
            $msg = "Client({$reactorId} - {$fd}): {$data}.\n";
            $server->send($fd, $msg);
            echo $msg;
        };
        $handleClose = function (Server $server, int $fd, int $reactorId) {
            echo "Client({$reactorId} - {$fd}): Close.\n";
        };

        $server = new Server($this->host, 9501);
        $server->set([
            'worker_num'  => 8,
            'max_request' => 1e4,
        ]);
        $server->on('Connect', $handleConnect);
        $server->on('Receive', $handleReceive);
        $server->on('Close', $handleClose);
        $server->start();

        $this->assertTrue(true);
    }

    /** @test */
    public function udpServer()
    {
        $handlePacket = function (Server $server, string $data, array $clientInfo) {
            $server->sendto($clientInfo['address'], $clientInfo['port'], "Server " . $data);
            echo json_encode($clientInfo) . ": {$data}\n";
        };

        $server = new Server($this->host, 9502, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);
        $server->on('Packet', $handlePacket);
        $server->start();

        $this->assertTrue(true);
    }

    /** @test */
    public function httpServer()
    {
        $handleRequest = function (Request $request, Response $response) {
            if ($request->server['path_info'] == '/favicon.ico' || $request->server['request_uri'] == '/favicon.ico') {
                return $response->end();
            }
            $info = json_encode($request);
            $response->header("Content-Type", "text/html; charset=utf-8");
            return $response->end("<h1>Hello Swoole. #" . rand(1000, 9999) . "</h1><pre>{$info}</pre>");
        };

        $http = new HttpServer($this->host, 9503);
        $http->on('request', $handleRequest);
        $http->start();
    }

    /** @test */
    public function webSocketServer()
    {
        new WebSocket();
        $this->assertTrue(true);
    }
}
