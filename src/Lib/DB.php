<?php


namespace Trink\Demo\Lib;

use Upfor\Juggler\Juggler;

class DB
{
    private static $instance;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function instance(): Juggler
    {
        $config = require_once dirname(dirname(__DIR__)) . '/config/db.php';
        if (!self::$instance instanceof self) {
            self::$instance = new Juggler($config);
        }
        return self::$instance;
    }
}
