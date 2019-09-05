<?php


namespace Trink\Core\Component;

use Upfor\Juggler\Juggler;

class DbJuggler extends Juggler
{
    public function __construct(Settings $setting)
    {
        $dbs = $setting->get('db');
        parent::__construct([
            'host'     => $dbs['host'],
            'dbname'   => $dbs['name'],
            'username' => $dbs['user'],
            'password' => $dbs['pass'],
            'charset'  => $dbs['charset'],
        ]);
    }
}
