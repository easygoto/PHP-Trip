<?php

namespace Trink\App\Dp\Factory\Electronics;

use ReflectionClass;

class WatchFactory
{
    public static function create($class)
    {
        return (new ReflectionClass("Trink\\Dp\\Factory\\Electronics\\Watch\\{$class}"))->newInstance();
    }
}
