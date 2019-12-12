<?php


namespace Trink\Frame\Component;

use Trink\Core\Component\Setting;

class Juggler extends \Upfor\Juggler\Juggler
{
    public function __construct(Setting $settings)
    {
        $dbs = $settings->get('db');
        parent::__construct([
            'host'     => $dbs['host'],
            'dbname'   => $dbs['name'],
            'username' => $dbs['user'],
            'password' => $dbs['pass'],
            'charset'  => $dbs['charset'],
        ]);
    }
}