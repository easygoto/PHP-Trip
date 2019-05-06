<?php


namespace Dp\Test;

use PHPUnit\Framework\TestCase;
use Trink\Dp\AbstractFactory\ComputerSetting\Computer\High4PC;
use Trink\Dp\AbstractFactory\ComputerSetting\Computer\Low4PC;
use Trink\Dp\AbstractFactory\ComputerSetting\HardDisk;
use Trink\Dp\AbstractFactory\ComputerSetting\HardDisk\HDD256G5400RPM;
use Trink\Dp\AbstractFactory\ComputerSetting\HardDisk\SSD256G;
use Trink\Dp\AbstractFactory\ComputerSetting\Memory;

class AbstractFactoryTest extends TestCase
{
    /** @test */
    public function hardDisk()
    {
        $hdd = (new HDD256G5400RPM)
            ->showSize()
            ->showSpeed()
            ->showType();
        $this->assertTrue($hdd instanceof HardDisk);

        $ssd = (new SSD256G)
            ->showSize()
            ->showSpeed()
            ->showType();
        $this->assertTrue($ssd instanceof HardDisk);
    }

    /** @test */
    public function high()
    {
        $highPC = new High4PC();
        $highPC->cpu()->showCore()->showFrequency();
        $highPC->hardDisk()->showSize()->showSpeed();
        array_map(function ($memory) {
            /** @var Memory $memory */
            $memory->showSize();
        }, $highPC->memory());
        $this->assertTrue(true);
    }

    /** @test */
    public function low()
    {
        $highPC = new Low4PC();
        $highPC->cpu()->showCore()->showFrequency();
        $highPC->hardDisk()->showSize()->showSpeed();
        array_map(function ($memory) {
            /** @var Memory $memory */
            $memory->showSize();
        }, $highPC->memory());
        $this->assertTrue(true);
    }
}
