<?php


namespace Test\Net;

class SocketTest extends TestCase
{
    /** @test */
    public function tcpServer()
    {
        $server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_bind($server, "192.168.0.173", 9696);
        socket_listen($server);
        $logFilename = __DIR__ . '/debug/' . date('Y_m_d_H_i_s') . '.log';
        $clientLinkNum = 0;
        while ($clientLinkNum++ < 5) {
            $conn = socket_accept($server);
            socket_getpeername($conn, $address, $port);
            $uniqueKey = "{$address}:{$port}";
            $content = '';
            while (true) {
                $data = socket_read($conn, 1024);
                if ($data === '') {
                    break;
                }
                $content .= $data;
            }

            $logText = <<<LOG
address: {$uniqueKey}
content: {$content}
\n
LOG;
            file_put_contents($logFilename, $logText, FILE_APPEND);
        }
        socket_close($server);
        $this->assertTrue(true);
    }

    /** @test */
    public function tcpClient()
    {
        $linkNum = 5;
        while ($linkNum-- > 0) {
            $packageNum = 10;
            $client = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            socket_connect($client, "192.168.0.173", 9696);
            while ($packageNum-- > 0) {
                $rand = rand(1e4, 1e5 - 1);
                socket_write($client, "{$rand} ");
                usleep(1e5);
            }
            socket_close($client);
        }
        $this->assertTrue(true);
    }
}
