<?php

namespace Trink\App\Dp\Singleton\Config;

/**
 * @property array      db
 * @property mixed|null app
 */
class Config
{
    /** @var Config $instance */
    private static $instance;

    private $props = [];

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public function __get($name)
    {
        return $this->props[$name] ?? null;
    }

    public function __set($name, $value)
    {
        $this->props[$name] = $value;
    }

    public static function instance()
    {
        if (!static::$instance instanceof static) {
            static::$instance        = new static();
            static::$instance->props = require_once __DIR__ . '/config/config.php';
        }
        return static::$instance;
    }
}
