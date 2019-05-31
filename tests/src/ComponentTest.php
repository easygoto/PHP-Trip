<?php


namespace Test\Trip;

use PHPUnit\Framework\TestCase;
use Trink\Trip\Component\Template\Template;

/**
 * Class ComponentTest
 *
 * @package Test\Trip
 */
class ComponentTest extends TestCase
{
    private static $res_dir;

    /** @before */
    public function init()
    {
        self::$res_dir = dirname(dirname(__DIR__)) . '/res/';
    }

    public function test()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function template()
    {
        $tpl = new Template([
            'php_turn'     => true,
            'debug'        => true,
            'compile_dir'  => self::$res_dir . 'cache/',
            'template_dir' => self::$res_dir . 'template/',
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
