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
use Trink\Frame\Component\Setting;

/**
 * Class App
 *
 * @package Trink\Frame\Container
 * @property Setting      setting
 * @property Medoo        medoo
 * @property Connection   capsule
 * @property Juggler      juggler
 * @property McCache      mc
 * @property BaseResponse response
 */
class App
{
    protected array $container = [];

    protected static ?App $instance = null;

    public static function instance()
    {
        if (static::$instance == null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    public function __get($name)
    {
        if (isset($this->container[$name])) {
            return $this->container[$name];
        }

        switch ($name) {
            case 'setting':
                return $this->register($name, new Setting());
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
                return null;
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

    protected function register($name, $object)
    {
        $this->container[$name] = $object;
        return $this->container[$name];
    }
}
