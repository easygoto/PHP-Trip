<?php


namespace Test\Trip\Core;

use Test\Trip\TestCase;
use Trink\Core\Helper\Arrays;
use Trink\Core\Helper\Image;

class HelperTest extends TestCase
{
    public function testImage()
    {
        $image = Image::load(TEMP_DIR . 'test.jpg');
        $targetImagePath = $image->watermark(TEMP_DIR . 'test.jpg');
        var_dump($targetImagePath);

        $result = Image::toBase64(TEMP_DIR . 'test.jpg');
        file_put_contents(TEMP_DIR . 'temp.txt', $result);
        file_put_contents(TEMP_DIR . 'temp.jpg', base64_decode($result));
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
