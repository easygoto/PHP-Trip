<?php


namespace Trink\Core\Helper\Net;

class FOpen
{
    public static function head($host, $path, $data = '')
    {
        return self::request($host, $path, 'HEAD', $data);
    }

    public static function get($host, $path, $data = '')
    {
        return self::request($host, $path, 'GET', $data);
    }

    public static function post($host, $path, $data = '', $options = [])
    {
        return self::request($host, $path, 'POST', $data, $options);
    }

    public static function patch($host, $path, $data = '', $options = [])
    {
        return self::request($host, $path, 'PATCH', $data, $options);
    }

    public static function delete($host, $path, $data = '', $options = [])
    {
        return self::request($host, $path, 'DELETE', $data, $options);
    }

    public static function request($host, $path, $method = 'GET', $data = '', $options = [])
    {
        $headers = $options['headers'] ?? [];
        $port = $options['port'] ?? 80;
        $conn = pfsockopen($host, $port, $errno, $errMsg, 30);
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
