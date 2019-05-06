<?php


namespace Dp\Test;

use PHPUnit\Framework\TestCase;
use Trink\Dp\AbstractFactory\ComputerSetting\Computer\High4PC;
use Trink\Dp\AbstractFactory\ComputerSetting\Computer\Low4PC;
use Trink\Dp\AbstractFactory\ComputerSetting\Memory;

class AbstractFactoryTest extends TestCase
{
    public function test()
    {

        $this->assertTrue(true);
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
