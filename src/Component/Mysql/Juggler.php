<?php

namespace Trink\Frame\Component\Mysql;

use Trink\Frame\Component\Setting;

class Juggler extends \Upfor\Juggler\Juggler
{
    public function __construct(Setting $settings)
    {
        $dbs = $settings->get('db');
        parent::__construct([
            'host'     => $dbs['host'],
            'dbname'   => $dbs['dbname'],
            'username' => $dbs['user'],
            'password' => $dbs['pass'],
            'charset'  => $dbs['charset'],
        ]);
    }
}
