<?php

namespace Test\Trip\App;

use Test\Trip\TestCase;
use Trink\App\Trip\Demo\Template\Template;

class TemplateTest extends TestCase
{
    /** @test */
    public function template()
    {
        $tpl = new Template([
            'php_turn'     => true,
            'debug'        => true,
            'compile_dir'  => TEMP_DIR . 'template/compile/',
            'template_dir' => TEMP_DIR . 'template/template/',
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
