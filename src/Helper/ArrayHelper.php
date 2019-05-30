<?php


namespace Trink\Demo\Helper;

class ArrayHelper
{
    public static function getValue(array $list, string $key, $default = '')
    {
        if (! array_key_exists($key, $list)) {
            return $default;
        }
        return $list[$key];
    }

    public static function getInteger(array $list, string $key, $default = '')
    {
        return (int)self::getValue($list, $key, $default);
    }

    public static function getDigits(array $list, string $key, $decimals = 2, $default = '')
    {
        return number_format((float)self::getValue($list, $key, $default), $decimals);
    }
}
