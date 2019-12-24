<?php


namespace Test\Net;

class FSockTest extends TestCase
{
    /** @test */
    public function httpHead()
    {
        echo $this->httpRequest(
            $this->hostname(),
            $this->returnJsonPath(),
            'HEAD'
        );
        $this->assertTrue(true);
    }

    /** @test */
    public function httpGet()
    {
        echo $this->httpRequest(
            $this->hostname(),
            $this->returnJsonPath(),
            'GET',
            http_build_query(['name' => '中文'])
        );
        $this->assertTrue(true);
    }

    /** @test */
    public function httpPost()
    {
        echo $this->httpRequest(
            $this->hostname(),
            $this->returnJsonPath(),
            'POST',
            json_encode(['name' => '中文']),
            ['Content-Type: application/json']
        );
        $this->assertTrue(true);
    }

    /** @test */
    public function httpPatch()
    {
        echo $this->httpRequest(
            $this->hostname(),
            $this->returnJsonPath(),
            'PATCH',
            json_encode(['name' => '中文']),
            ['Content-Type: application/json']
        );
        $this->assertTrue(true);
    }

    /** @test */
    public function httpDelete()
    {
        echo $this->httpRequest(
            $this->hostname(),
            $this->returnJsonPath(),
            'DELETE',
            json_encode(['name' => '中文']),
            ['Content-Type: application/json']
        );
        $this->assertTrue(true);
    }

    public function httpRequest($host, $path, $method = 'GET', $data = '', $headers = [])
    {
        $conn = pfsockopen($host, 80, $errno, $errMsg, 30);
        if ($errno == 0 && $conn) {
            $http = "{$method} {$path} HTTP/1.1" . PHP_EOL;
            $http .= "Host: {$host}" . PHP_EOL;
            $http .= 'Connection: Close' . PHP_EOL;
            if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
                $http .= 'Content-Length: ' . strlen($data) . PHP_EOL;
            }
            $http .= implode(PHP_EOL, $headers) . PHP_EOL;
            $http .= PHP_EOL . $data . PHP_EOL . PHP_EOL;
            fputs($conn, $http);
            $content = '';
            while (!feof($conn)) {
                $content .= fgets($conn);
            }
            return $content;
        } else {
            return "Error: $errMsg($errno)";
        }
    }
}
