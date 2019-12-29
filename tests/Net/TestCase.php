<?php


namespace Test\Trip\Net;

use Trink\Frame\Container\App;

class TestCase extends \Test\Trip\TestCase
{
    public function hostname()
    {
        return App::instance()->setting->get('host');
    }

    public function returnJsonPath()
    {
        return '/index.php/api/json';
    }

    public function returnJsonUrl()
    {
        return "http://{$this->hostname()}{$this->returnJsonPath()}";
    }
}
