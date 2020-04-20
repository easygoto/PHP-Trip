<?php

namespace Trink\Frame\Container;

use Exception;
use ReflectionClass;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Trink\Core\Exception\HttpException;
use Trink\Frame\Component\Response\SWebResponse;
use Trink\Frame\Component\Router;

class SWeb
{
    public static ?Request $request = null;

    public static ?Response $response = null;

    public static function run(Request $request, Response $response, array $config = [])
    {
        // 将请求赋值到传统的超级全局变量中
        static::$request = $request;
        static::$response = $response;
        static::handleRequest($request);
        static::initComponent();

        // 路由解析到文件, 大小写用中划线分隔开(仿Yii2)
        $requestUri = $request->server['request_uri'] ?? '';

        try {
            ['controller' => $controller, 'actionName' => $actionName] = Router::uri2File($requestUri);
            return $response->end(call_user_func_array([$controller, $actionName], []));
        } catch (HttpException $e) {
            $response->setStatusCode($e->getCode());
            return $response->end();
        } catch (Exception $e) {
            return $response->end();
        }
    }

    protected static function initComponent()
    {
        App::instance()->response = SWebResponse::class;
    }

    protected static function handleRequest(Request $request)
    {
        $_SERVER = $_COOKIE = $_GET = $_POST = $_FILES = [];
        $_SERVER['SCRIPT_NAME'] = '/index.php';
        $_SERVER['SCRIPT_FILENAME'] = TRIP_ROOT . '/index.php';

        if ($request->server) {
            foreach ($request->server as $key => $item) {
                $_SERVER[strtoupper($key)] = $item;
            }
        }
        if ($request->header) {
            foreach ($request->header as $key => $item) {
                $_SERVER['HTTP_' . strtoupper(str_replace('-', '_', $key))] = $item;
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
        $_REQUEST = array_merge($_GET, $_POST);
    }
}
