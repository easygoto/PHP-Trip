<?php

namespace Test\Trip\Dp;

use Test\Trip\TestCase;
use Trink\Dp\Factory\Electronics\Computer;
use Trink\Dp\Factory\Electronics\ComputerFactory;
use Trink\Dp\Factory\Electronics\Phone;
use Trink\Dp\Factory\Electronics\PhoneFactory;
use Trink\Dp\Factory\Electronics\Watch;
use Trink\Dp\Factory\Electronics\WatchFactory;

class FactoryTest extends TestCase
{
    /**
     * @test
     * @group electronics
     * @group computer
     */
    public function aio()
    {
        $aio = ComputerFactory::create('AIO');
        $this->assertTrue($aio instanceof Computer\AIO);
        $this->assertTrue($aio instanceof Computer\Operate);
        $aio->run();
        $aio->play();
        $aio->close();
    }

    /**
     * @test
     * @group electronics
     * @group computer
     */
    public function laptop()
    {
        $laptop = ComputerFactory::create('Laptop');
        $this->assertTrue($laptop instanceof Computer\Laptop);
        $this->assertTrue($laptop instanceof Computer\Operate);
        $laptop->run();
        $laptop->play();
        $laptop->close();
    }

    /**
     * @test
     * @group electronics
     * @group computer
     */
    public function pc()
    {
        $pc = ComputerFactory::create('PC');
        $this->assertTrue($pc instanceof Computer\PC);
        $this->assertTrue($pc instanceof Computer\Operate);
        $pc->run();
        $pc->play();
        $pc->close();
    }

    /**
     * @test
     * @group electronics
     * @group computer
     */
    public function tablet()
    {
        $tablet = ComputerFactory::create('Tablet');
        $this->assertTrue($tablet instanceof Computer\Tablet);
        $this->assertTrue($tablet instanceof Computer\Operate);
        $tablet->run();
        $tablet->play();
        $tablet->close();
    }

    /**
     * @test
     * @group electronics
     * @group phone
     */
    public function ios()
    {
        $ios = PhoneFactory::create('IOS');
        $this->assertTrue($ios instanceof Phone\IOS);
        $this->assertTrue($ios instanceof Phone\Operate);
        $ios->open();
        $ios->call();
    }

    /**
     * @test
     * @group electronics
     * @group phone
     */
    public function andriod()
    {
        $andriod = PhoneFactory::create('Andriod');
        $this->assertTrue($andriod instanceof Phone\Andriod);
        $this->assertTrue($andriod instanceof Phone\Operate);
        $andriod->open();
        $andriod->call();
    }

    /**
     * @test
     * @group electronics
     * @group phone
     */
    public function symbian()
    {
        $symbian = PhoneFactory::create('Symbian');
        $this->assertTrue($symbian instanceof Phone\Symbian);
        $this->assertTrue($symbian instanceof Phone\Operate);
        $symbian->open();
        $symbian->call();
    }

    /**
     * @test
     * @group electronics
     * @group watch
     */
    public function digitalWatch()
    {
        $digitalWatch = WatchFactory::create('Digital');
        $this->assertTrue($digitalWatch instanceof Watch\Digital);
        $this->assertTrue($digitalWatch instanceof Watch\Operate);
        $digitalWatch->run();
    }

    /**
     * @test
     * @group electronics
     * @group watch
     */
    public function quartzWatch()
    {
        $quartzWatch = WatchFactory::create('Quartz');
        $this->assertTrue($quartzWatch instanceof Watch\Quartz);
        $this->assertTrue($quartzWatch instanceof Watch\Operate);
        $quartzWatch->run();
    }
}
