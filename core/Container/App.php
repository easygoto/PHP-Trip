<?php


namespace Trink\Core\Container;

use Illuminate\Database\Connection;
use Trink\Core\Component\Settings;
use Trink\Core\Component\CapsuleDb;
use Trink\Core\Component\JugglerDb;
use Trink\Core\Component\MedooDb;

/**
 * Class App
 *
 * @package Trink\Core\Container
 *
 * @property Settings   settings
 * @property MedooDb    medoo
 * @property Connection capsule
 * @property JugglerDb  juggler
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
            case 'settings':
                return $this->register($name, new Settings());
            case 'medoo':
                return $this->register($name, new MedooDb($this->settings));
            case 'capsule':
                return $this->register($name, CapsuleDb::instance($this->settings));
            case 'juggler':
                return $this->register($name, new JugglerDb($this->settings));
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
