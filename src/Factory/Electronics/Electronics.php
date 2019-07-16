<?php


namespace Trink\Dp\Factory\Electronics;

use ReflectionClass;

/**
 * @method static Computer computer(string $class_name)
 * @method static Phone phone(string $class_name)
 * @method static Watch watch(string $class_name)
 */
class Electronics
{
    public static function __callStatic($method_name, $arguments)
    {
        list($class_name) = $arguments;
        return (new ReflectionClass("{$class_name}"))->newInstance() ?? null;
    }
}
