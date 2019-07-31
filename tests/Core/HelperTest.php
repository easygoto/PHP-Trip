<?php


namespace Test\Trip\Core;

use Test\Trip\TestCase;
use Trink\Core\Container\App;

class HelperTest extends TestCase
{
    public function testArrays()
    {
        $arrays = App::instance()->arrays;
        $list = [
            'a' => '1',
            'b' => '2',
            'c' => '4',
            'd' => '8',
            'e' => [
                'a' => '1',
                'b' => '2',
                'c' => '4',
                'd' => '8',
                'e' => [
                    'a' => '1',
                    'b' => '2',
                    'c' => '4',
                    'd' => '8',
                    'e' => [
                        'a' => '1',
                        'b' => '2',
                        'c' => '4',
                        'd' => '8',
                    ]
                ]
            ]
        ];
        $obj = json_decode(json_encode($list));
        print $arrays::get($obj, 'e.e.a');
        $this->assertTrue(true);
    }
}
