<?php


namespace Trink\Core\Component\Db;

use Trink\Core\Container\Statement\Config;
use Trink\Core\Container\Statement\Db;

class Juggler extends \Upfor\Juggler\Juggler implements Db
{
    public function __construct(Config $config)
    {
        $db = $config->get('db');
        parent::__construct([
            'host'     => $db['host'],
            'dbname'   => $db['name'],
            'username' => $db['user'],
            'password' => $db['pass'],
            'charset'  => $db['charset'],
        ]);
    }
}
