<?php


namespace Trink\Dp\Registry\Demo;

class Register
{
    protected static $objects;

    public static function set($key, $object)
    {
        self::$objects[$key] = $object;
    }

    public static function get($key)
    {
        return self::$objects[$key] ?? null;
    }

    public static function unset($key)
    {
        unset(self::$objects[$key]);
    }
}
