<?php


namespace Trink\Core\Component;

use Medoo\Medoo;

class DbMedoo extends Medoo
{
    public function __construct(Settings $settings)
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
