<?php

namespace Trink\App\Trip\Swoole;

use Swoole\Http\Request;
use Swoole\Timer;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;
use Trink\Core\Component\Logger;

class WsServer
{
    protected ?Server $server = null;
    protected array $clientList = [];

    protected string $host = '';
    protected int $port = 0;

    protected int $heartBeatTime = 10000;

    public function __construct(string $host = '0.0.0.0', int $port = 9504)
    {
        $this->host = $host;
        $this->port = $port;

        $this->server = new Server($host, $port);
        $this->server->set(['worker_num' => 8, 'task_worker_num' => 16]);
        $this->server->on('open', [$this, 'handleOpen']);
        $this->server->on('message', [$this, 'handleMessage']);
        $this->server->on('task', [$this, 'handleTask']);
        $this->server->on('finish', [$this, 'handleFinish']);
        $this->server->on('close', [$this, 'handleClose']);
    }

    public function run()
    {
        Logger::println("Websocket open on - {$this->host}:{$this->port}");
        $this->server->start();
    }

    public function handleOpen(Server $ws, Request $request)
    {
        Logger::println($request);
        $ws->push($request->fd, "hello, welcome\n");

        Timer::tick(
            $this->heartBeatTime,
            function (int $timerId) use ($ws, $request) {
                $fd = $request->fd;
                $client = $this->clientList[$fd] ?? [];
                $client['initTimerId'] = $timerId;
                $this->clientList[$fd] = $client;
                Logger::println("{$timerId} : test");
                $ws->push($fd, json_encode(['status' => 0, 'event' => 'test', 'msg' => 'server: tick send...']));
            }
        );
    }

    public function handleMessage(Server $ws, Frame $frame)
    {
        Logger::println("Message: {$frame->data}");
        $ws->task(['taskId' => uniqid(), 'fd' => $frame->fd]);

        // 延时发送数据(异步)
        Timer::after(
            3000,
            function () use ($ws, $frame) {
                $ws->push(
                    $frame->fd,
                    json_encode(['status' => 0, 'event' => 'test', 'msg' => 'server: after send...'])
                );
            }
        );

        $ws->push($frame->fd, "server: {$frame->data}");
    }

    public function handleClose(Server $ws, int $fd)
    {
        $initTimerId = $this->clientList["$fd"]['initTimerId'] ?? 0;
        if ($initTimerId) {
            Timer::clear($initTimerId);
            unset($this->clientList["$fd"]);
        }
        Logger::println("client-{$fd} is closed");
    }

    public function handleTask(Server $ws, int $taskId, int $workerId, $data)
    {
        sleep(3);
        Logger::println([$taskId, $workerId, $data]);
        flush();
        return "finish";
    }

    public function handleFinish(Server $ws, int $taskId, string $data)
    {
        Logger::println("{$taskId} : {$data}");
    }
}
