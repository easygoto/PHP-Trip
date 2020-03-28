<?php

namespace Trink\App\Trip\Swoole;

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;
use Trink\Core\Component\Logger;

class HttpServer
{
    protected ?Server $server = null;

    protected string $host = '';
    protected int $port = 0;

    public function __construct(string $host = '0.0.0.0', int $port = 9501)
    {
        $this->host = $host;
        $this->port = $port;

        $this->server = new Server($host, $port);
        $this->server->set(['worker_num' => 8, 'task_worker_num' => 16, 'max_request' => 32]);
        $this->server->on('start', [$this, 'handleStart']);
        $this->server->on('task', [$this, 'handleTask']);
        $this->server->on('request', [$this, 'handleRequest']);
    }

    public function run()
    {
        $this->server->start();
    }

    public function handleStart(Server $server)
    {
        Logger::println('Swoole http server is started at http://' . $this->host . ':' . $this->port);
    }

    public function handleTask(Server $server, int $taskId, int $srcWorkerId, $data)
    {
        Logger::toFile(['server' => $server, 'taskId' => $taskId, 'srcWorkerId' => $srcWorkerId, 'data' => $data]);
    }

    public function handleRequest(Request $request, Response $response)
    {
        $requestUri = $request->server['request_uri'] ?? '';
        if ($request->server['path_info'] == '/favicon.ico' || $requestUri == '/favicon.ico') {
            $response->end();
            return;
        }
        $response->header('Content-Type', 'application/json');
        $response->end(json_encode(['status' => 0]));
        Logger::println($requestUri);
    }
}
