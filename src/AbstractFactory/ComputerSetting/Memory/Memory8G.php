<?php


namespace Trink\Dp\AbstractFactory\ComputerSetting\Memory;

use Trink\Dp\AbstractFactory\ComputerSetting\Memory;

class Memory8G implements Memory
{
    public function showSize(): Memory
    {
        print "Memory Size : 8G\n";
        return $this;
    }
}
