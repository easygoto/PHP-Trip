<?php


namespace Trink\Frame\Container;

use Exception;
use ReflectionClass;

class Web
{
    public static function run()
    {
        ['path' => $path] = parse_url(trim($_SERVER['REQUEST_URI'], '/'));
        $router = array_map(fn ($value) => ucfirst($value), explode('/', $path));
        $actionName = array_pop($router);
        $controllerName = array_pop($router);
        $dir = $router ? '\\' . implode('\\', $router) : '';
        $controllerClassName = "\\Trink\\Frame\\Controller{$dir}\\" . ucfirst($controllerName) . 'Controller';
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
