<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Trink\Dp\Factory\Demo\BloggsCommsManager;
use Trink\Dp\Factory\Electronics\Computer;
use Trink\Dp\Factory\Electronics\Computer\AIO;
use Trink\Dp\Factory\Electronics\Computer\Laptop;
use Trink\Dp\Factory\Electronics\Computer\PC;
use Trink\Dp\Factory\Electronics\Computer\Tablet;
use Trink\Dp\Factory\Electronics\Electronics;
use Trink\Dp\Factory\Electronics\Phone;
use Trink\Dp\Factory\Electronics\Phone\Andriod;
use Trink\Dp\Factory\Electronics\Phone\IOS;
use Trink\Dp\Factory\Electronics\Phone\Symbian;
use Trink\Dp\Factory\Electronics\Watch;
use Trink\Dp\Factory\Electronics\Watch\DigitalWatch;
use Trink\Dp\Factory\Electronics\Watch\QuartzWatch;

class FactoryTest extends TestCase
{
    /**
     * @test
     */
    public function demo()
    {
        $bcm = new BloggsCommsManager();
        echo $bcm->getHeaderText();
        var_dump($bcm->getApptEncoder());
        echo $bcm->getFooterText();
        $this->assertTrue(true);
    }

    /**
     * @test
     * @group electronics
     * @group computer
     */
    public function aio()
    {
        $aio = Electronics::computer('AIO');
        $this->assertTrue($aio instanceof AIO);
        $this->assertTrue($aio instanceof Computer);
        $aio->run()->play()->close();
    }

    /**
     * @test
     * @group electronics
     * @group computer
     */
    public function laptop()
    {
        $laptop = Electronics::computer('Laptop');
        $this->assertTrue($laptop instanceof Laptop);
        $this->assertTrue($laptop instanceof Computer);
        $laptop->run()->play()->close();
    }

    /**
     * @test
     * @group electronics
     * @group computer
     */
    public function pc()
    {
        $pc = Electronics::computer('PC');
        $this->assertTrue($pc instanceof PC);
        $this->assertTrue($pc instanceof Computer);
        $pc->run()->play()->close();
    }

    /**
     * @test
     * @group electronics
     * @group computer
     */
    public function tablet()
    {
        $tablet = Electronics::computer('Tablet');
        $this->assertTrue($tablet instanceof Tablet);
        $this->assertTrue($tablet instanceof Computer);
        $tablet->run()->play()->close();
    }

    /**
     * @test
     * @group electronics
     * @group phone
     */
    public function ios()
    {
        $ios = Electronics::phone('IOS');
        $this->assertTrue($ios instanceof IOS);
        $this->assertTrue($ios instanceof Phone);
        $ios->open()->call();
    }

    /**
     * @test
     * @group electronics
     * @group phone
     */
    public function andriod()
    {
        $andriod = Electronics::phone('Andriod');
        $this->assertTrue($andriod instanceof Andriod);
        $this->assertTrue($andriod instanceof Phone);
        $andriod->open()->call();
    }

    /**
     * @test
     * @group electronics
     * @group phone
     */
    public function symbian()
    {
        $symbian = Electronics::phone('Symbian');
        $this->assertTrue($symbian instanceof Symbian);
        $this->assertTrue($symbian instanceof Phone);
        $symbian->open()->call();
    }

    /**
     * @test
     * @group electronics
     * @group watch
     */
    public function digitalWatch()
    {
        $digitalWatch = Electronics::watch('DigitalWatch');
        $this->assertTrue($digitalWatch instanceof DigitalWatch);
        $this->assertTrue($digitalWatch instanceof Watch);
        $digitalWatch->run();
    }

    /**
     * @test
     * @group electronics
     * @group watch
     */
    public function quartzWatch()
    {
        $quartzWatch = Electronics::watch('QuartzWatch');
        $this->assertTrue($quartzWatch instanceof QuartzWatch);
        $this->assertTrue($quartzWatch instanceof Watch);
        $quartzWatch->run();
    }
}
