<?php

namespace Trink\Core\Component\Setting;

use Trink\Core\Component\Setting;
use Trink\Core\Helper\Arrays;

class File implements Setting
{
    protected $props;

    public function __construct()
    {
        $this->props = require DATA_DIR . 'config/main.php';
    }

    public function set(string $key, $value)
    {
        $this->props[$key] = $value;
    }

    public function get(string $key = null)
    {
        return Arrays::get($this->props, $key);
    }

    public function initDefault()
    {
        $this->props = [];
    }
}
