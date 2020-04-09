<?php

namespace Test\Trip\App;

use Imagick;
use ImagickDraw;
use ImagickException;
use ImagickPixel;
use Test\Trip\TestCase;

class ImagickTest extends TestCase
{
    /** @test */
    public function captcha()
    {
        $imagick = new Imagick();
        $imagickDraw = new ImagickDraw();
        $imagickDraw->setFontSize(20);

        $bg = new ImagickPixel();
        $bg->setColor('white');
        $string = substr(str_shuffle('ABXZRMHTL23456789'), 2, 6);
        $imagick->newImage(85, 30, $bg);
        $imagick->annotateImage($imagickDraw, 4, 20, 0, $string);
        $imagick->swirlImage(20);

        $imagickDraw->line(rand(0, 70), rand(0, 30), rand(0, 70), rand(0, 30));
        $imagickDraw->line(rand(0, 70), rand(0, 30), rand(0, 70), rand(0, 30));
        $imagickDraw->line(rand(0, 70), rand(0, 30), rand(0, 70), rand(0, 30));
        $imagickDraw->line(rand(0, 70), rand(0, 30), rand(0, 70), rand(0, 30));
        $imagickDraw->line(rand(0, 70), rand(0, 30), rand(0, 70), rand(0, 30));

        $imagick->drawImage($imagickDraw);
        $imagick->setImageFormat('png');
        $imagick->writeImage(TEMP_DIR . 'imagick/captcha.png');
        $this->assertTrue(true);
    }

    /** @test */
    public function thumb()
    {
        $imagick = new Imagick();
        try {
            $imagick->readImage(TEMP_DIR . 'imagick/test.jpg');
        } catch (ImagickException $e) {
        }
        $imagick->thumbnailImage(100, null);
        $imagick->writeImage(TEMP_DIR . 'imagick/thumb.jpg');
        $imagick->destroy();
        $this->assertTrue(true);
    }

    /** @test */
    public function watermark()
    {
        $imagick = new Imagick();
        $imagickDraw = new ImagickDraw();
        $imagickDraw->setFontSize(50);
        try {
            $imagick->readImage(TEMP_DIR . 'imagick/test.jpg');
        } catch (ImagickException $e) {
        }
        $imagickDraw->setGravity(Imagick::GRAVITY_CENTER);
        $imagick->annotateImage($imagickDraw, 4, 20, 0, "Test Watermark");
        $imagick->setImageFormat('png');
        $imagick->writeImage(TEMP_DIR . 'imagick/water.png');
        $this->assertTrue(true);
    }
}
