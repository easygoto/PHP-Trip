<?php

namespace Trink\App\Trip\Swoole;

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

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
        $this->server->on('handShake', [$this, 'handleHandShake']); # n
        $this->server->on('open', [$this, 'handleOpen']); # n
        $this->server->on('message', [$this, 'handleMessage']); # y
        $this->server->on('connect', [$this, 'handleConnect']);
        $this->server->on('receive', [$this, 'handleReceive']);
        $this->server->on('packet', [$this, 'handlePacket']);
        $this->server->on('close', [$this, 'handleClose']);
        $this->server->on('task', [$this, 'handleTask']);
        $this->server->on('finish', [$this, 'handleFinish']);
        $this->server->on('pipeMessage', [$this, 'handlePipeMessage']);
        $this->server->on('workerStart', [$this, 'handleWorkerStart']);
        $this->server->on('workerStop', [$this, 'handleWorkerStop']);
        $this->server->on('workerExit', [$this, 'handleWorkerExit']);
        $this->server->on('workerError', [$this, 'handleWorkerError']);
        $this->server->on('managerStart', [$this, 'handleManagerStart']);
        $this->server->on('managerStop', [$this, 'handleManagerStop']);
    }

    public function run()
    {
        $this->server->start();
    }

    public function handleStart(Server $server)
    {
    }

    public function handleShutdown(Server $server)
    {
    }

    public function handleHandShake(Request $request, Response $response)
    {
    }

    public function handleOpen(Server $server, Request $request)
    {
    }

    public function handleMessage(Server $server, Frame $frame)
    {
    }

    public function handleConnect(Server $server, int $fd, int $reactorId)
    {
    }

    public function handleReceive(Server $server, int $fd, int $reactorId, string $data)
    {
    }

    public function handlePacket(Server $server, string $data, array $clientInfo)
    {
    }

    public function handleClose(Server $server, int $fd, int $reactorId)
    {
    }

    public function handleTask(Server $server, int $taskId, int $srcWorkerId, $data)
    {
    }

    public function handleFinish(Server $server, int $taskId, string $data)
    {
    }

    public function handlePipeMessage(Server $server, int $srcWorkerId, $message)
    {
    }

    public function handleWorkerStart(Server $server, int $workerId)
    {
    }

    public function handleWorkerStop(Server $server, int $workerId)
    {
    }

    public function handleWorkerExit(Server $server, int $workerId)
    {
    }

    public function handleWorkerError(Server $server, int $workerId, int $workerPid, int $exitCode, int $signal)
    {
    }

    public function handleManagerStart(Server $server)
    {
    }

    public function handleManagerStop(Server $server)
    {
    }
}
