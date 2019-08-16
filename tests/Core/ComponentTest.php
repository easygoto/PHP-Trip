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
