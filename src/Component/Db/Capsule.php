<?php


namespace Trink\Core\Component\Db;

use Illuminate\Database\Capsule\Manager as CapsuleManager;
use Trink\Core\Component\Config\Setting;

class Capsule
{
    protected static $instance;

    public static function instance(Setting $setting)
    {
        $db = $setting->get('db');

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
