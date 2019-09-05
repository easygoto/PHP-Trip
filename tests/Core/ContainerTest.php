<?php


namespace Test\Trip\Core;

use Test\Trip\TestCase;
use Trink\Core\Container\App;

class ContainerTest extends TestCase
{
    public function test()
    {
        $data = App::instance()->settings->get('db.type');
        print_r($data);
        App::instance()->settings->set('heh', 'heh');
        $data = App::instance()->settings->get('heh');
        print_r($data);
        $set = App::instance()->settings;
        print_r($set);
        $this->assertTrue(true);
    }
}
