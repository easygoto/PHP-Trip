<?php

namespace Test\Trip\Dp;

use Test\Trip\TestCase;
use Trink\App\Dp\AbstractFactory\ComputerSetting\Computer;
use Trink\App\Dp\AbstractFactory\ComputerSetting\Computer\HighPC;
use Trink\App\Dp\AbstractFactory\ComputerSetting\Computer\LowPC;
use Trink\App\Dp\AbstractFactory\ComputerSetting\CPU;
use Trink\App\Dp\AbstractFactory\ComputerSetting\CPU\CPU2400MHzCore4;
use Trink\App\Dp\AbstractFactory\ComputerSetting\CPU\CPU4000MHzCore8;
use Trink\App\Dp\AbstractFactory\ComputerSetting\HardDisk;
use Trink\App\Dp\AbstractFactory\ComputerSetting\HardDisk\HDD256G5400RPM;
use Trink\App\Dp\AbstractFactory\ComputerSetting\HardDisk\SSD256G;
use Trink\App\Dp\AbstractFactory\ComputerSetting\Memory;
use Trink\App\Dp\AbstractFactory\ComputerSetting\Memory\Memory2G;
use Trink\App\Dp\AbstractFactory\ComputerSetting\Memory\Memory4G;
use Trink\App\Dp\AbstractFactory\ComputerSetting\Memory\Memory8G;

class AbstractFactoryTest extends TestCase
{
    /** @test */
    public function cpu()
    {
        $CPU2400_4 = (new CPU2400MHzCore4())->showCore()->showFrequency();
        $this->assertTrue($CPU2400_4 instanceof CPU);

        $CPU4000_8 = (new CPU4000MHzCore8())->showCore()->showFrequency();
        $this->assertTrue($CPU4000_8 instanceof CPU);
    }

    /** @test */
    public function memory()
    {
        $G2 = (new Memory2G())->showSize();
        $this->assertTrue($G2 instanceof Memory);

        $G4 = (new Memory4G())->showSize();
        $this->assertTrue($G4 instanceof Memory);

        $G8 = (new Memory8G())->showSize();
        $this->assertTrue($G8 instanceof Memory);
    }

    /** @test */
    public function hardDisk()
    {
        $hdd = (new HDD256G5400RPM())
            ->showSize()
            ->showSpeed()
            ->showType();
        $this->assertTrue($hdd instanceof HardDisk);

        $ssd = (new SSD256G())
            ->showSize()
            ->showSpeed()
            ->showType();
        $this->assertTrue($ssd instanceof HardDisk);
    }

    /** @test */
    public function high()
    {
        $highPC = HighPC::instance()->info();
        $this->assertTrue($highPC instanceof HighPC);
        $this->assertTrue($highPC instanceof Computer);
    }

    /** @test */
    public function low()
    {
        $lowPC = LowPC::instance()->info();
        $this->assertTrue($lowPC instanceof LowPC);
        $this->assertTrue($lowPC instanceof Computer);
    }
}
