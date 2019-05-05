<?php


namespace Trink\Dp\AbstractFactory\ComputerSetting\HardDisk;

use Trink\Dp\AbstractFactory\ComputerSetting\HardDisk;

class HDD512G5400 implements HardDisk
{
    public function showSize(): HardDisk
    {
        print "HardDisk Size : 512G\n";
        return $this;
    }

    public function showSpeed(): HardDisk
    {
        print "HardDisk Speed : 54M/s\n";
        return $this;
    }
}
