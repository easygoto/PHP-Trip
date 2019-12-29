<?php


namespace Trink\Core\Container;

use Trink\Core\Component\Setting;

/**
 * Class App
 *
 * @package Trink\Core\Container
 *
 * @property Setting setting
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
                return $this->register($name, new Setting\File());
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
