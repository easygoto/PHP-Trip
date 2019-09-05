<?php


namespace Trink\Core\Container;

use Illuminate\Database\Connection;
use Trink\Core\Component\Settings;
use Trink\Core\Component\DbCapsule;
use Trink\Core\Component\DbJuggler;
use Trink\Core\Component\DbMedoo;

/**
 * Class App
 *
 * @package Trink\Core\Container
 *
 * @property Settings   settings
 * @property DbMedoo    medoo
 * @property Connection capsule
 * @property DbJuggler  juggler
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
                return $this->register($name, new Settings());
            case 'medoo':
                return $this->register($name, new DbMedoo($this->settings));
            case 'capsule':
                return $this->register($name, DbCapsule::instance($this->settings));
            case 'juggler':
                return $this->register($name, new DbJuggler($this->settings));
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
