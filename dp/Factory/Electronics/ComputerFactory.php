<?php


namespace Trink\App\Dp\Factory\Electronics;

use ReflectionClass;

class ComputerFactory
{
    public static function create($class)
    {
        return (new ReflectionClass("Trink\\Dp\\Factory\\Electronics\\Computer\\{$class}"))->newInstance();
    }
}
