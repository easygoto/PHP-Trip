<?php


namespace Trink\Core\Component;

class Logger
{
    public static function print($data)
    {
        if (is_array($data) || is_object($data)) {
            print json_encode($data);
        } else {
            print sprintf("%s", $data);
        }
    }

    public static function println($data)
    {
        if (is_array($data) || is_object($data)) {
            print json_encode($data) . "\n";
        } else {
            print sprintf("%s\n", $data);
        }
    }
}
