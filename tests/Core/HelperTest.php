<?php


namespace Test\Trip\Core;

use Test\Trip\TestCase;
use Trink\Core\Helper\Arrays;
use Trink\Core\Helper\Image;

class HelperTest extends TestCase
{
    public function testImage()
    {
        $image = Image::load(TEMP_DIR . 'gd/test.jpg');
        $image->reset()->crop()->savePath();
        $image->reset()->scale(200)->savePath();
        $image->reset()->watermark(TEMP_DIR . 'gd/mark.jpg')->savePath();
        $image->reset()->watermark(TEMP_DIR . 'gd/mark.jpg', 'RU')->savePath();
        $image->reset()->watermark(TEMP_DIR . 'gd/mark.jpg', 'LD')->savePath();
        $image->reset()->watermark(TEMP_DIR . 'gd/mark.jpg', 'LU')->savePath();
        $image->reset()->crop()->scale(200)->savePath();
        $image->reset()->crop()->watermark(TEMP_DIR . 'gd/mark.jpg')->savePath();
        $image->reset()->scale(200)->crop()->savePath();
        $image->reset()->scale(200)->watermark(TEMP_DIR . 'gd/mark.jpg')->savePath();
        $image->reset()->crop()->scale(200)->watermark(TEMP_DIR . 'gd/mark.jpg')->savePath();
        $image->reset()->scale(200)->crop()->watermark(TEMP_DIR . 'gd/mark.jpg')->savePath();
        $this->assertTrue(true);
    }

    public function testArrays()
    {
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
        print Arrays::get($obj, 'e.e.a');
        $this->assertTrue(true);
    }
}
