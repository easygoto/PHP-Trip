<?php

namespace Trink\Frame\Container;

use Exception;
use ReflectionClass;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Trink\Core\Exception\HttpException;
use Trink\Core\Helper\Format;

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

        // 路由解析到文件, 大小写用中划线分隔开(仿Yii2)
        // TODO 路由组件
        $requestUri = $request->server['request_uri'] ?? '';
        ['path' => $path] = parse_url(trim($requestUri, '/'));
        $router = array_map(fn ($value) => ucfirst(Format::toCamelCase($value, '-')), explode('/', $path));
        $actionName = count($router) >= 2 ? (array_pop($router) ?: 'Index') : 'Index';
        $controllerName = count($router) >= 1 ? (array_pop($router) ?: 'Home') : 'Home';
        $dir = $router ? '\\' . implode('\\', $router) : '';
        $controllerClassName = "Trink\\Frame\\Controller{$dir}\\" . ucfirst($controllerName) . 'Controller';

        // Controller 处理
        try {
            $controller = (new ReflectionClass($controllerClassName))->newInstance();
            $action = lcfirst($actionName);
            if (!is_callable([$controller, $action])) {
                throw new HttpException(404, "Not Found Action : $controllerClassName::$action");
            }
            return $response->end($controller->$action());
        } catch (HttpException $e) {
            $response->setStatusCode($e->getCode());
            return $response->end();
        } catch (Exception $e) {
            return $response->end();
        }
    }

    protected static function handleRequest(Request $request)
    {
        $_SERVER = $_COOKIE = $_GET = $_POST = $_FILES = [];

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
