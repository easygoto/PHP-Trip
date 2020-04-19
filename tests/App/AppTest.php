<?php

namespace Test\Trip\App;

use Test\Trip\TestCase;

class AppTest extends TestCase
{
    public function test()
    {
        var_dump(method_exists(null, 'ama'));
        $this->assertTrue(true);
    }

    public function test4()
    {
        $a = 123;
        $b = 'welcome';
        $c = new \stdClass();
        $arr = compact('a', 'b', 'c');
        $this->assertEquals($b, $arr['b']);

        $brr = [
            'x' => 123,
            'y' => 'welcome',
            'z' => new \stdClass(),
        ];
        extract($brr);
        /** @var $y */
        $this->assertEquals($brr['y'], $y);
    }

    public function test3()
    {
        var_dump($a ?? 1);
        var_dump(null ?? 1);
        var_dump(false ?? 1);
        var_dump(0 ?? 1);

        var_dump(false ?: 1);
        var_dump(null ?: 1);
        var_dump('' ?: 1);
        var_dump('0' ?: 1);
        var_dump(0 ?: 1);

        $this->assertTrue(true);
    }

    public function test2()
    {
        $content = file_get_contents('http://www.3dmgame.com/games/Starcraft/');
        $pattern = '/(<h1>(?<name>.*)<\/h1>)|' .
            '(<li>类型：(?<type>.*)<\/li>)|' .
            '(<font>(?<score>[\d.]*)<\/font>)/';
        preg_match_all($pattern, $content, $matches);
        $type = $matches['type'][1] ?? '';
        $name = $matches['name'][0] ?? '';
        $score = $matches['score'][2] ?? '';
        echo "{$type} {$name}, {$score}\n";
        $this->assertTrue(true);
    }
}
