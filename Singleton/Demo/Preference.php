<?php

namespace Singleton\Demo;


class Preference {
    private        $rnd;
    private        $props    = [];
    private static $instance = null;

    private function __construct() { }

    // 私有化克隆函数, 防止系统出现多个对象
    private function __clone() { }

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance      = new Preference();
            self::$instance->rnd = rand(1000, 9999);
        }
        return self::$instance;
    }

    /**
     * @return mixed
     */
    public function getRnd() {
        return $this->rnd;
    }

    public function setProperty($key, $value) {
        $this->props[$key] = $value;
    }

    public function getProperty($key) {
        return $this->props[$key];
    }
}