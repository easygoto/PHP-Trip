<?php


namespace Test\Demo;

use PHPUnit\Framework\TestCase;
use Trink\Demo\Component\Template\Template;

class AppTest extends TestCase
{
    private $res_dir;

    /** @before */
    public function init()
    {
        $this->res_dir = dirname(__DIR__) . '/res/';
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
            'compile_dir'  => $this->res_dir . 'cache/',
            'template_dir' => $this->res_dir . 'template/',
        ]);
        $tpl->assign('data', 'hello world');
        $tpl->assign('person', 'cafeCAT');
        $tpl->assign('pai', 3.14);
        $arr = [1, 2, 3, 4, "hahattt", 6];
        $tpl->assign('b', $arr);
        $tpl->show('member');
        $this->assertTrue(true);
    }
}
