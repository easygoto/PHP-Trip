<?php


namespace Trink\Frame\Container;

use Illuminate\Database\Connection;
use Trink\Frame\Component\Cache\McCache;
use Trink\Frame\Component\Mysql\Capsule;
use Trink\Frame\Component\Mysql\Juggler;
use Trink\Frame\Component\Mysql\Medoo;

/**
 * Class App
 *
 * @package Trink\Frame\Container
 *
 * @property Medoo      medoo
 * @property Connection capsule
 * @property Juggler    juggler
 * @property McCache    mc
 */
class App extends \Trink\Core\Container\App
{
    public function __get($name)
    {
        switch ($name) {
            case 'medoo':
                return $this->register($name, new Medoo($this->setting));
            case 'capsule':
                return $this->register($name, Capsule::instance($this->setting));
            case 'juggler':
                return $this->register($name, new Juggler($this->setting));
            case 'mc':
                return $this->register($name, McCache::instance($this->setting, null));
            default:
                return parent::__get($name);
        }
    }
}
