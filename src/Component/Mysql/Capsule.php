<?php

namespace Trink\Frame\Component\Mysql;

use Illuminate\Database\Capsule\Manager as CapsuleManager;
use Trink\Frame\Component\Setting;

class Capsule
{
    protected static CapsuleManager $instance;

    public static function instance(Setting $settings)
    {
        $dbs = $settings->get('db');
        self::$instance = new CapsuleManager();
        self::$instance->addConnection([
            'driver'    => $dbs['type'],
            'host'      => $dbs['host'],
            'database'  => $dbs['dbname'],
            'username'  => $dbs['user'],
            'password'  => $dbs['pass'],
            'charset'   => $dbs['charset'],
            'collation' => $dbs['collation'],
            'prefix'    => $dbs['prefix'],
        ]);
        return self::$instance->getConnection();
    }
}
