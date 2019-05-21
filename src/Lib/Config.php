<?php


namespace Trink\Demo\Lib;

/**
 * @property  array db
 * @property  array redis
 * @property  array rabbit
 */
class Config
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

    public static function instance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        $instance        = self::$instance;
        $instance->props = require_once dirname(dirname(__DIR__)) . '/config/config.php';
        return self::$instance;
    }
}
