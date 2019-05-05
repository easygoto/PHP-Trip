<?php


namespace Trink\Dp\AbstractFactory\ComputerSetting\HardDisk;

use Trink\Dp\AbstractFactory\ComputerSetting\HardDisk;

class HDD1T7200 implements HardDisk
{
    public function showSize(): HardDisk
    {
        print "HardDisk Size : 1T\n";
        return $this;
    }

    public function showSpeed(): HardDisk
    {
        print "HardDisk Speed : 72M/s\n";
        return $this;
    }
}
