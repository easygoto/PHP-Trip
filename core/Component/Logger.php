<?php


namespace Trink\Core\Component;

class Logger
{
    public static function echo($data)
    {
        if (is_array($data) || is_object($data)) {
            echo json_encode($data) . "\n";
        } else {
            echo "{$data}\n";
        }
    }
}
