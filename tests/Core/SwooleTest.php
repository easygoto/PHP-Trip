<?php


namespace Test\Trip\Core;

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server as HttpServer;
use Swoole\Server;
use Test\Trip\TestCase;
use Trink\Core\Component\Swoole\WebSocket;

class SwooleTest extends TestCase
{
    private string $host = '0.0.0.0';

    /** @test */
    public function tcpServer()
    {
        $handleConnect = function (Server $server, int $fd, int $reactorId) {
            echo "Client({$reactorId} - {$fd}): Connect.\n";
        };
        $handleReceive = function (Server $server, int $fd, int $reactorId, string $data) {
            $msg = "Client({$reactorId} - {$fd}): {$data}.\n";
            $server->send($fd, $msg);
            echo $msg;
        };
        $handleClose = function (Server $server, int $fd, int $reactorId) {
            echo "Client({$reactorId} - {$fd}): Close.\n";
        };

        $server = new Server($this->host, 9501);
        $server->set([
            'worker_num'  => 8,
            'max_request' => 1e4,
        ]);
        $server->on('Connect', $handleConnect);
        $server->on('Receive', $handleReceive);
        $server->on('Close', $handleClose);
        $server->start();

        $this->assertTrue(true);
    }

    /** @test */
    public function udpServer()
    {
        $handlePacket = function (Server $server, string $data, array $clientInfo) {
            $server->sendto($clientInfo['address'], $clientInfo['port'], "Server " . $data);
            echo json_encode($clientInfo) . ": {$data}\n";
        };

        $server = new Server($this->host, 9502, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);
        $server->on('Packet', $handlePacket);
        $server->start();

        $this->assertTrue(true);
    }

    /** @test */
    public function httpServer()
    {
        $handleRequest = function (Request $request, Response $response) {
            if ($request->server['path_info'] == '/favicon.ico' || $request->server['request_uri'] == '/favicon.ico') {
                return $response->end();
            }
            $info = json_encode($request);
            $response->header("Content-Type", "text/html; charset=utf-8");
            return $response->end("<h1>Hello Swoole. #" . rand(1000, 9999) . "</h1><pre>{$info}</pre>");
        };

        $http = new HttpServer($this->host, 9503);
        $http->on('request', $handleRequest);
        $http->start();
    }

    /** @test */
    public function webSocketServer()
    {
        new WebSocket();
        $this->assertTrue(true);
    }
}
