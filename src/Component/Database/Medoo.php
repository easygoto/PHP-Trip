<?php


namespace Trink\Frame\Component;

use Trink\Core\Component\Setting;

class Medoo extends \Medoo\Medoo
{
    public function __construct(Setting $settings)
    {
        $dbs = $settings->get('db');
        parent::__construct([
            'database_type' => $dbs['type'],
            'database_name' => $dbs['name'],
            'server'        => $dbs['host'],
            'username'      => $dbs['user'],
            'password'      => $dbs['pass'],
        ]);
    }
}