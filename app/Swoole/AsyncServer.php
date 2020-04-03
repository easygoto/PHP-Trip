<?php

namespace Trink\App\Trip\Swoole;

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Server;
use Swoole\WebSocket\Frame;

interface AsyncServer
{
    public function handleStart(Server $server);

    public function handleShutdown(Server $server);

    // 不属于 HTTP/UDP 的方法
    public function handleConnect(Server $server, int $fd, int $reactorId);

    public function handleClose(Server $server, int $fd, int $reactorId);

    // 属于 HTTP/WS 的方法
    public function handleRequest(Request $request, Response $response);

    // 属于 WS 的方法
    public function handleOpen(Server $server, Request $request);

    // 属于 WS 的方法
    public function handleMessage(Server $server, Frame $frame);

    // 属于 WS 的方法
    public function handleHandShake(Request $request, Response $response);

    // 属于 TCP 的方法
    public function handleReceive(Server $server, int $fd, int $reactorId, string $data);

    // 属于 UDP 的方法
    public function handlePacket(Server $server, string $data, array $clientInfo);

    // 涉及 task 必实现的方法
    public function handleTask(Server $server, int $taskId, int $srcWorkerId, $data);

    public function handleFinish(Server $server, int $taskId, string $data);

    public function handlePipeMessage(Server $server, int $srcWorkerId, $message);

    public function handleWorkerStart(Server $server, int $workerId);

    public function handleWorkerStop(Server $server, int $workerId);

    public function handleWorkerExit(Server $server, int $workerId);

    public function handleWorkerError(Server $server, int $workerId, int $workerPid, int $exitCode, int $signal);

    public function handleManagerStart(Server $server);

    public function handleManagerStop(Server $server);
}
