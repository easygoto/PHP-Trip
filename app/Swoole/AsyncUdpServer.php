<?php

namespace Trink\App\Trip\Swoole;

use Swoole\Server;
use Trink\Core\Component\Logger;

class AsyncUdpServer
{
    protected ?Server $server = null;

    protected string $host = '';
    protected int $port = 0;

    public function __construct(string $host = '0.0.0.0', int $port = 9502)
    {
        $this->host = $host;
        $this->port = $port;

        $this->server = new Server($host, $port, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);
        $this->server->set(
            [
                'reactor_num' => 12,
                'worker_num' => 12,
                'task_worker_num' => 24,
                'max_request' => 1024,
            ]
        );

        $this->server->on('start', [$this, 'handleStart']);
        $this->server->on('packet', [$this, 'handlePacket']);
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
        Logger::println("Swoole UDP Server is started at http://{$this->host}:{$this->port}");
    }

    public function handlePacket(Server $server, string $data, array $clientInfo)
    {
        $server->task(['clientInfo' => $clientInfo, 'data' => $data]);
        Logger::print("client connect and send message, redirect to task ... {$data}");
        Logger::println($clientInfo);
    }

    public function handleClose(Server $server, int $fd, int $reactorId)
    {
        Logger::print("client {$fd} close ...");
    }

    public function handleTask(Server $server, int $taskId, int $srcWorkerId, $data)
    {
        usleep(rand(2e5, 2e6));
        ['clientInfo' => $clientInfo, 'data' => $content] = $data;
        $sign = md5(uniqid($content));
        $server->sendto($clientInfo['address'], $clientInfo['port'], $sign);
        Logger::println("taskId {$taskId} task ...");
        $server->finish($sign);
    }

    public function handleFinish(Server $server, int $taskId, string $data)
    {
        Logger::println("taskId {$taskId} finish, sign : " . $data);
    }
}
