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
        if (!self::$instance instanceof self) {
            $db = Config::instance()->db;

            self::$instance = new Juggler([
                'host'     => $db['host'],
                'username' => $db['user'],
                'password' => $db['pass'],
                'dbname'   => $db['name'],
                'charset'  => $db['charset'],
            ]);
        }
        return self::$instance;
    }
}
