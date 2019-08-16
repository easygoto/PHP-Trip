<?php


namespace Trink\Core\Component\Db;

use Trink\Core\Component\Config\Setting;

class Juggler extends \Upfor\Juggler\Juggler
{
    public function __construct(Setting $setting)
    {
        $db = $setting->get('db');
        parent::__construct([
            'host'     => $db['host'],
            'dbname'   => $db['name'],
            'username' => $db['user'],
            'password' => $db['pass'],
            'charset'  => $db['charset'],
        ]);
    }
}
