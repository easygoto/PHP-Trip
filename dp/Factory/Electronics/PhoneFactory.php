<?php


namespace Trink\App\Dp\Factory\Electronics;

use ReflectionClass;

class PhoneFactory
{
    public static function create($class)
    {
        return (new ReflectionClass("Trink\\Dp\\Factory\\Electronics\\Phone\\{$class}"))->newInstance();
    }
}
