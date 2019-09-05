<?php


namespace Test\Trip\App\Demo;

use Test\Trip\TestCase;
use Trink\Trip\App\Demo\Template\Template;

class TempTest extends TestCase
{
    /** @test */
    public function template()
    {
        $tpl = new Template([
            'php_turn'     => true,
            'debug'        => true,
            'compile_dir'  => RES_DIR . 'temp/',
            'template_dir' => RES_DIR . 'template/',
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