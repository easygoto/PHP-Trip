<?php


namespace Test\Trip;

use Trink\Frame\Container\App;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @before */
    public function init()
    {
        require_once __DIR__ . '/../bootstrap.php';
    }

    public function returnJsonUrl()
    {
        $host = App::instance()->setting->get('host');
        return "http://{$host}/api/json";
    }
}
