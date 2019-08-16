<?php


namespace Trink\Core\Container;

use Illuminate\Database\Connection;
use Trink\Core\Component;
use Trink\Core\Component\Config\Setting;
use Trink\Core\Component\Db\Capsule;
use Trink\Core\Component\Db\Juggler;
use Trink\Core\Component\Db\Medoo;

/**
 * Class App
 *
 * @package Trink\Core\Container
 *
 * @property Setting    setting
 * @property Medoo      medoo
 * @property Connection capsule
 * @property Juggler    juggler
 */
class App
{
    protected $container = [];

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
            case 'setting':
                return $this->register($name, new Setting());
            case 'medoo':
                return $this->register($name, new Medoo($this->setting));
            case 'capsule':
                return $this->register($name, Capsule::instance($this->setting));
            case 'juggler':
                return $this->register($name, new Juggler($this->setting));
            default:
                return null;
        }
    }

    protected function register($name, $object)
    {
        if (isset($this->container[$name])) {
            return $this->container[$name];
        }
        $this->container[$name] = $object;
        return $this->container[$name];
    }
}
