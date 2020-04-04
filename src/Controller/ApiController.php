<?php

namespace Trink\Frame\Controller;

use Trink\Core\Exception\HttpException;
use Trink\Frame\Component\BaseController;
use Trink\Frame\Container\SWeb;

class ApiController extends BaseController
{
    /**
     * @return string
     * @throws HttpException
     */
    public function json()
    {
        // handle data
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) == 'HTTP_') {
                $key = strtolower(substr($key, 5));
                $headers[$key] = $value;
            }
        }
        $method = $_SERVER['REQUEST_METHOD'];
        $response = json_encode([
            'method'  => $method,
            'request' => $_REQUEST,
            'input'   => json_decode(file_get_contents("php://input") ?? '', 1),
            'headers' => $headers,
        ]);

        if (in_array($method, ['OPTION', 'HEAD']) && rand(0, 9) > 5) {
            throw new HttpException(404);
        }

        // log
        $filename = TEMP_DIR . 'debug/' . date('Y_m_d/H_i_s') . ".{$method}.log";
        $dirname = dirname($filename);
        if (!file_exists($dirname)) {
            mkdir($dirname, 0777, 1);
        }
        file_put_contents($filename, $response);

        // TODO response 容器适配器
        if (SWeb::$response) {
            SWeb::$response->setHeader('Content-Type', 'application/json');
        }
        return $response;
    }
}
