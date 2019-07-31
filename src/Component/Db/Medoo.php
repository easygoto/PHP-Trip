<?php


namespace Trink\Core\Component\Db;

use Trink\Core\Container\Statement\Config;
use Trink\Core\Container\Statement\Db;

class Medoo extends \Medoo\Medoo implements Db
{
    public function __construct(Config $config)
    {
        $db = $config->get('db');
        parent::__construct([
            'database_type' => $db['type'],
            'database_name' => $db['name'],
            'server'        => $db['host'],
            'username'      => $db['user'],
            'password'      => $db['pass'],
        ]);
    }
}
