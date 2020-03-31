<?php

namespace Trink\App\Trip\Swoole;

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;
use Trink\Core\Component\Logger;

class AsyncHttpServer
{
    protected ?Server $server = null;

    protected string $host = '';
    protected int $port = 0;

    public function __construct(string $host = '0.0.0.0', int $port = 9503)
    {
        $this->host = $host;
        $this->port = $port;

        $this->server = new Server($host, $port);
        $this->server->set(['worker_num' => 8, 'task_worker_num' => 16, 'max_request' => 32]);

        $this->server->on('start', [$this, 'handleStart']);
        $this->server->on('shutdown', [$this, 'handleShutdown']);
        $this->server->on('request', [$this, 'handleRequest']);
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

    public function handleStart(Server $server)
    {
        Logger::println("Swoole Http Server is started at http://{$this->host}:{$this->port}");
    }

    public function handleShutdown(Server $server)
    {
        Logger::println('Swoole Http Server is stopped');
    }

    public function handleRequest(Request $request, Response $response)
    {
        $requestUri = $request->server['request_uri'] ?? '';
        if ($request->server['path_info'] == '/favicon.ico' || $requestUri == '/favicon.ico') {
            return $response->end();
        }
        Logger::println($requestUri);
        $response->header('Content-Type', 'application/json');
        return $response->end(json_encode(['status' => rand(1e3, 1e4 - 1)]));
    }

    public function handlePacket(Server $server, string $data, array $clientInfo)
    {
    }

    public function handleClose(Server $server, int $fd, int $reactorId)
    {
    }

    public function handleTask(Server $server, int $taskId, int $srcWorkerId, $data)
    {
        Logger::toFile(['server' => $server, 'taskId' => $taskId, 'srcWorkerId' => $srcWorkerId, 'data' => $data]);
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
