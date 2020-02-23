<?php


namespace Trink\Core\Component\Swoole;

use Swoole\Http\Request;
use Swoole\Timer;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;
use Trink\Core\Component\Logger;

class WebSocket
{
    protected array $clientList = [];

    public function __construct(string $host = '0.0.0.0', int $port = 9504)
    {
        $ws = new Server($host, $port);
        $ws->set([
            'worker_num'      => 8,
            'task_worker_num' => 16,
        ]);

        $ws->on('open', [$this, 'handleOpen']);
        $ws->on('message', [$this, 'handleMessage']);
        $ws->on('task', [$this, 'handleTask']);
        $ws->on('finish', [$this, 'handleFinish']);
        $ws->on('close', [$this, 'handleClose']);

        $ws->start();
    }

    public function handleTask(Server $ws, int $taskId, int $workerId, $data)
    {
        sleep(3);
        Logger::println([$taskId, $workerId, $data]);
        ob_flush();
        flush();
        return "finish";
    }

    public function handleFinish(Server $ws, int $taskId, string $data)
    {
        Logger::println("{$taskId} : {$data}");
    }

    public function handleOpen(Server $ws, Request $request)
    {
        Logger::println($request);
        $ws->push($request->fd, "hello, welcome\n");

        Timer::tick(3000, function (int $timerId) use ($ws, $request) {
            $fd = $request->fd;
            $client = $this->clientList[$fd] ?? [];
            $client['initTimerId'] = $timerId;
            $this->clientList[$fd] = $client;
            Logger::println("{$timerId} : test");
            $ws->push($fd, json_encode(['status' => 0, 'event' => 'test', 'msg' => 'server: tick send...']));
        });
    }

    public function handleMessage(Server $ws, Frame $frame)
    {
        Logger::println("Message: {$frame->data}");
        $ws->task(['taskId' => uniqid(), 'fd' => $frame->fd]);

        // 延时发送数据(异步)
        Timer::after(3000, function () use ($ws, $frame) {
            $ws->push($frame->fd, json_encode(['status' => 0, 'event' => 'test', 'msg' => 'server: after send...']));
        });

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
}
