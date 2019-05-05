<?php


namespace Trink\Dp\AbstractFactory\ComputerSetting\Memory;

use Trink\Dp\AbstractFactory\ComputerSetting\Memory;

class Memory4G implements Memory
{
    public function showSize(): Memory
    {
        print "Memory Size : 4G\n";
        return $this;
    }
}
