<?php

namespace Trink\Demo\Test;

abstract class Order
{
    abstract public static function pay($store_id);

    public static function payByStore($store_id)
    {
        static::pay($store_id);
    }
}
