<?php


namespace Trink\Dp\DependencyInjection\Demo;

use Trink\Dp\DependencyInjection\Demo\Concrete\Config;
use Trink\Dp\DependencyInjection\Demo\Concrete\DB;

class App
{
    private static $instance;

    /** @var DB */
    public $db;
    /** @var Log */
    public $log;
    /** @var Config */
    public $config;

    private function __construct()
    {
        $this->log    = new Concrete\Log();
        $this->config = new Concrete\Config();
        $this->db     = new Concrete\DB($this->config);
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

    public function __get($name)
    {
        return null;
    }
}
