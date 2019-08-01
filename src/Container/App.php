<?php


namespace Trink\Core\Container;

use Trink\Core\Component;
use Trink\Core\Container\Statement\Config;
use Trink\Core\Container\Statement\Db;

/**
 * Class App
 *
 * @package Trink\Core\Container
 * @property Db|Component\Db\Medoo db
 * @property Config                config
 */
class App
{
    public function __construct()
    {
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
