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
            $config = [
                'host' => '127.0.0.1',
                'port' => 3306,
                'dbname' => 'test',
                'username' => 'root',
                'password' => '123123',
                'charset' => 'utf8',
            ];

            self::$instance = new Juggler($config);
        }
        return self::$instance;
    }
}
