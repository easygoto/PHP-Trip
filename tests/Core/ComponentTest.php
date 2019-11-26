<?php


namespace Test\Trip\Core;

use Test\Trip\TestCase;
use Trink\Frame\Container\App;

/**
 * Class ComponentTest
 *
 * @package Test\Trip
 */
class ComponentTest extends TestCase
{
    public function testDb()
    {
        $medoo  = App::instance()->medoo;
        $result = $medoo->count('goods', '*', ['id' => 10]);
        var_dump($result);

        $this->assertTrue(true);
    }

    /** @test */
    public function config()
    {
        print App::instance()->setting->get('db.type');
        $this->assertTrue(true);
    }
}
