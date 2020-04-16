<?php

namespace Trink\App\Trip\Swoole;

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;
use Trink\Core\Component\Logger;

class AsyncWsServer
{
    protected ?Server $server = null;

    protected string $host = '';
    protected int $port = 0;

    public function __construct(string $host = '0.0.0.0', int $port = 9504)
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
        $this->server->on('shutdown', [$this, 'handleShutdown']);
        $this->server->on('open', [$this, 'handleOpen']); # n
        $this->server->on('message', [$this, 'handleMessage']); # y
        $this->server->on('connect', [$this, 'handleConnect']);
        $this->server->on('task', [$this, 'handleTask']);
        $this->server->on('finish', [$this, 'handleFinish']);
    }

    public function run()
    {
        $this->server->start();
    }

    public function handleStart(Server $server)
    {
        Logger::println("Swoole WebSocket Server is started at http://{$this->host}:{$this->port}");
    }

    public function handleShutdown(Server $server)
    {
        Logger::println('Swoole WebSocket Server is stopped ...');
    }

    public function handleOpen(Server $server, Request $request)
    {
        $server->push($request->fd, '初次见面, 请多关照 ^_^');
        Logger::println('WebSocket client join ...');
    }

    public function handleMessage(Server $server, Frame $frame)
    {
        $server->task(['frame' => $frame]);
        Logger::println('client send message, redirect to task ...');
    }

    public function handleConnect(Server $server, int $fd, int $reactorId)
    {
        Logger::println("client {$fd} join ...");
    }

    public function handleTask(Server $server, int $taskId, int $srcWorkerId, $data)
    {
        usleep(rand(1e5, 2e6));
        /** @var Frame $frame */
        $frame = $data['frame'];
        $sign = md5(uniqid($frame->data));
        $server->push($frame->fd, $sign);
        Logger::println("handle a task, taskId : {$taskId}, srcWorkerId : {$srcWorkerId}");
        $server->finish($sign);
    }

    public function handleFinish(Server $server, int $taskId, string $data)
    {
        Logger::println("handle task finish, taskId : {$taskId}, data: {$data}");
    }
}
