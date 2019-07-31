<?php


namespace Trink\Core\Container;

use Trink\Core\Component\Config\Index as DefaultConfig;
use Trink\Core\Helper\Arrays;
use Trink\Core\Helper\Format;

class App
{
    private static $instance;

    public $config;

    /** @var Arrays $arrays */
    public $arrays;

    /** @var Format $format */
    public $format;

    private function __construct()
    {
        $this->arrays = new Arrays();
        $this->format = new Format();

        $this->config = new DefaultConfig(['arrays' => $this->arrays]);
    }

    private function __clone()
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
