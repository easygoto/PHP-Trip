<?php

namespace Trink\Frame\Container;

use Illuminate\Database\Connection;
use ReflectionClass;
use ReflectionException;
use Trink\Frame\Component\BaseResponse;
use Trink\Frame\Component\Cache\McCache;
use Trink\Frame\Component\Mysql\Capsule;
use Trink\Frame\Component\Mysql\Juggler;
use Trink\Frame\Component\Mysql\Medoo;
use Trink\Frame\Component\Response\WebResponse;

/**
 * Class App
 *
 * @package Trink\Frame\Container
 *
 * @property Medoo medoo
 * @property Connection capsule
 * @property Juggler juggler
 * @property McCache mc
 * @property BaseResponse response
 */
class App extends \Trink\Core\Container\App
{
    public static function instance(): self
    {
        return parent::instance();
    }

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
            case 'response':
                return $this->container[$name] ?? (new WebResponse());
            default:
                return parent::__get($name);
        }
    }

    /**
     * @param string $name
     * @param string $class
     * @throws ReflectionException
     */
    public function __set(string $name, string $class)
    {
        switch ($name) {
            case 'response':
                $this->register($name, (new ReflectionClass($class))->newInstance());
                break;
            default:
                break;
        }
    }
}
