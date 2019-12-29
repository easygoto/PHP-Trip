<?php


namespace Trink\Frame\Container;

use Exception;
use ReflectionClass;

class Web
{
    public static function run()
    {
        if (strpos($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']) === false) {
            $root = $_SERVER['REQUEST_URI'];
        } else {
            $root = substr($_SERVER['REQUEST_URI'], strlen($_SERVER['SCRIPT_NAME']));
        }
        ['path' => $path] = parse_url(trim($root, '/'));
        $router = array_map(fn ($value) => ucfirst($value), explode('/', $path));
        $actionName = count($router) >= 2 ? (array_pop($router) ?: 'Index') : 'Index';
        $controllerName = count($router) >= 1 ? (array_pop($router) ?: 'Home') : 'Home';
        $dir = $router ? '\\' . implode('\\', $router) : '';
        $controllerClassName = "\\Trink\\Frame\\Controller{$dir}\\" . ucfirst($controllerName) . 'Controller';
        try {
            $controller = (new ReflectionClass($controllerClassName))->newInstance();
            $action = 'action' . ucfirst($actionName);
            if (!method_exists($controller, $action)) {
                throw new Exception("Not Found Action : $controllerClassName::$action");
            }
            return $controller->$action();
        } catch (Exception $e) {
            header('HTTP/1.1 404 Not Found');
            exit($e->getMessage());
        }
    }
}
