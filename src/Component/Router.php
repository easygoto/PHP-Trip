<?php

namespace Trink\Frame\Component;

class Router
{
    public static function path2File(string $uri)
    {
        ['path' => $path] = parse_url(trim($uri, '/'));
        $router = array_map(fn ($value) => ucfirst($value), explode('/', $path));
        $action = count($router) >= 2 ? (array_pop($router) ?: 'Index') : 'Index';
        $controllerName = count($router) >= 1 ? (array_pop($router) ?: 'Home') : 'Home';
        $dir = $router ? '\\' . implode('\\', $router) : '';
        $controller = "\\Trink\\Frame\\Controller{$dir}\\" . ucfirst($controllerName) . 'Controller';
        return ['controller' => $controller, 'action' => lcfirst($action)];
    }
}
