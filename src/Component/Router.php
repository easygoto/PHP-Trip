<?php

namespace Trink\Frame\Component;

use ReflectionClass;
use ReflectionException;
use Trink\Core\Exception\HttpException;
use Trink\Core\Helper\Format;

class Router
{
    /**
     * @param string $uri
     * @return array
     * @throws ReflectionException
     * @throws HttpException
     */
    public static function uri2File(string $uri)
    {
        $path = parse_url(trim($uri, '/'))['path'] ?? '';
        $router = array_map(fn ($value) => ucfirst(Format::toCamelCase(ucfirst($value), '-')), explode('/', $path));
        $actionName = lcfirst(count($router) >= 2 ? (array_pop($router) ?: 'index') : 'index');
        $controllerName = count($router) >= 1 ? (array_pop($router) ?: 'Home') : 'Home';
        $dir = $router ? '\\' . implode('\\', $router) : '';
        $controllerClass = "\\Trink\\Frame\\Controller{$dir}\\" . ucfirst($controllerName) . 'Controller';

        /** @var BaseController $controller */
        $controller = (new ReflectionClass($controllerClass))->newInstance();
        if (!is_callable([$controller, $actionName]) || !is_subclass_of($controller, BaseController::class)) {
            throw new HttpException(404, "Not Found Action : {$controllerName}::{$actionName}");
        }
        $controller->id = Format::toUnderScore($controllerName, '-');
        $controller->actionId = Format::toUnderScore($actionName, '-');
        $controller->moduleList = array_map(fn ($v) => Format::toUnderScore($v, '-'), $router);
        return ['controller' => $controller, 'actionName' => $actionName];
    }
}
