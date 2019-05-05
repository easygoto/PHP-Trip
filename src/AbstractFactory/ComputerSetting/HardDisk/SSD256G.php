<?php


namespace Trink\Dp\AbstractFactory\ComputerSetting\HardDisk;

use Trink\Dp\AbstractFactory\ComputerSetting\HardDisk;

class SSD256G implements HardDisk
{
    public function showSize(): HardDisk
    {
        print "HardDisk Size : 256G\n";
        return $this;
    }

    public function showSpeed(): HardDisk
    {
        print "HardDisk Speed : 440M/s\n";
        return $this;
    }
}
