<?php


namespace Trink\Core\Component;

use Illuminate\Database\Capsule\Manager as CapsuleManager;

class CapsuleDb
{
    protected static $instance;

    public static function instance(Setting $settings)
    {
        $dbs = $settings->get('db');
        self::$instance = new CapsuleManager;
        self::$instance->addConnection([
            'driver'    => $dbs['type'],
            'host'      => $dbs['host'],
            'database'  => $dbs['name'],
            'username'  => $dbs['user'],
            'password'  => $dbs['pass'],
            'charset'   => $dbs['charset'],
            'collation' => $dbs['collation'],
            'prefix'    => $dbs['prefix'],
        ]);
        return self::$instance->getConnection();
    }
}
