<?php


namespace Trink\Dp\AbstractFactory\ComputerSetting\Memory;

use Trink\Dp\AbstractFactory\ComputerSetting\Memory;

class Memory2G implements Memory
{
    public function showSize(): Memory
    {
        print "Memory Size : 2G\n";
        return $this;
    }
}
