<?php

namespace Trink\Frame\Component\Mysql;

use Trink\Core\Component\Setting;

class Medoo extends \Medoo\Medoo
{
    public function __construct(Setting $settings)
    {
        $dbs = $settings->get('db');
        parent::__construct([
            'database_type' => $dbs['type'],
            'database_name' => $dbs['dbname'],
            'server'        => $dbs['host'],
            'username'      => $dbs['user'],
            'password'      => $dbs['pass'],
        ]);
    }
}
