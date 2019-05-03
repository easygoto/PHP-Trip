<?php


namespace Demo\Test;

use PHPUnit\Framework\TestCase;
use Trink\Demo\Lib\Template\Template;

class AppTest extends TestCase
{
    public function test()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function template()
    {
        $tpl = new Template(['php_turn' => true, 'debug' => true]);
        $tpl->assign('data', 'hello world');
        $tpl->assign('person', 'cafeCAT');
        $tpl->assign('pai', 3.14);
        $arr = [1, 2, 3, 4, "hahattt", 6];
        $tpl->assign('b', $arr);
        $tpl->show('member');
        $this->assertTrue(true);
    }
}
