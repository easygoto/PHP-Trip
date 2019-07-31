<?php


namespace Trink\Core\Component\Container;

use Trink\Core\Component\Container\Realization\Config\Index as DefaultConfig;

class App
{
    private static $instance;

    public $config;

    private function __construct()
    {
        $this->config = DefaultConfig::instance();
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    /** @return static */
    public static function instance()
    {
        if (!static::$instance instanceof static) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}
