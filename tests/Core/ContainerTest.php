<?php


namespace Test\Trip\Core;

use Test\Trip\TestCase;
use Trink\Frame\Container\App;

class ContainerTest extends TestCase
{
    public function test()
    {
        $data = App::instance()->setting->get('db.type');
        print_r($data);
        App::instance()->setting->set('heh', 'heh');
        $data = App::instance()->setting->get('heh');
        print_r($data);
        $set = App::instance()->setting;
        print_r($set);
        $this->assertTrue(true);
    }
}
