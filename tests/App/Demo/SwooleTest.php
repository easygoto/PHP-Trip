<?php


namespace Test\Trip\App\Demo;

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Server;
use Test\Trip\TestCase;

class SwooleTest extends TestCase
{
    private string $host = '0.0.0.0';

    /** @test */
    public function tcpServer()
    {
        $handleConnect = function ($server, $fd) {
            echo "Client: Connect.\n";
        };
        $handleReceive = function (Server $server, $fd, $from_id, $data) {
            $server->send($fd, "Server: {$data}");
        };
        $handleClose = function ($server, $fd) {
            echo "Client: Close.\n";
        };

        $server = new Server($this->host, 9501);
        $server->on('Connect', $handleConnect);
        $server->on('Receive', $handleReceive);
        $server->on('Close', $handleClose);
        $server->start();

        $this->assertTrue(true);
    }

    /** @test */
    public function udpServer()
    {
        $handlePacket = function (Server $server, $data, $clientInfo) {
            $server->sendto($clientInfo['address'], $clientInfo['port'], "Server " . $data);
            var_dump($clientInfo);
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
                return null;
            }
            var_dump($request->server['request_method'], $request->get, $request->post);
            $response->header("Content-Type", "text/html; charset=utf-8");
            $response->end("<h1>Hello Swoole. #" . rand(1000, 9999) . "</h1>");
        };

        $http = new \Swoole\Http\Server($this->host, 9501);
        $http->on('request', $handleRequest);
        $http->start();
    }

    /** @test */
    public function webSocketServer()
    {
        $handleOpen = function (\Swoole\WebSocket\Server $ws, Request $request) {
            var_dump($request->fd, $request->get, $request->server);
            $ws->push($request->fd, "hello, welcome\n");
        };
        $handleMessage = function (\Swoole\WebSocket\Server $ws, $frame) {
            echo "Message: {$frame->data}\n";
            $ws->push($frame->fd, "server: {$frame->data}");
        };
        $handleClose = function (\Swoole\WebSocket\Server $ws, $fd) {
            echo "client-{$fd} is closed\n";
        };

        $ws = new \Swoole\WebSocket\Server($this->host, 9502);
        $ws->on('open', $handleOpen);
        $ws->on('message', $handleMessage);
        $ws->on('close', $handleClose);
        $ws->start();

        $this->assertTrue(true);
    }
}
