<?php


namespace Trink\Frame\Container;

use Exception;
use ReflectionClass;

class Web
{
    public static function run()
    {
        [$actionName, $controllerName] = array_reverse(explode('/', $_SERVER['REQUEST_URI']));
        $controllerClassName = '\\Trink\\Frame\\Controller\\' . ucfirst($controllerName) . 'Controller';
        try {
            $controller = (new ReflectionClass($controllerClassName))->newInstance();
            $action = 'action' . ucfirst($actionName);
            if (!method_exists($controller, $action)) {
                throw new Exception();
            }
            return $controller->$action();
        } catch (Exception $e) {
            header('HTTP/1.1 404 Not Found');
            exit;
        }
    }
}
