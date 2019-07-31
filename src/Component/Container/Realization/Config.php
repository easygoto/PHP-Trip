<?php

namespace Trink\Core\Component\Container\Realization;

/**
 * @property  array db
 * @property  array redis
 * @property  array rabbit
 *
 * @method array db(array $keyMap)
 */
class Config implements \Trink\Core\Component\Container\Statement\Config
{
    private static $instance;

    private $props;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __get($name)
    {
        return $this->props[$name];
    }

    public function __call($name, $arguments)
    {
        list($keyMap) = $arguments;
        $props    = $this->props[$name];
        $newProps = [];
        foreach ($keyMap as $key => $configKey) {
            $newProps[$key] = $props[$configKey];
        }
        return $newProps;
    }

    public static function instance()
    {
        if (!self::$instance instanceof self) {
            self::$instance        = new self();
            self::$instance->props = require_once TRIP_ROOT . '/config/config.php';
        }
        return self::$instance;
    }

    public function get(string $key)
    {
        if (strpos($key, '.') !== false) {
            $keyMap = explode('.', $key);
            $temp = $this->props;
            foreach ($keyMap as $item) {
                $temp = $temp[$item];
            }
            return $temp;
        }
        return $this->props[$key];
    }

    public function set(string $key)
    {
    }
}
