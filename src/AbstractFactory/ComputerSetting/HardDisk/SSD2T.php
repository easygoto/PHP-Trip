<?php


namespace Trink\Dp\AbstractFactory\ComputerSetting\HardDisk;

use Trink\Dp\AbstractFactory\ComputerSetting\HardDisk;

class SSD2T implements HardDisk
{
    public function showSize(): HardDisk
    {
        print "HardDisk Size : 2T\n";
        return $this;
    }

    public function showSpeed(): HardDisk
    {
        print "HardDisk Speed : 440M/s\n";
        return $this;
    }
}
