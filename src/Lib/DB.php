<?php


namespace Trink\Demo\Lib;

use Medoo\Medoo;

class DB
{
    private static $instance;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function instance(): Medoo
    {
        if (!self::$instance instanceof self) {
            $db = Config::instance()->db;

            self::$instance = new Medoo([
                'database_type' => 'mysql',
                'database_name' => $db['name'],
                'server'        => $db['host'],
                'username'      => $db['user'],
                'password'      => $db['pass'],
            ]);
        }
        return self::$instance;
    }
}
