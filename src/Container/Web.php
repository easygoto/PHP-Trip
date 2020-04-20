<?php

namespace Trink\Frame\Container;

use Exception;
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

        static::initComponent();

        try {
            // 路由解析
            ['controller' => $controller, 'actionName' => $actionName] = Router::uri2File($root);
            return call_user_func_array([$controller, $actionName], []);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    protected static function initComponent()
    {
        App::instance()->response = WebResponse::class;
    }
}
