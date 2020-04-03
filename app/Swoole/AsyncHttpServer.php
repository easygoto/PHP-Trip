<?php

namespace Trink\App\Trip\Swoole;

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;
use Trink\Core\Component\Logger;
use Trink\Frame\Container\SWeb;

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
        $this->server->set(
            [
                'reactor_num' => 24,
                'worker_num' => 24,
                'task_worker_num' => 96,
                'max_request' => 1024,
                'max_connection' => 10240,
            ]
        );

        $this->server->on('start', [$this, 'handleStart']);
        $this->server->on('shutdown', [$this, 'handleShutdown']);
        $this->server->on('request', [$this, 'handleRequest']);
        $this->server->on('task', [$this, 'handleTask']);
    }

    public function run()
    {
        $this->server->start();
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

        $_SERVER = $_COOKIE = $_GET = $_POST = $_FILES = [];
        if ($request->server) {
            foreach ($request->server as $key => $item) {
                $_SERVER[strtoupper($key)] = $item;
            }
        }
        if ($request->cookie) {
            foreach ($request->cookie as $key => $item) {
                $_COOKIE[$key] = $item;
            }
        }
        if ($request->get) {
            foreach ($request->get as $key => $item) {
                $_GET[$key] = $item;
            }
        }
        if ($request->post) {
            foreach ($request->post as $key => $item) {
                $_POST[$key] = $item;
            }
        }
        if ($request->files) {
            foreach ($request->files as $key => $item) {
                $_FILES[$key] = $item;
            }
        }
        Logger::println($requestUri);
        $response->setHeader('Content-Type', 'application/json');
        return $response->end(SWeb::run((array)$request));
    }

    public function handleTask(Server $server, int $taskId, int $srcWorkerId, $data)
    {
    }
}
