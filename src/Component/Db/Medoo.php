<?php


namespace Trink\Core\Component\Db;

use Trink\Core\Component\Config\Setting;

class Medoo extends \Medoo\Medoo
{
    public function __construct(Setting $setting)
    {
        $db = $setting->get('db');
        parent::__construct([
            'database_type' => $db['type'],
            'database_name' => $db['name'],
            'server'        => $db['host'],
            'username'      => $db['user'],
            'password'      => $db['pass'],
        ]);
    }
}
