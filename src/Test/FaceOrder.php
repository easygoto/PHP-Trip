<?php


namespace Trink\Demo\Test;

class FaceOrder extends Order
{
    private static function ext()
    {
        print "extra function ...\n";
    }

    public static function pay($store_id = 0)
    {
        self::ext();
        print "{$store_id} : FaceOrder pay ...\n";
    }
}
