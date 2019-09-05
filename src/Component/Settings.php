<?php


namespace Trink\Core\Component;

use Trink\Core\Helper\Arrays;

class Settings
{
    protected $props;

    public function __construct()
    {
        $this->props = require TRIP_ROOT . 'config/main.php';
    }

    public function set(string $key, $value)
    {
        $this->props[$key] = $value;
    }

    public function get(string $key = null)
    {
        return Arrays::get($this->props, $key);
    }
}
