<?php

namespace Trink\App\Trip\Swoole;

use Swoole\Server;
use Trink\Core\Component\Logger;

class AsyncTcpServer
{
    protected ?Server $server = null;

    protected string $host = '';
    protected int $port = 0;

    public function __construct(string $host = '0.0.0.0', int $port = 9501)
    {
        $this->host = $host;
        $this->port = $port;

        $this->server = new Server($host, $port);
        $this->server->set(
            [
                'reactor_num' => 12,
                'worker_num' => 12,
                'task_worker_num' => 24,
                'max_request' => 1024,
            ]
        );

        $this->server->on('start', [$this, 'handleStart']);
        $this->server->on('connect', [$this, 'handleConnect']);
        $this->server->on('receive', [$this, 'handleReceive']);
        $this->server->on('close', [$this, 'handleClose']);
        $this->server->on('task', [$this, 'handleTask']);
        $this->server->on('finish', [$this, 'handleFinish']);
    }

    public function run()
    {
        $this->server->start();
    }

    public function handleStart(Server $server)
    {
        Logger::println("Swoole TCP Server is started at http://{$this->host}:{$this->port}");
    }

    public function handleConnect(Server $server, int $fd, int $reactorId)
    {
        Logger::println("client {$fd} connect ...");
    }

    public function handleReceive(Server $server, int $fd, int $reactorId, string $data)
    {
        $server->task(['fd' => $fd, 'data' => $data]);
        Logger::println("client {$fd} send message, but redirect to task ...");
    }

    public function handleClose(Server $server, int $fd, int $reactorId)
    {
        Logger::println("client {$fd} close ...");
    }

    public function handleTask(Server $server, int $taskId, int $srcWorkerId, $data)
    {
        usleep(rand(2e5, 2e6));
        ['fd' => $fd, 'data' => $data] = $data;
        $sign = md5(uniqid($data));
        $server->send($fd, $sign);
        Logger::println("taskId {$taskId} task ...");
        $server->finish($sign);
    }

    public function handleFinish(Server $server, int $taskId, string $data)
    {
        Logger::println("taskId {$taskId} finish, sign : " . $data);
    }
}
