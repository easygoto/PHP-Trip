<?php


use PHPUnit\Framework\TestCase;
use Trink\Dp\Factory\Demo\BloggsCommsManager;
use Trink\Dp\Factory\Electronics\Computer\AIO;
use Trink\Dp\Factory\Electronics\Computer\Laptop;
use Trink\Dp\Factory\Electronics\Computer\PC;
use Trink\Dp\Factory\Electronics\Computer\Tablet;
use Trink\Dp\Factory\Electronics\Electronics;
use Trink\Dp\Factory\Electronics\Phone\Andriod;
use Trink\Dp\Factory\Electronics\Phone\IOS;
use Trink\Dp\Factory\Electronics\Phone\Symbian;

class FactoryTest extends TestCase {

    /**
     * @test
     */
    function demo() {
        $bcm = new BloggsCommsManager();
        echo $bcm->getHeaderText();
        var_dump($bcm->getApptEncoder());
        echo $bcm->getFooterText();
        $this->assertTrue(true);
    }

    /**
     * @group electronics
     * @group computer
     */
    function testAIO() {
        $aio = Electronics::computer('AIO');
        $aio->run()->play()->close();
        $this->assertTrue($aio instanceof AIO);
    }

    /**
     * @group electronics
     * @group computer
     */
    function testLaptop() {
        $laptop = Electronics::computer('Laptop');
        $laptop->run()->play()->close();
        $this->assertTrue($laptop instanceof Laptop);
    }

    /**
     * @group electronics
     * @group computer
     */
    function testPC() {
        $pc = Electronics::computer('PC');
        $pc->run()->play()->close();
        $this->assertTrue($pc instanceof PC);
    }

    /**
     * @group electronics
     * @group computer
     */
    function testTablet() {
        $tablet = Electronics::computer('Tablet');
        $tablet->run()->play()->close();
        $this->assertTrue($tablet instanceof Tablet);
    }

    /**
     * @group electronics
     * @group phone
     */
    function testIOS() {
        $ios = Electronics::phone('IOS');
        $ios->open()->call();
        $this->assertTrue($ios instanceof IOS);
    }

    /**
     * @group electronics
     * @group phone
     */
    function testAndriod() {
        $andriod = Electronics::phone('Andriod');
        $andriod->open()->call();
        $this->assertTrue($andriod instanceof Andriod);
    }

    /**
     * @group electronics
     * @group phone
     */
    function testSymbian() {
        $symbian = Electronics::phone('Symbian');
        $symbian->open()->call();
        $this->assertTrue($symbian instanceof Symbian);
    }
}