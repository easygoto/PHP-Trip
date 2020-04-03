<?php

namespace Trink\Frame\Container;

class SWeb
{
    public static function run($options = [])
    {
        return json_encode(
            [
                'SERVER' => $_SERVER,
                'COOKIE' => $_COOKIE,
                'GET' => $_GET,
                'POST' => $_POST,
                'FILES' => $_FILES,
                'ENV' => $_ENV,
                'REQUEST' => $_REQUEST,
                'OPTIONS' => $options,
            ]
        );
    }
}
