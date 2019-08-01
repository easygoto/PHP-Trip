<?php


namespace Test\Trip\Core;

use Test\Trip\TestCase;
use Trink\Core\Component\Template\Template;
use Trink\Core\Container\App;

/**
 * Class ComponentTest
 *
 * @package Test\Trip
 */
class ComponentTest extends TestCase
{
    /** @test */
    public function db()
    {
        $result = (new App)->db->select('goods', '*', ['id' => 1]);
        print_r($result);
        $this->assertTrue(true);
    }

    /** @test */
    public function config()
    {
        print (new App)->config->get('db.type');
        $this->assertTrue(true);
    }

    /** @test */
    public function template()
    {
        $tpl = new Template([
            'php_turn'     => true,
            'debug'        => true,
            'compile_dir'  => self::$resDir . 'cache/',
            'template_dir' => self::$resDir . 'template/',
        ]);
        $tpl->assign('data', 'hello world');
        $tpl->assign('person', 'cafeCAT');
        $tpl->assign('pai', 3.14);
        $arr = [1, 2, 3, 4, "hah", 6];
        $tpl->assign('b', $arr);
        $tpl->show('member');
        $this->assertTrue(true);
    }
}
