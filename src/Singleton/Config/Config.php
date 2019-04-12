<?php


namespace Trink\Singleton\Config;


/**
 * @property void db
 */
class Config {

    private static $instance;
    private        $props = [];

    private function __construct() { }

    private function __clone() { }

    public function __get($name) {
        if (array_key_exists($name, $this->props)) {
            return $this->props[$name];
        }
        return null;
    }

    public static function instance() {
        if (! (self::$instance instanceof self)) {
            self::$instance        = new self();
            self::$instance->props = require_once __DIR__ . '/config/config.php';
            return self::$instance;
        }
        return self::$instance;
    }
}