<?php


namespace Trink\Core\Component;

use Upfor\Juggler\Juggler;

class JugglerDb extends Juggler
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
