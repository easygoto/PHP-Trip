<?php


namespace Trink\Core\Component\Config;

use Trink\Core\Container\Statement\Config;
use Trink\Core\Helper\Arrays;

class Normal implements Config
{

    protected $props;

    public function __construct()
    {
        $this->props = require_once TRIP_ROOT . '/config/config.php';
    }

    public function set(string $key)
    {
    }

    public function get(string $key)
    {
        return Arrays::get($this->props, $key);
    }
}
