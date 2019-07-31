<?php


namespace Trink\Core\Container;

use Trink\Core\Component;

class App
{
    public $config;
    public $db;

    public function __construct()
    {
        $this->config = new Component\Config\Normal();
        $this->db = Component\Db\Capsule::instance($this->config);
    }
}
