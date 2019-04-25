<?php


namespace Trink\Dp\Factory\Electronics;


use ReflectionClass;

/**
 * @method static Computer computer(string $class_name)
 * @method static Phone phone(string $class_name)
 * @method static Watch watch(string $string)
 */
class Electronics {

    private static $product_map = [
        'computer' => 'Computer',
        'phone'    => 'Phone',
        'watch'    => 'Watch',
    ];

    public static function __callStatic($method_name, $arguments) {
        if (!array_key_exists($method_name, self::$product_map)) {
            return null;
        }
        $base_namespace = "Trink\\Dp\\Factory\\Electronics";
        $namespace      = self::$product_map[$method_name];
        list($class_name) = $arguments;
        return (new ReflectionClass("{$base_namespace}\\{$namespace}\\{$class_name}"))->newInstance() ?? null;
    }
}