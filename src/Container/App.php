<?php


namespace Trink\Core\Container;

use Illuminate\Database\Connection;
use Medoo\Medoo;
use Trink\Core\Component;
use Trink\Core\Container\Statement;

/**
 * Class App
 *
 * @package Trink\Core\Container
 *
 * @property Statement\Db|Medoo|Connection db
 * @property Statement\Config              config
 */
class App
{
    protected static $instance;

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    public static function instance()
    {
        if (self::$instance == null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function __get($name)
    {
        switch ($name) {
            case 'db':
                return new Component\Db\Medoo($this->config);
            case 'config':
                return new Component\Config\Normal();
        }
        return null;
    }
}
