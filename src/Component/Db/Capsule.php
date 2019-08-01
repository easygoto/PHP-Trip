<?php


namespace Trink\Core\Component\Db;

use Illuminate\Database\Capsule\Manager as CapsuleManager;
use Trink\Core\Container\Statement\Config;
use Trink\Core\Container\Statement\Db;

class Capsule implements Db
{
    protected static $instance;

    public static function instance(Config $config)
    {
        $db = $config->get('db');

        self::$instance = new CapsuleManager;
        self::$instance->addConnection([
            'driver'    => $db['type'],
            'host'      => $db['host'],
            'database'  => $db['name'],
            'username'  => $db['user'],
            'password'  => $db['pass'],
            'charset'   => $db['charset'],
            'collation' => $db['collation'],
            'prefix'    => $db['prefix'],
        ]);
        return self::$instance->getConnection();
    }
}
