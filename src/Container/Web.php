<?php

namespace Trink\Frame\Container;

use Exception;
use ReflectionClass;
use Trink\Core\Exception\HttpException;
use Trink\Frame\Component\Response\WebResponse;
use Trink\Frame\Component\Router;

class Web
{
    public static function run()
    {
        // 获取 Uri
        if (strpos($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']) === false) {
            $root = $_SERVER['REQUEST_URI'];
        } else {
            $root = substr($_SERVER['REQUEST_URI'], strlen($_SERVER['SCRIPT_NAME']));
        }
        // 路由解析
        ['controller' => $controllerName, 'action' => $action] = Router::path2File($root);

        // Controller 处理
        try {
            $controller = (new ReflectionClass($controllerName))->newInstance();
            if (!is_callable([$controller, $action])) {
                throw new HttpException(404, "Not Found Action : {$controllerName}::{$action}");
            }
            static::initComponent();
            return $controller->$action();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    protected static function initComponent()
    {
        App::instance()->response = WebResponse::class;
    }
}
